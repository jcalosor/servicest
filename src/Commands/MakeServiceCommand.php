<?php

namespace JCalosor\Servicest\Commands;

use Illuminate\Support\Facades\Artisan;

class MakeServiceCommand extends ServicestCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service 
                            {controller : The name of the class corresponding to an existing controller class [ Must be an existing controller class ]} 
                            {--r|resource : Generate a resource controller class}
                            {--m|model : Generate a model class}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service library class';


    /**
     * Defined namespace path
     *
     * @var string
     */
    protected $controller;

    /**
     * The name of the controller
     *
     * @var string
     */
    protected $controllerName;

    /**
     * Defined model namespace
     *
     * @var string
     */
    protected $model;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $modelName;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Build Controller or Model first,
        // Build the service last
        $this->executeBuild()->buildService();
    }

    /**
     * Build Class function
     * @final 
     * @return void
     */
    final protected function executeBuild(): object 
    {
        // Mandatory build the controller
        $this->buildController();

        if($this->option('model')){
            $this->buildModel();
        }

        return $this;
    }

    /**
     * Get Stub
     *
     * @return String
     */
    protected function getStub(): String
    {
        $stub = null;
        if($this->option('model')){
           $stub = $this->stubs.'/service.model.stub'; 
        }
        $stub = $stub ?? $this->stubs.'/service.plain.stub';
        return $stub;
    }

    /**
     * Build Model function
     * Check if a corresponding model is existing,
     * Create if needed
     * @return void
     */
    protected function buildModel(): void
    {
        // Default path
        $path = $this->namespace.$this->modelPath.$this->argument('controller');
        // Model namespace
        $this->model = str_replace('/', '\\', $path);
        if ($this->laravel->runningInConsole()) {
            // Model does not exists
            if (!class_exists($this->model.$this->modelExtenstion)) {
                $response = $this->ask("Model [{$this->model}] does not exist. Would you like to create it?", 'Yes');
                if ($this->rateResponse($response)) {
                    // Build the controller by mocking the Artisan::call()
                    $this->mock('model', $this->model.$this->modelExtenstion);
                    $this->line("Model [{$this->model}] has been successfully created.");
                } else {
                    $this->line("Model [{$this->model}] does not get created.");
                }
            }
        }

        $modelParts = explode('\\', $this->model);
        $this->modelName = array_pop($modelParts);
        
    }

    /**
     * Build Controller
     * Check if a corresponding controller is existing,
     * Create if needed
     * @return void
     */
    protected function buildController(): void
    {
        $path = $this->namespace.$this->controllerPath.$this->argument('controller');
        // Controller namespace
        $this->controller = str_replace('/', '\\', $path);
        if ($this->laravel->runningInConsole()) {
            // Controller does not exists
            if (!class_exists($this->controller.$this->controllerExtension)) { // Append the 'Controller' suffix for path checking
                $response = $this->ask("Controller [{$this->controller}] does not exist. Would you like to create it?", 'Yes');
                if ($this->rateResponse($response)) {
                    // Build the controller by mocking the Artisan::call()
                    $this->mock('controller', $this->controller.$this->controllerExtension);
                    $this->line("Controller [{$this->controller}] has been successfully created.");
                } else {
                    $this->line("Controller [{$this->controller}] does not get created.");
                }
            }
        }

        $controllerParts = explode('\\', $this->controller);
        $this->controllerName = array_pop($controllerParts);
    }

    /**
     * Build Service
     * The process of creating the Service
     * Requires an existing controller by 'default'
     *
     * @return void
     */
    protected function buildService(): void
    {
        $content = $this->file->get($this->getStub());
        $replacements = [
            '%controller%'                   => $this->controller,
            '%serviceName%'                  => $this->controllerName,
            '%modelName%'                    => $this->modelName,
            '%namespaces.services%'          => $this->namespace.$this->config('namespaces.services')
        ];
        $content = str_replace(array_keys($replacements), array_values($replacements), $content);
        $fileName = $this->controllerName.'Service';
        $fileDirectory = app()->basePath().'/app/'.$this->config('paths.services');
        $filePath      = $fileDirectory.$fileName.'.php';
        // Check if the directory exists, if not create...
        if (!$this->file->exists($fileDirectory)) {
            $this->file->makeDirectory($fileDirectory, 0755, true);
        }
        if ($this->laravel->runningInConsole() && $this->file->exists($filePath)) {
            $response = $this->ask("The service [{$fileName}] already exists. Do you want to overwrite it?", 'Yes');
            if (!$this->rateResponse($response)) {
                $this->line("The service [{$fileName}] will not be overwritten.");
                return;
            }
        }
        $this->line("The service [{$fileName}] has been created.");
        $this->file->put($filePath, $content);
    }
    
    /**
     * Mock Artisan function ::call()
     * @uses Artisan::call Anonymous
     * @param String $command
     * @param String $argument
     * @return void
     */
    final protected function mock(String $command, String $argument): void
    {
        $base = 'make:';
        $parameters = [];
        switch($command){
            case 'controller':
                $parameters['--resource'] = ($this->option('resource')) ? true : false;
            break;
        }
        $command = (isset($command)) ? $base.$command : $base.'controller';
        $parameters['name'] = (isset($argument)) ? $argument : 'Base';

        Artisan::call($command, $parameters);
    }
}
