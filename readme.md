# Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

# Documentation
Tasks:
  * Users
    - Has many permissions thru Roles
    - Has many roles
  * Permissions
    - Belongs to many roles
  * Roles
    - Has many permissios
    - Belongs to many users
    - Has many menus
  * Menus
    Belongs to a role
  * Punches
    - Belongs to a Employee
  * Revenue types
    - Has many campaings
  * Campaigns
    - Belongs to project
    - Belongs to a revenue type 
  * Payment types
    - Belongs to many positions
  * Payment frequency
    Belongs to many positions
  * Departments
    - Has many employees through positions
  * Termination Reasons
    - Belongs to a termination
    - Has many employees thru terminations
  * ARS
    - Has many employees
  * AFP
    - Has many employees
  * Maritals
    - has many employees
  * Genders
    - Has many employees
  * Supervisors
    - Has many employees
    - Has Many performances
  * Projects
    - Project has many employees
    - Project has many performance
    - Has many campaigns
  * Employees
    - Has one position
    - Employee Has one punch
    - Employee has many performances
    - Employee belongs to a site
    - Employee belongs to a project
    - Belongs to a supervisor
    - Has one gender
    - Has one marital
    - belongs to a ARS
    - Belongs to a AFP
    - Has a termination (When the employee is terminated
  * Positions
    - Has many employees
    - Has one payment type
    - Has one payment frequencie
  * Performance
    - Performance belongs to a employee
    - Performance belongs to a project
  * Remove Sources Module
  * Sites
    - Site has many employees
  * Terminations
    - Belongs to a employee (meaning the employee is inactve)
    - Has a reason


  * Migrate Dicenew to dainsys @created(18-12-20 10:20)
    - Hours
    Hours is common to all projects
    - Performance
    - QA
  * Incentives??????
  * Create a Module to monitor personal issues.  @created(18-12-04 20:35)
  * Create a Module for reporting bugs and issues for the app.  @created(18-12-04 20:35)
 only signed in users with this permission should see the link
 Projects:
