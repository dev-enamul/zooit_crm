"use strict";

function getDateRange(id,CustomRangeLabel = false){ 

    var defaultRange = $("#"+id).attr("default");
    var startDate = $("#"+id).attr("start");
    var endDate = $("#"+id).attr("end");

 
    var defaultStartDate, defaultEndDate;

    if (startDate && endDate) {
        defaultStartDate = moment(startDate);
        defaultEndDate = moment(endDate);
    }else{
        switch (defaultRange) {
            case "All":
                defaultStartDate = moment('1900-01-01');
                defaultEndDate = moment();
                break;
            case "Today":
                defaultStartDate = moment();
                defaultEndDate = moment();
                break;
            case "Yesterday":
                defaultStartDate = moment().subtract(1, "days");
                defaultEndDate = moment().subtract(1, "days");
                break;
            case "Last 7 Days":
                defaultStartDate = moment().subtract(6, "days");
                defaultEndDate = moment();
                break;
            case "Last 30 Days":
                defaultStartDate = moment().subtract(29, "days");
                defaultEndDate = moment();
                break;
            case "This Month":
                defaultStartDate = moment().startOf("month");
                defaultEndDate = moment().endOf("month");
                break;
            case "Last Month":
                defaultStartDate = moment().subtract(1, "month").startOf("month");
                defaultEndDate = moment().subtract(1, "month").endOf("month");
                break; 
            default: 
                defaultStartDate = moment().subtract(29, "days");
                defaultEndDate = moment();
                break;
        }
    }

    var direction = $("html").attr("dir") === "rtl" ? "left" : "right";  
    $("#"+id).daterangepicker({
        opens: direction,
        startDate:defaultStartDate,
        endDate: defaultEndDate,
        showCustomRangeLabel: CustomRangeLabel,
        ranges: {
            // "All": [moment('1900-01-01'), moment()],  
            Today: [moment(), moment()],
            Yesterday: [moment().subtract(1, "days"), moment().subtract(1, "days")],
            "Last 7 Days": [moment().subtract(6, "days"), moment()],
            "Last 30 Days": [moment().subtract(29, "days"), moment()],
            "This Month": [moment().startOf("month"), moment().endOf("month")],
            "Last Month": [
                moment().subtract(1, "month").startOf("month"),
                moment().subtract(1, "month").endOf("month")
            ], 
        }
    });
}