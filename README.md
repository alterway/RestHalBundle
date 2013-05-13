# RestHalBundle

Bundle to manage [Hal API](http://stateless.co/hal_specification.html) with Symfony2.

## Installation

Edit your `composer.json`:

```json
"require": {
    "alterway/rest-hal-bundle" : "master"
}
```

And run Composer:

    php composer.phar update alterway/rest-hal-bundle

Add the following line at the end of your `autoload.php`:

```php
Doctrine\Common\Annotations\AnnotationRegistry::registerLoader(array($loader, 'loadClass'));
```

Enable your bundle in your `AppKernel.php`:

```php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Alterway\Bundle\RestHalBundle\AwRestHalBundle(),
    );
}
```

## Usage

### Resource

A resource is a PHP class who represents informations about elements of your applications.

For example:

```php
// src/Alterway/DemoBundle/ApiResource/UserResource.php

namespace Alterway\DemoBundle\ApiResource;

use Alterway\Bundle\RestHalBundle\ApiResource\Resource;

class UserResource extends Resource
{
    public function __construct(\Alterway\DemoBundle\Entity\User $user)
    {
        parent::__construct();
        $this->user = $user;
    }

    protected function prepare()
    {
        $this->addLink('next', '/users?page=2');
        $this->addLink('search', '/users?id={user_id}');
    }

    protected function generateUri()
    {
        return "url to generate for the hal resource's self link";
    }
}
```

### Controller

#### With annotations:

```php
// some controller or yours

use Alterway\DemoBundle\ApiResource\UserResource;

/**
 * @Hal(code="200")
 */
public function userWithAnnotateAction(Request $request)
{
    $user = new User;
    return new UserResource($user);
}
```

#### Without annotations:

```php
// some controller or yours

use Alterway\Bundle\HalRestBundle\Response\HalResponse;
use Alterway\DemoBundle\ApiResource\UserResource;

public function userWithoutAnnotateAction(Request $request)
{
    $user = new User;
    $resource = new UserResource($user);
    return new HalResponse($resource, 200);
}
```

## Contribute

Install dev dependencies:

    php composer.phar update

Run Behat:

    ./vendor/bin/behat @AwRestHalBundle

## Copyright

Copyright (c) 2013 Jean-François Lépine (Halleck45). See LICENSE for details.

##  Contributors

+ Jean-François Lépine (Halleck45)
+ Benoît Merlet (trompette)
+ Antoine Lévêque (gh0stonio)

## Sponsors

+ [Alter Way](http://www.alterway.fr)
