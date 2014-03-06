<?php
/**
 * @author Dmitry Stepanov <dmitry@stepanov.lv>
 * @copyright 2013, Dmitry Stepanov. All rights reserved.
 * @link http://stepanov.lv
 */

namespace App;

use \Core\Core;

/**
 * An abstraction layer representing a logic capable of accepting
 * parameters / arguments to generate an output.
 *
 * Possible underlying implementation is a PHP file that replaces
 * variables with argument values and echoes the output.
 */
abstract class Template
{
    /**
     * Default constructor.
     */
    public function __construct()
    {
    }

    /**
     * Parses template and yields results to stdout.
     *
     * @param ArrayAccess $args
     *     Arguments to use while generating the output.
     */
    public abstract function Parse( $args = array() );
}
