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

## Começando

Siga os passos abaixo para configurar e executar o ambiente de desenvolvimento local.

**1. Clone o repositório:**

```bash
git clone https://github.com/seu-usuario/phone-book-api.git
cd phone-book-api
```

**2. Crie o arquivo de ambiente:**

Copie o arquivo de exemplo `.env.example` para um novo arquivo chamado `.env`.

```bash
cp .env.example .env
```

**3. Configure as variáveis de ambiente:**

Abra o arquivo `.env` e atualize as variáveis do banco de dados para corresponderem às configurações do `docker-compose.yml`:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=phone_book
DB_USERNAME=root
DB_PASSWORD=root
```

**4. Inicie os containers Docker:**

Use o Docker Compose para construir e iniciar os serviços (servidor de banco de dados e phpMyAdmin).

```bash
docker-compose up -d
```

**5. Instale as dependências do PHP:**

Acesse o terminal do container da aplicação (que você precisará criar ou adicionar ao `docker-compose.yml`) para instalar as dependências do Composer. Se você não tem um container para a `app`, pode executar o composer localmente, desde que tenha o PHP e as extensões necessárias instaladas.

*Nota: O `docker-compose.yml` fornecido não contém um serviço para a aplicação PHP. As instruções a seguir presumem que você executará os comandos `artisan` e `composer` em um ambiente PHP local ou em um container de aplicação que você adicionou.*

Assumindo que você tenha um container de aplicação chamado `app`, os comandos seriam:

```bash
# Exemplo se houvesse um container 'app'
docker-compose exec app composer install
```

**6. Gere a chave da aplicação:**

```bash
# Exemplo com container 'app'
docker-compose exec app php artisan key:generate
```

**7. Execute as migrações e seeders:**

Isso criará as tabelas no banco de dados e o populará com dados de exemplo.

```bash
# Exemplo com container 'app'
docker-compose exec app php artisan migrate --seed
```

## Executando os Testes

Para rodar a suíte de testes automatizados, execute o seguinte comando:

```bash
# Exemplo com container 'app'
docker-compose exec app php artisan test
```

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

## Variáveis de Ambiente

Estas são as principais variáveis que você precisa configurar no seu arquivo `.env`:

```ini
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=phone_book
DB_USERNAME=root
DB_PASSWORD=root
```
link no youtube: https://www.youtube.com/watch?v=pRgvHfulOmM
link do responsivo do app: https://youtu.be/GV6XMf1C3ts
