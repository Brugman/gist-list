(function($) {

    /**
     * On load: Datatable.
     */

    var datatable = $( '.js-datatable' ).DataTable({
        'order': [[ 1, 'asc' ]],
        'stateSave': true,
        'responsive': {
            'details': {
                'type': false
            },
        },
        'scrollY': 'calc( 100vh - 300px )',
        'paging': false,
        'language': {
            'searchPlaceholder': 'Search'
        },
    });

    var query = window.location.search.substring( 3 ).replace( /%20/g, ' ' );

    if ( query != '' )
    {
        /**
         * On load: Search datatable for query.
         */

        // place query in search box and give focus
        $( '#DataTables_Table_0_filter input' ).val( query ).focus();
        // reload datatable
        datatable.search( query ).draw();
    }
    else
    {
        /**
         * On load: Focus search field.
         */

        // give focus
        $( '#DataTables_Table_0_filter input' ).focus().select();
        // clear query string
        window.location.search = '';
    }

    /**
     * On click: Focus search field.
     */

    $( 'a' ).on( 'click', function ( event ) {
        $( '#DataTables_Table_0_filter input' ).focus().select();
    });

    /**
     * On click: Update gist db.
     */

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
            $('.js-us-loading').hide();
            $('.js-us-success').show();
            setTimeout( location.reload.bind( location ), 3000 );
        });
    });

})( jQuery );