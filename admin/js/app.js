$(document).ready(function($){
    // Get current path and find target link
    var path = window.location.pathname.split("/");
    if (path.length == 3) {
        var select = "/" + path[1] + "/" + path[2];
    } else if (path.length == 4) {
        var select = "/" + path[1] + "/" + path[2] + "/" + path[3];
    } 
    if (path[2] == "") {
        var select = "/admin/";
    }
    if (path[2] == "index.php") {
        var select = "/admin/";
    }
    if (path[3] == "index.php") {
        var select = "/" + path[1] + "/" + path[2] + "/";
    }
    var target = $(`.sidebar a[href="${select}"]`);
    target.addClass('active');
    
});

$(document).ready( function () {
    $(document).ready( function () {
        $('#mysheets').DataTable( {
            "pagingType": "full_numbers",
            searchPanes:{
                cascadePanes: true,
                viewTotal: true,
            },
            buttons: [
                'csv',
                'excel'
            ],
            "order": [[ 0, 'desc' ]],
            dom: 
                "<'row'<'col-sm-12 col-md-6'Q><'col-sm-12 col-md-6'>>" +
                "<'row'<'col-sm-12 col-md-6 mb-4'B><'col-sm-12 col-md-6'>>" +
                "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
        });
    } );
} );

$(document).ready(function () {
    $(".actionselect").change(function changeSelect() {
        window.location.href=this.value;
    });
});