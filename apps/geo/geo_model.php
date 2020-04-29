<?php
    echo "\n";
?>
<!-- Prepare Geo chart for display -->
google.charts.load('current', {
    'packages':['geochart'],
    'mapsApiKey': 'AIzaSyCucRkAZOkWKLUR6ayZ83dSew4OCsFkLyY'
});

function drawChart(year) {
    // Prepare data for loading.
    var GeoData = $.ajax({
        type: 'POST',
        url: "geo_controller.php",
        data: { 'option': year },
        dataType: "json",
        global: false,
        async: false,
        success: function(data) {
            return data;
        },
        error: function(xhr, textStatus, error) {
            console.log(xhr.statustext);
            console.log(textStatus);
            console.log(error);
        }
    }).responseText;

    var data = new google.visualization.DataTable(GeoData);

    var options = {
        //sizeAxis: { minValue: 0, maxValue: 100 }, // for proportional markers
        region: 'US-CA', // California
        displayMode: 'markers',
        resolution: 'provinces',
        colorAxis: {colors: ['#e7711c', '#4374e0']} // orange to blue
      };

    var chart = new google.visualization.GeoChart(document.getElementById('chart_div'));
    chart.draw(data, options);
};