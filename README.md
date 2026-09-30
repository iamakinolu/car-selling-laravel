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

Build the Tailwind/Vite assets with `npm install` and `npm run build`, then open `http://127.0.0.1:8000`.

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

## Persistent car photo storage on Vercel

Vercel's application filesystem is temporary. Create a public `car-images` bucket in Supabase Storage, then add these environment variables to the Vercel project for Production (and Preview if needed):

```env
SUPABASE_URL=https://YOUR_PROJECT_REF.supabase.co
SUPABASE_SERVICE_ROLE_KEY=YOUR_SERVER_ONLY_SERVICE_ROLE_KEY
SUPABASE_STORAGE_BUCKET=car-images
```

Never expose `SUPABASE_SERVICE_ROLE_KEY` in frontend code or a `VITE_` variable. Local development continues to use Laravel's public disk when the Supabase Storage variables are unset.
