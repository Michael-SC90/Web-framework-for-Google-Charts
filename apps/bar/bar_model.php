<?php
    echo "\n";
?>
<!-- Prepare line chart for display -->
google.charts.load('45.2', {'packages':['corechart']});

function drawChart(county) {
    // Prepare data for loading.
    var BarData = $.ajax({
        type: 'POST',
        url: "bar_controller.php",
        data: { 'option': county },
        dataType: "json",
        global: false,
        async: false,
        success: function(data) {
            document.getElementById('regression-type').value = 'linear';
            return data;
        },
        error: function(xhr, textStatus, error) {
            console.log(xhr.statustext);
            console.log(textStatus);
            console.log(error);
        }
    }).responseText;

    // Create data table.
    var data = new google.visualization.DataTable(BarData);

    var options = {
          title: 'English Learner Population by Years in Program over Time',
          width: 900,
          height: 500,
          backgroundColor: '#F0F0F0',
          trendlines: {
            0: {
                type: 'linear',
                visibleInLegend: false,
                showR2: true,
                pointsVisible: false,
                opacity: 0.4
            },
            1: {
                type: 'linear',
                visibleInLegend: false,
                showR2: true,
                pointsVisible: false,
                opacity: 0.4
            },
            2: {
                type: 'linear',
                visibleInLegend: false,
                showR2: true,
                pointsVisible: false,
                opacity: 0.4
            }
          }
    };

    var chart = new google.visualization.BarChart(document.getElementById('open_new'));

    google.visualization.events.addListener(chart, 'ready', function () {
        console.log(chart.Zl().jp[1].text);
        console.log(chart.Zl().jp[3].text);
        console.log(chart.Zl().jp[5].text);
    });

    chart.draw(data, options);

    document.getElementById('regression-type').onchange = function() {
        options['trendlines'][0]['type'] = this.value;
        options['trendlines'][1]['type'] = this.value;
        options['trendlines'][2]['type'] = this.value;
        chart.draw(data, options);
    };
}