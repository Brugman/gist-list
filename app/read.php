<?php

if ( !file_exists( dirname( __FILE__ ).'/config.php' ) )
    exit('You don\'t have a config.php yet. Make a copy of config-example.php and configure it.');

include 'config.php';

include 'functions.php';

?>
<!DOCTYPE html>
<html>
<head>

    <!-- meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">

    <!-- title -->
    <title>Gist List</title>

    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <!-- css -->
    <link rel="stylesheet" href="/assets/vendor/datatables-1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/assets/vendor/datatables-responsive-2.2.3/responsive.dataTables.min.css">
    <link rel="stylesheet" href="/assets/app.min.css?v20210606">

</head>
<body>

<?php

$gists = get_gists_local();

$gists = filter_usable_data( $gists );

if ( isset( $gists ) && !empty( $gists ) ):

?>

<table class="js-datatable">

    <thead>
        <tr>
            <th data-priority="2">Language</th>
            <th data-priority="1">Gist</th>
            <th>Public</th>
            <th>Created</th>
            <th>Updated</th>
        </tr>
    </thead>

    <tbody>

<?php

foreach ( $gists as $gist ):

?>

        <tr>
            <td data-order="<?=( $gist['filelang'] ?: 'ZZZZZ' );?>"><?=$gist['filelang'];?></td>
            <td><a href="<?=$gist['url'];?>" target="_blank"><?=$gist['filename'];?></a></td>
            <td><?=( $gist['public'] ? 'Yes' : '' );?></td>
            <td data-order="<?=$gist['created_at'];?>"><?=format_date( $gist['created_at'] );?></td>
            <td data-order="<?=$gist['updated_at'];?>"><?=format_date( $gist['updated_at'] );?></td>
        </tr>

<?php

endforeach; // $gists

?>

    </tbody>

</table>

<?php

else: // $gists

?>

<p>Your local Gist List database is empty.</p>

<?php

endif; // $gists

?>

<div class="update">
    <div class="icon icon-reload js-us-neutral"><a href="#" class="js-update" title="Update Gist List"><?=file_get_contents('../public_html/assets/images/sync-alt-solid.svg');?><span class="text">Update Gist List</span></a></div>
    <div class="icon icon-spinner js-us-loading" style="display: none;"><?=file_get_contents('../public_html/assets/images/spinner-regular.svg');?></div>
    <div class="icon icon-check js-us-success" style="display: none;"><?=file_get_contents('../public_html/assets/images/check-solid.svg');?><span class="text">Done. Reloading...</span></a></div>
</div>

<script src="/assets/vendor/jquery-3.3.1/jquery.min.js"></script>
<script src="/assets/vendor/datatables-1.10.19/js/jquery.dataTables.min.js"></script>
<script src="/assets/vendor/datatables-responsive-2.2.3/dataTables.responsive.min.js"></script>
<script src="/assets/app.min.js?v20210606"></script>

</body>
</html>