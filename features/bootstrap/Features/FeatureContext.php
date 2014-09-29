<?php

namespace Features;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Coduo\Flipper;
use Coduo\Flipper\Feature;
use Coduo\Flipper\Feature\Repository\InMemoryFeatureRepository;
use Coduo\Tests\Flipper\TestUser;
use Coduo\Flipper\Activation\Strategy;

/**
 * Features context.
 */
class FeatureContext implements SnippetAcceptingContext
{
    private $flipper;
    private $users;

    public function __construct()
    {
        $this->flipper = new Flipper(new InMemoryFeatureRepository());
        $this->users = [];
    }

    /**
     * @Given following users exist:
     */
    public function followingUsersExist(TableNode $table)
    {
        foreach ($table->getHash() as $user) {
            $this->users[] = new TestUser($user['Flipper identifier']);
        }
    }

    /**
     * @When following features are set up:
     */
    public function followingFeaturesAreSetUp(TableNode $table)
    {
        foreach ($table->getHash() as $featureData) {
            $feature = new Feature($featureData['Feature'], new Strategy\UserFlipperIdentifier());
            foreach (explode(',', $featureData['Users']) as $userName) {
                $user = $this->findUser(trim($userName));
                $feature->addUser($user);
            }

            $this->flipper->add($feature);
        }

    }

    /**
     * @Then the feature :featureName should be active for user :userName
     */
    public function theFeatureShouldBeActivateForUser($featureName, $userName)
    {
        $user = $this->findUser($userName);
        expect($this->flipper->isActive($featureName, $user))->toBe(true);
    }

    /**
     * @Then the feature :featureName should not be active for user :userName
     */
    public function theFeatureShouldNotBeActiveForUser($featureName, $userName)
    {
        $user = $this->findUser($userName);
        expect($this->flipper->isActive($featureName, $user))->toBe(false);
    }

    /**
     * @param $userName
     */
    protected function findUser($userName)
    {
        foreach ($this->users as $user) {
            if ($user->getFlipperIdentifier() === $userName) {
                return $user;
            }
        }
    }

}
