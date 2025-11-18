# Phone Book API

Uma API RESTful simples para gerenciamento de contatos, construída com Laravel.

## Funcionalidades

- Autenticação de usuário (Login/Logout).
- Operações CRUD completas para contatos (Criar, Listar, Atualizar, Deletar).
- Upload de avatar para contatos.
- Paginação na listagem de contatos.
- Ambiente de desenvolvimento local com Docker.

## Tecnologias Utilizadas

- **Backend:** PHP 8.2+ / Laravel 12
- **Banco de Dados:** MySQL 8.0
- **Autenticação:** Laravel Sanctum
- **Containerização:** Docker & Docker Compose

## Pré-requisitos

- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)


## Endpoints da API

Todos os endpoints estão prefixados com `/api`.

| Método   | Endpoint                     | Descrição                                | Requer Autenticação |
| :------- | :--------------------------- | :--------------------------------------- | :------------------ |
| `POST`   | `/login`                     | Autentica um usuário e retorna um token. | Não                 |
| `POST`   | `/logout`                    | Invalida o token do usuário autenticado. | Sim                 |
| `GET`    | `/users`                     | Obtém os dados do usuário autenticado.   | Sim                 |
| `POST`   | `/contacts`                  | Cria um novo contato.                    | Sim                 |
| `GET`    | `/contacts`                  | Lista todos os contatos do usuário.      | Sim                 |
| `PATCH`  | `/contacts/{id}`             | Atualiza os dados de um contato.         | Sim                 |
| `PATCH`  | `/contacts/{id}/avatar`      | Faz o upload do avatar de um contato.    | Sim                 |
| `DELETE` | `/contacts/{id}`             | Deleta um contato específico.            | Sim                 |


