"use strict";

$(function () {
    var direction = $("html").attr("dir");
    var orientation = direction === "rtl" ? "right" : "left";


    $(".datepicker").each(function () {  
        // var placeholder = $(this).attr("placeholder") || "Select Item";
        // var allowClear = $(this).is("[allowClear]"); 
        var button = $(this).is("[button]")
        var multidate = $(this).is("[multidate]")  
        if(button){
            $(this).datepicker({
                orientation: orientation,
                todayBtn: "linked",
                clearBtn: true,
                todayHighlight: true
            });
        }else if(multidate){
            $(this).datepicker({
                orientation: orientation,
                multidate: true,
                multidateSeparator: ", ",
                todayHighlight: true
            });
        }else{
            $(this).datepicker({
                orientation: orientation,
                autoclose: true,
                todayHighlight: true, 
            });
        } 
       
    });
 
});
