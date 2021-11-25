# Desafio API Brasil.Io - Por Wellington Lopes de Deus
O desafio consiste em consumir API do [Brasil.io](https://blog.brasil.io/2020/10/31/nossa-api-sera-obrigatoriamente-autenticada/) retornando os casos de Covid19 em um período e estado (UF), e criar um ranking Top10 das cidades com maior índice de covid no período, utilizando PHP8, Laravel 8 e MySQL.

Todos os dados foram obtidos pelas Secretarias de Saúde das Unidades Federativas e foram tratados por Álvaro Justen e colaboradores da Brasil.io. Os dados convertidos estão sob a licença Creative Commons Attribution ShareAlike.

## Levantando o ambiente
Conforme descrito na documentação da API [Brasil.io](https://blog.brasil.io/2020/10/31/nossa-api-sera-obrigatoriamente-autenticada/) é necessário realizar o cadastro e solicitar o token de acesso da API.

#### 1 - Clone do ambiente
```SHELL
    git clone git@github.com:WellyOfGod/api-covid19.git
```
<hr />

#### 2 - Cópia do arquivo .env
```SHELL
    cp .env.example .env
```
<hr />

#### 3 - Inserir o token do Brasil.Io e dados de acesso ao banco de dados no arquivo .env
```SHELL
    BRASILIO_TOKEN=

    DB_CONNECTION=mysql  
    DB_HOST=127.0.0.1  
    DB_PORT=3306  
    DB_DATABASE=  
    DB_USERNAME=  
    DB_PASSWORD=
```
<hr />

#### 4 - Instalação das dependências do Laravel via composer
```SHELL
    composer install
```
#### 5 - Gerando nova `APP_KEY`, rodando as migrations:
```SHELL
    php artisan key:generate
```

```SHELL
    php artisan migrate
```
<hr />

## Endereços:
#### A documentação das rotas da API podem ser consultadas via PostMan:
[![Run in Postman](https://run.pstmn.io/button.svg)](https://documenter.getpostman.com/view/11132869/UVJbGHFr)
<hr />
