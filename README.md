# cinema-api

This API allows to manage movies and their schedules.

## APIs Documentation

https://documenter.getpostman.com/view/9234523/T1LPESsP

## Deployment

Copy .env.example to another new file, call it .env. Later, you have to create your database and set it in the file created previously. **This project is available to deploy with Docker.**

You must run these commands to deploy the project successfully:

-   composer install
-   php artisan key:generate
-   php artisan migrate
-   php artisan jwt:secret
-   php artisan db:seed

After run last command, you will have a user to access through API routes:

-   email: admin@cinema.test
-   password: secret
