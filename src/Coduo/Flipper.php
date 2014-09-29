<?php

namespace Coduo;

use Coduo\Flipper\Feature\Repository;
use Coduo\Flipper\Feature;
use Coduo\Flipper\User\FeatureAwareUser;

class Flipper
{
    /**
     * @var Flipper\Feature\Repository
     */
    private $repository;

    /**
     * @param Repository $repository
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
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
     * @return mixed
     */
    public function findByName($name)
    {
        return $this->repository->findByName($name);
    }

    /**
     * @param $featureName
     * @param FeatureAwareUser $user
     * @return boolean
     *
     * @throws \RuntimeException
     */
    public function isActive($featureName, FeatureAwareUser $user)
    {
        $feature = $this->findByName($featureName);
        if (null === $feature) {
            throw new \RuntimeException();
        }

        return $feature->isActive($user);
    }
}
