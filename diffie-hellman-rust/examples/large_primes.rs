use diffie_hellman_rust::primes;
use std::time::Instant;
use text_io::read;

pub fn main() {
    print!("Enter the prime number size in bytes: ");
    let size: usize = read!();

    print!("Enter the amount of times to test: ");
    let num: usize = read!();

    let mut total_elapsed: f32 = 0.0;

    for _ in 0..num {
        let now = Instant::now();
        primes::get_prime(size);
        total_elapsed += now.elapsed().as_secs_f32();
    }

    println!(
        "The average time to generate a prime with {size} byte length is: {}s",
        total_elapsed / (num as f32)
    );
}
