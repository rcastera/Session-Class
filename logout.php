<?php 
	require_once('Class.Session.php');
  $Session = new Session();
  $Session->end();
  header('location: login.php');
  exit;
?>