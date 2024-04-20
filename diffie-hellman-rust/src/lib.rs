pub mod random {
    use num_bigint::BigUint;
    use rand::Rng;

    pub fn get_odd_bytes(size: usize) -> BigUint {
        let mut bytes: Vec<u8> = Vec::with_capacity(size);
        let mut rng = rand::thread_rng();

        for _ in 0..size {
            bytes.push(rng.gen());
        }

        bytes[0] = bytes[0] | 128;
        bytes[size - 1] = bytes[size - 1] | 1;

        BigUint::from_bytes_be(&bytes)
    }

    pub fn get_even_bytes(size: usize) -> BigUint {
        let mut bytes: Vec<u8> = Vec::with_capacity(size);
        let mut rng = rand::thread_rng();

        for i in 0..size {
            bytes.push(rng.gen());

            if i == 0 {
                bytes[i] = bytes[i] ^ 128;
            } else if i == size - 1 {
                bytes[i] = bytes[i] | 1;
            }
        }

        BigUint::from_bytes_be(&bytes)
    }

    pub fn get_bytes(size: usize) -> BigUint {
        let mut bytes: Vec<u8> = Vec::with_capacity(size);
        let mut rng = rand::thread_rng();

        for i in 0..size {
            bytes.push(rng.gen());

            if i == 0 {
                bytes[i] = bytes[i] | 255;
            }
        }

        BigUint::from_bytes_be(&bytes)
    }
}

pub mod primes {
    use super::random;
    use num_bigint::{BigUint, RandBigInt};
    use num_integer::Integer;
    use num_iter;
    use num_traits::{One, Zero};

    pub fn miller_rabin(n: &BigUint, k: usize) -> bool {
        let mut rng = rand::thread_rng();

        if n <= &BigUint::one() {
            return false;
        }

        if n == &BigUint::from(2_u8) || n == &BigUint::from(3_u8) {
            return true;
        }

        if n.is_even() {
            return false;
        }

        let mut r: u64 = 0;
        let mut d: BigUint = n - 1_u8;

        while d.is_even() {
            r += 1;
            d >>= 1;
        }

        for _ in 0..k {
            let a = rng.gen_biguint_range(&BigUint::from(2_u8), &(n - 2_u8));
            let mut x = a.modpow(&d, n);

            if x == BigUint::one() || x == (n - BigUint::one()) {
                continue;
            }

            for _ in 1..r {
                x = x.modpow(&BigUint::from(2_u8), n);

                if x == (n - BigUint::one()) {
                    break;
                }
            }

            if x != (n - BigUint::one()) {
                return false;
            }
        }

        true
    }

    pub fn get_prime(size: usize) -> BigUint {
        let mut prime = random::get_odd_bytes(size);

        while !miller_rabin(&prime, 40) {
            prime = random::get_odd_bytes(size);
        }

        prime
    }

    pub fn get_factors(num: &BigUint) -> Vec<BigUint> {
        let mut factors: Vec<BigUint> = Vec::new();
        let mut n = num.clone();

        for i in num_iter::range_step_inclusive(BigUint::from(2u8), n.sqrt(), BigUint::one()) {
            while &n % &i == BigUint::zero() {
                factors.push(i.clone());
                n /= &i;
            }

            if n == BigUint::one() {
                break;
            }
        }

        if n > BigUint::one() {
            factors.push(n);
        }

        factors
    }

    pub fn get_primitive_root(p: &BigUint) -> Option<BigUint> {
        let phi = p.clone() - BigUint::one();

        let factors = get_factors(&phi);

        for g in num_iter::range_step_inclusive(BigUint::from(2u8), p.clone(), BigUint::one()) {
            let mut is_primitive_root = true;

            for factor in &factors {
                let exp = &phi / factor;
                if g.modpow(&exp, p) == BigUint::one() {
                    is_primitive_root = false;
                    break;
                }
            }

            if is_primitive_root {
                return Some(g);
            }
        }

        None
    }
}

pub mod crypto {
    use num_bigint::BigUint;
    use num_traits::Zero;
    use std::{
        collections::HashMap,
        str::{self, FromStr},
        thread, time,
    };

    use super::primes;

    pub struct Client {
        modulus: BigUint,
        base: BigUint,
        private_key: BigUint,
        shared_key: BigUint,
        client: reqwest::Client,
        server_name: String,
        name: String,
        bytes: usize,
    }

    impl Client {
        pub fn init(name: &str, server_name: &str, bytes: usize) -> Client {
            Client {
                name: String::from(name),
                client: reqwest::Client::new(),
                server_name: String::from(server_name),
                private_key: primes::get_prime(bytes),
                shared_key: BigUint::zero(),
                modulus: BigUint::zero(),
                base: BigUint::zero(),
                bytes,
            }
        }

        pub async fn negotiate_constants(&mut self) -> Result<(), reqwest::Error> {
            self.modulus = primes::get_prime(self.bytes);
            self.base = primes::get_primitive_root(&self.modulus).unwrap();

            let mut map = HashMap::new();

            map.insert("modulus", self.modulus.to_string());
            map.insert("base", self.base.to_string());
            map.insert("name", self.name.to_string());

            let res = self
                .client
                .post(self.server_name.to_owned() + "/negotiate")
                .json(&map)
                .send()
                .await?;

            if res.status() == reqwest::StatusCode::CONFLICT {
                let body: HashMap<String, String> = res.json().await?;

                self.modulus = BigUint::from_str(body.get("modulus").unwrap()).unwrap();
                self.base = BigUint::from_str(body.get("base").unwrap()).unwrap();
            }

            println!("{}, {}", self.modulus, self.base);

            Ok(())
        }

        pub async fn exchange(&mut self) -> Result<(), reqwest::Error> {
            let public_key = self.base.modpow(&self.private_key, &self.modulus);

            let mut map = HashMap::new();
            map.insert("key", public_key.to_string());
            map.insert("name", self.name.to_string());

            let mut res = self
                .client
                .post(self.server_name.to_owned() + "/key")
                .json(&map)
                .send()
                .await?;

            while res.status() == reqwest::StatusCode::ACCEPTED {
                thread::sleep(time::Duration::from_secs(1));

                res = self
                    .client
                    .post(self.server_name.to_owned() + "/key")
                    .json(&map)
                    .send()
                    .await?;
            }

            let body: HashMap<String, String> = res.json().await?;

            let other_public_key = BigUint::from_str(body.get("key").unwrap()).unwrap();

            println!("mine: {}", public_key);
            println!("other: {}", other_public_key);

            self.shared_key = other_public_key.modpow(&self.private_key, &self.modulus);

            println!("{}", self.shared_key);

            Ok(())
        }

        pub async fn reset(&mut self) -> Result<(), reqwest::Error> {
            self.base = BigUint::zero();
            self.modulus = BigUint::zero();
            self.private_key = primes::get_prime(self.bytes);
            self.shared_key = BigUint::zero();

            self.client
                .get(self.server_name.to_owned() + "/reset")
                .send()
                .await?;

            Ok(())
        }
    }
}
