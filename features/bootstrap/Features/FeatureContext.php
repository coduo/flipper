<?php

namespace Features;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Hook\Scope\AfterScenarioScope;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Coduo\Flipper;
use Coduo\Flipper\Activation\Strategy\DateRange\CurrentDateTime;
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
    private $context;

    public function __construct()
    {
        $this->context = new Flipper\Activation\Context('default');
        $this->flipper = new Flipper(new InMemoryFeatureRepository());
        $this->flipper->addContext($this->context);
        $this->users = array();
    }

    /**
     * @BeforeScenario
     */
    public function clenup(BeforeScenarioScope $scope)
    {
        $this->flipper = new Flipper(new InMemoryFeatureRepository());
        $this->flipper->addContext($this->context);
        $this->users = array();
        CurrentDateTime::reset();
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
            $strategy = new Strategy\UserIdentifier();
            $feature = new Feature($featureData['Feature'], $strategy);
            foreach (explode(',', $featureData['Users']) as $userName) {
                $user = $this->findUser(trim($userName));
                $strategy->addIdentifier(new Flipper\Activation\Argument\UserIdentifier($user->getId()));
            }

            $this->flipper->add($feature);
        }

    }

    /**
     * @Then I set up feature :featureName for :percentage percent of users
     */
    public function iSetUpFeatureForPercentOfUsers($featureName, $percentage)
    {
        $feature = new Feature($featureName, new Strategy\Gradual($percentage));
        $this->flipper->add($feature);
        $this->currentFeature = $feature;
    }

    /**
     * @Given the :featureName feature exist for range :from - :to
     */
    public function theFeatureExistForRange($featureName, $from, $to)
    {
        $feature = new Feature($featureName, new Strategy\DateRange(
            new Strategy\DateRange\DateTime($from),
            new Strategy\DateRange\DateTime($to))
        );
        $this->flipper->add($feature);
    }

    /**
     * @Then about :count users should see the feature
     */
    public function aboutUsersShouldSeeTheFeature($count)
    {
        $activated = 0;

        foreach ($this->users as $user) {
            $this->context->registerArgument(new Flipper\Activation\Argument\UserIdentifier($user->getId()));
            if ($this->flipper->isActive($this->currentFeature->getName(), $this->context->getName())) {
                $activated++;
            }
            $this->context->clear();
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
        $this->context->clear();
        $this->context->registerArgument(new Flipper\Activation\Argument\UserIdentifier($userName));
        expect($this->flipper->isActive($featureName))->toBe(true);
    }

    /**
     * @Then the feature :featureName should not be active for user :userName
     */
    public function theFeatureShouldNotBeActiveForUser($featureName, $userName)
    {
        $user = $this->findUser($userName);
        $this->context->clear();
        $this->context->registerArgument(new Flipper\Activation\Argument\UserIdentifier($userName));
        expect($this->flipper->isActive($featureName))->toBe(false);
    }

    /**
     * @When current date is :dateString
     */
    public function currentDateIs($dateString)
    {
        CurrentDateTime::modifyDate(new \DateTime($dateString));
    }

    /**
     * @Then the feature :featureName should be active
     */
    public function theFeatureShouldBeActive($featureName)
    {
        expect($this->flipper->isActive($featureName))->toBe(true);
    }

    /**
     * @Then the feature :featureName should not be active
     */
    public function theFeatureShouldNotBeActive($featureName)
    {
        expect($this->flipper->isActive($featureName))->toBe(false);
    }

    /**
     * @param $userName
     */
    protected function findUser($userName)
    {
        foreach ($this->users as $user) {
            if ((String) $user->getId() === $userName) {
                return $user;
            }
        }
    }

}
