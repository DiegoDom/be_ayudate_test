# Test CRUD Diego Domínguez

## Instrucciones

1.- Clonar el repositorio y correr el comando

    composer install

2.- Generar el archivo enviroment y configurar la conexión a la DB

    copy .env.example .env

    *añadir esta linea para la vigencia de los token
    JWT_TTL=1440

3.- Correr las migraciones y el seeder

    php artisan migrate
    php artisan db:seed

5.-  Ejecutar

    php artisan jwt:secret

6.- Correr el proyecto

    php -S localhost:8000 -t public



La documentación para el framework se puede encontrar en [Lumen website](https://lumen.laravel.com/docs).


Muchas gracias!


Diego Alberto Domínguez
