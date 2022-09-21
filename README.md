### Hexlet tests and linter status:
[![Actions Status](https://github.com/sergeiwerty/php-project-lvl3/workflows/hexlet-check/badge.svg)](https://github.com/sergeiwerty/php-project-lvl3/actions)
[![Tests-check](https://github.com/sergeiwerty/php-project-lvl3/actions/workflows/tests-check.yml/badge.svg)](https://github.com/sergeiwerty/php-project-lvl3/actions/workflows/tests-check.yml)
[![Maintainability](https://api.codeclimate.com/v1/badges/ecb3a9e4842535600b63/maintainability)](https://codeclimate.com/github/sergeiwerty/php-project-lvl3/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/ecb3a9e4842535600b63/test_coverage)](https://codeclimate.com/github/sergeiwerty/php-project-lvl3/test_coverage)

### Link to running application on Heroku:
https://page-analazer.herokuapp.com/

### About
Page analyzer is a full-fledged website based on Laravel framework. It analyzes the specified pages for SEO suitability.
Here are used the basic principles of MVC-architecture: routing, request handlers, template engine, interactions with database.

### Requirements
###### PHP ^8.1
###### Node.js & npm
###### Sqlite for local
###### Docker

### Installation and launching:

In your terminal run:

  ```sh
   git clone https://github.com/sergeiwerty/php-project-lvl3.git
  ```
  ```sh
 cd php-project-lvl3
  ```
  ```sh
 make setup
  ```
  ```sh
 make start
  ```
  ```sh
 docker-compose up server
