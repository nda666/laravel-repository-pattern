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
}
