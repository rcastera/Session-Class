<?php
/**
 * @uses        Session Class in PHP5
 * @author      Richard Castera
 * @link        http://www.richardcastera.com/projects/php5-session-class
 * @version     0.02
 * @copyright   Richard Castera 2010 Copyright 
 * @access      Public
 * @see         http://www.php.net/manual/en/book.session.php
 * @license     GNU LESSER GENERAL Public LICENSE
 */
 
class Session {


  /**
   * @uses    Default time for session in minutes.
   * @access  Private
   * @var     String
   */
  private $time;

	
	/**
   * @uses    Constructor.
   * @access	Public  
   * @param   None.
   * @return  None.
   */
  public function __construct($time = 60) {
		session_start();
		$this->time = $time;
	}
	

  /**
   * @uses		Destructor.
   * @access	Public
   * @param	  None.
   * @return  None.
   */ 
  public function __destruct() {
    unset($this);
  }
	
	
  /**
   * @uses		Register the session with a user.
   * @access	Public
   * @param	  String $newUser - The user you want to register a session for.
   * @return  None.
   */
  public function registerSession($newUser) {
    $_SESSION['reg_user'] = $newUser;
    $_SESSION['ses_begin'] = $this->generateNewTime();
    $_SESSION['ses_id'] = session_id();
  }
	
	
  /**
   * @uses		Checks to see if the session is registered.
   * @access	Public
   * @param	  None.
   * @return  True if it is, False if not.
   */ 
  public function isSessionRegistered() {
    if(!empty($_SESSION['reg_user'])) {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }
	
	
  /**
   * @uses		Gets the id for the current session.
   * @access	Public
   * @param	  None.
   * @return  The session id for the current session.
   */
  public function getSessionId() {
    return $_SESSION['ses_id'];
  }
	
	
  /**
   * @uses		Checks to see if the session is over based on the amount of time given.
   * @access	Public
   * @param	  None.
   * @return 	True if the session is over, False if not.
   */
  public function isSessionExpired() {
    if($_SESSION['ses_begin'] < $this->timeNow()) {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }
	
	
  /**
   * @uses		Renews the session when the given time is not up and there is activity on the site.
   * @access	Public
   * @param	  None.
   * @return  None.
   */
  public function renewSession() {
    $_SESSION['ses_begin'] = $this->generateNewTime();
  }
	
	
  /**
   * @uses		Returns the current time.
   * @access	Public
   * @param	  None.
   * @return  The current time.
   */
  private function timeNow() {
    $currentHour = date('H'); // Get current hour.
    $currentMin  = date('i'); // Get current minute.
    $currentSec  = date('s'); // Get current second.
    $currentMon  = date('m'); // Get current month.
    $currentDay  = date('d'); // Get current day.
    $currentYear = date('y'); // Get current year.
  
    // Return the current time stamp.
    return mktime($currentHour, $currentMin, $currentSec, $currentMon, $currentDay, $currentYear);
  }
	  
	  
  /**
   * @uses		Generates new time.
   * @access  Public
   * @param	  None.
   * @return  The new time.
   */
  private function generateNewTime() {
    $currentHour = date('H'); // Get current hour.
    $currentMin  = date('i'); // Get current minute.
    $currentSec  = date('s'); // Get current second.
    $currentMon  = date('m'); // Get current month.
    $currentDay  = date('d'); // Get current day.
    $currentYear = date('y'); // Get current year.
  
    // Return the current time stamp.
    return mktime($currentHour, ($currentMin + $this->time), $currentSec, $currentMon, $currentDay, $currentYear);
  }

	
  /**
   * @uses		Destroys the session.
   * @access	Public
   * @param	  None.
   * @return  None.
   */
  public function destroySession() {
    session_destroy();
    $_SESSION = array();
  }
}
?>