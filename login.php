<?php
  $errors = array();

  // You'll definitely want to add more validation here and check against a database or something.
  // This is just an example.
  if (!empty($_POST)) {
    if ($_POST['username'] == 'test' && $_POST['password'] == 'test') {
        require_once('Class.Session.php');
        $Session = new Session(30); // Defined in minutes

        // You can define what you like to be stored.
        $user = array(
          'user_id' => 100,
          'username' => $_POST['username']
        );
        $Session->register('current_user', $user);
        header('location: index.php');
        exit;
    }
    else {
      $errors[] = 'Invalid login.';
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
<title>Login Page</title>
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
    #content .alert {
      background-color: #F2DEDE;
      border: 1px solid #EED3D7;
      border-radius: 4px 4px 4px 4px;
      color: #B94A48;
      margin-bottom: 18px;
      padding: 8px 35px 8px 14px;
      text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
    }
    #content .alert ul, 
    #content .alert ul li {
      margin: 0px;
      padding: 0px;
      list-style-type: none;
    }
    #content form {
      margin: 0pt auto;
      padding: 20px;
      width: 300px;
      display: block;
      background-color: #F7F7F9;
      border: 1px solid #E1E1E8;
      border-radius: 4px 4px 4px 4px;
    }
    #content form div {
      margin: 0px 0px 10px 0px;
      clear: both;
    }
    #content form label {
      padding: 5px 10px 0px 0px;
      width: 100px;
      float: left;
    }
    #content form input {
      padding: 5px;
    }
</style>
</head>
<body>
  <header id="header">
    <h1>Login</h1>
  </header>

  <div id="content">
    <p class="note">
      Enter "test" for Email and Password.
    </p>

    <?php if (!empty($errors)): ?>
      <div class="alert">
        <ul>
        <?php foreach($errors as $error): ?>
          <li><?php echo $error; ?></li>
        <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form method="post" action="login.php">
      <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="" placeholder="Email" />
      </div>
      <div>
        <label for="password">Password:</label>
        <input type="text" id="password" name="password" value="" placeholder="Password" />
      </div>
      <div>
        <input type="submit" id="" name="" value="Login" />
      </div>
    </form>
  </div>

  <footer id="footer">
    
  </footer>

  <script src="//code.jquery.com/jquery-latest.min.js"></script>
</body>
</html>