# Slim PHP REST API

## Videó
[Slim PHP REST API 70 perc alatt](https://www.youtube.com/watch?v=l1YEWxTJol8)

## Endpoints

| URL           | HTTP method | Auth | JSON Response       |
|---------------|-------------|------|---------------------|
| /users/login  | POST        |      | user's token        |
| /users        | GET         |  Y   | all users           |
| /products     | GET         |      | all products        |
| /products     | POST        |  Y   | new product added   |
| /products     | PATCH       |  Y   | edited product      |
| /products     | DELETE      |  Y   | true / false        |
