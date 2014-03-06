<?php
/**
 * @author Dmitry Stepanov <dmitry@stepanov.lv>
 * @copyright 2013, Dmitry Stepanov. All rights reserved.
 * @link http://stepanov.lv
 */

namespace App;

use \ArrayAccess;
use \App\Session\Data as SessionData;

/**
 * Provides interface to access session data object associated with
 * current session.
 *
 * NOTE: not to be confused with interface to access ANY session. This interface
 * provides access only to a single (usually active) session.
 */
abstract class Session
{
    /**
     * Returns session data object.
     *
     * @param $access
     *    Desired access level.
     *
     * @return SessionData
     */
    public abstract function Open( $access = Access::READ );
}