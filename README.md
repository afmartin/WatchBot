# WatchBot 
### CMPT 395 - Software Engineering Assignment - MacEwan University

This is a demo webapp that uses user authentication.  When users are authenticated they can post videos from YouTube to be added to the video table.  

## List of Actions

This is a thorough list of everything possible on the website:
- Create an account, login and logout
- Modify your profile
- View other profiles
- Have a table of videos that are YouTube embeds.
- Post a video if logged in 
- Edit said video
- See a list of new videos every page

## Requirements

1. PHP >= 5.4
2. MCrypt PHP Extension
3. PHP5-sqlite

Composer will install the additional dependencies.  

## Installation

Enter the below commands into a terminal to get setup with the demo webapp running on a local test server with randomized data already inserted.


    $ git clone https://github.com/afmartin/WatchBot.git
    $ cd WatchBot
    $ curl -sS https://getcomposer.org/installer | php
    $ php composer.phar install
    $ php artisan migrate
    $ php artisan db:seed
    $ php artisan serve


Running `composer install` will install necessary dependencies.  

`Artisan db:seed` is option, it sets up the database with sample data.

Running the server through Artisan should only be used for testing locally. 

If Laravel is reporting that you are missing the sqlite driver, in Debian based distributions do:

    $ sudo apt-get install php5-sqlite

## License

Code in the app folder is licensed the MIT license.  





