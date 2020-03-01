
<p  align="center">

<a  href="https://github.com/yiisoft"  target="_blank">

</a>

<h1  align="center">Cygo order</h1>

<br>

</p>
Cygo order is built with [Yii 2](http://www.yiiframework.com/) PHP framework, Javascript and Jquery deployed on Heroku.
  
  

REQUIREMENTS

------------

  

The minimum requirement to run this application on your local is PHP 5.6.0.

  
  

INSTALLATION

------------

  

### Install via Composer

  
Clone this repository by running this command on your terminal

~~~

git clone https://github.com/ademola-raimi/Cigo-order.git

~~~

After clonning the repository, you are ready to set it up with composer. If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions

at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

  



  Then run 

~~~

composer install

~~~
at the project root. After composer has installed all the dependency, then start the server by running 
  
~~~

php yii serve --port=8888

~~~

You should see the server started then navigate to
  

~~~

http://localhost/order/index

~~~

The deployed url can be found [here](https://cygo-stage.herokuapp.com/order/index):

### Database

  
Note that the database used at this point is the database I have set up for testing purpose to help facilitate faster set up, however, if you want to setup your database

Edit the file `config/db.php` with real data, for example:

  

```php

return [

'class'  =>  'yii\db\Connection',

'dsn'  =>  'mysql:host=localhost;dbname=yii2basic',

'username'  =>  'root',

'password'  =>  '1234',

'charset'  =>  'utf8',

];

```

  
  

TESTING

-------

Tests can be executed by running

  

```

vendor/bin/codecept run

```
