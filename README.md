Демонстрационный каталог товаров на Laravel.

Проект реализует:
- древовидную структуру категорий
- вывод каталога товаров
- сортировку по названию и цене
- загрузку тестовых данных (82 товара)
- работу с базой данных через Eloquent

---

# Установка проекта

- git clone <repo>
- cd project
- cp .env.example .env
- docker compose up --build
- docker exec -it laravel_app php artisan key:generate
- docker exec -it laravel_app php artisan migrate:fresh --seed
- open http://localhost:8000

---

# Unit test

- php artisan test
