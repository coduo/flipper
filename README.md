flipper
====================
[![Build Status](https://travis-ci.org/coduo/flipper.svg?branch=master)](https://travis-ci.org/coduo/flipper)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/coduo/flipper/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/coduo/flipper/?branch=master)


WIP
Simple and extensive feature flipper for php. User centric.

## Set up your feature definitions

```php
<?php
use Coduo\Flipper;
use Coduo\Flipper\Feature;
use Coduo\Flipper\Feature\Repository\InMemoryFeatureRepository;
use Coduo\Flipper\Activation\Strategy;

$flipper = new Flipper(new InMemoryFeatureRepository())
$feature = new Feature('captcha', new Strategy\UserFlipperIdentifier());
$feature->addIdentifier('michal@coduo.pl');
$feature2 = new Feature('new_topbar', new Strategy\SystemWide(true));
$flipper->add($feature);
$flipper->add($feature2)
```

## Set up your feature aware user

```php
<?php
class Customer implements FeatureAwareUser, UserInterface
{

    ...
    
    public function getFlipperIdentifier()
    {
        return new Identifier($this->getUserame());
    }
}
```

## Check it
```php
<?php
$customer = Customer::fromEmail('michal@coduo.pl');
$customer2 = Customer::fromEmail('norbert@coduo.pl');
$flipper->isActive('captcha', $customer); #true
$flipper->isActive('captcha', $customer); #fakse
$flipper->isActive('new_topbar', $customer); #true
$flipper->isActive('new_topbar', $customer2); #true
```

```
require: {
   "coduo/flipper": "dev-master"
}
```
