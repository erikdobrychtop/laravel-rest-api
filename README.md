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

   Para dúvidas ou sugestões, abra uma issue no repositório ou envie um e-mail para erikdobrychtop@gmail.com.