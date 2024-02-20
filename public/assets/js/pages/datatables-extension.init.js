$(document).ready(function() {  
    if (document.getElementById("datatable")) { 
        var title = $('.page-title-box').find('h4').text();
        var Period = $('.page-title-box').find('p').text();
        var hideExport = ':nth-child(1),:nth-child(2)'; 
        if(!hideExport){ 
           var hideExport = '';
        } 
        if(!pageOrientation){
            var pageOrientation = "portrait";
        } 
        if(!pageSize){
            var pageSize = "A4";
        }

        if(!fontSize){
            var fontSize = 10;
        }
 

        $("#datatable").DataTable({
            lengthChange: false,
            ordering: false,
            pageLength: 20,
            buttons: [
                {
                    extend: "excelHtml5",
                    text: "Excel",
                    title: "Way Housing Pvt. Ltd \n"+title+"\n"+Period ,
                    exportOptions: {
                        columns: ':visible:not('+hideExport+')'
                    } 
                },
                {
                    extend: "pdfHtml5",
                    text: "PDF",
                    title: "",
                    exportOptions: {
                        columns: ':visible:not('+hideExport+')'
                    },
                    customize: function(doc) {
                        doc.content.unshift({
                            text: [
                                { text: 'Way Housing Pvt. Ltd\n', fontSize: 16, bold: true },
                                { text: title+'\n', fontSize: 14, bold: true },
                                { text: Period+'\n', fontSize: 12}
                            ],
                            alignment: "center"
                        });
                        doc.pageOrientation = pageOrientation;
                        doc.pageSize = pageSize;
                        doc.defaultStyle.fontSize = fontSize;
 
                        // full width 
                        doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
 
                        // header margin
                        doc.content[1].table.body[0].forEach(function(headerCell) {
                            headerCell.alignment = 'left';
                            headerCell.margin = [2, 0, 0, 0];
                            headerCell.fontSize = fontSize;
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
