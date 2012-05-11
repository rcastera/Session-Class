Session Class
=============

This is a Session class for you guessed it, managing sessions. Back in the day, when 
there weren't many open source frameworks on the market, developers had to code things 
from scratch to achieve certain functionality. This class's inception, is the from one of 
those instances. With this class you can easily time-out your authenticated users after 
a specified interval.


Examples
-----------
    From within your app, once authenticated, you would run this to check if the user's session is still valid.
    <?php
      // Load the class and instatiate it.
      require_once('Class.Session.php');
      $Session = new Session(30); // Measured in minutes; this case 30

      // Check if the session registered.
      if ($Session->isRegistered()) {
        // Check to see if the session has expired.
        // If it has, end the session and redirect to login.
        if ($Session->isExpired()) {
            $Session->end();
            header('location: login.php');
            exit;
        } 
        else {
          // Keep renewing the session as long as they keep taking action.
          $Session->renew();
        }
      }
      else {
        header('location: login.php');
        exit;
      }
    ?>

Contributing
------------

1. Fork it.
2. Create a branch (`git checkout -b my_branch`)
3. Commit your changes (`git commit -am "Added something"`)
4. Push to the branch (`git push origin my_branch`)
5. Create an [Issue][1] with a link to your branch
6. Enjoy a refreshing Coke and wait
