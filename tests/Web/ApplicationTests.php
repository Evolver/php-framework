<?php
/**
 * @author Dmitry Stepanov <dmitry@stepanov.lv>
 * @copyright 2013, Dmitry Stepanov. All rights reserved.
 * @link http://stepanov.lv
 */

namespace Web;

use \Core\Core;
use \Core\Tests;
use \App\ApplicationTests as BaseTests;

class ApplicationTests extends BaseTests
{
    protected function GoodConfig_Fixtures()
    {
        $appClass = Application::class;

        $cfg = new Config;
        $cfg->baseURI = 'someURI';
        $cfg->publicRoot = $_SERVER[ 'DOCUMENT_ROOT' ];
        $cfg->systemRoot = $_SERVER[ 'DOCUMENT_ROOT' ];
        yield 'All specified' => array( $appClass, $cfg );

        $cfg = new Config;
        $cfg->publicRoot = $_SERVER[ 'DOCUMENT_ROOT' ];
        $cfg->systemRoot = $_SERVER[ 'DOCUMENT_ROOT' ];
        yield 'No baseURI' => array( $appClass, $cfg );

        $cfg = new Config;
        $cfg->baseURI = 'someURI';
        $cfg->systemRoot = $_SERVER[ 'DOCUMENT_ROOT' ];
        yield 'No publicRoot' => array( $appClass, $cfg );
    }

    protected function BadConfig_Fixtures()
    {
        $appClass = Application::class;

        $cfg = new Config;
        yield 'All unspecified' => array( $appClass, $cfg );

        $cfg = new Config;
        $cfg->baseURI = $_SERVER[ 'DOCUMENT_ROOT' ];
        $cfg->publicRoot = $_SERVER[ 'DOCUMENT_ROOT' ];
        yield 'No sysroot' => array( $appClass, $cfg );
    }

    protected function ConfigFallback_Fixtures()
    {
        yield Config::class => array( Application::class, Config::class );
    }

    public function ConfigFallback( $appClass, $cfgClass )
    {
        $cfg = new $cfgClass;
        $cfg->publicRoot = $_SERVER[ 'DOCUMENT_ROOT' ];
        $cfg->systemRoot = $_SERVER[ 'DOCUMENT_ROOT' ];

        $app = new $appClass( $cfg );
        parent::AssertEq( $app->cfg->baseURI, Core::GetServerURI() );

        $cfg = new $cfgClass;
        $cfg->baseURI = 'someURI';
        $cfg->systemRoot = $_SERVER[ 'DOCUMENT_ROOT' ];

        $app = new $appClass( $cfg );
        parent::AssertEq( $app->cfg->publicRoot, $_SERVER[ 'DOCUMENT_ROOT' ] );
    }

    protected function GetBaseURI_Fixtures()
    {
        $cfg = new Config;
        $cfg->baseURI = 'http://stepanov.lv';
        $cfg->publicRoot = $_SERVER[ 'DOCUMENT_ROOT' ];
        $cfg->systemRoot = $_SERVER[ 'DOCUMENT_ROOT' ];

        $app = new Application( $cfg );

        yield 'NoArgs' => array( $app, [], 'http://stepanov.lv' );
        yield 'SeveralArgs' => array( $app, [ 'x' => 5, 'y' => 10 ], 'http://stepanov.lv?x=5&y=10' );
    }

    protected function GetResourceURI_Fixtures()
    {
        $cfg = new Config;
        $cfg->baseURI = 'http://stepanov.lv';
        $cfg->publicRoot = $_SERVER[ 'DOCUMENT_ROOT' ];
        $cfg->systemRoot = $_SERVER[ 'DOCUMENT_ROOT' ];

        $app = new Application( $cfg );

        yield 'NoPathNoArgs' => array( $app, '', [], 'http://stepanov.lv' );
        yield 'NoPathSeveralArgs' => array( $app, '', [ 'x' => 5, 'y' => 10 ], 'http://stepanov.lv?x=5&y=10' );
        yield 'NoArgs' => array( $app, '/path', [], 'http://stepanov.lv/path' );
        yield 'SeveralArgs' => array( $app, '/path', [ 'x' => 5, 'y' => 10 ], 'http://stepanov.lv/path?x=5&y=10' );
    }
}