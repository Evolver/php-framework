<?php
/**
 * @author Dmitry Stepanov <dmitry@stepanov.lv>
 * @copyright 2013, Dmitry Stepanov. All rights reserved.
 * @link http://stepanov.lv
 */

namespace App\Template;

use \Core\Files;
use \App\TemplateTests;

class FileTests extends TemplateTests
{
    protected function GetTemplates()
    {
        $tplCode = '!' .
                   '<?php if( isset( $x ) ) echo $x; ?>' .
                   '<?php if( isset( $y ) ) echo $y; ?>' .
                   '?';
        $tplFilePath = Files::MakeTemporary();

        try
        {
            parent::AssertNotFalse( file_put_contents( $tplFilePath, $tplCode ) );

            $tpl = new File( $tplFilePath );

            yield File::class => $tpl;
        }
        finally
        {
            unlink( $tplFilePath );
        }
    }

    protected function GetParseOutputs()
    {
        yield 'No args' => array( [], '!?' );
        yield 'X in args' => array( [ 'x' => 'X' ], '!X?' );
        yield 'X and Y in args' => array( [ 'x' => 'X', 'y' => 'Z' ], '!XZ?' );
    }
}