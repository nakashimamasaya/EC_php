# CakePHP Application Skeleton

[![Build Status](https://img.shields.io/travis/cakephp/app/master.svg?style=flat-square)](https://travis-ci.org/cakephp/app)
[![Total Downloads](https://img.shields.io/packagist/dt/cakephp/app.svg?style=flat-square)](https://packagist.org/packages/cakephp/app)

A skeleton for creating applications with [CakePHP](https://cakephp.org) 3.x.

The framework source code can be found here: [cakephp/cakephp](https://github.com/cakephp/cakephp).

## Installation

1. Download [Composer](https://getcomposer.org/doc/00-intro.md) or update `composer self-update`.
2. Run `php composer.phar create-project --prefer-dist cakephp/app [app_name]`.

If Composer is installed globally, run

```bash
composer create-project --prefer-dist cakephp/app
```

In case you want to use a custom app dir name (e.g. `/myapp/`):

```bash
composer create-project --prefer-dist cakephp/app myapp
```

You can now either use your machine's webserver to view the default home page, or start
up the built-in webserver with:

```bash
bin/cake server -p 8765
```

Then visit `http://localhost:8765` to see the welcome page.

## Update

Since this skeleton is a starting point for your application and various files
would have been modified as per your needs, there isn't a way to provide
automated upgrades, so you have to do any updates manually.

## Configuration

Read and edit `config/app.php` and setup the `'Datasources'` and any other
configuration relevant for your application.

## Layout

The app skeleton uses a subset of [Foundation](http://foundation.zurb.com/) (v5) CSS
framework by default. You can, however, replace it with any other library or
custom styles.


## Table design

### users table
| Field         | Type         | Null | Key | Default | Extra          |
|:-----------:|:------------:|:------------:|:------------:|:------------:|:------------:|
|id|INT|NO|PRYMARY|-|AUTO_INCREMENT|
|firstname|VARCHAR(255)|NO|-|-|-|
|lastname|VARCHAR(255)|NO|-|-|-|
|email|VARCHAR(255)|NO|-|-|UNIQUE|
|postNumber|VARCHAR(255)|NO|-|-|-|
|prefecture|VARCHAR(255)|NO|-|-|-|
|address|VARCHAR(255)|NO|-|-|-|
|password|VARCHAR(255)|NO|-|-|-|
|level|INT|NO|-|0|-|

level 0:(Normal User)   1:(Seller User) 2:(Admin User)

### products table
| Field         | Type         | Null | Key | Default | Extra          |
|:-----------:|:------------:|:------------:|:------------:|:------------:|:------------:|
|id|INT|NO|PRY|-|AUTO_INCREMENT|
|title|VARCHAR(255)|NO|-|-|-|
|img|VARCHAR(255)|NO|-|初期画像URL|-|
|details|TEXT|YES|-|-|-|
|price|DECIMAL(10,3)|NO|-|-|-|
|stock|INT|NO|-|-|-|
|saleDate|TIMESTAMP|NO|-|-|-|
|user_id|INT|NO|FOREIGN|-|-|

### Purchase table
| Field         | Type         | Null | Key | Default | Extra          |
|:-----------:|:------------:|:------------:|:------------:|:------------:|:------------:|
|id|INT|NO|PRY|-|AUTO_INCREMENT|
|purchaseDate|TIMESTAMP|NO|-|-|-|
|level|INT|NO|-|0|-|
|user_id|INT|NOT|FOREIGN|-|-|

level:0(Before purchase) level:1(After purchase)

### Cart table
| Field         | Type         | Null | Key | Default | Extra          |
|:-----------:|:------------:|:------------:|:------------:|:------------:|:------------:|
|user_id|INT|NOT|PRIMARY|-|-|
|product_id|INT|NOT|PRIMARY|-|-|
|Purchase_id|INT|NOT|PRIMARY|-|-|
|count|INT|NOT|-|-|-|
