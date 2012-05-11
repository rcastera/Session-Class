<?php
/**
* Session Class in PHP5
* @author Richard Castera
* @link http://www.richardcastera.com/projects/php5-session-class
* @see http://www.php.net/manual/en/book.session.php
* @license GNU LESSER GENERAL Public LICENSE
*/
 
class Session {
  /**
   * Default time for session in minutes.
   * @var String
   */
  private $time;

  /**
   * Constructor.
   * @param Integer $time.
   */
  public function __construct($time = 60) {
    session_start();
    $this->time = $time;
  }

  /**
   * Destructor.
   */ 
  public function __destruct() {
    unset($this);
  }

  /**
   * Register the session with a user.
   * @param String $key - The user you want to register a session for.
   * @param Mixed $value
   */
  public function register($key = '', $value = '') {
    $_SESSION['session_id'] = session_id();
    $_SESSION['session_start'] = $this->newTime();

    if (!empty($key) && !empty($value)) {
      $_SESSION[$key] = $value;
    }
  }

  /**
   * Checks to see if the session is registered.
   * @return  True if it is, False if not.
   */ 
  public function isRegistered() {
    if (!empty($_SESSION['session_id'])) {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }

  /**
   * Undocumented variable
   * @var 
   */
  public function getSession() {
    return $_SESSION;
  }

  /**
   * Gets the id for the current session.
   * @return  The session id for the current session.
   */
  public function getSessionId() {
    return $_SESSION['session_id'];
  }

  /**
   * Checks to see if the session is over based on the amount of time given.
   * @return  True if the session is over, False if not.
   */
  public function isExpired() {
    if ($_SESSION['session_start'] < $this->timeNow()) {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }

  /**
   * Renews the session when the given time is not up and there is activity on the site.
   */
  public function renew() {
    $_SESSION['session_start'] = $this->newTime();
  }

  /**
   * Returns the current time.
   * @return  The current time.
   */
  private function timeNow() {
    $currentHour = date('H');
    $currentMin  = date('i');
    $currentSec  = date('s');
    $currentMon  = date('m');
    $currentDay  = date('d');
    $currentYear = date('y');
    return mktime($currentHour, $currentMin, $currentSec, $currentMon, $currentDay, $currentYear);
  }

  /**
   * Generates new time.
   * @return  The new time.
   */
  private function newTime() {
    $currentHour = date('H');
    $currentMin  = date('i');
    $currentSec  = date('s');
    $currentMon  = date('m');
    $currentDay  = date('d');
    $currentYear = date('y');
    return mktime($currentHour, ($currentMin + $this->time), $currentSec, $currentMon, $currentDay, $currentYear);
  }
  
  /**
   * Destroys the session.
   */
  public function end() {
    session_destroy();
    $_SESSION = array();
  }
}
