<?php
/**
 * @author Dmitry Stepanov <dmitry@stepanov.lv>
 * @copyright 2013, Dmitry Stepanov. All rights reserved.
 * @link http://stepanov.lv
 */

namespace Web;

use \App\Config as BaseConfig;

class Config extends BaseConfig
{
    /**
     * Request method (upper case).
     *
     * @var string
     */
    public $method = 'GET';
}