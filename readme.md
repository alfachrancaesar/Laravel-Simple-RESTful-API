"Simple RESTful API using Laravel Framework"

--------------------------------------------------------------------------------


STEP 1: Install Laravel 5.4.*

composer create-project --prefer-dist laravel/laravel simple-restful "5.4."

--------------------------------------------------------------------------------

STEP 2: Install Dingo Package 

-> Inside composer.json

"require": {
    "dingo/api": "2.0.0-alpha1"
}

-> Register Service Provider inside app.php
Dingo\Api\Provider\LaravelServiceProvider::class

-> composer update and publish vendor in Terminal
php artisan vendor:publish --provider="Dingo\Api\Provider\LaravelServiceProvider"

---------------------------------------------------------------------------------

STEP 3: Add API Prefix

-> Inside .env

API_PREFIX=api
API_DEBUG=true

---------------------------------------------------------------------------------

STEP 4: Creating Endpoint API

-> Inside route/api.php

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', ['namespace' => 'App\Http\Controllers'], function($api){
	contains RESTful methods (GET, POST, PUT, DELETE)
});

----------------------------------------------------------------------------------

STEP 5: Database Configuration

-> Inside .env

Set database name

----------------------------------------------------------------------------------

STEP 6: Migrate User

-> In terminal

php artisan migrate

----------------------------------------------------------------------------------

STEP 7: User Seeder

-> In terminal

php artisan make:seeder UsersTableSeeder

-> Inside UsersTableSeeder.php, create 5 fakers data

public function run()
    {
        factory(App\User::class,5)->create();
    }

-> Then, call the seeder from User to the main seeder inside DatabaseSeeder.php

public function run()
    {
          $this->call(UsersTableSeeder::class);
    }

-> In Terminal

php artisan db:seed

-----------------------------------------------------------------------------------

STEP 8: RESTful Methods Implementation

-> In Terminal, create APIUserController (contains RESTful methods)

php artisan make:controller APIUserController

-> Then, serve

php artisan serve

----------------------------------------------------------------------------------

STEP 9: POSTMAN REST Client

Web Apps	vs	Web Service (RESTful)

Create 			POST
Read			GET
Update 			PUT
Delete 			DELETE


-> Open POSTMAN

-> Create Request

-> Serve Terminal

Key: Content-Type


GET localhost:8000/api/users
-> Change value to application/json
-> Body: none
-> Send GET

POST localhost:8000/api/users
-> Change value to application/x-www-form-urlencoded
-> Change body, add key and value
-> Send POST

PUT localhost:8000/api/users/id
-> Change value to application/x-www-form-urlencoded
-> Change body, edit value for update
-> Change url /id to which id you want to be updated (int)
-> Send PUT

DELETE localhost:8000/api/users/id
-> Change url /id to which id you want to be deleted (int)
-> Send DELETE

----------------------------------------------------------------------------------

STEP 10: JWT Authentication

-> Inside composer.json, install tymon jwt library

"require": {
    "tymon/jwt-auth": "0.5."
}

-> Inside app.php, add in the providers and aliases

'Tymon\JWTAuth\Providers\JWTAuthServiceProvider'
'JWTAuth' => 'Tymon\JWTAuth\Facades\JWTAuth',
'JWTFactory' => 'Tymon\JWTAuth\Facades\JWTFactory'

-> Publish config in terminal

php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\JWTAuthServiceProvider"

php artisan jwt:generate

----------------------------------------------------------------------------------

STEP 11: Creating Login Function and Token

-> Create APIAuthController in API folder as well as APIUserController

php artisan make:controller API\APIAuthController

-> Check APIAuthController for detail explanation

----------------------------------------------------------------------------------

STEP 12: Login Endpoint in POSTMAN

-> Add new route in api.php 

$api->post('login','API\AuthController@login');

-> In POSTMAN, create new request

POST localhost:8000/api/login
-> Change the body to email and password matching the database
-> Successfully logged in!

----------------------------------------------------------------------------------

STEP 13: Creating JWT Auth Middleware 

-> Add route middleware in Kernel.php
-> Check Kernel.php for the routes
-> Open api.php to edit the routes for user and guest
-> Request /users via POSTMAN:

GET localhost:8000/api/users
-> Change the headers and add Authorization with the value of Bearer + token
-> Data are obtained as user!

----------------------------------------------------------------------------------

STEP 14: Creating Logout Function

-> Open the APIAuthController and add the logout function
-> Check the APIAuthController for detailed function
-> Open api.php to add another route for users (logout)
-> Request /logout via POSTMAN:

POST localhost:8000/api/logout
-> Use the previous headers
-> Add the key 'token' and value of the token into the body
-> Successfully logged out!