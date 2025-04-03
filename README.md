# Travel Order Microservice

Microsserviço desenvolvido em Laravel para gerenciar pedidos de viagem corporativa. Esta API REST permite criar, atualizar, consultar e listar pedidos de viagem, com autenticação JWT, filtros avançados, notificações por e-mail e testes automatizados. O ambiente é totalmente dockerizado para facilitar a execução e implantação.

## Funcionalidades

- **Criar Pedido de Viagem**: Registra pedidos com ID, nome do solicitante, destino, datas de ida e volta, e status inicial "solicitado".
- **Atualizar Status**: Altera o status para "aprovado" ou "cancelado", restrito a usuários que não sejam o solicitante.
- **Consultar Pedido**: Retorna detalhes de um pedido específico por ID, visível apenas ao solicitante.
- **Listar Pedidos**: Lista os pedidos do usuário autenticado, com filtros por status, período e destino.
- **Cancelar Pedido**: Cancela pedidos aprovados, enviando notificação ao solicitante.
- **Notificações**: Envia e-mails ao solicitante quando o status é atualizado.
- **Autenticação**: Utiliza JWT para proteger as rotas, restringindo o acesso aos próprios pedidos do usuário.

## Pré-requisitos

- [Docker](https://docs.docker.com/get-docker/) e [Docker Compose](https://docs.docker.com/compose/install/)
- [Git](https://git-scm.com/downloads)
- Opcional: Cliente HTTP como [Postman](https://www.postman.com/) ou [Insomnia](https://insomnia.rest/) para testar a API

## Instalação

Siga os passos abaixo para configurar o projeto localmente:

1. **Clone o repositório:**
   ```bash   
   git clone https://github.com/erikdobrychtop/laravel-rest-api.git travel-order-service
   cd travel-order-service
   
2. **Instale as dependências:**
   ```bash
   docker-compose exec app composer install

3. **Configure o arquivo .env (copie .env.example e ajuste as variáveis).**
4. **Execute as migrações:**
   ```bash
   docker-compose exec app php artisan migrate

## Executando o Serviço
   
1. **Comando:**
   ```bash
   docker-compose up --build

## Configuração do Ambiente
- DB_*: Configurações do MySQL.
- JWT_SECRET: Gerado com php artisan jwt:secret.
- MAIL_*: Configurações de e-mail (ex.: Mailtrap).

## Executando Testes

1. **Comando:**
   ```bash
   docker-compose exec app php artisan test

## Endpoints
- POST /api/login: Autenticação (email, password).
- POST /api/travel-orders: Criar pedido.
- PUT /api/travel-orders/{id}/status: Atualizar status.
- GET /api/travel-orders/{id}: Consultar pedido.
- GET /api/travel-orders: Listar pedidos (filtros: status, start_date, end_date, destination).
- DELETE /api/travel-orders/{id}: Cancelar pedido.

- Notas: Use um token JWT no header Authorization: Bearer {token} para rotas autenticadas.

1. **Criar usuário - Curl**
   ```bash
      curl --request POST \
      --url http://localhost:8001/api/register \
      --header 'Content-Type: application/json' \
      --data '{
      "name": "Erik",
      "email": "erikdobryxchtop@gmail.com",
      "password": "qwert12345",
      "password_confirmation": "qwert12345",
      "phone_number": "99999-9999",
      "birth_date": "1994-06-15"
      }'
   
   BODY

   {
    "name": "Erik",
    "email": "erikdobryxchtop@gmail.com",
    "password": "qwert12345",
    "password_confirmation": "qwert12345",
    "phone_number": "99999-9999",
    "birth_date": "1994-06-15"
   }

2. **Login - Curl**
   ```bash
   curl --request POST \
   --url http://localhost:8001/api/login \
   --header 'Content-Type: application/json' \
   --data '{
      "email": "erikdobryxchtop@gmail.com", 
      "password": "qwert12345"
      }'

   BODY

   {
	"email": "erikdobryxchtop@gmail.com", 
	"password": "qwert12345"
   }

3. **Listar Pedidos - Curl**
   ```bash
   curl --request GET \
   --url 'http://localhost:8001/api/travel-orders?status=requested&start_date=2025-01-01&end_date=2025-05-31&destination=New%20York' \
   --header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDEvYXBpL2xvZ2luIiwiaWF0IjoxNzQzNzA5MjMzLCJleHAiOjE3NDM3MTI4MzMsIm5iZiI6MTc0MzcwOTIzMywianRpIjoidW1HRktNRmlSTlFIOHZKSCIsInN1YiI6IjMiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.rDYJawocTLEEKnPZMYxnPcUfNSJd-d4pR7QyaBFeCwk'
   
4. **Consultar Pedido - Curl**
   ```bash
   curl --request GET \
   --url http://localhost:8001/api/travel-orders/1 \
   --header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDEvYXBpL2xvZ2luIiwiaWF0IjoxNzQzNzA5NjA4LCJleHAiOjE3NDM3MTMyMDgsIm5iZiI6MTc0MzcwOTYwOCwianRpIjoiSnpVNjV6ZUJYV2tCNm5FTCIsInN1YiI6IjMiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.6DQPg2MbVHIoB6Oa5MNeO-1k7WuqQeSLhjxt92n2PPM'

5. **Criar Pedido de Viagem - Curl**
   ```bash
   curl --request POST \
   --url http://localhost:8001/api/travel-orders \
   --header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDEvYXBpL2xvZ2luIiwiaWF0IjoxNzQzNzA5MjMzLCJleHAiOjE3NDM3MTI4MzMsIm5iZiI6MTc0MzcwOTIzMywianRpIjoidW1HRktNRmlSTlFIOHZKSCIsInN1YiI6IjMiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.rDYJawocTLEEKnPZMYxnPcUfNSJd-d4pR7QyaBFeCwk' \
   --header 'Content-Type: application/json' \
   --data '{
      "requester_name": "John Doe",
      "destination": "New York",
      "departure_date": "2025-05-01",
      "return_date": "2025-05-05"
   }'

   BODY
   
   {
    "requester_name": "John Doe",
    "destination": "New York",
    "departure_date": "2025-05-01",
    "return_date": "2025-05-05"
   }

6. **Atualizar Status - Curl**
   ```bash
   curl --request PUT \
   --url http://localhost:8001/api/travel-orders/1/status \
   --header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDEvYXBpL2xvZ2luIiwiaWF0IjoxNzQzNzA5MjMzLCJleHAiOjE3NDM3MTI4MzMsIm5iZiI6MTc0MzcwOTIzMywianRpIjoidW1HRktNRmlSTlFIOHZKSCIsInN1YiI6IjMiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.rDYJawocTLEEKnPZMYxnPcUfNSJd-d4pR7QyaBFeCwk' \
   --header 'Content-Type: application/json' \
   --data '{
      "status": "approved"
   }'

   BODY
   {
    "status": "approved"
   }

7. **Cancelar Pedido - Curl**
   ```bash
   curl --request DELETE \
   --url http://localhost:8001/api/travel-orders/1 \
   --header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDEvYXBpL2xvZ2luIiwiaWF0IjoxNzQzNzA5MjMzLCJleHAiOjE3NDM3MTI4MzMsIm5iZiI6MTc0MzcwOTIzMywianRpIjoidW1HRktNRmlSTlFIOHZKSCIsInN1YiI6IjMiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.rDYJawocTLEEKnPZMYxnPcUfNSJd-d4pR7QyaBFeCwk'

      
## Dúvidas ou Sugestões

- Para dúvidas ou sugestões, abra uma issue no repositório ou envie um e-mail para erikdobrychtop@gmail.com.