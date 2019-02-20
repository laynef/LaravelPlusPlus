# Laravel++

Autogenerate your CRUD operations with Swagger like API documentation

## Requirements

## Installation

`composer require laravelpp/laravelpp`

## CLI Commands

Your command CLI command bin path is `./vendor/bin/laravelpp`

![CLI DOCUMENTATION](./docs/command_list.png)

## Getting Started

Run the initialize command to get started:

`./vendor/bin/laravelpp init`

Run the model command to generate a migration, model, and completed controller:

This controller is overwritable when you declare the same method name in it's controller class.

`./vendor/bin/laravelpp model (model-name)`

Update your migration and model file. Then declare your routes with `Route::apiResource`.
The controller has all api resources completed by default. These will fail if your migration and
model are not completed. And your routes are not defined.

Steps to do after:

- Update model file
- Update migration file
- Define your routes with Route::apiResource

Run the make_test command to make phpunit tests:

`./vendor/bin/laravelpp make_test (resource-route-name)`

After your tests are completed. Update your testStore and testUpdate methods.
Add the keys available to your request body. If you have special headers like
"Authorization" add those to the public variable $headers in that file.

Steps to do after:

- Update request body based on the controller model's $fillable keys
- Update your headers for all the requests

`phpunit`
