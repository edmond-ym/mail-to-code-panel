# Mail Code Communication Tool

Welcome to the Mail Code Communication Tool! This project is designed to provide a secure and spam-free alternative to traditional email systems by using a unique Mail Code system for each user.

## Project Overview

The Mail Code system uses a two-part code to facilitate secure communication:

- **Public Code (XXXXXXX)**: A unique identifier that you can share freely with others.
- **Private Code (YYYYYY)**: Acts as a security measure, similar to a door access card. Each Private Code is unique to the sender-receiver pair.

## How It Works

1. **Creating an Account**: Sign up on the Mail Code platform to get your unique Public Code.
2. **Generating Private Codes**: For each contact you want to communicate with, generate a unique Private Code.
3. **Sending Mail**: When someone wants to send you a message, they need to enter both your Public Code and the unique Private Code you provided them.
4. **Preventing Spam**: If you receive unwanted messages, simply revoke the Private Code used by the sender. This will prevent them from sending you any more messages using that code.

## Features

- **Spam Prevention**: Easily revoke Private Codes to block unwanted messages.
- **Security**: Private Codes act as an additional security layer, making it difficult for spammers to send you unsolicited messages.
- **User-Friendly Interface**: Compatible with both mobile and desktop devices for seamless communication.

## Technology Stack

- **Backend**: Laravel
- **Frontend**: VueJS
- **Database**: MySQL
- **Languages**: PHP, JavaScript

## Getting Started

### Prerequisites

- PHP >= 8.3
- Composer
- Node.js
- MySQL

### Installation

1. Clone the repository:

    ```sh
    git clone https://github.com/edmond-ym/mail-to-code-panel.git
    cd mail-to-code-panel
    ```

2. Install backend dependencies:

    ```sh
    composer install
    ```

3. Install frontend dependencies:

    ```sh
    npm install
    ```

4. Environment Configuration:

    - Copy `.env.example` to `.env`:
    
        ```sh
        cp .env.example .env
        ```
    
    - Update `.env` with your database and other configurations.

5. Generate Application Key:

    ```sh
    php artisan key:generate
    ```

6. Run Migrations:

    ```sh
    php artisan migrate
    ```

7. Build Frontend Assets:

    ```sh
    npm run dev
    ```

8. Start the Development Server:

    ```sh
    php artisan serve
    ```

Visit [http://localhost:8000](http://localhost:8000) in your browser to see the application.

## Usage

1. **Sign Up**: Create an account on the platform to get your unique Public Code.
2. **Generate Private Codes**: Generate unique Private Codes for each contact.
3. **Send Messages**: Use the Public Code and Private Code to send secure messages.
4. **Manage Codes**: Revoke Private Codes to block unwanted senders.

## Contributing

We welcome contributions to improve the Mail Code Communication Tool! Here’s how you can contribute:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature/your-feature`).
3. Commit your changes (`git commit -m 'Add some feature'`).
4. Push to the branch (`git push origin feature/your-feature`).
5. Open a pull request.

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Acknowledgements

Thank you to the contributors of Laravel, VueJS, and MySQL for their excellent tools and documentation.

## Contact

If you have any questions or feedback, please reach out at [edmond@inchoatae.com](mailto:edmond@inchoatae.com).


