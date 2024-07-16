# Estatísticas de Transações

Gostaríamos de ter uma API RESTful para nossas estatísticas. O principal caso de uso da API é calcular estatísticas em tempo real para os últimos 60 segundos de transações.

## Instalação
1. Clone GitHub:
```
git clone https://github.com/humberto-hlcorp/case-precpago.git
```
2. Laravel:
```php
composer install
npm install
cp .env.example .env
php artisan key:generate
```

3. Docker (Porta 8989 - http://localhost:8989):
```
docker-compose up -d
```

3. Testes:
```php
php artisan test
```

## Autor
Humberto Oliveira `humbertoo@hlcorp.com.br`

### API endpoints:
* POST `/transactions` – chamado sempre que uma transação é feita.
* GET `/statistics` – retorna a estatística baseada nas transações dos últimos 60 segundos.
* DELETE `/transactions` – exclui todas as transações.

### Especificações:
#### POST /transactions
Este endpoint é chamado para criar uma nova transação. Deve executar em tempo e memória constantes (O(1)).

Corpo:

```json
{
    "amount": "12.3343",
    "timestamp": "2018-07-17T09:59:51.312Z"
}
```

Onde:
* amount – valor da transação; campo númerico.
* timestamp – hora da transação no formato ISO 8601 YYYY-MM-DDThh:mm:ss.sssZ no fuso horário UTC (este não é o timestamp atual)

Retorna: Corpo vazio com uma das seguintes respostas:
* 201 – em caso de sucesso.
* 204 – se a transação for mais antiga que 60 segundos.
* 400 – se o JSON for inválido.
* 422 – se algum dos campos não puder ser analisado ou a data da transação estiver no futuro.

#### GET /statistics
Este endpoint retorna as estatísticas baseadas nas transações que ocorreram nos últimos 60 segundos. Deve executar em tempo e memória constantes (O(1)).

```json
{
    "sum": "1000.00",
    "avg": "100.53",
    "max": "200000.49",
    "min": "50.23",
    "count": 10
}
```

Onde:
* sum – um float especificando a soma total do valor das transações nos últimos 60 segundos.
* avg – um float especificando o valor médio das transações nos últimos 60 segundos.
* max – um float especificando o maior valor de uma única transação nos últimos 60 segundos.
* min – um float especificando o menor valor de uma única transação nos últimos 60 segundos.
* count – um int especificando o número total de transações que ocorreram nos últimos 60 segundos.
  Todos os valores do tipo “float” deve contêm exatamente duas casas decimais e usar arredondamento HALF_ROUND_UP. ex: 10.345 é retornado como 10.35, 10.8 é retornado como 10.80.

#### DELETE /transactions
Este endpoint faz com que todas as transações existentes sejam excluídas.
O endpoint deve aceitar um corpo de solicitação vazio e retornar um código de status 204.
