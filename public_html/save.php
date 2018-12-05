<?php

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

echo 'Local Gists DB updated.';

?>
<style>
body {
    background-color: #222;
    color: #fff;
    font-family: Arial;
    font-size: 18px;
}
td {
    padding: 5px 10px;
}
</style>

