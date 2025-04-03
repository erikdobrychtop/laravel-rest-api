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
   git clone https://github.com/seu-usuario/travel-order-service.git
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

Para dúvidas ou sugestões, abra uma issue no repositório ou envie um e-mail para erikdobrychtop@gmail.com.