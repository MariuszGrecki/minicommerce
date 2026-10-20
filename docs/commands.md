docker compose exec order-service php artisan make:controller Api/OrderController
docker compose exec order-service php artisan make:migration create_orders_table
docker compose exec order-service php artisan db:table orders
docker compose exec order-service php artisan route:list




docker compose exec order-service php artisan install:api