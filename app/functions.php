<?php

function get_gists_page( $page = false )
{
    if ( !$page )
        return false;

    global $github_username, $github_token;

    $api_url = 'https://api.github.com/users/'.$github_username.'/gists?per_page=100&page='.$page;

    $ch = curl_init();
    $options = [
        CURLOPT_URL            => $api_url,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_FOLLOWLOCATION => 1,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_AUTOREFERER    => 1,
        CURLOPT_USERAGENT      => 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)',
        CURLOPT_TIMEOUT        => 300,
        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_0,
        CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4,
        CURLOPT_HTTPHEADER     => [ 'Authorization: Bearer '.$github_token ],
    ];

    curl_setopt_array( $ch, $options );
    $items = curl_exec( $ch );
    $items = json_decode( $items, true );

    return $items;
}

function get_all_gists()
{
    $all_items = [];
    $page = 0;

    do
    {
        $page++;
        $items = get_gists_page( $page );
        $all_items = array_merge( $all_items, $items );
    }
    while ( count( $items ) == 100 );

    return $all_items;
}

function get_gists_local()
{
    global $database_file;
    // if it doesnt exist create the file
    if ( !file_exists( $database_file ) )
        file_put_contents( $database_file, '[]' );
    // create filehandler - read
    $wtf_fh_r = fopen( $database_file, 'r' ) or die('cant access file');
    // read data from file
    $gists = fread( $wtf_fh_r, filesize( $database_file ) );
    // close filehandler
    fclose( $wtf_fh_r );
    // decode
    $gists = json_decode( $gists, true );

    return $gists;
}

function filter_usable_data( $old = [] )
{
    $new = [];

    foreach ( $old as $item )
    {
        $new[] = [
            'url'         => $item['html_url'],
            'filename'    => remove_extension( reset( $item['files'] )['filename'] ),
            'filelang'    => reset( $item['files'] )['language'],
            'description' => $item['description'],
            'public'      => $item['public'],
            'created_at'  => $item['created_at'],
            'updated_at'  => $item['updated_at'],
        ];
    }

    return $new;
}

function remove_extension( $file = '' )
{
    if ( strpos( $file, '.' ) === false )
        return $file;

    $file = explode( '.', $file );
    array_pop( $file );
    $file = implode( '.', $file );

    return $file;
}

function format_date( $string )
{
    $timestamp = strtotime( $string );

    return date( 'Y-m-d', $timestamp );
}

