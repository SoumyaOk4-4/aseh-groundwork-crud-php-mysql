# PHP and MySQL Student CRUD

A small learning project for practicing PHP database access and the CRUD operations—create, read, update, and delete—with MySQL. It provides a simple student manager for storing student names and courses.

## What you'll learn

- Connect PHP to MySQL with PDO
- Create and query a MySQL table
- Use prepared statements for database writes and lookups
- Build a basic HTML form and table with PHP
- Implement create, read, update, and delete flows

## Requirements

- PHP with the PDO MySQL extension enabled
- MySQL

## Setup

1. Create the database and sample table by running `setup.sql` once:

   ```sh
   mysql -u root -p < setup.sql
   ```

   Alternatively, open `setup.sql` in a MySQL client and execute it. The script creates the `aseh_crud` database and `students` table, then inserts sample rows. Running it again will insert the sample rows again.

2. Update the connection settings in `db.php` to match your local MySQL host, database, username, and password.

3. From the project directory, start PHP's built-in development server:

   ```sh
   php -S localhost:8000
   ```

4. Open [http://localhost:8000](http://localhost:8000) in your browser.

## Project files

- `index.php` — student list and create, edit, and delete actions
- `db.php` — PDO database connection
- `setup.sql` — database, table, and sample data setup

## Learning/demo use

This project is intended for local learning and experimentation. Before deploying an application based on it, review and add appropriate production safeguards, including secure configuration management and request protections.

## License

This project is available under the [MIT License](LICENSE).
