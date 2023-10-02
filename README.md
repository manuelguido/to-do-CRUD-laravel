
# To-do CRUD web application

## Download project

To download the project open your terminal and run:

```bash
  git clone https://github.com/manuelguido/vue-laravel-code-challenge.git
```

## Setup project

Cd into the project folder

```bash
cd to-do-CRUD-laravel
```

Install composer dependencies

```bash
composer install
```

Install NPM dependencies

```bash
npm install
```

Create a local copy of the .env file

```bash
cp .env.example .env
```

Generate an app encryption key

```bash
php artisan key:generate
```

Configure a new database into your .env file (Replace every example data to match your DB configuration)

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

Run migrations

```bash
php artisan migrate
```

Run seeds

```bash
php artisan db:seed
```

## Run project

To your the project locally, make sure your dababase is up an running. Then run

```bash
php artisan serve
```

And in new terminal tab run

```bash
npm run dev
```

Now you can test the project at http://localhost:8000/

## Testing project

#### IMPORTANT: This PHP tests use "Illuminate\Foundation\Testing\RefreshDatabase", so after runing any of them the whole database will be refreshed. In case you run the tests while being logged in, your frontend Sanctum Autentication information will be obsolete and all the database information will be lost.

To run PHP tests, use the following command on a new terminal tab

```bash
php artisan test
```

To run JavaScript tests, use the following command on a new terminal tab

```bash
npm run test
```
