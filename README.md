# BabiPoly - E-commerce API

A complete Laravel backend API for the BabiPoly internship project. This is a fully functional e-commerce API with user authentication, product management, categories, orders, and an admin panel.

## 🚀 Features

- **User Authentication** (Register/Login/Logout with Laravel Sanctum)
- **Product Management** (Full CRUD operations)
- **Category Management** (Full CRUD operations)  
- **Order Management** (Full CRUD operations with order items)
- **Admin Panel** (Filament PHP)
- **RESTful API Design** with proper HTTP status codes
- **Token-based Authentication** (Laravel Sanctum)
- **Database Relationships** (Eloquent ORM)
- **Input Validation** with custom error messages
- **API Documentation** (Postman collection)

## 📋 Complete API Endpoints

### 🔐 Authentication
- `POST /api/register` - User registration with validation
- `POST /api/login` - User login with token generation
- `POST /api/logout` - User logout (token invalidation)

### 📂 Categories Management
- `GET /api/categories` - List all categories with their products
- `POST /api/categories` - Create a new category
- `GET /api/categories/{id}` - Get specific category with products
- `PUT /api/categories/{id}` - Update category information
- `DELETE /api/categories/{id}` - Delete a category

### 📦 Products Management
- `GET /api/products` - List all products with their categories
- `POST /api/products` - Create a new product (requires category)
- `GET /api/products/{id}` - Get specific product with category
- `PUT /api/products/{id}` - Update product information
- `DELETE /api/products/{id}` - Delete a product

### 🛒 Orders Management
- `GET /api/orders` - List all orders with user and order items
- `POST /api/orders` - Create a new order with multiple items
- `GET /api/orders/{id}` - Get specific order with details
- `PUT /api/orders/{id}` - Update order status
- `DELETE /api/orders/{id}` - Delete an order

## 🗃️ Database Schema

### Entities and Relationships:
- **Users** 👤 → **Orders** 🛒 (One-to-Many)
- **Orders** 🛒 → **OrderItems** 📦 (One-to-Many) 
- **OrderItems** 📦 → **Products** 📱 (Many-to-One)
- **Categories** 📂 → **Products** 📱 (One-to-Many)

### Key Tables:
- `users` - User authentication and profiles
- `categories` - Product categorization
- `products` - Product information with pricing
- `orders` - Order headers with status
- `order_items` - Individual order line items

## 🛠️ Installation & Setup

### Prerequisites
- PHP 8.0+
- Composer
- SQLite Database

### 1. Clone the Repository
```bash
git clone https://github.com/moustaphabzeih/BabiPoly.git
cd BabiPoly