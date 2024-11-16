#!/usr/bin/env php
<?php
/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 * @version //autogentag//
 */

require 'autoload.php';

if ( !function_exists( 'readline' ) )
{
    function readline( $prompt = '' )
    {
        echo $prompt . ' ';
        return trim( fgets( STDIN ) );
    }
}

function microtime_float()
{
    return microtime( true );
}

set_time_limit( 0 );

$cli = eZCLI::instance();

$script = eZScript::instance(
    array(
        'description' =>
            "eZFind search index updater.\n\n" .
            "Goes trough all objects and reindexes the meta data to the search engine" .
            "\n" .
            "updatesearchindexsolr.php",
        'use-session' => true,
        'use-modules' => true,
        'use-extensions' => true
    )
);

$solrUpdate = new ezfUpdateSearchIndexSolr( $script, $cli, $argv[0] );
$solrUpdate->run();

$script->shutdown( 0 );

?>
