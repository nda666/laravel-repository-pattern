<?php

namespace LaravelRepositoryPattern\Tests;

class MakeRepositoryTest extends TestCase
{
    public function testShouldOkWhenCreateNewRepository()
    {
        $this->artisan('make:repository Post');
        $this->assertFileExists(app_path('Repositories/PostRepository.php'));
        $this->assertFileExists(app_path('Interfaces/PostInterface.php'));
    }

    public function testShouldErrorWhenCreateSameRepository()
    {
        $this->artisan('make:repository User')->assertExitCode(0);
        $this->artisan('make:repository User')->expectsOutput('Repositories already exists!');
    }

    public function testShouldOkWhenCreateNewRepositoryWithSomeSlash()
    {
        $this->artisan('make:repository Node/Node1/Post');
        $this->assertFileExists(app_path('Repositories/Node/Node1/PostRepository.php'));
        $this->assertFileExists(app_path('Interfaces/Node/Node1/PostInterface.php'));
    }
}
