<?php

if ( !file_exists( dirname( __FILE__ ).'/config.php' ) )
    exit('You don\'t have a config.php yet. Make a copy of config-example.php and configure it.');

include 'config.php';

include 'functions.php';

include 'core-head.php';

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

?>
<style>
body {
    min-height: 100vh;
    margin: 0;
    padding: 0;
    background-color: #222;
    display: flex;
    justify-content: center;
    align-items: center;
}
p {
    text-align: center;
    font-family: Arial;
    font-size: 18px;
    color: #fff;
}
</style>

<p>Local Gists DB updated.</p>

<?php

include 'core-foot.php';

