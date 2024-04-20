use diffie_hellman_rust::crypto;

use text_io::read;

#[tokio::main]
async fn main() -> Result<(), reqwest::Error> {
    print!("Enter client name: ");
    let name: String = read!();

    print!("Enter keysize in bytes: ");
    let bytes: usize = read!();

    let mut client = crypto::Client::init(&name, "http://localhost:3000", bytes);

    let mut input: String;

    loop {
        print!("Enter [exchange], [reset], or [quit]: ");
        input = read!();

        match input.as_str() {
            "exchange" => {
                client.negotiate_constants().await?;
                client.exchange().await?;
            }
            "reset" => {
                client.reset().await?;
            }
            "quit" => {
                break;
            }
            &_ => {
                println!("Please enter one of the options !");
            }
        }
    }

    Ok(())
}
