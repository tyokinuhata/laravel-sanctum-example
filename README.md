# laravel-sanctum-example

- Laravel SanctumでBearerトークンを使った認証を実装するサンプル

### セットアップ

```bash
$ composer install
$ cp .env.example .env
$ php artisan key:generate
$ touch database/database.sqlite
$ php artisan migrate
$ php artisan serve
```

### エンドポイント

#### 認証不要のエンドポイント

```
GET /api/hello
```

##### リクエスト

```json
-
```

##### レスポンス

```json
{
    "message": "hello, world!"
}
```

#### サインアップ

```
GET /api/auth/signup
```

##### リクエスト

```json
{
    "name": "テスト",
    "user_id": "test",
    "password": "testtest"
}
```

##### レスポンス

```json
{
    "token": "9|5aJ85oVEVPwuuXbvGnr4UgpsNnyPSMt28ZGNiRYEb16c0f4f"
}
```

#### サインイン

```
GET /api/auth/signin
```

##### リクエスト

```json
{
    "user_id": "test",
    "password": "testtest"
}
```

##### レスポンス

```json
{
    "token": "7|eZDe8pFa4t9khg94H2BMdvs4Q60z5v2AE3iD60Sf99e0c72b"
}
```

#### 認証が必要なエンドポイント

- リクエストヘッダに `Authorization: Bearer {token}` を付与する

```
GET /api/user
```

##### リクエスト

```json
-
```

##### レスポンス

```json
{
    "id": 1,
    "name": "テスト",
    "user_id": "test",
    "created_at": "2024-03-23T10:56:38.000000Z",
    "updated_at": "2024-03-23T10:56:38.000000Z"
}
```
