<?php

if ( !file_exists( dirname( __FILE__ ).'/config.php' ) )
    exit('You don\'t have a config.php yet. Make a copy of config-example.php and configure it.');

include 'config.php';

include 'functions.php';

include 'core-head.php';

?>

<div class="container">

<?php

$gists = get_gists_local();

$gists = filter_usable_data( $gists );

if ( isset( $gists ) && !empty( $gists ) ):

?>

    <table class="js-datatable">

        <thead>
            <tr>
                <th>Language</th>
                <th>Gist</th>
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

    <p>Gist List empty.</p>

<?php

endif; // $gists

?>

</div><!-- container -->

<script src="/assets/vendor/jquery-3.3.1/jquery.min.js"></script>
<script src="/assets/vendor/datatables-1.10.19/js/jquery.dataTables.min.js"></script>

<script>
(function($) {

    var datatable = $( '.js-datatable' ).DataTable({
        'order': [[ 3, 'desc' ]],
        'paging': false,
        'scrollY': '50vh',
        'stateSave': true,
        language: {
            searchPlaceholder: 'Search'
        },
    });

<?php

if ( isset( $_GET['q'] ) && !empty( $_GET['q'] ) ):

$query = trim( $_GET['q'] );

?>

    $( '#DataTables_Table_0_filter input' ).val( '<?=$query;?>' ).focus();
    datatable.search( '<?=$query;?>' ).draw();

<?php

else: // $_GET['q']

?>

    $( '#DataTables_Table_0_filter input' ).focus().select();

<?php

endif; // $_GET['q']

?>

})( jQuery );
</script>

<?php

include 'core-foot.php';

