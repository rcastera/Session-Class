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
<!DOCTYPE html>
<html>
<head>
<title>Session Class</title>
<meta charset=utf-8 />
<meta http-equiv="keywords" content="" />
<meta http-equiv="description" content="" />
<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<style>
  body {
    margin: 0px;
    padding: 0px;
    top: 0px;
    right: 0px;
    bottom: 0px;
    left: 0px;
    font-family: serif;
  }
  header {
    background-color: #000;
  }
    header h1 {
      margin: 0px;
      padding: 10px;
      color: #fff;
    }
  #content {
    padding: 20px;
  }
    #content .note {
      background-color: #FCF8E3;
      border: 1px solid #FBEED5;
      border-radius: 4px 4px 4px 4px;
      color: #C09853;
      margin-bottom: 18px;
      padding: 8px 35px 8px 14px;
      text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
    }
</style>
</head>
<body>
  <header id="header">
    <h1>Welcome to my App</h1>
  </header>

  <div id="content">
    <a href="logout.php">Logout</a>
  </div>

  <footer id="footer">

  </footer>

  <script src="//code.jquery.com/jquery-latest.min.js"></script>
</body>
</html>