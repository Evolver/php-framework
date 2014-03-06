<?php
/**
 * @author Dmitry Stepanov <dmitry@stepanov.lv>
 * @copyright 2013, Dmitry Stepanov. All rights reserved.
 * @link http://stepanov.lv
 */

namespace App;

use \ReflectionClass;
use \Core\Tests;

class TemplateTests extends Tests
{
    protected function GetTemplates()
    {
        yield _DummyTemplate::class => new _DummyTemplate;
    }

    protected function GetParseOutputs()
    {
        yield 'No args' => array( [], '' );
        yield 'Some args' => array( [ 'x' => 5 ], '' );
    }

    protected function Parse_Fixtures()
    {
        foreach( $this->GetTemplates() as $className => $tpl )
        {
            foreach( $this->GetParseOutputs() as $name => $outputInfo )
            {
                array_unshift( $outputInfo, $tpl );
                yield [ $className, $name ] => $outputInfo;
            }
        }
    }

    public function Parse( $tpl, $args, $output )
    {
        parent::AssertOutputEq( $output, function() use( $tpl, $args )
        {
            $tpl->Parse( $args );
        });
    }
}

class _DummyTemplate extends Template
{
    /**
     * @see Template::Parse()
     */
    public function Parse( $args = array() )
    {
        // No-op
    }
}