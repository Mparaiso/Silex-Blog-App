#Silex Blog

## A blog engine powered with Silex and MongoDB in php
Check out the silex framework , by Fabien Potencier, author of Symfony,Twig,Simso,Pimple ...
http://silex.sensiolabs.org

### this is a Silex showcase app written with php and Silex

#### Status : Work in progress

#### Author M.PARAISO , Paris, France, contact mparaiso@free.fr

### LIVE DEMO : http://silex-mongoblog.herokuapp.com/

#### WHY ? 
+ help learn silex symfony 
  + Symfony is the #1 php MVC framework, 
  + Silex is a framework that allow direct integration with Symfony components but with a fastest learning curve.
+ help learn MongoDB
  + MongoDB allows easy scaling of the database.
+ create a wordpress like CMS 
  + Most of clients are used to manage their content with a Wordpress like interface
  + this app will try to reproduce the best features of the wordpress CMS , like easy content management , easy template management , and easy plugin extension


## features

+ user management
  + sign in 
  + sign out
  + register

+ articles management
  + create , update , delete articles
  + comments
  + tags
  + articles support key,value metadatas 
  
+ Symfony modules :
	+ security
	+ session
	+ monolog
	+ form
	+ config
	+ translation
	+ ...

+ antispam integration 
  +via Akismet


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

+ get an askimet api key to deal with spammers
and declare a envirronment variable called
AKISMET_APIKEY

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

### Silex based frameworks
+ https://github.com/bobdenotter/bolt

### other kitchen sink / boilerplate projects for silex :

+ https://github.com/lyrixx/Silex-Kitchen-Edition
+ https://github.com/litek/silex-skeleton
+ https://github.com/fabpot/Silex-Skeleton
+ https://github.com/vesparny/silex-simple-rest

### get some help : mparaiso@online.fr
#### please contribute , fork , refactor and make pull request ;)

