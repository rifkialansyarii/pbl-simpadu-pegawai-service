#!/bin/bash

echo "Setup laravel docker environment"

if ! docker info > /dev/null 2>&1; then
    echo "Docker is not running. Please start Docker first."
    exit 1
fi

if [ ! -f .env ]; then
    echo "Copying environment file..."
    cp .env.example .env
    sed -i 's/# DB_DATABASE=laravel/DB_DATABASE=app/' .env
    sed -i 's/# DB_USERNAME=root/DB_USERNAME=laravel/' .env
    sed -i 's/# DB_PASSWORD=/DB_PASSWORD=secret/' .env
else
    echo ".env file already exists. Skipping copy."
fi

echo "Building and starting Docker containers..."
docker compose up -d --build

echo -n "Waiting for services to initialize."
until docker exec laravel_php nc mysql 3306; do
    echo -n "."
    sleep 1
done
echo -e "\nServices are initialized."

if ! grep -q "APP_KEY=base64:" .env; then
    echo "Generating application key..."
    docker exec laravel_php php artisan key:generate
fi

# Run migrations and seeders
echo "Running database migrations and seeders..."
docker exec laravel_php php artisan migrate:fresh --force
docker exec laravel_php php artisan db:seed

# Clear and cache configs
echo "Optimizing Laravel..."
docker exec laravel_php php artisan config:clear
docker exec laravel_php php artisan cache:clear
docker exec laravel_php php artisan route:clear
docker exec laravel_php php artisan view:clear

echo "Setup complete!"
echo "Your application is running at: http://localhost:1234"
echo "Database is available at: localhost:33060"