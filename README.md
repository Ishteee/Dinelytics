# Dinelytics — Restaurant Analytics Dashboard

**Dinelytics** is a web-based analytics dashboard built with Laravel and Tailwind CSS, designed to help restaurant owners track and understand their order data. The application provides insights such as total revenue, popular dishes, and revenue trends over time, all in a simple and responsive interface.

**Live Demo:** [Visit Site](https://dinelytics-main-ncybau.laravel.cloud/)  
_This project is deployed using [Laravel Cloud](https://cloud.laravel.com/)._

---

## Screenshots

### Dashboard Overview
<img src="https://github.com/user-attachments/assets/90f2d13e-0745-4abd-9224-c120c2a2ce80" alt="Dashboard Screenshot" width="100%" />

### Dishes Table
<img src="https://github.com/user-attachments/assets/94b02329-76a5-40fa-bb92-f9b2e723d32d" alt="Dishes Table Screenshot" width="100%" />

### Orders Table with Filters
<img src="https://github.com/user-attachments/assets/fc193f07-fb92-4a3c-94d9-0f5d523fbda5" alt="Orders Table Screenshot" width="100%" />

---

## Features

- **Interactive Dashboard**  
  The main dashboard displays key performance metrics including total revenue, total orders, and average order value.

- **Visual Revenue Trends**  
  A line chart powered by Chart.js shows daily revenue trends for the past 30 days.

- **Most Ordered Dishes**  
  Highlights the most frequently ordered menu items, helping identify top-performing dishes.

- **Paginated Order and Dish Tables**  
  Orders and dishes are shown in well-structured, paginated tables for easy browsing.

- **Date Filtering and Sorting**  
  The Orders page supports filtering by date range and sorting by order ID, amount, or date. Filters are applied instantly without needing a separate submit button.

- **Responsive Design**  
  The layout adapts to all screen sizes, making it usable on both desktop and mobile devices.

---

## Tech Stack

- **Backend:** Laravel 12 (PHP 8.2)  
- **Frontend:** Blade, Tailwind CSS
- **Database:** SQLite  
- **Charts:** Chart.js

---

## Local Installation
To run this project on your local machine, follow these steps:

```bash
git clone https://github.com/your-username/dinelytics.git
cd dinelytics

# Install PHP dependencies
composer install

# Install JS dependencies
npm install && npm run dev

# Create a .env file
cp .env.example .env

# Generate app key
php artisan key:generate

# Set DB_CONNECTION=sqlite in .env
# and create the SQLite file
touch database/database.sqlite

# Run migrations
php artisan migrate

# Seed the database with sample data
php artisan db:seed

# Serve the application
php artisan serve
```

---

## License

This project is open-source and available under the MIT license.
