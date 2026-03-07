Демонстрационный каталог товаров на Laravel.

Проект реализует:
- древовидную структуру категорий
- вывод каталога товаров
- сортировку по названию и цене
- загрузку тестовых данных (82 товара)
- работу с базой данных через Eloquent

---

# Установка проекта

git clone <repo>
cd project
cp .env.example .env
docker compose up --build
docker exec -it laravel_app php artisan key:generate
docker exec -it laravel_app php artisan migrate:fresh --seed
open http://localhost:8000

---

# Техническое описание проекта: Каталог товаров
1. Технологический стек
Backend:
- PHP 8+
- Laravel (MVC)
- PostgreSQL
- Docker / Docker Compose

Frontend:
- Blade Templates
- CSS
- Vite (сборка ассетов)
2. Архитектурный подход
Используется архитектура MVC + Service Layer.

Controller → Service → Model → Database

Контроллеры отвечают за обработку запроса и передачу данных во View.
Бизнес‑логика вынесена в сервисы.
3. Структура базы данных
Таблицы:

groups
- id
- name
- id_parent

products
- id
- name
- id_group

prices
- id
- id_product
- price

Связи:
products.id_group → groups.id
prices.id_product → products.id

4. Миграции
База создаётся через Laravel migrations.

Основные миграции:
- create_groups_table
- create_products_table
- create_prices_table

Команда запуска:
php artisan migrate

5. Связи моделей
Product
- hasOne Price

Price
- belongsTo Product

Group
- hasMany Product

Также реализован метод:
getAllChildrenIds() для получения вложенных категорий.

6. Контроллеры
CatalogController
- вывод всех товаров
- сортировка
- пагинация

GroupController
- вывод товаров выбранной категории
- поддержка вложенных категорий
- breadcrumbs

HomeController
- главная страница
- вывод категорий и товаров

7. Сортировка
Реализована через сервис ProductSortService.

Поддерживаемые параметры:
sort: name | price
direction: asc | desc

Поведение:
ASC → DESC → reset

8. Пагинация
Используется Laravel Paginator.

Количество товаров на странице:
6 / 12 / 18

Передается через параметр:
per_page

9. Интерфейс
Используются Blade Templates.

Структура views:

resources/views
  layouts/
    app.blade.php
  catalog/
    index.blade.php
  home.blade.php
  group.blade.php

10. Layout
Основной шаблон:

resources/views/layouts/app.blade.php

Отвечает за:
- HTML структуру
- подключение CSS
- подключение JS

Подключение ассетов:
@vite(['resources/css/app.css','resources/js/app.js'])

11. Стили
CSS находится в:

resources/css/app.css

Сборка:
npm run dev

12. Таблица товаров
Принято решение использовать фиксированную ширину таблицы.

.products-table {
    width: 800px;
    margin: 0 auto;
    table-layout: fixed;
}

Это делает интерфейс стабильным и предотвращает растягивание колонок.
13. Глобальные данные для View
Используется View::composer('*') в AppServiceProvider.

Передает во все шаблоны:
groupTree — дерево категорий.
14. Docker
Проект запускается через Docker Compose.

Основные команды:

php artisan migrate
php artisan db:seed
php artisan migrate:fresh --seed
15. Итоговая архитектура
Laravel MVC
+ Service Layer
+ PostgreSQL
+ Docker

Функциональность:
- иерархия категорий
- каталог товаров
- сортировка
- пагинация
- breadcrumbs
- выбор количества товаров
