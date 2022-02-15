# Projeto teste de cadastro de produtos

Esse projeto consiste em um CRUD de produtos e tags, onde a relação entre eles é N:N.
O usuário tem a opção de acessar o site sem estar logado, e vai conseguir acessar a página de listagem de produtos e tags, e vai conseguir pesquisar por produtos na página de pesquisa. 

Mas caso ele deseje criar, deletar e editar tags e produtos será necessário fazer login no site.
O setup é feito com docker, então é preciso ter o docker e docker-compose instalados na máquina.

Depois será necessário prencher os campos do banco de dados no arquivo .env (o docker-compose precisa dessas variaveis para criar o banco de dados), e também é necessario preencher os campos USER e UID no final do .env, que são o nome do user e o ID dele.

O projeto usa PHP8.

## Setup
Primeiro rode o comando abaixo para rodar os containers e fazer build do Dockerfile
```docker
docker-compose up -d
```
Logo depois será preciso baixar as dependencias do Laravel usando o composer

```docker
docker-compose exec app composer update
```

Após baixar as dependencias, será preciso rodar as migrations
```docker
docker-compose exec app php artisan migrate
```
caso o container do laravel não consiga se conectar no container do mysql, espere alguns segundos e tente novamente.

E caso você queira popular as tabelas do banco de dados com o Seeder, rode esse comando
```docker
docker-compose exec app php artisan db:seed
```

## Informações
O phpmyadmin está rodando na porta 8000, então é possivel acessar ele pelo localhost:8000.
O container do NGINX está rodando na porta 80, então basta acessar localhost para entrar no app

Caso o usuário esteja logado, na página de pesquisa ele poderá editar e deletar produtos. Logo após realizar essa ação será redirecionado para a listagem de produtos, ao invés de ser redirecionado de volta para a página de pesquisa. 
Julguei como sendo a melhor opção de uso quando existem muitos produtos e o usuario quer rapidamente achar um produto pra editar ou deletar.

### Comando SQL para extração de relatório
```sql
SELECT tag.id ,tag.name AS "Tag", COUNT(product_tag.tag_id) AS "Produtos" 
FROM tag 
LEFT JOIN product_tag ON product_tag.tag_id = tag.id 
GROUP BY tag.name 
ORDER BY COUNT(tag.name) DESC;
``` 