# Servicest
Laravel 5.6 Services class generator

[![Latest Stable Version](https://poser.pugx.org/jcalosor/servicest/v/stable)](https://packagist.org/packages/jcalosor/servicest)
[![Latest Unstable Version](https://poser.pugx.org/jcalosor/servicest/v/unstable)](https://packagist.org/packages/jcalosor/servicest)
[![License](https://poser.pugx.org/jcalosor/servicest/license)](https://packagist.org/packages/jcalosor/servicest)


## Installation

### Step 1: Execute composer
```
composer require jcalosor/servicest
```

### Step 2: While in the  laravel directory, edit the config/app.php file
_Add the following code._
```
JCalosor\Servicest\ServicestServiceProvider::class
```

### Step 3: Publish the configuration file
**Note:** _Make sure you are inside the laravel directory first, then run._
```
php artisan vendor:publish --tag=servicest-config
```

### Step 4: Verify the install
**Note:** _Again the in laravel directory, run._
```
php artisan
```
_A new command in the make section should already appear like so:_
```
make:service         Create a new service library class
```

### Installation Done!