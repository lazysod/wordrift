# Wordrift

Wordrift is a Wordle-inspired word guessing game powered by the Strata PHP Framework.

## Quick Start

1. **Clone the repository**
2. **Install Composer dependencies:**
   - Run `composer install` in the project root to install PHP dependencies.
3. **Copy and configure settings:**
   - Copy `htdocs/app/config-example.php` to `htdocs/app/config.php` and update your site settings.
   - Copy `htdocs/app/mail_config-example.php` to `htdocs/app/mail_config.php` and update mail settings (optional).
   - Copy `htdocs/app/db_conf.php` if you have an existing database config, or let the installer create it.
4. **Prepare your environment:**
   - Ensure you have PHP and MySQL/MariaDB installed.
   - Set up your web server to serve the `htdocs/` directory.
5. **Run the installer:**
   - Open `/app/install.php` in your browser and follow the step-by-step instructions.
   - The installer will check for required config files and set up the database.

## Installation Steps

- Before running the installer, make sure you have created and configured:
  - `htdocs/app/config.php`
  - `htdocs/app/mail_config.php`
- The installer will fail if these files are missing.
- The installer will create `db_conf.php` for your database credentials.

## After Installation

- Remove or secure `/app/install.php` for security.
- Log in to the admin panel to configure game settings and manage users.

## Troubleshooting

- If you see errors about missing config files, copy the example files and update them.
- For more detailed documentation, see the `/docs/` directory.

## License

This project is licensed under the MIT License.

---
For advanced configuration and developer documentation, see `/docs/`.
---
For any issues contact me on https://barrysmith.dev