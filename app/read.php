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

    <p>Your local Gist List database is empty.</p>

<?php

endif; // $gists

?>

    <div class="update">
        <div class="icon icon-reload js-us-neutral"><a href="#" class="js-update" title="Update Gist List"><?=file_get_contents('../public_html/assets/images/sync-alt-solid.svg');?><span class="text">Update Gist List</span></a></div>
        <div class="icon icon-spinner js-us-loading" style="display: none;"><?=file_get_contents('../public_html/assets/images/spinner-regular.svg');?></div>
        <div class="icon icon-check js-us-success" style="display: none;"><?=file_get_contents('../public_html/assets/images/check-solid.svg');?><span class="text">Done. Reloading...</span></a></div>
    </div>

</div><!-- container -->

<script src="/assets/vendor/jquery-3.3.1/jquery.min.js"></script>
<script src="/assets/vendor/datatables-1.10.19/js/jquery.dataTables.min.js"></script>

<script>
(function($) {

    $('.js-update').on( 'click', function ( event ) {
        // prevent default
        event.stopPropagation();
        event.preventDefault();
        // show loading
        $('.js-us-neutral').hide();
        $('.js-us-loading').show();
        // make the call
        $.ajax({
            url: '/update',
        }).done( function( return_data ) {
            // console.log( 'return_data:' );
            // console.log( return_data );
            $('.js-us-loading').hide();
            $('.js-us-success').show();
            setTimeout( location.reload.bind( location ), 3000 );
        });
    });

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

