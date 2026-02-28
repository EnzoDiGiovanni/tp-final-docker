# Recipe Manager — Docker Final Project

A Laravel 12 recipe management application containerized with Docker Compose. The stack consists of three containers: a custom PHP-FPM application container, a MySQL database, and an Nginx HTTP server as the sole public-facing entry point.

## Architecture

| Container | Image               | Role               | Exposed port         |
| --------- | ------------------- | ------------------ | -------------------- |
| `app`     | Custom (Dockerfile) | PHP-FPM / Laravel  | Internal only (9000) |
| `db`      | `mysql:8.4`         | MySQL database     | Internal only        |
| `nginx`   | `nginx`             | HTTP reverse proxy | **8081** → 80        |

- The **database is only accessible within the Docker network** — no port is published on the host.
- MySQL data is persisted via a **named volume** (`mysql`) so data survives container restarts and stops.
- **Nginx** is the only container reachable from outside the Docker network.

## Prerequisites

- [Docker](https://docs.docker.com/get-docker/) with Docker Compose v2
- Git (to clone the repository)

## Getting Started

### 1. Clone the repository

```bash
git clone <repository-url>
cd tp-final-docker
```

### 2. Set up the environment file

```bash
cp .env.example .env
```

### 3. Build and start the containers

```bash
docker compose up -d --build
```

### 4. Initialize the Laravel application

```bash
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate
docker compose exec app php artisan storage:link
```

### 5. Open the application

Go to <http://localhost:8081>

## Populating the Database

Run the seeder to insert 5 sample recipes:

```bash
docker compose exec app php artisan db:seed
```

You can also create recipes directly through the UI at <http://localhost:8081>.

## Stopping the Application

```bash
# Stop containers — data is preserved in the mysql volume
docker compose down

# Stop and delete all data
docker compose down -v
```

## Project Structure

```text
.
├── Dockerfile              # Custom PHP-FPM image (php:8.4-fpm base)
├── docker-compose.yml      # Orchestrates app, db, and nginx containers
├── .dockerignore           # Excludes vendor, node_modules, .env from the build context
├── nginx/
│   └── default.conf        # Nginx virtual host configuration
├── app/
│   ├── Http/Controllers/
│   │   └── RecipeController.php
│   └── Models/
│       └── Recipe.php
├── database/
│   ├── migrations/
│   │   └── 2026_02_28_000000_create_recipes_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── RecipeSeeder.php
└── .env.example
```

## Source Code Modifications

This project is based on a standard Laravel 12 skeleton. The following changes were made to adapt it for Docker:

- **`Dockerfile`**: Custom image built on `php:8.4-fpm`. Adds the `pdo_mysql`, `mysqli`, and `intl` PHP extensions, installs Composer, Node.js, and npm, then runs `composer install` and `npm run build` at image build time.
- **`.dockerignore`**: Prevents `vendor/`, `node_modules/`, `public/build/`, and `.env` from being sent to the build context, keeping the image clean and build fast.
- **`docker-compose.yml`**: Three-service architecture with a dedicated internal Docker network (`web`). The `db` service has no published ports. Anonymous volumes protect `vendor/`, `node_modules/`, and `public/build/` built inside the image from being overridden by the host bind mount. A named volume (`mysql`) ensures data persistence.
- **`nginx/default.conf`**: Nginx configured to serve Laravel's `public/` directory and forward PHP requests to the `app` container on port 9000 via FastCGI.
- **`APP_ENV=production`** in `.env.example`: Required for compiled Vite assets (CSS/JS) to load correctly. Without this, Laravel tries to reach the Vite dev server which is not running inside the container.
- **`app/Http/Controllers/RecipeController.php`** and **`app/Models/Recipe.php`**: Full CRUD resource controller and Eloquent model for recipes, not present in the base skeleton.
- **`database/migrations/2026_02_28_000000_create_recipes_table.php`**: Creates the `recipes` table with `name`, `description`, `ingredients`, and `duration` columns.
- **`database/seeders/RecipeSeeder.php`**: Inserts 5 sample recipes for testing.
