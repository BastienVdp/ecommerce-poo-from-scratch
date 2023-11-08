E-commerce PHP MVC 
===

## Informations
- Title:  `E-commerce PHP MVC`
- Author:  `neitsab`

## Installation
- Clone the projet using git
- Run `composer install`
- Configure the app/config.php 
- Run migrations by executing `php database/index.php --seed --refresh (facultatif)
  
## Features
- Router
- Migrations / Factory / Seeder
- Relations between Models
- Middlewares
- User Authentication
- Content Management 
- Shopping Cart
- Administration
- File Uploader

## Guide 
- Create your migrations in Database\Migrations following the convention
- Create your models in App\Models 
- Create your controller in App\Controllers
- Defining your routes in app/routes.php

## Directory Hierarchy
```
|—— app
|    |—— Actions
|        |—— Auth
|            |—— LoginAction.php
|            |—— RegisterAction.php
|        |—— Category
|            |—— CreateCategoryAction.php
|            |—— DeleteCategoryAction.php
|            |—— UpdateCategoryAction.php
|        |—— Product
|            |—— CreateProductAction.php
|            |—— DeleteProductAction.php
|            |—— UpdateProductAction.php
|    |—— config.php
|    |—— Controllers
|        |—— AdminController.php
|        |—— AuthController.php
|        |—— CartController.php
|        |—— CategoryController.php
|        |—— HomeController.php
|        |—— ProductController.php
|        |—— ProfileController.php
|    |—— Core
|        |—— Application.php
|        |—— Controller.php
|        |—— Database.php
|        |—— Factory.php
|        |—— Middleware.php
|        |—— Migration.php
|        |—— Model.php
|        |—— Request.php
|        |—— Response.php
|        |—— Router.php
|        |—— Runner.php
|        |—— Session.php
|        |—— Validation.php
|        |—— View.php
|    |—— Middlewares
|        |—— AdminMiddleware.php
|        |—— AuthMiddleware.php
|    |—— Models
|        |—— Category.php
|        |—— Order.php
|        |—— Product.php
|        |—— User.php
|    |—— routes.php
|    |—— Services
|        |—— FileUploader.php
|    |—— Trait
|        |—— Relationship.php
|—— composer.json
|—— composer.lock
|—— database
|    |—— factories
|        |—— CategoryFactory.php
|        |—— ProductFactory.php
|        |—— UserFactory.php
|    |—— index.php
|    |—— migrations
|        |—— m001_create_users_table.php
|        |—— m002_create_categories_table.php
|        |—— m003_create_products_table.php
|        |—— m004_create_orders_table.php
|        |—— m005_create_order_product_table.php
|    |—— seeders
|        |—— DatabaseSeeder.php
|—— public
|    |—— .htaccess
|    |—— images
|        |—— products
|    |—— index.php
|—— ressources
|    |—— views
|        |—— admin
|            |—— categories
|                |—— create.php
|                |—— edit.php
|                |—— index.php
|            |—— dashboard.php
|            |—— products
|                |—— create.php
|                |—— edit.php
|                |—— index.php
|            |—— users.php
|        |—— auth
|            |—— login.php
|            |—— register.php
|        |—— cart
|            |—— index.php
|        |—— home
|            |—— index.php
|        |—— layouts
|            |—— admin.php
|            |—— default.php
|            |—— guest.php
|            |—— header.php
|            |—— profile.php
|        |—— products
|            |—— index.php
|            |—— show.php
|        |—— profile
|            |—— index.php
|            |—— orders
|                |—— index.php
|                |—— show.php
```

