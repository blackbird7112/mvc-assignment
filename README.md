# mvc-assignment
Library Management System made with PHP and MVC Architecture

## Setup
* Clone repository
* Open mysql and create a database
* Enter the Database name, Mysql Username and password in the config/config.php file
* Now create a admin login for the library management system by running the setup.php using the following command: `php setup.php --admin=<admin username> --pass=<password>`
* Now type the following commands in the terminal: `composer install`, `composer dump-autoload`
* Now change directory to public: `cd public`
* Run `php -S localhost:<port>`
* View the website at `http://localhost:<port>`
