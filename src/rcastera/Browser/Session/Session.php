<?php
/**
 * Copyright (c) 2010 Richard Castera
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without li`ation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
namespace rcastera\Browser\Session;

class Session
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        session_start();
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        unset($this);
    }

    /**
     * Register the session.
     *
     * @param integer $time.
     */
    public function register($time = 60)
    {
        $_SESSION['session_id'] = session_id();
        $_SESSION['session_time'] = intval($time);
        $_SESSION['session_start'] = $this->newTime();
    }

    /**
     * Checks to see if the session is registered.
     *
     * @return  True if it is, False if not.
     */
    public function isRegistered()
    {
        if (! empty($_SESSION['session_id'])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Set key/value in session.
     *
     * @param mixed $key
     * @param mixed $value
     */
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Retrieve value stored in session by key.
     *
     * @var mixed
     */
    public function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key]:false;
    }

    /**
     * Retrieve the global session variable.
     *
     * @return array
     */
    public function getSession()
    {
        return $_SESSION;
    }

    /**
     * Gets the id for the current session.
     *
     * @return integer - session id
     */
    public function getSessionId()
    {
        return $_SESSION['session_id'];
    }

    /**
     * Checks to see if the session is over based on the amount of time given.
     *
     * @return boolean
    */
    public function isExpired()
    {
        if ($_SESSION['session_start'] < $this->timeNow()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Renews the session when the given time is not up and there is activity on the site.
     */
    public function renew()
    {
        $_SESSION['session_start'] = $this->newTime();
    }

    /**
     * Returns the current time.
     *
     * @return unix timestamp
     */
    private function timeNow()
    {
        $currentHour = date('H');
        $currentMin = date('i');
        $currentSec = date('s');
        $currentMon = date('m');
        $currentDay = date('d');
        $currentYear = date('y');
        return mktime($currentHour, $currentMin, $currentSec, $currentMon, $currentDay, $currentYear);
    }

    /**
     * Generates new time.
     *
     * @return unix timestamp
     */
    private function newTime()
    {
        $currentHour = date('H');
        $currentMin = date('i');
        $currentSec = date('s');
        $currentMon = date('m');
        $currentDay = date('d');
        $currentYear = date('y');
        return mktime($currentHour, ($currentMin + $_SESSION['session_time']), $currentSec, $currentMon, $currentDay, $currentYear);
    }

    /**
     * Destroys the session.
     */
    public function end()
    {
        session_destroy();
        $_SESSION = array();
    }
}
