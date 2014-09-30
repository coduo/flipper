Feature: Toggling features for percentage of users
  In order be able to test new features
  I want to be able toggle features for percentage of users users

  Background:
    Given following users exist:
      | Flipper identifier         |
      | michal                     |
      | claudio                    |
      | norbert                    |

  Scenario: Activating features for users
    When following features are set up:
      | Feature          | Users                |
      | captcha          | claudio, norbert     |
      | chat             | michal               |
      | popup            | norbert              |

    Then the feature "captcha" should be active for user "claudio"
    And the feature "chat" should be active for user "michal"
    And the feature "popup" should not be active for user "michal"