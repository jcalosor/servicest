# Servicest
Laravel 5.6 Services class generator

<p>
<a href="https://travis-ci.com/jcalosor/servicest"><img src="https://travis-ci.com/jcalosor/servicest.svg?branch=master" alt="build:passed"></a>
<a href="https://packagist.org/packages/jcalosor/servicest"><img src="https://poser.pugx.org/jcalosor/servicest/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/jcalosor/servicest"><img src="https://poser.pugx.org/jcalosor/servicest/downloads.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/jcalosor/servicest"><img src="https://poser.pugx.org/jcalosor/servicest/license.svg" alt="License"></a>
</p>

## Installation

### Step 1: Execute composer
```
composer require jcalosor/servicest
```

### (Optional): For Laravel versions < 5.5, while in the  laravel directory, edit the config/app.php file
_Add the following code._
```
JCalosor\Servicest\ServicestServiceProvider::class
```

### Step 2: Publish the configuration file
**Note:** _Make sure you are inside the laravel directory first, then run._
```
php artisan vendor:publish --tag=servicest-config
```

### Step 3: Verify the install
**Note:** _Again in the laravel directory, run._
```
php artisan
```
_A new command in the make section should already appear like so:_
```
make:service         Create a new service library class
```

### Installation Done!