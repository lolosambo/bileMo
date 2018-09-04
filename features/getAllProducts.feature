@api
@api_request

Feature: As an authenticated user, I would be able to see the full products list

  Background:
    Given I load "ClientsFixtures" fixtures file
    And I load "ProductsFixtures" fixtures file
    And I am on "/products"
    When I was authenticated on url "/api/login_check" with method "POST" as user "Client1" with password "MySuperPassword", I send a "GET" request to "/products"

  Scenario: [success] I see all Products list
    Then Client "Client1" should exists into Database
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"
    And print last JSON response
#    """
#    {
#        "name": "Galaxy S9+",
#        "brand": "Samsung",
#        "height": 9,
#        "width": 175,
#        "weight": 575,
#        "screen": "10 pouces",
#        "os": "Android",
#        "price": 949.99
#        "links": {
#            "self": {
#                "href": "/products/
#            }
#        }
#    }
#    """
#    And the JSON node "brand" should exist
#    And the JSON node "description" should exist
#    And the JSON node "height" should exist
#    And the JSON node "width" should exist
#    And the JSON node "height" should exist
#    And the JSON node "screen" should exist
#    And the JSON node "os" should exist
#    And the JSON node "price" should exist