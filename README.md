# DOCUMENTATION

## START PROJECT

- Download this project and save to your local
- Run `composer install` to install all dependencies needed
- Open your computer server to run your server, then create new database on your database
- Configure your .env file, go to database section, and configure the database according to the database you are using, the user, and the password you are using as below
  ```
      DB_CONNECTION=mysql
      DB_HOST=127.0.0.1
      DB_PORT=8889
      DB_DATABASE=db_lembur
      DB_USERNAME=root
      DB_PASSWORD=root
  ```
- After that, you can run command `php artisan migrate` to generate all table migrations which is exist in this project
- Then, you can run command `php artisan db:seed --class=ReferenceSeeder` and `php artisan db:seed --class=SettingSeeder` to seed your database with Reference and Setting data to references table and settings table
- Then, you can run command `php artisan serve` to start your laravel server and try the endpoint has been build

## API ENDPOINT

### Update Settings

Request :

- Method : PATCH
- Endpoint : `/api/settings/{id}`
- Header :
  - Content-Type: application/json
  - Accept: application/json
- Body :

```json
{
  "key": "string",
  "value": "integer"
}
```

Response :

```json
{
  "success": "boolean",
  "code": "integer",
  "message": "string",
  "data": {
    "key": "string",
    "value": "integer"
  }
}
```

## Post Employee

Request :

- Method : POST
- Endpoint : `/api/employees`
- Header :
  - Accept: application/json
- Body :

```json
{
  "name": "string",
  "salary": "long"
}
```

Response :

```json
{
  "success": "boolean",
  "code": "integer",
  "message": "string",
  "data": {
    "id": "integer, unique",
    "name": "string",
    "salary": "long"
  }
}
```

## Post Overtime

Request :

- Method : POST
- Endpoint : `/api/overtimes`
- Header :
  - Content-Type: application/json
  - Accept: application/json
- Body :

```json
{
  "employee_id": "integer",
  "date": "date",
  "time_started": "time {HH:MM}",
  "time_ended": "time {HH:MM}"
}
```

Response :

```json
{
  "success": "boolean",
  "code": "integer",
  "message": "string",
  "data": {
    "id": "string, unique",
    "date": "date",
    "time_started": "time {HH:MM}",
    "time_ended": "time {HH:MM}",
    "overtime_duration": "integer"
  }
}
```

## Get Overtime Pay

Request :

- Method : GET
- Endpoint : `/api/overtime-pays/calculate`
- Header :
  - Accept: application/json
- Query Param :
  - month : string (YYYY-MM),

Response :

```json
{
  "status": "boolean",
  "code": "integer",
  "message": "string",
  "data": [
    {
      "id": "integer, unique",
      "name": "string",
      "salary": "long",
      "overtimes": [
        {
          "id": "integer, unique",
          "date": "date",
          "time_started": "time {HH:MM}",
          "time_ended": "time {HH:MM}",
          "overtime_duration": "integer"
        }
      ],
      "overtime_duration_total": "integer",
      "amount": "integer"
    },
    {
      "id": "integer, unique",
      "name": "string",
      "salary": "long",
      "overtimes": [
        {
          "id": "integer, unique",
          "date": "date",
          "time_started": "time {HH:MM}",
          "time_ended": "time {HH:MM}",
          "overtime_duration": "integer"
        }
      ],
      "overtime_duration_total": "integer",
      "amount": "integer"
    }
  ]
}
```
