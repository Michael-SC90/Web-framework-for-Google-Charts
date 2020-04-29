<?php
    echo "\n";
?>
<!-- Prepare line chart for display -->
google.charts.load('current', {'packages':['corechart']});

function drawChart(yearid) {
    // Prepare data for loading.
    var ScatterData = $.ajax({
        type: 'POST',
        url: "scatter_controller.php",
        data: { 'option': yearid },
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

    // Create data table.
    var data = new google.visualization.DataTable(ScatterData);

    data.addColumn('number', 'Student');
    data.addColumn('number', 'ELYears');

    var options = {
          width: 900,
          height: 500
    };
    data.sort([{column: 0}]);
    var chart = new google.visualization.ScatterChart(document.getElementById('open_new'));
    chart.draw(data, options);
}