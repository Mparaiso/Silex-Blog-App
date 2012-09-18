#Silex Blog
## A blog engine powered with Silex and MongoDB in php
### this is a Silex showcase app written with php and Silex

#### WHY ? 
+ help learn silex symfony 
+ help learn develop a application backed by a Schenaless Database
+ help learn MongoDB
+ create a wordpress like CMS with a micro framework like SILEX

#### Status : Work in progress

#### Author M.PARAISO

### LIVE DEMO : http://mpmedia.alwaysdata.net/silexblog/


## features

+ user management
  + sign in 
  + sign out
  + register

+ articles management
  + create , update , delete articles
  + comments
  + tags

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

###TODO

+ configuration support
+ comment spam management
+ category management
+ pages management
+ fully featured content editor 
+ content backup
+ installation script
+ RDBMS support
+ embedded content support
+ short code support
+ templates support
+ menu management

### get some help : mparaiso@online.fr
#### please contribute , fork , refactor and make pull request ;)

