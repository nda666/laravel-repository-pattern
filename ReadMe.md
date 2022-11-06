# Laravel Repository Pattern

It's a simple repository file generator.

## Laravel without auto-discovery:

If you don't use auto-discovery, add the ServiceProvider to the providers array in config/app.php

```shell
LaravelRepositoryPattern\Providers\RepositoryPatternProvider::class
```

to publish the config file:

```shell
php artisan vendor:publish --provider="LaravelRepositoryPattern\Providers\RepositoryPatternProvider"
```

## How To:

```shell
php artisan make:repository User
```

Will generate UserRepository.php and UserInterface.php file

## Example

Example using generated repo in controller

```php
<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;

class HomeController extends Controller
{
    protected UserRepository $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return $this->user->getAll();
    }
}
```
