<?php
/**
 * @author Dmitry Stepanov <dmitry@stepanov.lv>
 * @copyright 2013, Dmitry Stepanov. All rights reserved.
 * @link http://stepanov.lv
 */

namespace App;

use \Core\Tests;

class ApplicationTests extends Tests
{
    protected function GoodConfig_Fixtures()
    {
        $appClass = _DummyApplication::class;

        $cfg = new Config;
        $cfg->baseURI = 'someURI';
        $cfg->publicRoot = 'someRoot';
        $cfg->systemRoot = 'someSysRoot';

        yield 'All specified' => array( $appClass, $cfg );
    }

    public function GoodConfig( $appClass, $cfg )
    {
        parent::AssertNoThrow( function() use( $appClass, $cfg )
        {
            new $appClass( $cfg );
        });
    }

    protected function BadConfig_Fixtures()
    {
        $appClass = _DummyApplication::class;

        $cfg = new Config;
        yield 'All unspecified' => array( $appClass, $cfg );

        $cfg = new Config;
        $cfg->publicRoot = 'someRoot';
        $cfg->systemRoot = 'someSysRoot';
        yield 'No baseURI' => array( $appClass, $cfg );

        $cfg = new Config;
        $cfg->baseURI = 'someURI';
        $cfg->systemRoot = 'someSysRoot';
        yield 'No publicRoot' => array( $appClass, $cfg );

        $cfg = new Config;
        $cfg->baseURI = 'someURI';
        $cfg->publicRoot = 'someRoot';
        yield 'No sysroot' => array( $appClass, $cfg );
    }

    public function BadConfig( $appClass, $cfg )
    {
        parent::AssertThrows( function() use( $appClass, $cfg )
        {
            new $appClass( $cfg );
        });
    }

    protected function GetBaseURI_Fixtures()
    {
        $cfg = new Config;
        $cfg->baseURI = '/base';
        $cfg->publicRoot = 'someRoot';
        $cfg->systemRoot = 'someSysRoot';

        $app = new _DummyApplication( $cfg );

        yield 'NoArgs' => array( $app, [], '/base?' );
        yield 'SeveralArgs' => array( $app, [ 'x' => 5, 'y' => 10 ], '/base?x=5&y=10' );
    }

    public function GetBaseURI( $app, $args, $baseURI )
    {
        parent::AssertEq( $app->GetBaseURI( $args ), $baseURI );
    }

    protected function GetResourceURI_Fixtures()
    {
        $cfg = new Config;
        $cfg->baseURI = '/base';
        $cfg->publicRoot = 'someRoot';
        $cfg->systemRoot = 'someSysRoot';

        $app = new _DummyApplication( $cfg );

        yield 'NoArgs' => array( $app, '/path', [], '/base/path?' );
        yield 'SeveralArgs' => array( $app, '/path', [ 'x' => 5, 'y' => 10 ], '/base/path?x=5&y=10' );
    }

    public function GetResourceURI( $app, $path, $args, $resourceURI )
    {
        parent::AssertEq( $app->GetResourceURI( $path, $args ), $resourceURI );
    }
}

class _DummyApplication extends Application
{
    /**
     * @see Application::GetResourceURI()
     */
    public function GetResourceURI( $path, $args = array() )
    {
        return $this->cfg->baseURI . $path . '?' . http_build_query( $args );
    }
}