<?php
    echo "\n";
?>
<!-- Prepare Bubble chart for display -->
google.charts.load('current', {'packages':['corechart', 'controls']});

function drawChart(year) {
    // Create dashboard for filter controls.
    var dash = new google.visualization.Dashboard(
        document.getElementById('dashboard_div'));

    // Create range slider for chart.
    var rangeSlider = new google.visualization.ControlWrapper({
        'controlType': 'NumberRangeFilter',
        'containerId': 'filter_div',
        'options': {
            'filterColumnLabel': 'Grade'
        }
    });

    // Prepare data for loading.
    var BubbleData = $.ajax({
        type: 'POST',
        url: "bubble_controller.php",
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

    var data = new google.visualization.DataTable(BubbleData);

    var chart = new google.visualization.ChartWrapper({
       'chartType': 'BubbleChart',
       'containerId': 'chart_div',
       'options': {
          'title': 'Correlation between time since entering US K-12 System and ' +
                    'time spent in English Learner program.',
          'tooltip': {'trigger': 'auto'},
          'hAxis': {'title': 'Student Age at time of EL Program Enrollment'},
          'vAxis': {'title': 'Current Age'},
          'bubble': {
            'textStyle': {
                'fontName': 'Times-Roman'
            }
          },
          'backgroundColor': '#F0F0F0',
          'height': '600',
          'width': '1000',
          'fontSize': '16'
        }
    });

    dash.bind(rangeSlider, chart);
    dash.draw(data);
}