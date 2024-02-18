$(document).ready(function() {  
    if (document.getElementById("datatable")) { 
        $("#datatable").DataTable({
            lengthChange: false,
            ordering: false,
            buttons: [
                {
                    extend: "excelHtml5",
                    text: "Excel",
                    title: "Way Housing Pvt. Ltd \n"+title+"\nPeriod: "+Period ,
                    // exportOptions: {
                    //     columns: ':visible:not()'
                    // } 
                },
                {
                    extend: "pdfHtml5",
                    text: "PDF",
                    title: "",
                    // exportOptions: {
                    //     columns: ':visible:not()'
                    // },
                    customize: function(doc) {
                        doc.content.unshift({
                            text: [
                                { text: 'Way Housing Pvt. Ltd\n', fontSize: 16, bold: true },
                                { text: title+'\n', fontSize: 14, bold: true },
                                { text: 'Period: '+ Period+'\n', fontSize: 12}
                            ],
                            alignment: "center"
                        });
 
                        doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
 
                        doc.content[1].table.body[0].forEach(function(headerCell) {
                            headerCell.alignment = 'left';
                            headerCell.margin = [2, 0, 0, 0];
                        });
                    }
                },
                // "colvis"
            ],
            
            language: {
                paginate: {
                    previous: "<i class='mdi mdi-chevron-left'>",
                    next: "<i class='mdi mdi-chevron-right'>"
                }
            },
            drawCallback: function() {
                $(".dataTables_paginate > .pagination").addClass("pagination");
            }
        }).buttons().container().appendTo("#datatable_wrapper .col-md-6:eq(0)");
    }
});
