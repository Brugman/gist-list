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

    <!-- link css -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

    <style>
    body {
        background-color: #1f1f1f;
        padding-top: 100px;
        padding-bottom: 50px;
        font-family: Arial;
        font-size: 18px;
        color: #fff;
    }
    a {
        color: #fff;
        text-decoration: none;
        border-bottom: 1px dotted #fff;
    }
    .container {
        max-width: 1400px;
        margin: 0 auto;
    }
    table {}
    table tr {
        background-color: #1f1f1f !important;
    }
    table th {
        text-align: left;
    }
    #DataTables_Table_0_filter {
        float: none;
        text-align: center;
        margin-bottom: 50px;
    }
    #DataTables_Table_0_filter label {
        font-size: 0;
    }
    #DataTables_Table_0_filter input {
        padding: 5px 10px;
        font-size: 24px;
        text-align: center;
        border: 0;
        background-color: #ffc016;
        color: #1f1f1f;
    }
    #DataTables_Table_0_filter input::placeholder {
        text-transform: uppercase;
        opacity: 0.3;
    }
    .dataTables_wrapper.no-footer .dataTables_scrollBody {
        border-bottom: 1px solid #ffc016;
    }
    table.dataTable thead th,
    table.dataTable thead td { border-bottom: 1px solid #ffc016; }
    #DataTables_Table_0_info {
        color: #aaa;
    }
    </style>

</head>
<body>

<div class="container">

<?php

include 'config.php';

include 'functions.php';

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

else:

?>

    <p>Gist List empty.</p>

<?php

endif; // $gists

?>

</div><!-- container -->

<script src="jquery.min.js"></script>
<script src="jquery.dataTables.min.js"></script>

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

if ( isset( $_GET['q'] ) && !empty( $_GET['q'] ) )
{
    $query = trim( $_GET['q'] );
?>
    $( '#DataTables_Table_0_filter input' ).val( '<?=$query;?>' ).focus();
    datatable.search( '<?=$query;?>' ).draw();
<?php
}
else
{
?>
    $( '#DataTables_Table_0_filter input' ).focus().select();
<?php
}

?>

})( jQuery );
</script>

</body>
</html>