cp .env.example .env

sed -i 's/APP_FAKER_LOCALE=en_US/APP_FAKER_LOCALE=id_ID/g' .env

composer install

php artisan sail:install --with=mariadb

alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'

echo -e "\n\nJWT_TOKEN=your-jwt-token\n\n# SAIL\nFORWARD_DB_PORT=33060\nAPP_PORT=1234" >> .env

sail artisan config:clear

sail down -v
sail up -d

echo " "
echo -n "wait until mariadb is starting "
for i in {1..15}; do
    echo -n "."
    sleep 2
done
echo -e "\nmariadb is started, enjoy"

sail artisan migrate:fresh --seed

echo -e "Enjoy, access at:\n- IP ADDRESS: http://127.0.0.1:1234/api/<endpoint_name>"

sail artisan serve
