# BabiPoly API Documentation

## Quick Start
**Base URL:** http://localhost:8080

## Authentication Endpoints

### 1. Register a New User
**URL:** POST /api/register

**Example Request:**
Name: John Doe
Email: john@example.com  
Password: password123
Password Confirmation: password123

**Success Response:**
User registered successfully with ID and token

### 2. Login User
**URL:** POST /api/login

**Example Request:**
Email: john@example.com
Password: password123

**Success Response:**
Login successful with user data and access token

## Planned Endpoints
- GET /api/games - List games
- POST /api/games - Create game
- GET /api/games/1 - Get game details
- PUT /api/games/1 - Update game
- DELETE /api/games/1 - Delete game
