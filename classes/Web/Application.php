<?php
/**
 * @author Dmitry Stepanov <dmitry@stepanov.lv>
 * @copyright 2013, Dmitry Stepanov. All rights reserved.
 * @link http://stepanov.lv
 */

namespace Web;

use \Core\Core;
use \App\Application as BaseApplication;

class Application extends BaseApplication
{
    /**
     * Constructor.
     *
     * @param Config $cfg
     */
    public function __construct( $cfg )
    {
        Core::Assert( $cfg instanceof Config );

        if( $cfg->baseURI === null )
        {
            $cfg->baseURI = Core::GetBaseURI( $cfg->publicRoot );
        }

        if( $cfg->publicRoot === null )
        {
            $cfg->publicRoot = $_SERVER[ 'DOCUMENT_ROOT' ];
        }

        parent::__construct( $cfg );
    }

    /**
     * @see Application::GetResourceURI()
     */
    public function GetResourceURI( $path, $args = array() )
    {
        $URI = $this->cfg->baseURI . $path;

        if( !empty( $args ) )
        {
            $URI .= '?' . http_build_query( $args, null, '&', PHP_QUERY_RFC3986 );
        }

        return $URI;
    }
}