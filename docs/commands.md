docker compose exec order-service php artisan make:migration create_orders_table
docker compose exec order-service php artisan db:table orders