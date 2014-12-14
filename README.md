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
use Coduo\Flipper\Context;
use Coduo\Flipper\Identifier;
use Coduo\Flipper\Feature;
use Coduo\Flipper\Feature\Repository\InMemoryFeatureRepository;
use Coduo\Flipper\Activation\Strategy;

$context = new Context('default');
$context->registerArgumentResolver(Resolver\UserIdentifier); #returns michal@coduo.pl
$context->registerArgumentResolver(Resolver\Environment); #returns staging

$context2 = new Context('other');
$context2->registerArgumentResolver(Resolver\UserIdentifier); #returns norbert@coduo.pl

$flipper = new Flipper(new InMemoryFeatureRepository());
$flipper->addContext($context);
$flipper->addContext($context2);


$feature = new Feature('captcha', new Strategy\UserIdentifier(
    new Identifier('michal@coduo.pl')
]));

$feature2 = new Feature('new_topbar', new Strategy\SystemWide(true));
$flipper->add($feature);
$flipper->add($feature2);


#all set up

```


## Check it
```php
<?php
$flipper->isActive('captcha', 'default'); #true
$flipper->isActive('captcha', 'other'); #false

```

```
require: {
   "coduo/flipper": "dev-master"
}
```
