<?php
/**
 * @author Dmitry Stepanov <dmitry@stepanov.lv>
 * @copyright 2013, Dmitry Stepanov. All rights reserved.
 * @link http://stepanov.lv
 */

use \Core\Core;

Core::AddNamespace( 'App', __DIR__ . '/classes' );
Core::AddNamespaceTests( 'App', __DIR__ . '/tests', true );

Core::AddNamespace( 'Web', __DIR__ . '/classes' );
Core::AddNamespaceTests( 'Web', __DIR__ . '/tests', true );