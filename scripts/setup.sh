#!/bin/bash

echo "Setup laravel docker environment"

if ! docker info > /dev/null 2>&1; then
    echo "Docker is not running. Please start Docker first."
    exit 1
fi

if [ ! -f .env ]; then
    echo "Copying environment file..."
    cp .env.docker .env
    sed -i 's/APP_FAKER_LOCALE=en_US/APP_FAKER_LOCALE=id_ID/' .env
    echo -e "\n\n#JWT_SECRET\nJWT_SECRET=your-jwt-secret-key" >> .env
else
    echo ".env file already exists. Skipping copy."
fi

echo "Building and starting Docker containers..."
docker compose up -d --build

echo -n "Waiting for services to initialize."
for i in {1..30}; do
    echo -n "."
    sleep 1
done
echo -e "\n"

if ! grep -q "APP_KEY=base64:" .env; then
    echo "Generating application key..."
    docker exec laravel_php php artisan key:generate
fi

# Run migrations and seeders
echo "Running database migrations and seeders..."
docker exec laravel_php php artisan migrate --force
docker exec laravel_php php artisan db:seed --force

# Clear and cache configs
echo "Optimizing Laravel..."
docker exec laravel_php php artisan config:clear
docker exec laravel_php php artisan cache:clear
docker exec laravel_php php artisan route:clear
docker exec laravel_php php artisan view:clear

echo "Setup complete!"
echo "Your application is running at: http://localhost:1234"
echo "Database is available at: localhost:33060"