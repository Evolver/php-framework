<?php
/**
 * @author Dmitry Stepanov <dmitry@stepanov.lv>
 * @copyright 2013, Dmitry Stepanov. All rights reserved.
 * @link http://stepanov.lv
 */

namespace App\Session;

use \ArrayAccess;

/**
 * An abstraction layer used to access session data.
 */
abstract class Data implements ArrayAccess
{
}