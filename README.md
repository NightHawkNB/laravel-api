# Arctiq Backend (Laravel)

This is the backend part of the Arctiq application built with Laravel.

---

## Prerequisites
- PHP 8.x
- Composer
- MySQL
- Laravel

---

## Setup

1. Install the necessary backend dependencies:

    ```bash
    composer install
    ```

2. Create a new MySQL database named `arctiq_api`:

    ```sql
    CREATE DATABASE arctiq_api;
    ```

3. Copy the `.env.example` file to `.env` and configure your database connection:

    ```bash
    cp .env.example .env
    ```

    Update the following lines in the `.env` file:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=arctiq_api
    DB_USERNAME=your_mysql_username ('root' by default)
    DB_PASSWORD=your_mysql_password (no password by default)
    ```

4. Generate an application key:

    ```bash
    php artisan key:generate
    ```

5. Run the migrations and seeders to set up the database:

    ```bash
    php artisan migrate --seed
    ```

6. Serve the Laravel backend:

    ```bash
    php artisan serve
    ```

---

## API Endpoints

Here are the available API endpoints for the Arctiq application. For detailed request and response formats, please use the attached Postman collection file: **Arctiq-api.postman_collection.json**.

### Suppliers
- **GET /suppliers/get** - Get all suppliers
- **GET /suppliers/get/{id}** - Get a supplier by ID
- **GET /suppliers/getAll?page=1** - Get paginated list of suppliers
- **PATCH /suppliers/update/{id}** - Update supplier by ID
- **DELETE /suppliers/delete/{id}** - Delete supplier by ID
- **POST /suppliers/create** - Create a new supplier
- **POST /suppliers/search** - Search suppliers by mobile number

### Products
- **POST /products/create/{supplier_id}** - Create a product for a supplier
- **POST /products/createMultiple/{supplier_id}** - Create multiple products for a supplier
- **GET /products/getAll** - Get all products
- **GET /products/get/sup/{supplier_id}** - Get products by supplier ID
- **PATCH /products/update/{id}** - Update a product by ID
- **DELETE /products/delete/{id}** - Delete a product by ID

---

## Postman Collection

To simplify API testing, use the provided Postman collection: **Arctiq-api.postman_collection.json**. This collection contains all the pre-configured API endpoints for suppliers and products.

---

## Notes

- Ensure that both the frontend and backend servers are running for full functionality.
