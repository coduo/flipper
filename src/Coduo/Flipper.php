<?php

namespace Coduo;

use Coduo\Flipper\Activation\Context;
use Coduo\Flipper\Feature\Repository;
use Coduo\Flipper\Feature;
use Coduo\Flipper\Identifier;

final class Flipper
{
    /**
     * @var Flipper\Feature\Repository
     */
    private $repository;
    /**
     * @var Flipper\Activation\Context
     */
    private $context;

    /**
     * @param Repository $repository
     */
    public function __construct(Repository $repository, Context $context)
    {
        $this->repository = $repository;
        $this->context = $context;
    }

    /**
     * @param Feature $feature
     */
    public function add(Feature $feature)
    {
        $this->repository->add($feature);
    }

    /**
     * @param $name
     * @return Feature|null
     */
    public function findByName($name)
    {
        return $this->repository->findByName($name);
    }

    /**
     * @param $featureName
     * @throws \RuntimeException
     *
     * @return boolean
     */
    public function isActive($featureName)
    {
        $feature = $this->findByName($featureName);
        if (null === $feature) {
            throw new \RuntimeException();
        }

        return $feature->isActive($this->context);
    }
}
