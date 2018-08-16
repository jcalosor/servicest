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
    protected $signature = 'make:service {controller}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service library class';

    /**
     * Stubs
     *
     * @var array
     */
    protected $stubs = [
        'service' => __DIR__.'/../stubs/Services/services.stub'
    ];

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
        $this->testController();
        $this->createService();
    }

    /**
     * Test Controller
     * Check if a corresponding controller is existing,
     * Create if needed
     * @return void
     */
    protected function testController() : void
    {
        $controller = $this->namespace.$this->controllerNamespace.$this->argument('controller');
        $this->controller = str_replace('/', '\\', $controller);
        if ($this->laravel->runningInConsole()) {
            // Controller does not exists
            if (!class_exists($this->controller.$this->argumentExtension)) { // Append the 'Controller' suffix for path checking
                $response = $this->ask("Controller [{$this->controller}] does not exist. Would you like to create it?", 'Yes');
                if ($this->isResponsePositive($response)) {
                    Artisan::call('make:controller', [
                        'name' => $this->controller.$this->argumentExtension,
                    ]);
                    $this->line("Controller [{$this->controller}] has been successfully created.");
                } else {
                    $this->line("Failed to create controller [{$this->controller}].");
                }
            }
        }

        $controllerParts = explode('\\', $this->controller);
        $this->controllerName = array_pop($controllerParts);
        \Log::debug($this->controllerName);
    }

    /**
     * Create Service
     * The process of creating the Service
     * Requires an existing controller by 'default'
     *
     * @return void
     */
    protected function createService() : void
    {
        $content = $this->file->get($this->stubs['service']);
        $replacements = [
            '%controller%'                   => $this->controller,
            '%controllerName%'               => $this->controllerName,
            '%namespaces.services%'          => $this->namespace.$this->config('namespaces.services'),
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
            if (!$this->isResponsePositive($response)) {
                $this->line("The service [{$fileName}] will not be overwritten.");
                return;
            }
        }
        $this->line("The service [{$fileName}] has been created.");
        $this->file->put($filePath, $content);
    }
}
