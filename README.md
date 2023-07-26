# Single-page application with Vue and Laravel API

Setup and installation 

install required dependencies for Laravel:
```bash
cd api
composer install 
```

install required dependencies for Vue:
```bash
cd client
npm install
```

setup environment variables for Laravel
```bash
cd api
cp env.example env
```

Generate `APP_KEY`
```bash
php artisan key:generate
```

setup development servers 
```bash
cd api
php artisan serve

cd client
npm run dev
```
