# API WebQuartinho

Este projeto é uma API desenvolvida com Laravel, criada especificamente para ser utilizada por um frontend específico. A aplicação inteira (front e API) foi desenvolvida com o objetivo de cumprir um desafio proposto pela empresa WebQuarto para uma vaga de estágio.

## Pré-requisitos

- PHP ^8.1
- Composer
- MySQL ou outro banco de dados relacional compatível
- Node.js e NPM (para o frontend)

## Instalação

Siga os passos abaixo para configurar o projeto em seu ambiente local:

### 1. Clonar o Repositório

Clone este repositório para o seu ambiente local usando o seguinte comando:

```bash
git clone https://github.com/eukvyn/api.web-quartinho.git
cd api.web-quartinho
```

### 2. Configurar o Ambiente

Copie o arquivo .env.example para um novo arquivo chamado .env:

```bash
cp .env.example .env
```

Abra o arquivo .env e atualize as variáveis de ambiente relacionadas ao banco de dados (DB_DATABASE, DB_USERNAME, DB_PASSWORD ...) e a variável FRONTEND_URL para conter a URL de onde o frontend está rodando, a fim de evitar erros de CORS.

### 3. Instalar Dependências

Execute o Composer para instalar as dependências do projeto:

```bash
composer install
```

### 4. Gerar Chave da Aplicação

Gere a chave da aplicação Laravel com o comando:

```bash
php artisan key:generate
```

### 5. Criar Link Simbólico para Armazenamento

Execute o comando Artisan para criar um link simbólico para a pasta de armazenamento:

```bash
php artisan storage:link
```

### 6. Preparar o Banco de Dados

Crie o banco de dados que você especificou no seu arquivo .env e execute as migrations:

```bash
php artisan migrate
```

### 7. Preparar Pastas de Imagens e Seeders

Antes de executar as seeders, crie dentro da pasta public uma nova pasta storage, e dentro dela, crie duas pastas: profile_images e property_images. Adicione uma foto com o nome default.png em profile_images e uma foto default.jpg em property_images, pois as seeders utilizam essas imagens padrão.

### 8. Executar Seeders

Popule o banco de dados com dados iniciais executando:

```bash
php artisan db:seed
```

## Executando o Projeto

Com todas as configurações feitas, você pode iniciar o servidor de desenvolvimento do Laravel com:

```bash
php artisan serve
```
Agora, a API estará rodando em http://localhost:8000.

