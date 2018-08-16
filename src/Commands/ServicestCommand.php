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
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct(); 

        $this->file = app('files');
        $this->namespace = app()->getNamespace();
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
}
