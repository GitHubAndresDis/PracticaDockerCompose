# Practica Docker Compose
Practica de docker-compose - Clase Informatica II - Especialziación en Ingenieria del Software - Universidad Distrital

# Integrantes:
VERGARA RODRÍGUEZ DAINER ANDRÉS cod: 20202099037
CORDOBA AGUILAR RHOSBEN ADHIER cod: 20202099025
CASTRO ESCORCIA EDGAR JUNIOR cod: 20202099024


# Una aplicación web de Php simple que se conecta a apache para almacenar usuarios (crud) y el cual cuenta con una base de datos mysql.

# Aquí está el docker-compose.yml que impulsa toda la configuración.

version: '3'

services:
  mysql:
    image: andresvergara0/mysql:5.7
    container_name: docker-mysql
    environment:
       #MYSQL_DATABASE: db_crud_3_capas
       #MYSQL_USER: root
       #MYSQL_PASSWORD: password
      MYSQL_ROOT_PASSWORD: 123456
    ports:
      - "3306:3306"
    restart: always
    
  web:
    image: edgar180251/php:7.3-apache2
    container_name: docker-php
    ports:
      - "80:80"
    volumes:
      - ./www:/var/www/html
    links:
      - mysql


# Configuración

Iniciamos creando una imagen de mysql el cual crea la base de datos y configura el servicio

Posteriormente creamos la imagen de php la cual monta el servicio y configura el mysqli.

Comandos para la creación de la imagen de php

docker exec -it docker-php bash
cd /usr/local/bin
./docker-php-ext-install pdo_mysql
./docker-php-ext-install mysqli
docker tag php-apache:latest edgar180251/php:7.3-apache2
docker push edgar180251:php:7.3

# dockerfile:

FROM edgar180251:7.3-apache
RUN cd /usr/local/bin && ./docker-php-ext-install pdo_mysql && ./docker-php-ext-install mysqli
COPY . /var/www
EXPOSE 80

# Ejecución 
para la ejecución del proyecto
1: ubicarse sobre la raiz del proyecto.
2: Ejecutar el comando docker-compose up -d
3: Revisar la url de su navegador 
