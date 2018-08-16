<?php

namespace JCalosor\Servicest;

use Illuminate\Support\ServiceProvider;
use JCalosor\Servicest\Commands\MakeServiceCommand;

class ServicestServiceProvider extends ServiceProvider
{
    /**
     * Register commands
     * @var array
     */
    private $servicestCommands = [
        MakeServiceCommand::class
    ];
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/servicest.php', 'servicest');
    	$this->publishes([
	        __DIR__.'/config/servicest.php' => app()->basePath() . '/config/servicest.php'
	    ], 'servicest-config');
        $this->registerCommands();
    }

     /**
     * Registers servicest commands.
     */
    public function registerCommands()
    {
    	$this->commands($this->servicestCommands);
    }
}
