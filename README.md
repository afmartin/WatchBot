# WatchBot 
### CMPT 395 - Software Engineering Assignment - MacEwan University

This is a demo webapp that uses user authentication.  When users are authenticated they can post videos from YouTube to be added to the video table.  

## List of Actions

This is a thorough list of everything possible on the website:
- Register/login/logout
- Modify profile
- Browse other users
- See a user's profile.
- Post a link to a YouTube video
- See a posted video (which is an embedded YouTube video).

## Requirements

1. PHP >= 5.4
2. MCrypt PHP Extension
3. Composer

Composer will install the additional dependencies.  

## Installation

Enter the below commands into a terminal to get setup with the demo webapp running on a local test server with randomized data already inserted.

#+BEGIN_EXAMPLE
$ git clone https://github.com/afmartin/WatchBot.git
$ composer install
$ artisan migrate
$ artisan db:seed
$ artisan serve
#+END_EXAMPLE

Running `composer install` will install necessary dependencies.  
Running the server through Artisan should only be used for testing locally. 

## PureCSS 

This project uses PureCSS (http://purecss.io/) for responsive web design.  PureCSS is licenses under the Yahoo BSD license included in the Public directory.

## License

Code in the app folder is licensed the MIT license.  





