* Todo
    * [x] Write a WordPress plugin.
    * [x] Create a shortcode for the plugin.
    * [x] On navigation to the endpoint, the plugin has to send an HTTP request to a REST API endpoint.
    * [x] Parse the JSON response and use it to build and display an HTML table. 
    * [x] The content of three mandatory columns must be a link ( tag). When a visitor clicks any of these links, the details of that user must be shown.
    * [x] Responsiveness.
    * [x] We expect some kind of cache for HTTP requests.
    * [x] Error handling for the external HTTP requests.

## How to use
After activating the plugin, you can use the plugin by placing the shortcode `[inpsyde_plugin]` on the desired page.
It is possible to specify **REST API endpoint**.
For this purpose, you can specify the desired REST API endpoint as in the following example in the plugin shortcode.

#####Example:
```
[inpsyde_plugin url="https://jsonplaceholder.typicode.com/users"]
```

#####Note:
Default rest api endpoint is https://jsonplaceholder.typicode.com/users

## How to Test
All test cases is being placed in tests folder.

    1. composer install (Install dev dependencies (phpunit/phpunit))
    2. composer run-script test