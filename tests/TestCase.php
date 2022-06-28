<?php

namespace LaravelRepositoryPattern\Tests;

use Illuminate\Support\Facades\File;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();
        $this->cleanOutputDirectory();
    }

    private function cleanOutputDirectory()
    {
        if (File::isDirectory(app_path('Repositories'))) {
            File::deleteDirectories(app_path('Repositories'));
        }

        if (File::isDirectory(app_path('Repositories'))) {
            File::deleteDirectories(app_path('Repositories'));
        }
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
        \LaravelRepositoryPattern\Providers\RepositoryPatternProvider::class,
        ];
    }

     /**
     * Resolve application core configuration implementation.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return void
     */
    protected function resolveApplicationConfiguration($app): void
    {
        parent::resolveApplicationConfiguration($app);

        $app['config']->set('laravel-repository-pattern.interface_namespace', "App\\Interfaces");
        $app['config']->set('laravel-repository-pattern.repository_namespace', "App\\Repositories");
    }
}
