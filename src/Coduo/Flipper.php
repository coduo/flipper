<?php

namespace Coduo;

use Coduo\Flipper\Activation\Context;
use Coduo\Flipper\Feature\Repository;
use Coduo\Flipper\Feature;

final class Flipper
{
    /**
     * @var Flipper\Feature\Repository
     */
    private $repository;

    /**
     * @var Flipper\Activation\Context
     */
    private $contexts;

    /**
     * @param Repository $repository
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
        $this->contexts = array();
    }

    /**
     * @param Feature $feature
     */
    public function add(Feature $feature)
    {
        $this->repository->add($feature);
    }

    public function addContext(Context $context)
    {
        $this->contexts[] = $context;
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
     * @param $name
     * @return Context|null
     */
    public function findContextByName($name)
    {
        foreach ($this->contexts as $context) {
            if ($context->getName() === $name) {
                return $context;
            }
        }
    }

    /**
     * @param $featureName
     * @throws \RuntimeException
     *
     * @return boolean
     */
    public function isActive($featureName, $contextName = 'default')
    {
        $feature = $this->findByName($featureName);
        if (null === $feature) {
            throw new \RuntimeException();
        }

        $context = $this->findContextByName($contextName);

        if (null === $context) {
            throw new \RuntimeException("Context not found");
        }

        return $feature->isActive($context);
    }
}
