<?php
/**
 * @author Dmitry Stepanov <dmitry@stepanov.lv>
 * @copyright 2013, Dmitry Stepanov. All rights reserved.
 * @link http://stepanov.lv
 */

namespace App\Template;

use \Core\Core;
use \App\Template as BaseTemplate;

class File extends BaseTemplate
{
    /**
     * Absolute path to template file.
     *
     * @var string
     */
    private $path;

    /**
     * @see BaseTemplate::__construct()
     *
     * @param string $path
     *     Absolute path to template file.
     */
    public function __construct( $path )
    {
        $this->path = $path;
        parent::__construct();
    }

    /**
     * If template could not be parsed or the template file
     * has returned boolean false, throws Exception. Otherwise,
     * returns result of include().
     *
     * @see BaseTemplate::__invoke()
     *
     * @param array $args
     *
     * @return
     *     mixed
     */
    public function Parse( $args = array() )
    {
        extract( $args, EXTR_OVERWRITE );

        $result = include( $this->path );

        if( $result === false )
        {
            Core::Fail( 'Could not parse template ' . $this->path );
        }

        return $result;
    }
}