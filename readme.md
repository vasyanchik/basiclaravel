## Laravel Test Project

This is test laravel project.

Steps to set it up

- Clone this repository from [https://github.com/vasyanchik/basiclaravel](https://github.com/vasyanchik/basiclaravel).
- Create two databases: one for main project and one for testing.
- Copy .env.example into .env and .env.testing. Configure them with database access data that you have.
- Run `composer install` to install dependencies
- Run `php artisan key:generate` to generate key
- Run `php artisan migrate` to migrate database structure
- Run `php artisan db:seed` to add some sample data into database
- Open project in browser
- Run `phpunit` for tests


## API ENDPOINTS
POST `/api/voucher` - add new voucher
Expected parameters: 
- `discount` numerical, with amount of discount (10,15,20,25)
- `start_date` date
- `end_date` date

Expected response - array with created voucher
 

POST `/api/product` - add new product
Expected parameters:
- `name` string, name of product
- `price` numerical, price for product

Expected response - array with created product

PUT `/api/product/{product}/{voucher}` - add voucher for a product
URL Parameters:
- `product` numerical, id of product
- `voucher` numerical, id of voucher

Expected response - array with product

DELETE `/api/product/{product}/{voucher}` - unlink voucher from a product
URL Parameters:
- `product` numerical, id of product
- `voucher` numerical, id of voucher

Expected response - array with product

POST `/api/product/{product}/buy` - buy product
URL Parameters:
- `product` numerical, id of product

Expected response - `ok` string


