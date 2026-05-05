# Aroma Pharmacy

Aroma Pharmacy is a PHP/MySQL pharmaceutical e-commerce platform with a customer storefront, doctor consultation options, a chatbot, and an admin dashboard for management.

## Features
- Browse and purchase medicines with product details and search.
- Consult with doctors via WhatsApp, email, or the AroBot chatbot.
- Dynamic cart and checkout with multiple payment options.
- Health articles and wellness content.
- Admin panel for products, orders, customers, and content management.

## Tech Stack
- Frontend: HTML, CSS, JavaScript, Bootstrap
- Backend: PHP (mysqli)
- Database: MySQL/MariaDB

## Project Structure
- `admin_area/` – admin dashboard, product/order management, uploads
- `customer/` – customer authentication and account pages
- `includes/`, `functions/` – shared PHP helpers and DB connection
- `others/p/database.sql` – chatbot tables with sample data
- Root `*.php` files – main storefront pages and flows
- `image/`, `admin_area/*_images`, `admin_area/uploads/` – assets and uploads

## Local Development

### Prerequisites
- PHP 7.4+ with the mysqli extension
- MySQL/MariaDB
- Apache/Nginx or the PHP built-in server
- (Optional) XAMPP/WAMP/LAMP stack

### Setup
Before you start: the repository only includes SQL for chatbot tables. You also need the ecommerce schema for core features. It should include tables like `admins`, `products`, `product_category`, `categories`, `cart`, `customers`, `customer_order`, `payments`, `slider`, `boxes_section`, `articles`, `contact`, `password_resets`, and `user_chats`. Export the full schema from an existing deployment or request it from the project owner, then import it into your local database.

1. Create a MySQL database (the default config uses `aroinsa`, but you can choose any name if you update the config files in step 4).
2. Import the full ecommerce schema into the database.
3. Import the chatbot schema from `others/p/database.sql`.
4. Update database credentials in:
   - `config.php`
   - `admin_area/config.php`
   - `database.inc.php`
   - `includes/db.php`
5. Ensure upload directories are writable:
   - `admin_area/admin_images`
   - `admin_area/product_images`
   - `admin_area/slider_images`
   - `admin_area/uploads`

### Run
From the repository root:

```bash
php -S localhost:8000
```

Open http://localhost:8000 in your browser.

Admin login: http://localhost:8000/admin_area/login.php (requires an `admins` record).
