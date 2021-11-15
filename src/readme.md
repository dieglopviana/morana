## Teste Morana

Para rodar esta aplicação, será necessário ter o docker instalado na máquina, com isso, siga as instruções abaixo:

Após a clonagem do respositório, na raiz do projeto, rodar o camando

> ```docker-compose up -d --build```

Isso deverá subir o container com o seguinte ambiente:

```
PHP 5.6
MySQL 5.7
```

Com isso, nossa aplicação será feita com o **Laravel 5.4**. Em seguida, acesse o container com o comando:

> ```docker exec -it phpmorana bash```

Na pasta "/var/www/html", vamos instalar as depências com o composer

```
composer install
```

Em seguida, na pasta *"/src"* altere o arquivo *".env"* e configure as variáveis de conexão com o MySQL, deixando assim:

```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=morana
DB_USERNAME=root
DB_PASSWORD=root
```

Agora, com o container rodando e o arquivo ".env" criado e configurado, devemos rodar as migrations, pra isso, acesse o container novamente e rode o comando:


```
php artisan migrate
```

Se tudo ocorreu bem até aqui, já deve ser possível acessar a aplicação, pela URL [http://localhost:8056/](http://localhost:8056/)
