# API Documentation

## Overview

This is the API documentation for the `Laravel` application. The API is built using the `Laravel` framework and
`Passport` for authentication. The API is a RESTful API that allows users to perform various actions such as creating,
updating, and deleting articles, managing users, roles, and permissions.
---

## Installation

1. Clone the repository
    ```bash
    git clone
2. Install dependencies
    ```bash
    composer install
    ```
3. Create a `.env` file
    ```bash
    cp .env.example .env
    ```

4. Generate an application key
    ```bash
    php artisan key:generate
    ```

5. Create a database and update the `.env` file with the database credentials
6. Run the migrations
    ```bash
    php artisan migrate
    ```

7. Generate personal access client
    ```bash
    php artisan passport:client --personal
    ```

8. Update the `.env` file with the `PERSONAL_ACCESS_CLIENT_ID` and `PERSONAL_ACCESS_CLIENT_SECRET` generated in the
   previous step

9. Fake data
    ```bash
    php artisan db:seed
    ```

10. Start the server
    ```bash
    php artisan serve
    ```

---

## Live Documentation URL

https://tanjilahmed.com/user-management-docs

---

## Users for Testing

After running the `php artisan db:seed` command, the following users will be created:

### Admin

- **Email**: `admin@example.com`
- **Password**: `admin123`

### User

- **Email**: `user@example.com`
- **Password: `user123`

## Table of Contents

1. [Authentication](#authentication)
    - [Register](#register)
    - [Login](#login)
    - [Logout](#logout)
2. [Admin](#admin)
    - [Roles](#roles)
        - [Create Role](#create-role)
        - [List Roles](#list-roles)
        - [Update Role](#update-role)
        - [Delete Role](#delete-role)
    - [Permissions](#permissions)
        - [Create Permission](#create-permission)
        - [List Permissions](#list-permissions)
        - [Update Permission](#update-permission)
        - [Delete Permission](#delete-permission)
    - [Users](#users)
        - [List Users](#list-users)
        - [Assign Role](#assign-role)
        - [Remove Role](#remove-role)
        - [Assign Permission](#assign-permission)
        - [Remove Permission](#remove-permission)
3. [Articles](#articles)
    - [List Articles](#list-articles)
    - [Get Article](#get-article)
    - [Create Article](#create-article)
    - [Update Article](#update-article)
    - [Delete Article](#delete-article)

---

## Authentication

### Register

#### Request

- **URL**: `/register`
- **Method**: `POST`
- **Description**: Register a new user.

**Request Body**:

```json
{
    "name"    : "string (required, max: 255)",
    "email"   : "string (required, email, max: 255, unique: users)",
    "password": {
        "required"     : true,
        "string"       : true,
        "confirmed"    : true,
        "min"          : 8,
        "mixedCase"    : true,
        "numbers"      : true,
        "symbols"      : true,
        "uncompromised": true
    }
}
```

#### Response

```json
{
    "token": "string (token)"
}
```

---

### Login

#### Request

- **URL**: `/login`
- **Method**: `POST`
- **Description**: Login a user.

**Request Body**:

```json
{
    "email"   : "string (required, email, max: 255)",
    "password": "string (required)"
}
```

#### Response

```json
{
    "token": "string (token)"
}
```

---

### Logout

#### Request

- **URL**: `/logout`
- **Method**: `POST`
- **Description**: Logout a user.
- **Headers**:
    - `Authorization`: `Bearer <token
    - `Accept`: `application/json`
    - `Content-Type`: `application/json`

#### Response

```json
{
    "message": "Successfully logged out"
}
```

---

## Admin

### Roles

#### Create Role

#### Request

- **URL**: `/roles`
- **Method**: `POST`
- **Description**: Create a new role.
- **Headers**:
    - `Authorization`: `Bearer <token
    - `Accept`: `application/json`
    - `Content-Type`: `application/json`

**Request Body**:

```json
{
    "name": "string (required, max: 255)"
}
```

#### Response

```json
{
    "message": "Role created successfully"
}
```

---

#### List Roles

#### Request

- **URL**: `/roles`
- **Method**: `GET`
- **Description**: List all roles.
- **Headers**:
    - `Authorization`: `Bearer <token
    - `Accept`: `application/json`
    - `Content-Type`: `application/json`

#### Response

```json
{
    "roles": [
        {
            "id"        : "integer",
            "name"      : "string",
            "created_at": "string",
            "updated_at": "string"
        }
    ]
}
```

---

#### Update Role

#### Request

- **URL**: `/roles/{id}`
- **Method**: `PUT`
- **Description**: Update a role.
- **Headers**:
    - `Authorization`: `Bearer <token
    - `Accept`: `application/json`
    - `Content-Type`: `application/json`
    - `Accept`: `application/json`

**Request Body**:

```json
{
    "name": "string (required, max: 255)"
}
```

#### Response

```json
{
    "message": "Role updated successfully"
}
```

---

#### Delete Role

#### Request

- **URL**: `/roles/{id}`
- **Method**: `DELETE`
- **Description**: Delete a role.
- **Headers**:
    - `Authorization`: `Bearer <token
    - `Accept`: `application/json`
    - `Content-Type`: `application/json`

#### Response

```json
{
    "message": "Role deleted successfully"
}
```

---

### Permissions

#### Create Permission

#### Request

- **URL**: `/permissions`
- **Method**: `POST`
- **Description**: Create a new permission.
- **Headers**:
    - `Authorization`: `Bearer <token
    - `Accept`: `application/json`
    - `Content-Type`: `application/json`

**Request Body**:

```json
{
    "name": "string (required, max: 255)"
}
```

#### Response

```json
{
    "name"      : "string",
    "updated_at": "timestamp",
    "created_at": "timestamp",
    "id"        : "integer"
}
```

---

#### List Permissions

#### Request

- **URL**: `/permissions`
- **Method**: `GET`
- **Description**: List all permissions.
- **Headers**:
    - `Authorization`: `Bearer <token
    - `Accept`: `application/json`
    - `Content-Type`: `application/json`
- **Response**:

```json
[
    {
        "id"        : "integer",
        "name"      : "string",
        "created_at": "string",
        "updated_at": "string"
    }
]
```

---

#### Update Permission

#### Request

- **URL**: `/permissions/{id}`
- **Method**: `PUT`
- **Description**: Update a permission.
- **Headers**:
    - `Authorization`: `Bearer <token
    - `Accept`: `application/json`
    - `Content-Type`: `application/json`

**Request Body**:

```json
{
    "name": "string (required, max: 255)"
}
```

#### Response

```json
{
    "message": "Permission updated successfully"
}
```

---

#### Delete Permission

#### Request

- **URL**: `/permissions/{id}`
- **Method**: `DELETE`
- **Description**: Delete a permission.
- **Headers**:
    - `Authorization`: `Bearer <token
    - `Accept`: `application/json`
    - `Content-Type`: `application/json`

#### Response

```json
{
    "message": "Permission deleted successfully"
}
```

---

### Users

#### List Users

#### Request

- **URL**: `/users`
- **Method**: `GET`
- **Description**: List all users.
- **Headers**:
    - `Authorization`: `Bearer <token
    - `Accept`: `application/json`
    - `Content-Type`: `application/json`

#### Response

```json
[
    {
        "id"               : "integer",
        "name"             : "string",
        "email"            : "string",
        "email_verified_at": "timestamp",
        "created_at"       : "timestamp",
        "updated_at"       : "timestamp",
        "roles"            : [
            {
                "id"        : "integer",
                "name"      : "string",
                "created_at": "timestamp",
                "updated_at": "timestamp",
                "pivot"     : {
                    "user_id": "integer",
                    "role_id": "integer"
                }
            }
        ],
        "permissions"      : [
            {
                "id"        : "integer",
                "name"      : "string",
                "created_at": "timestamp",
                "updated_at": "timestamp",
                "pivot"     : {
                    "user_id"      : "integer",
                    "permission_id": "integer"
                }
            }
        ]
    }
]
```

---

#### Assign Role

#### Request

- **URL**: `/users/{id}/assign-role`
- **Method**: `POST`
- **Description**: Assign a role to a user.
- **Headers**:
    - `Authorization`: `Bearer <token
    - `Accept`: `application/json`
    - `Content-Type`: `application/json`

**Request Body**:

```json
    {
    "role_id": "integer (required)"
}
```

#### Response

```json
{
    "message": "Role assigned successfully"
}
```

---

#### Remove Role

#### Request

- **URL**: `/users/{id}/remove-role`
- **Method**: `POST`
- **Description**: Remove a role from a user.
- **Headers**:
    - `Authorization`: `Bearer <token
    - `Accept`: `application/json`
    - `Content-Type`: `application/json`

**Request Body**:

```json
    {
    "role_id": "integer (required)"
}
```

#### Response

```json
{
    "message": "Role removed successfully"
}
```

---

#### Assign Permission

#### Request

- **URL**: `/users/{id}/assign-permission`
- **Method**: `POST`
- **Description**: Assign a permission to a user.
- **Headers**:
    - `Authorization`: `Bearer <token
    - `Accept`: `application/json`
    - `Content-Type`: `application/json`

**Request Body**:

```json
{
    "permission_id": "integer (required)"
}
```

#### Response

```json
{
    "message": "Permission assigned successfully"
}
```

---

#### Remove Permission

#### Request

- **URL**: `/users/{id}/remove-permission`
- **Method**: `POST`
- **Description**: Remove a permission from a user.
- **Headers**:
    - `Authorization`: `Bearer <token
    - `Accept`: `application/json`
    - `Content-Type`: `application/json`

**Request Body**:

```json
{
    "permission_id": "integer (required)"
}
```

#### Response

```json
{
    "message": "Permission removed successfully"
}
```

---

### Articles

#### List Articles

#### Request

- **URL**: `/articles`
- **Method**: `GET`
- **Description**: List all articles.
- **Headers**:
    - `Authorization`: `Bearer <token
    - `Accept`: `application/json`
    - `Content-Type`: `application/json`

#### Response

```json
[
    {
        "id"        : "integer",
        "title"     : "string",
        "content"   : "string",
        "user_id"   : "integer",
        "created_at": "timestamp",
        "updated_at": "timestamp"
    }
]
```

---

#### Get Article

#### Request

- **URL**: `/articles/{id}`
- **Method**: `GET`
- **Description**: Get an article.
- **Headers**:
    - `Authorization`: `Bearer <token
    - `Accept`: `application/json`
    - `Content-Type`: `application/json`

#### Response

```json
{
    "id"        : "integer",
    "title"     : "string",
    "content"   : "string",
    "user_id"   : "integer",
    "created_at": "timestamp",
    "updated_at": "timestamp"
}
```

---

#### Create Article

#### Request

- **URL**: `/articles`
- **Method**: `POST`
- **Description**: Create a new article.
- **Headers**:
    - `Authorization`: `Bearer <token
    - `Accept`: `application/json`
    - `Content-Type`: `application/json`

**Request Body**:

```json
{
    "title"  : "string (required, max: 255)",
    "content": "string (required)"
}
```

#### Response

```json
{
    "message": "Article created successfully"
}
```

---

#### Update Article

#### Request

- **URL**: `/articles/{id}`
- **Method**: `PUT`
- **Description**: Update an article.
- **Headers**:
    - `Authorization`: `Bearer <token
    - `Accept`: `application/json`
    - `Content-Type`: `application/json`

**Request Body**:

```json
{
    "title"  : "string (required, max: 255)",
    "content": "string (required)"
}
```

#### Response

```json
{
    "message": "Article updated successfully"
}
```

---

#### Delete Article

#### Request

- **URL**: `/articles/{id}`
- **Method**: `DELETE`
- **Description**: Delete an article.
- **Headers**:
    - `Authorization`: `Bearer <token
    - `Accept`: `application/json`
    - `Content-Type`: `application/json`
- **Response**:

```json
{
    "message": "Article deleted successfully"
}
```

---

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
