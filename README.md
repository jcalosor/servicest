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

### Step 2: Publish the configuration file
**Note:** _Make sure you are inside the laravel directory first, then run_
```
php artisan vendor:publish --tag=servicest-config
```

### Step 3: Verify the install
**Note:** _Again the laravel directory, run_
```
php artisan
```
_A new command in the make section should already appear like so:_
```
make:service         Create a new service library class
```

### Installation Done!