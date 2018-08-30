@api
@api_request

Feature: As an authenticated user, I would be able to see the full products list

  Background:
    Given I am on "/products"

  Scenario: [success] I see all Products list
    When I was authenticated on url "/api/login_check" with method "POST" as user "Client1" with password "MySuperPassword", I send a "GET" request to "/products"
    Then the response status code should be 200
    And the JSON node "name" should exist
#    And the JSON node "brand" should exist
#    And the JSON node "description" should exist
#    And the JSON node "height" should exist
#    And the JSON node "width" should exist
#    And the JSON node "height" should exist
#    And the JSON node "screen" should exist
#    And the JSON node "os" should exist
#    And the JSON node "price" should exist