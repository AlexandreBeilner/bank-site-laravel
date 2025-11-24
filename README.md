COMO RODAR:

### Duplicar o .env-example como o nome .env

### Precisa do composer instalado apenas para o install, depois utiliza os container do sail


````bash
composer install
````

````bash
./vendor/bin/sail up -d
````

````bash
./vendor/bin/sail artisan key:generate
````

````bash
./vendor/bin/sail artisan migrate && ./vendor/bin/sail artisan db:seed
````

````bash
./vendor/bin/sail npm install && ./vendor/bin/sail npm run build
````

Caso nao tenha alterado as portas esta disponivel em http://localhost:8080
