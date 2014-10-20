Feature: Toggling features for user identifiers
  In order be able to deploy source code often
  As a developer
  I want to be able toggle features for given users

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