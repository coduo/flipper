flipper
====================
[![Build Status](https://travis-ci.org/coduo/flipper.svg?branch=master)](https://travis-ci.org/coduo/flipper)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/coduo/flipper/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/coduo/flipper/?branch=master)


WIP
Simple and extensive feature flipper for php. Identifier centric.

## Create a context and register your arguments in context

```php
<?php
use Coduo\Flipper;
use Coduo\Flipper\Feature\Repository\InMemoryFeatureRepository;
use Coduo\Flipper\Activation\Strategy;

$context = new Flipper\Activation\Context('default');
$context2 = new Flipper\Activation\Context('some_dummy_context');
$context->registerArgument(new Flipper\Activation\Argument\UserIdentifier('michal@coduo.pl');
```php

## Set up your feature definitions

$flipper = new Flipper(new InMemoryFeatureRepository());
$flipper->addContext($this->context);

$feature = new Feature('captcha', new Strategy\UserIdentifier(
    new Flipper\Activation\Argument\UserIdentifier('michal@coduo.pl')
]));

$feature2 = new Feature('new_topbar', new Strategy\SystemWide(true));
$flipper->add($feature);
$flipper->add($feature2);
```

## Check it
```php
<?php
$flipper->isActive('captcha', 'default'); #true
$flipper->isActive('captcha', 'Argument'); #false

```

```
require: {
   "coduo/flipper": "dev-master"
}
```
