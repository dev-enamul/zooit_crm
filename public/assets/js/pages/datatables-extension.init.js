$(document).ready(function() {
    if (document.getElementById("datatable-buttons")) {
        $("#datatable-buttons").DataTable({
            lengthChange: false,
            buttons: ["excel", "pdf"],
            language: {
                paginate: {
                    previous: "<i class='mdi mdi-chevron-left'>",
                    next: "<i class='mdi mdi-chevron-right'>"
                }
            },
            drawCallback: function() {
                $(".dataTables_paginate > .pagination").addClass("pagination");
            }
        }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");
    }
}); 

 