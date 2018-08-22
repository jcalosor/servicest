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
     * Default namespace / location of argument Controller
     * @var string
     */
    protected $controllerNamespace;

    /**
     * Default extension to identify the argument type
     * default: Controller
     * @var string
     */
    protected $argumentExtension;

    /**
     * Path to stubs resource
     */
    protected $stubs = __DIR__.'/../stubs';

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
        $this->controllerNamespace = 'Http/Controllers/';
        $this->argumentExtension = 'Controller';
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
     * @param  string
     * @return boolean
     */
    public function rateResponse($response)
    {
    	return in_array(strtolower($response), ['y', 'yes']);
    }
}
