<?php

if ( !file_exists( dirname( __FILE__ ).'/config.php' ) )
    exit('You don\'t have a config.php yet. Make a copy of config-example.php and configure it.');

include 'config.php';

include 'functions.php';

$gists = get_all_gists();

// if it doesnt exist create the file
if ( !file_exists( $database_file ) )
    file_put_contents( $database_file, '[]' );
// create filehandler - write
$wtf_fh_w = fopen( $database_file, 'w' ) or die('cant access file');
// write data to file
fwrite( $wtf_fh_w, json_encode( $gists ) );
// close filehandler
fclose( $wtf_fh_w );

header( 'Content-Type: application/json; charset=UTF-8' );
echo json_encode( 1 );
exit;

