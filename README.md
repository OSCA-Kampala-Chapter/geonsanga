# Geosanga
### Introduction
Geosanga is an open source package project to provide Ugandan based geolocation data using endpoints/packages that can be consumed directly within your applications. This is to help you reduce on the time that would be needed to collect and build the functionality within your application. 
### Geosanga Features
* The provides a PHP package that you can install directly in your PHP based applications using package managers like composer
* Endpoints are available to consume the data directly through http calls without any installation
### Installation Guide
* Run `composer install geosanga` to install the package
### API Endpoints
| HTTP Verbs | Endpoints | Action |
| --- | --- | --- |
| GET | /v1/districts | To fetch all districts |
| GET | /v1/counties | To fetch all counties |
| GET | /v1/subcounties | To fetch all subcounties |
| GET | /v1/parishes | To fetch all parishes |
| GET | /v1/villages | To fetch all villages |
### Technologies Used
* [PHP](https://www.php.net/) A popular general-purpose scripting language that is especially suited to web development.
Fast, flexible and pragmatic, PHP powers everything from your blog to the most popular websites in the world.
* [JSON](https://www.json.org/json-en.html) JSON (JavaScript Object Notation) is a lightweight data-interchange format.
### Contribution Guide
### Authors
### Reference Docs
1. Project Structure  - [View API Pattern](https://github.com/cim-engineering/view-api-pattern)
2. Router (Still in the Structure) - [Steampixel's Simple Router](https://github.com/steampixel/simplePHPRouter)
3. The Ugandan Locale Package - [Uganda Geo Data](https://github.com/kusaasira/uganda-geo-data)
### License
This project is available for use under the MIT License.