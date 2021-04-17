cp .env.example .env
# Configurar database

composer install
php artisan key:generate
php artisan migrate --seed
npm install
npm run dev

Admin User Padrão
E-mail: admin@admin.com
Password: 12345678