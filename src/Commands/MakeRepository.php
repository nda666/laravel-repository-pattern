<?php

namespace LaravelRepositoryPattern\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class MakeRepository extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:repository';


    protected $description = 'Create a new repository pattern and interface';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Repositories';

    public function handle()
    {
        $this->call(MakeInterface::class, ['name' => $this->argument('name')]);
        parent::handle();
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $stub = parent::replaceClass($stub, $name);
        $posibleName = str_replace('Repository', 'Interface', $this->getNameInput());
        $posibleName = str_replace('/', '\\', $posibleName);
        $stub = str_replace(
            'DummyInterfaceImport',
            config('laravel-repository-pattern.interface_namespace') . '\\' .  $posibleName,
            $stub
        );

        $exImplement = explode('\\', $posibleName);
        $posibleInterface = count($exImplement) ? $exImplement[count($exImplement) - 1] : $posibleName;
        $stub = str_replace('DummyInterface', $posibleInterface, $stub);

        return $stub;
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return  __DIR__ . '/../Stubs/make-repository.stub';
    }

     /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getNameInput()
    {
        preg_match('/repository/i', $this->argument('name'), $exist);
        return trim(ucwords($this->argument('name') . ( $exist ? "" : 'Repository')));
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return config('laravel-repository-pattern.repository_namespace');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the contract.'],
        ];
    }
}
