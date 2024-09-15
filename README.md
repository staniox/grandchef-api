# GrandChef API

GrandChef API é uma aplicação RESTful desenvolvida em Laravel 11, projetada para gerenciar categorias, produtos e pedidos. Esta API utiliza o **Repository Pattern**, **Form Requests** para validação, e retorna respostas JSON apropriadas para facilitar a integração.

## Requisitos

- **Docker** (>=20.10.0)
- **Docker Compose** (>=2.0.0)

## Instalação com Docker

1. Clone este repositório:
    ```bash
    git clone https://github.com/staniox/grandchef-api.git
    ```

2. Navegue até o diretório do projeto:
    ```bash
    cd grandchef-api
    ```

3. Crie o arquivo `.env` com base no `.env.example`:
    ```bash
    cp .env.example .env
    ```

4. Configure as informações do banco de dados no arquivo `.env` (opcional, o Docker usará as configurações padrão):
    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=grandchef
    DB_USERNAME=root
    DB_PASSWORD=root
    ```

5. Suba os containers Docker com **Docker Compose**:
    ```bash
    docker-compose up -d
    ```

6. Instale as dependências do Composer, execute as migrações e adicione a chave:
    ```bash
    docker-compose exec app composer install
    docker-compose exec app php artisan migrate
    docker-compose exec app php artisan key:generate
    ```

7. o Swagger com todas as requisições solicitadas estará disponível em:
    ```
    http://localhost
    ```
   
### Estrutura da API

A API segue uma estrutura **RESTful**, implementando as operações de **CRUD** (quando aplicáveis) para **Categorias**, **Produtos** e **Pedidos**. Nem todos os objetos possuem o CRUD completo; as operações disponíveis estão descritas abaixo.

## Rotas de Categorias

- **Listar todas as categorias**:  
  `GET /api/categorias`

- **Exibir uma categoria específica**:  
  `GET /api/categorias/{id}`

- **Criar uma nova categoria**:  
  `POST /api/categorias`
  ```json
  {
      "nome": "Bebidas"
  }

- **Atualizar uma categoria existente**:  
  `PUT /api/categorias/{id}`
    ```json
    {
        "nome": "Comidas"
    }

- **Excluir uma categoria**:  
  `DELETE /api/categorias/{id}`


## Rotas de Produtos

- **Listar todos os produtos**:  
  `GET /api/produtos`

- **Criar um novo produto**:  
  `POST /api/produtos`
    ```json
    {
    "nome": "Coca-Cola",
    "preco": 5.99,
    "categoria_id": 1
    }

## Rotas de Pedidos

- **Listar todos os pedidos**:  
  `GET /api/pedidos`

- **Exibir um pedido específico**:  
  `GET /api/pedidos/{id}`

- **Criar um novo pedido**:  
  `POST /api/pedidos`
    ```json
    {
        "produtos": [
            {
                "produto_id": 1,
                "preco": 5.99,
                "quantidade": 2
            },
            {
                "produto_id": 2,
                "preco": 3.50,
                "quantidade": 1
            }
        ]
    }

- **Atualizar um pedido existente**:  
  `PUT /api/pedidos/{id}`
    ```json
    {
        "estado": "concluido"
    }
