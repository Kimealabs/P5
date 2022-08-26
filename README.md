[![Codacy Badge](https://app.codacy.com/project/badge/Grade/ca81c3a410df40c2b895763aecfeb1bc)](https://www.codacy.com/gh/Kimealabs/P5/dashboard?utm_source=github.com&utm_medium=referral&utm_content=Kimealabs/P5&utm_campaign=Badge_Grade)

## CREATE YOUR FIRST BLOG WITH PHP

![alt text](https://www.php.net//images/logos/php-med-trans-light.gif)

This is a project for my formation on OpenClassRooms (number 5)

The goal about to create a blog system with administration (create/delete/editing posts, comments moderation), comments system, registration, authenfication and others stuffs like Contact page, Cv link

Bootstrap theme : Start Bootstrap - Clean Blog v6.0.8 (https://startbootstrap.com/theme/clean-blog)

## NOTE TO INSTALL

Copy all or clone (git) repository to your web local server

- Use db.sql FILE on Diagrams to construct Database
- Modify Config file config.yaml

## ROUTES

Examples
home : /
list all posts : /post/list
read a post : /post/id/{id}
Sign in : /user/signin
Sign up : /user/signup

## TESTED ENV.

WAMP V3.2.9 - PHP 8.1.0 (YAML ext.) - MySQL 5.7.36 - Apache 2.4.51 - PHPmyAdmin 5.2.0

# EDIT WITH VSCODE v1.70.2

#Important :

1/ You may become an user to Administrator easily : SignUp and update Level field on User Table to 1

2/ Use Apache server (htaccess)

Don't forget to verify your PHP setting for YAML support :

- php.ini entry is: extension=php_yaml
