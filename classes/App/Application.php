<?php
/**
 * @author Dmitry Stepanov <dmitry@stepanov.lv>
 * @copyright 2013, Dmitry Stepanov. All rights reserved.
 * @link http://stepanov.lv
 */

namespace App;

use \Core\Core;

abstract class Application
{
    /**
     * @var Config
     */
    public $cfg;

    /**
     * Initializes with specified config object.
     *
     * @param Config $cfg
     */
    public function __construct( $cfg )
    {
        Core::Assert( $cfg->publicRoot !== null );
        Core::Assert( $cfg->systemRoot !== null );
        Core::Assert( $cfg->baseURI !== null );

        $this->cfg = $cfg;
    }

    /**
     * Returns URI for the specified resource in the application.
     *
     * @param string $path
     *
     * @param array $args
     *
     * @return string
     */
    public abstract function GetResourceURI( $path, $args = array() );

    /**
     * Returns base URI of the application.
     *
     * @param array $args
     *
     * @return string
     */
    public function GetBaseURI( $args = array() )
    {
        return $this->GetResourceURI( '', $args );
    }
}