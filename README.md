
# Challenge Truckpag - Laravel

Neste projeto foi feito uma REST API com Laravel para para utilizar os dados do projeto Open Food Facts que tem como objetivo dar suporte a equipe de nutricionistas da empresa Fitness Foods LC para que eles possam revisar de maneira rápida a informação nutricional dos alimentos que os usuários publicam pela aplicação móvel.

### Tecnologias usadas:

* Laravel (v10);
* MySQL;
* PHPUnit;
* Postman.

### Requisitos

* Ter o Docker instalado na máquina;
* Ter no mínimo a versão 8.1 do PHP instalado;
* PHPUnit versão ^10.0;
* MySQL.

### Intalação

Foi utilizado a biblioteca do Laradock para usar o Docker no projeto com o servidor Nginx e MySQL (com PHPMyAdmin), o repositório para clonagem é [este](https://github.com/laradock/laradock.git). Portas usadas para os serviços foram as seguintes:

* Nginx: 8086
* MySQL: 8306
*PHPMyAdmin: 1010

Para subir os serviços use este comando (obs.:é necessário estar na pasta laradock):

`docker-compose up -d nginx mysql phpmyadmin`

Para entrar no workspace do projeto e rodar os comandos artisan:

`docker-compose exec workspace bash`

Para rodar testes unitários da API utilizei o PHPUnit, para instalá-lo rodei o seguinte comando:

`composer require --dev phpunit/phpunit`

A partir da instalação dessas dependências comecei a planejar o modelo do banco no mysql.

### Passo a passo da lógica

Após rodei os comando para criar o modelo e a migration do banco:

`php artisan make:model Product -m`
`php artisan make:model ProductImportHistory -m`

Rodei as migrations:

`php artisan migrate`

O 1° passo da integração foi criar a CRON no Laravel que importará e atualizará os dados na base e registrará também um registro/histórico de importação na tabela de apoio criada na migration:

`php artisan make:command ImportProducts --command=import:products`

Para rodar o comando manualmente acima:

`php artisan import:products`

Para agendá-lo e rodar o comando diariamente conforme a descrição do teste há 2 formas que pode ser no arquivo de cron ou direto no cron jobs do cpanel da aplicação, por exemplo:
Minute  Hora    Dia     Month   Weekday  Caminho até o comando
` 00    04      *       *      *         /opt/cpanel/ea-php81/root/usr/bin/php /home/usuario/projeto/artisan import:products`

Logo criei o controller da API Rest:

`php artisan make:controller App\\Product --resource`

Criei o resource da API para mostrar os dados de forma padrão:

`php artisan make:resource ProductResource`

Criei uma seeder para levantar junto com o banco e atualizar no endpoint PUT e uma factory que utilzei nos testes unitários:

```

php artisan make:seeder ProductSeeder
php artisan make:factory ProductFactory

```
Já partindo para a 2° parte do challenge foi feito as rotas e endpoints para a API, no caso foram 5:

* GET '/': Detalhes da API, se conexão leitura e escritura com a base de dados está OK, horário da última vez que o CRON foi executado, tempo online e uso de memória.
* GET '/products': Listar todos os produtos da base de dados, adicionar sistema de paginação para não sobrecarregar o REQUEST
* GET '/products/{code}': Obter a informação somente de um produto da base de dados
* PUT '/products/{code}': Será responsável por receber atualizações do Projeto Web
* DELETE '/products/{code}': Mudar o status do produto para trash

Utilizei o Guzzle para fazer requisições e para baixá-lo rodei o seguinte comando:

`composer require guzzlehttp/guzzle`

Para criar os testes utilizei o comando a seguir seguindo o padrão de estrutura de pastas:

`php artisan make:test app/Http/Controllers/Api/ProductTest`

**NOTAS**: 
* Para rodar o teste unitário pode-se utilizar o seguinte comando com o método de teste -> `php artisan test --filter ProductTest::testIndex` 
* Para rodar o servidor: 
``` 
php artisan migrate db:seed
php artisan serve
```
### Documentação da API Rest com Open Api (3.0 - Swagger) 
 
Utilizei a dependência do [L5-Swagger]() para documentar a API Rest na rota '/api/documentation'

`composer require "darkaonline/l5-swagger"`

![API Rest Truckpag](https://raw.githubusercontent.com/ArthurBandeira01/desafio-truckpag/master/API-Rest-Truckpag.png?token=GHSAT0AAAAAACOQXFNXCAPW435OXB7QTMI4ZQS4ZGA)

Criei um arquivo api-info.yml no diretório app/Http/Controllers/Api/api-info.yml também com a documentação da API.

Link Collection Postman: <https://api.postman.com/collections/12254422-4f3bd192-6afe-4fe0-8a8e-d21a69f506cd?access_key=PMAT-01HTWQVDA35M0RF7HJ70VVTKV5>

This is a challenge by [Coodesh](https://coodesh.com/)
