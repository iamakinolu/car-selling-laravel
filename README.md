# Car Findal — Laravel Car Selling Website

This project is a Laravel conversion of the supplied `html-css-car-selling-website-main` template.

## Requirements

- PHP 8.3+
- Composer
- SQLite (included with PHP)

## Install

```bash
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Then open `http://127.0.0.1:8000`.

### Demo account

- Email: `demo@example.com`
- Password: `password`

## Main features

- Blade conversion of the original UI
- Registration / login / logout
- Car listings and search filters
- Add, edit and delete cars
- Image uploads
- Individual car detail pages
- Favourite/watchlist
- UUID primary keys for users and cars
- SQLite by default, with MySQL/PostgreSQL configuration available in `.env`

No npm installation is required for this version; the supplied CSS and vanilla JavaScript are served directly from `public/`.
