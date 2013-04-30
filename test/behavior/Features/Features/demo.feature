Feature: Labels
  In order to distinguish issues
  As a GitHub user
  I need to be able to label them

  Scenario: List repository labels
    When I send a GET request to "/repos/behat/mink/labels"
    Then the response code should be 200
    And response should contain json:
      """
      [
          {
              "url":   "BASE_URL/repos/Behat/Mink/labels/feature",
              "name":  "feature",
              "color": "02e10c"
          },
          {
              "url":   "BASE_URL/repos/Behat/Mink/labels/bug",
              "name":  "bug",
              "color": "e10c02"
          },
          {
              "url":    "BASE_URL/repos/Behat/Mink/labels/proposal",
              "name":   "proposal",
              "color":  "d7e102"
          }
      ]
      """