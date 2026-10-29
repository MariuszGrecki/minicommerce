docker compose exec order-service php artisan make:controller Api/OrderController
docker compose exec order-service php artisan make:migration create_orders_table
docker compose exec order-service php artisan make:request StoreOrderRequest
docker compose exec order-service php artisan db:table orders
docker compose exec order-service php artisan route:list


docker compose exec order-service php artisan make:test StoreOrderTest


docker compose exec order-service php artisan install:api

docker compose exec order-service \
  php artisan serve --host=0.0.0.0 --port=8000

  curl -i -X POST http://127.0.0.1:33377/api/orders

    -i pokazuje nagłowki odpowiedzi
    -X POST ustawia metode żadani POST