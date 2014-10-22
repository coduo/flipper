Feature: Toggling features for percentage of users
  In order be able to test new features
  As a developer
  I want to be able toggle features for percentage of users users

  Scenario Outline: Activating features for percentage of users
    Given there are <usersCount> users
    When I set up feature <feature> for <percentage> percent of users
    Then about <estTotal> users should see the feature

  Examples:
    | usersCount | feature   | percentage | estTotal   |
    |  60        | captcha   |  50        | 30         |
    |  100       | captcha   |  10        | 10         |
    |  200       | captcha   |  15        | 30         |
    |  1000      | captcha   |  18        | 180        |