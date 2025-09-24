# BabiPoly API Documentation

## Quick Start
**Base URL:** http://localhost:8080

## Authentication Endpoints

### 1. Register User
- **URL:** POST /api/register
- **Data:** name, email, password, password_confirmation

### 2. Login User  
- **URL:** POST /api/login
- **Data:** email, password

## Planned Endpoints
- GET/POST/PUT/DELETE /api/games
- GET/POST /api/moves
## Validation Features

### Registration Validation:
- **Name:** Required, minimum 2 characters, maximum 255 characters
- **Email:** Required, must be valid email format, must be unique
- **Password:** Required, minimum 8 characters, must be confirmed
- **Password Confirmation:** Required, must match password

### Error Handling:
- Returns HTTP 422 status code for validation errors
- Detailed error messages for each field
- Returns HTTP 500 for server errors
- Returns HTTP 201 for successful registration
- Returns HTTP 200 for successful login
