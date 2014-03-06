<?php
/**
 * @author Dmitry Stepanov <dmitry@stepanov.lv>
 * @copyright 2013, Dmitry Stepanov. All rights reserved.
 * @link http://stepanov.lv
 */

namespace App;

class Config
{
    /**
     * Absolute path to directory where application's system
     * (non-public) part resides.
     *
     * @var string
     */
    public $systemRoot;

    /**
     * Absolute path to directory where application's public
     * part resides.
     *
     * @var string
     */
    public $publicRoot;

    /**
     * Absolute public base URI for the application.
     *
     * @var string
     */
    public $baseURI;

    /**
     * Session to use.
     * If not set, sessions are disabled.
     *
     * @var Session
     */
    public $session;
}