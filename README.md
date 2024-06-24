
# WIS Funds App

Welcome to the WIS Funds App, an application built using Laravel 11. This app is designed to manage and track fund transactions efficiently. Below you will find instructions on setting up, running, and contributing to the WIS Funds App.

## Table of Contents

- [Features](#features)

- [Requirements](#requirements)

- [Installation](#installation)

- [Configuration](#configuration)

- [Usage](#usage)

- [Testing](#testing)

- [License](#license)

## Features

- User authentication and authorization

- Fund management (create, update, delete funds)

- Transaction tracking

- Reporting and analytics

- User-friendly interface

## Requirements

- PHP 8.1 or higher

- Composer

- MySQL or PostgreSQL

- Node.js and npm (for front-end assets)

## Installation

1. Clone the repository:

```
git clone <https://github.com/rend1507/wis-funds-app.git>

cd wis-funds-app
```
  
2. Install dependencies:

```
composer install

npm install

npm run build
```
  
3. Set up the environment file:

```
cp .env.example .env
```
  
4. Generate an application key:

php artisan key:generate

## Configuration

1. Update the `.env` file with your database and other configurations:

```
APP_NAME="WIS Funds App"

APP_ENV=local

APP_KEY=base64:...

APP_DEBUG=true

APP_URL=<http://localhost>

  

DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=wis_funds_app

DB_USERNAME=root

DB_PASSWORD=

  

MAIL_MAILER=smtp

MAIL_HOST=smtp.mailtrap.io

MAIL_PORT=2525

MAIL_USERNAME=null

MAIL_PASSWORD=null

MAIL_ENCRYPTION=null

MAIL_FROM_ADDRESS=null

MAIL_FROM_NAME="${APP_NAME}"
```
  
2. Run the database migrations and seeders:

```
php artisan migrate --seed
```
  
## Usage

1. Start the development server:

```
php artisan serve
```
  
2. Open your browser and visit `http://localhost:8000` to access the WIS Funds App.

## Testing

1. Run the tests:

```
php artisan test
```

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
