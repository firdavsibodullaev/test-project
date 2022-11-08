## Server Requirements

- PHP >= 8.1
- BCMath PHP Extension
- Ctype PHP Extension
- cURL PHP Extension
- DOM PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PCRE PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

## Server Configuration

Configuration of Nginx

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name example.com;
    root /var/www/project-path;
 
    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";
 
    index index.php;
 
    charset utf-8;
 
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
 
    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }
 
    error_page 404 /index.php;
 
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
 
    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

## Installation

### Clone the project from github.

```shell
git clone https://github.com/firdavsibodullaev/test-project
```

### Install the packages from composer.

```shell
composer install
```

#### Rename `.env.example` to `.env`.

### Generate key.

```shell
php artisan key:generate
```

## Database configuration

#### Change the records below in `.env`.

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

> You can use pgsql instead of mysql in DB_CONNECTION to use PostgreSQL driver

#### After configuration of database you need migrate tables into database.

```shell
php artisan migrate
```

If you want to seed your tables with fake records run

```shell
php artisan db:seed
```

## Get token

#### To authorize in console, run.

```shell
php artisan auth:login
```

> Token will be available for 5 minutes

> To get user for authorization, you can create the user from registration form in browser

#### To send API requests with json data use this endpoint.

```html
GET|POST /api/post
Accept: application/json
Authorization: token
```

| Task                   | Estimation | Spent      | Comment                                                             |
|------------------------|------------|------------|---------------------------------------------------------------------|
| Framework installation | 10 minutes | 10 minutes |                                                                     |
| Task 1                 | 1 hour     | 2 hours    | The authorization logic was incorrect and had to change it a little |
| Task 2                 | 1 hour     | 1 hour     |                                                                     |
| Task 3                 | 5 hours    | 6 hours    | It was a bit difficult to realize edit page and update logic        |
| Tests                  | 2 hours    | 2.5 hours  | Calculated the time incorrectly and found some bugs during tests    |

