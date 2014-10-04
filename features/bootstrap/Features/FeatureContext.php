<?php

namespace Features;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Hook\Scope\AfterScenarioScope;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
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
    private $currentFeature;

    public function __construct()
    {
        $this->flipper = new Flipper(new InMemoryFeatureRepository());
        $this->users = array();
    }

    /**
     * @BeforeScenario
     */
    public function clenup(BeforeScenarioScope $scope)
    {
        $this->flipper = new Flipper(new InMemoryFeatureRepository());
        $this->users = array();
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
     * @Given there are :count users
     */
    public function thereAreUsers($count)
    {
        $count = $count;
        foreach (range(1, $count) as $i) {
            $this->users[] = new TestUser($i);
        }
    }

    /**
     * @When following features are set up:
     */
    public function followingFeaturesAreSetUp(TableNode $table)
    {

        foreach ($table->getHash() as $featureData) {
            $strategy = new Strategy\UserFlipperIdentifier();
            $feature = new Feature($featureData['Feature'], $strategy);
            foreach (explode(',', $featureData['Users']) as $userName) {
                $user = $this->findUser(trim($userName));
                $strategy->addIdentifier($user->getFlipperIdentifier());
            }

            $this->flipper->add($feature);
        }

    }

    /**
     * @Then I set up feature :arg1 for :arg2 percent of users
     */
    public function iSetUpFeatureForPercentOfUsers($featureName, $percentage)
    {
        $feature = new Feature($featureName, new Strategy\Gradual($percentage));
        $this->flipper->add($feature);
        $this->currentFeature = $feature;
    }

    /**
     * @Then about :count users should see the feature
     */
    public function aboutUsersShouldSeeTheFeature($count)
    {
        $activated = 0;

        foreach ($this->users as $user) {
            if ($this->flipper->isActive($this->currentFeature->getName(), $user->getFlipperIdentifier())) {
                $activated++;
            }
        }

        $thresholdLower = array($activated - ($activated * 0.10), $count - ($count * 0.10));
        $thresholdUpper = array($activated + ($activated * 0.10), $count + ($count * 0.10));

        if ((max($thresholdLower) - min($thresholdLower)) / max($thresholdLower) > 0.10) {
            throw new \Exception();
        }

        if ((max($thresholdUpper) - min($thresholdUpper)) / max($thresholdUpper) > 0.10) {
            throw new \Exception();
        }
    }

    /**
     * @Then the feature :featureName should be active for user :userName
     */
    public function theFeatureShouldBeActivateForUser($featureName, $userName)
    {
        $user = $this->findUser($userName);
        expect($this->flipper->isActive($featureName, $user->getFlipperIdentifier()))->toBe(true);
    }

    /**
     * @Then the feature :featureName should not be active for user :userName
     */
    public function theFeatureShouldNotBeActiveForUser($featureName, $userName)
    {
        $user = $this->findUser($userName);
        expect($this->flipper->isActive($featureName, $user->getFlipperIdentifier()))->toBe(false);
    }

    /**
     * @param $userName
     */
    protected function findUser($userName)
    {
        foreach ($this->users as $user) {
            if ((String) $user->getFlipperIdentifier() === $userName) {
                return $user;
            }
        }
    }

}
