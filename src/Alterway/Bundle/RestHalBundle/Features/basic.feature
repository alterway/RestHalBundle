Feature: Basic request

  Scenario: Get a 200 with annotation
    When I go to "/user/annotate/1"
    Then the response status code should be 200
    Then the response should contain "_links"

  Scenario: Get a 200 without annotation
    When I go to "/user/1"
    Then the response status code should be 200
    Then the response should contain "_links"
    