Session Class
=============

This is a Session class for you guessed it, managing sessions. Back in the day, when 
there weren't many open source frameworks on the market, developers had to code things 
from scratch to achieve certain functionality. This class's inception, is the from one of 
those instances. With this class you can easily time-out your authenticated users after 
a specified interval.

### Setup
-----------------
 Add a `composer.json` file to your project:

```javascript
{
  "require": {
      "rcastera/session": "v1.0.0"
  }
}
```

Then provided you have [composer](http://getcomposer.org) installed, you can run the following command:

```bash
$ composer.phar install
```

That will fetch the library and its dependencies inside your vendor folder. Then you can add the following to your
.php files in order to use the library (if you don't already have one).

```php
require 'vendor/autoload.php';
```

Then you need to `use` the relevant class, and instantiate the class. For example:


### Getting Started
-----------------
```php
require 'vendor/autoload.php';

use rcastera\Browser\Session\Session;

$session = new Session();
```


### Examples
-----------------

##### Logging in. (login.php)
```php
<?php
    require 'vendor/autoload.php';
    use rcastera\Browser\Session\Session;

    $errors = array();

    // You'll definitely want to add more validation here and check against a
    // database or something. This is just an example.
    if (! empty($_POST)) {
        if ($_POST['username'] == 'test' && $_POST['password'] == 'test') {
            $session = new Session();

            // You can define what you like to be stored.
            $user = array(
                'user_id' => 1,
                'username' => $_POST['username']
            );

            $session->register(120); // Register for 2 hours.
            $session->set('current_user', $user);
            header('location: index.php');
            exit;
        } else {
            $errors[] = 'Invalid login.';
        }
    }
?>

// Your form here.
```


##### Secure area once authenticated. (index.php/controller/whatever)
```php
<?php
    require 'vendor/autoload.php';
    use rcastera\Browser\Session\Session;

    $session = new Session();

    // Check if the session registered.
    if ($session->isRegistered()) {
        // Check to see if the session has expired.
        // If it has, end the session and redirect to login.
        if ($session->isExpired()) {
            $session->end();
            header('location: login.php');
            exit;
        } else {
            // Keep renewing the session as long as they keep taking action.
            $session->renew();
        }
    } else {
        header('location: login.php');
        exit;
    }
?>
```


##### Logging out. (logout.php)
```php
<?php
    require 'vendor/autoload.php';
    use rcastera\Browser\Session\Session;

    $session = new Session();
    $session->end();
    header('location: login.php');
    exit;
?>
```


### Contributing
-----------------
1. Fork it.
2. Create a branch (`git checkout -b my_branch`)
3. Commit your changes (`git commit -am "Added something"`)
4. Push to the branch (`git push origin my_branch`)
5. Create an Issue with a link to your branch
6. Enjoy a refreshing Coke and wait
