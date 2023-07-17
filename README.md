# API em php laravel - teste técnico Grupo Pan Marketing

Este é o backend da aplicação teste técnico Grupo Pan Marketing - Uma API desenvolvida para avaliar os conhecimentos em php laravel.


## 🌐 Link do deploy

O deploy foi realizado em um servidor gratuito, portanto, se houver demora no carregamento, essa é a razão.
```
https://deploy-ew5c.onrender.com
```

## 📄 Documentação

Consulte **[Documentaçâo](https://viniciusquirino.github.io/DOC-API-PHP-LARAVEL-GRUPO-PAN/)** para saber como ultilizar a API


## 🚀 Começando

Essas instruções permitirão que você obtenha uma cópia do projeto em operação na sua máquina local para fins de desenvolvimento e teste.

Faça o clone do projeto e siga os pré requisitos.

```
git clone git@github.com:ViniciusQuirino/technical_test.git
```

### 📋 Pré-requisitos

Pré requisitos para instalar as dependencias e começar a utilizar a API:

```
Docker-compose
Composer
Homebrew
```




## ⚙️ Instalando as dependencias

Para instalar as dependencias  execute o comando no terminal:

```
composer install
```


Crie o arquivo .env na raiz do projeto e copie as variáveis de ambiente do arquivo .env.example. Em seguida gere a SECRET_KEY e o APP_ENV rodando o comando no terminal:

```
1º comando APP_ENV: php artisan key:generate
2º comando JWT_SECRET: php artisan jwt:secret 
```

Para rodar a API utilizando docker execute o comando no terminal:

```
./vendor/bin/sail up
```

Com os containers rodando execute as migrations no banco de dados MySQL:

```
PRIMEIRO COMANDO: sudo docker exec -it technical_test-laravel.test-1  /bin/sh

SEGUNDO COMANDO: php artisan migrate
```

Prontinho, a API já poderá ser utilizada

```
http://localhost:80
```

## 🛠️ Construído com

* [PHP]() - linguagem de programção 
* [Laravel]() - Framework
* [MySQL]() - Banco de dados
* [Render]() - Plataforma de deploy 






