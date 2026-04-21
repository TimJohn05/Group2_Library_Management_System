# Library Management System API

A RESTful API for book management built with Laravel using **session-based authentication**.

## Features

- **Session-Based Authentication** - Secure login/logout using Laravel sessions
- **CRUD Operations** - Full Create, Read, Update, Delete for Books, Authors, and Categories
- **Eloquent Relationships** - Proper database relationships between entities
- **1000+ Records** - Pre-seeded database for testing

## Authentication Method

### What is Session-Based Authentication?

Session-based authentication is a traditional approach where the server creates a session after successful login and stores user information server-side. A session ID is sent to the client as a cookie and included in subsequent requests.

### Authentication Flow

1. **Register**: User submits registration details → Account created in database
2. **Login**: User submits credentials → Server validates → Session created → Session cookie returned
3. **Protected Routes**: Client sends request with session cookie → Server validates session → Request processed
4. **Logout**: User requests logout → Session destroyed → Cookie invalidated

### Advantages

- **Stateful**: Server maintains user state, easy to revoke sessions
- **Secure**: No tokens stored in local storage (less vulnerable to XSS)
- **Simple**: Built-in Laravel session handling
- **Scalable**: Can use database/Redis for session storage

### Disadvantages

- **Server-dependent**: Requires server-side session storage
- **Not ideal for mobile**: Not as easy to use with mobile apps compared to tokens
- **Cookie-based**: Limited to browser clients

## API Endpoints

### Authentication

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/register` | Register new user |
| POST | `/api/login` | Login (creates session) |
| POST | `/api/logout` | Logout (destroys session) |
| GET | `/api/user` | Get authenticated user |
| GET | `/api/session-check` | Check session status |

### Books

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/books` | Get all books |
| GET | `/api/books/{id}` | Get single book |
| POST | `/api/books` | Create new book |
| PUT | `/api/books/{id}` | Update book |
| DELETE | `/api/books/{id}` | Delete book |
| GET | `/api/books/author/{id}` | Get books by author |
| GET | `/api/books/category/{id}` | Get books by category |
| GET | `/api/analytics` | Get total book count |

### Authors

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/authors` | Get all authors |
| GET | `/api/authors/{id}` | Get single author |
| POST | `/api/authors` | Create new author |
| PUT | `/api/authors/{id}` | Update author |
| DELETE | `/api/authors/{id}` | Delete author |

### Categories

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/categories` | Get all categories |
| GET | `/api/categories/{id}` | Get single category |
| POST | `/api/categories` | Create new category |
| PUT | `/api/categories/{id}` | Update category |
| DELETE | `/api/categories/{id}` | Delete category |

## Installation

### Prerequisites

- PHP 8.2+
- Composer
- PostgreSQL (or MySQL/SQLite)

### Setup

```bash
# Clone the repository
git clone <repository-url>
cd Group2_Library_Management_System_Laravel

# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Configure database in .env
# DB_CONNECTION=pgsql
# DB_HOST=127.0.0.1
# DB_PORT=5432
# DB_DATABASE=postgres
# DB_USERNAME=postgres
# DB_PASSWORD=your_password

# Generate application key
php artisan key:generate

# Run migrations and seeders
php artisan migrate --seed

# Start the server
php artisan serve
```

## Testing the API

### Using Postman/cURL

1. **Login First** (creates session cookie):
```bash
curl -c cookies.txt -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"admin@example.com","password":"password123"}'
```

2. **Access Protected Route** (with session cookie):
```bash
curl -b cookies.txt http://localhost:8000/api/books
```

3. **Logout**:
```bash
curl -b cookies.txt -X POST http://localhost:8000/api/logout
```

### Postman Configuration

1. Create a new request
2. Go to **Settings → Cookies** and enable
3. Send login request - cookies will be stored automatically
4. Subsequent requests will include the session cookie

## Test Credentials

- **Email**: `admin@example.com`
- **Password**: `password123`

## Database Schema

```
users
  - id
  - name
  - email
  - password
  - timestamps

authors
  - id
  - name
  - bio
  - email (unique)
  - timestamps

categories
  - id
  - name (unique)
  - description
  - timestamps

books
  - id
  - title
  - isbn (unique)
  - published_year
  - author_id (foreign key)
  - category_id (foreign key)
  - timestamps
```

## Relationships

- **Book** belongs to **Author** and **Category**
- **Author** has many **Books**
- **Category** has many **Books**

## Project Structure

```
app/
├── Http/
│   └── Controllers/
│       └── Api/
│           ├── AuthController.php
│           ├── BookController.php
│           ├── AuthorController.php
│           └── CategoryController.php
└── Models/
    ├── User.php
    ├── Author.php
    ├── Category.php
    └── Book.php

database/
├── migrations/     # Database migrations
├── seeders/       # Database seeders (1000+ records)
└── factories/    # Model factories

routes/
└── api.php        # API routes
```

## License

This project is for educational purposes.
