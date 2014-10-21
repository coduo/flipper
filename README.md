flipper
====================
[![Build Status](https://travis-ci.org/coduo/flipper.svg?branch=master)](https://travis-ci.org/coduo/flipper)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/coduo/flipper/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/coduo/flipper/?branch=master)


WIP
Simple and extensive feature flipper for php. Identifier centric.

## Set up your feature definitions

```php
<?php
use Coduo\Flipper;
use Coduo\Flipper\Identifier;
use Coduo\Flipper\Feature;
use Coduo\Flipper\Feature\Repository\InMemoryFeatureRepository;
use Coduo\Flipper\Activation\Strategy;

$flipper = new Flipper(new InMemoryFeatureRepository())
$feature = new Feature('captcha', new Strategy\UserIdentifier(
    new Identifier('michal@coduo.pl')
]));
$feature2 = new Feature('new_topbar', new Strategy\SystemWide(true));
$flipper->add($feature);
$flipper->add($feature2)
```


## Check it
```php
<?php
$customer = Customer::fromEmail('michal@coduo.pl');
$customer2 = Customer::fromEmail('norbert@coduo.pl');
$flipper->isActive('captcha', new Identifier($customer->getEmail()); #true
$flipper->isActive('captcha', new Identifier($customer->getEmail()); #false
$flipper->isActive('new_topbar', new Identifier($customer->getEmail()); #true
$flipper->isActive('new_topbar', new Identifier($customer->getEmail()); #true
```

```
require: {
   "coduo/flipper": "dev-master"
}
```
