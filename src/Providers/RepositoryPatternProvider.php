<?php

namespace LaravelRepositoryPattern\Providers;

use HaydenPierce\ClassFinder\ClassFinder;
use Illuminate\Support\ServiceProvider;
use LaravelRepositoryPattern\Commands\MakeRepository;

class RepositoryPatternProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../publishable/config/laravel-repository-pattern.php',
            'laravel-repository-pattern'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../publishable/config/laravel-repository-pattern.php'
            => config_path('laravel-repository-pattern.php'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeRepository::class,
            ]);
        }

        $config = config('laravel-repository-pattern');

        $classes = ClassFinder::getClassesInNamespace($config['repository_namespace']);
        foreach ($classes as $class) {
            $r = new \ReflectionClass($class);

            if (isset($r->getInterfaceNames()[0])) {
                $this->app->bind($r->getInterfaceNames()[0], $class);
            } else {
                $this->app->bind($class, $class);
            }
        }
    }
}
