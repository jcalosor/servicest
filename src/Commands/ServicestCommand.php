<?php

namespace JCalosor\Servicest\Commands;

use Illuminate\Console\Command;

class ServicestCommand extends Command
{

    /**
     * Application namespace
     *
     * @var string
     */
    protected $namespace;

    /**
      * @var Illuminate\Filesystem\Filesystem
     */
    protected $file;

    /**
     * Default extension to identify the argument type
     * 
     * @example Controller Default
     * @var string
     */
    protected $controllerExtension;

    /**
     * Path to stubs resource
     */
    protected $stubs = __DIR__.'/../stubs';

    /**
     * Path for controllers
     * 
     * @example 'Http/Controllers/' Default
     * @var string
     */
    protected $controllerPath;

    /**
     * Path for models
     * 
     * @example '' Default
     * @var string
     */
    protected $modelPath;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct(); 

        $this->file = app('files');
        $this->namespace = app()->getNamespace();
        $this->controllerPath = $this->config('paths.controllers') ?? 'Http/Controllers/';
        $this->controllerExtension = 'Controller';
        $this->modelPath = $this->config('paths.models') ?? '';
        
    }

    /**
	 * Gets a configuration from package config file.
	 * 
	 * @param  string $key
	 * @return mixed
	 */
    protected function config($key)
    {
        return config('servicest.'.$key);
    }

    /**
     * Determine if the user input is positive.
     * 
     * @param string $response
     * @return boolean
     */
    public function rateResponse($response)
    {
    	return in_array(strtolower($response), ['y', 'yes']);
    }
}
