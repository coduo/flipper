Feature: Toggling features for a date range
  In order be able to toggle new features
  As a developer
  I want to be able toggle features withing a date range

  Background:
    Given the "holiday_break" feature exist for range "2014-12-24 08:00:00" - "2014-12-31 18:00:00"

  Scenario: Activating features within valid date range
    When current date is "2014-12-25 14:00:00"
    Then the feature "holiday_break" should be active

  Scenario: Activating features outside valid date range
    When current date is "2014-12-23 14:00:00"
    Then the feature "holiday_break" should not be active
