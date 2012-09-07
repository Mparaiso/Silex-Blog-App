#MONGOBLOG
## A blog engine powered with Silex and MongoDB in php
### this is a Silex showcase app written with php and Silex

### LIVE DEMO : http://mpmedia.alwaysdata.net/silexblog/


## features

+ user management
  + sign in 
  + sign out
  + register

+ articles management
  + create , update , delete articles
  + comments

+ Symfony modules :
	+ security
	+ session
	+ monolog
	+ form
	+ config
	+ translation
	+ ...

## requires :

+ PHP 5.3.*
+ MongoDB driver for PHP
+ a local or remote MongoDB database
+ an apache server , the server or virtual host root must point to the public folder.
+ composer for package management

## Installation :

install with composer :

+ php /path/to/composer/composer.phar install

+ change the path of the autoloader.php in app/bootstrap.php to "../vendor/autoload.php" or wherever the vendor/autoload.php file is.

+ use a local MongoDB server (localhost) , the name of the database is by default mongoblog OR set the envirronment variables on your server MONGODB_SERVER and MONGODB_DATABASE ( in a .htaccess file with SetEnv for instance ).



### get some help : mparaiso@online.fr
#### please contribute , fork , refactor and make pull request ;)

