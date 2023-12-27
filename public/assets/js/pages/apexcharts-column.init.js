function getChartColorsArray(t) {
    if (null !== document.getElementById(t)) {
        var e = document.getElementById(t).getAttribute("data-colors");
        if (e)
            return (e = JSON.parse(e)).map(function (t) {
                var e = t.replace(" ", "");
                if (-1 === e.indexOf(",")) {
                    var r = getComputedStyle(document.documentElement).getPropertyValue(e);
                    return r || e;
                }
                var o = t.split(",");
                return 2 != o.length ? e : "rgba(" + getComputedStyle(document.documentElement).getPropertyValue(o[0]) + "," + o[1] + ")";
            });
    }
}
 
function barChart(id){
    var chartColumnColors = getChartColorsArray(id);
    getChart(chartColumnColors, id);
}
 

function getChart(chartColumnColors, chartId){
    var chartData = document.getElementById(chartId).getAttribute("data-series");
    var xaxisCategories = document.getElementById(chartId).getAttribute("data-xaxis-categories");
    var height = document.getElementById(chartId).getAttribute("data-height"); 

    chartData = chartData ? JSON.parse(chartData) : [];
    xaxisCategories = xaxisCategories ? JSON.parse(xaxisCategories) : [];

    var options = {
        chart: {
            height: height,
            type: "bar",
            toolbar: { show: !1 },
        },
        plotOptions: {
            bar: {
                horizontal: !1,
                columnWidth: "45%",
                endingShape: "rounded",
            },
        },
        dataLabels: { enabled: !1 },
        stroke: { show: !0, width: 2, colors: ["transparent"] },
        series: chartData,
        colors: chartColumnColors,
        xaxis: { categories: xaxisCategories },
        grid: { borderColor: "#f1f1f1" },
        fill: { opacity: 1 },
        tooltip: {
            y: {
                formatter: function (t) {
                    return t;
                },
            },
        },
    };

    var chart = new ApexCharts(document.querySelector("#"+chartId), options);
    chart.render();
}