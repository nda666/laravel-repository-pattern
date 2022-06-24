<?php

namespace LaravelRepositoryPattern\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class MakeInterface extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:interface';


    protected $description = 'Create a new interface interface';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Interfaces';

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
        return $stub;
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return  __DIR__ . '/../Stubs/make-interface.stub';
    }

     /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getNameInput()
    {
        preg_match('/interface/i', $this->argument('name'), $exist);
        return trim(ucwords($this->argument('name') . ( $exist ? "" : 'Interface')));
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return config('laravel-repository-pattern.interface_namespace');
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
