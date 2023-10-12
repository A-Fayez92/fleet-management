# Fleet Management System

## Requirements
* Docker


## Installation
* Clone The Repo 
```
git clone https://github.com/A-Fayez92/fleet-management.git
cd fleet-management
```
* Install Composer Packages
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```
* Copy .env and set your DB Credentials
```
cp .env.example .env
```
* Run Docker Containers
```
vendor/bin/sail up 
```
* Generate AppKey and JWT Secret
```
vendor/bin/sail artisan key:generate

vendor/bin/sail artisan jwt:secret
```
* Migrate And Seed Your Database
```
vendor/bin/sail artisan migrate --seed
```
* Now You can Access the Admin Dashboard Through the following URL
```
http://localhost/admin/login
```

* Use the following Credentials to access the admin dashboard
```
Email: test@example.com
Password: password
```

* You Can Find Postman Collection With All Required APIs in the root directory

