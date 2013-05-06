# RestHalBundle

Bundle to manage [Hal API](http://stateless.co/hal_specification.html) with Symfony2.

## Installation

Edit your `composer.json`:

```json
"require": {
    "alterway/hal-rest-bundle" : "master"
}
```

And run Composer:

    php composer.phar update alterway/rest-hal-bundle

Enable tu bundle in your `AppKernel.php`:

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

    public function __construct(\Symfony\Component\HttpFoundation\Request $request, \Alterway\DemoBundle\Entity\User $user)
    {
        parent::__construct($request);
        $this->user = $user;
    }

    public function prepare()
    {
        $this->addLink('next', '/orders?page=2');
        $this->addLink('search', '/orders?id={order_id}');
    }

}
```

### Controller

#### With annotations:

```php
/**
 * @Hal(type="application/hal+json", code="200")
 */
public function userWithAnnotateAction(Request $request)
{
    $user = new User;
    return new UserResource($request, $user);
}
```

#### Without annotations:

```php
public function userWithoutAnnotateAction(Request $request)
{
    $user = new User;
    $resource = new UserResource($request, $user);
    return new HalResponse($resource, 200);
}
```

## Contribute

Install dev dependencies:

    php composer.phar update --dev

Run Behat:

    ./vendor/bin/behat @AwHalRestBundle

## Copyright

Copyright (c) 2013 Jean-François Lépine (Halleck45). See LICENSE for details.

##  Contributors

+ Jean-François Lépine (Halleck45)

## Sponsors

+ [Alter Way](http://www.alterway.fr)