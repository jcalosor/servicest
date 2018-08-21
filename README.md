# Servicest
Laravel 5.6 Services class generator

<p>
<a href="https://travis-ci.com/jcalosor/servicest"><img src="https://travis-ci.com/jcalosor/servicest.svg?branch=master" alt="build:passed"></a>
<a href="https://packagist.org/packages/jcalosor/servicest"><img src="https://poser.pugx.org/jcalosor/servicest/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/jcalosor/servicest"><img src="https://poser.pugx.org/jcalosor/servicest/v/unstable.svg" alt="Latest Unstable Version"></a>
<a href="https://packagist.org/packages/jcalosor/servicest"><img src="https://poser.pugx.org/jcalosor/servicest/license.svg" alt="License"></a>
</p>


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