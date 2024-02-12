function printDiv(divId) {
    var printContents = document.getElementById(divId).innerHTML;
    var printWindow = window.open('', '_blank');
    
    printWindow.document.open();
    printWindow.document.write('<html><head><title>Print</title></head><body>');
    printWindow.document.write(printContents);
    printWindow.document.write('</body></html>');
    printWindow.document.close();

    window.print();
   
}
