<?php
    echo "\n";
?>
<!-- Prepare line chart for display -->
google.charts.load('45.2', {'packages':['corechart']});

function drawChart(county) {
    // Prepare data for loading.
    var LineData = $.ajax({
        type: 'POST',
        url: "line_controller.php",
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
    var data = new google.visualization.DataTable(LineData);

    var options = {
          title: 'English Learner Population by Years in Program over Time',
          curveType: 'function',
          legend: { position: 'right' },
          backgroundColor: '#F0F0F0',
          fontSize: '16',
          hAxis: {
            maxValue : <?php echo date("Y"); ?>
          },
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
            },
            3: {
                type: 'linear',
                visibleInLegend: false,
                showR2: true,
                pointsVisible: false,
                opacity: 0.4
            }
          }
    };

    var container = document.getElementById('open_new');
    var chart = new google.visualization.LineChart(container);

    google.visualization.events.addListener(chart, 'ready', function () {
        console.log(chart.Zl().jp[1].text);
        console.log(chart.Zl().jp[3].text);
        console.log(chart.Zl().jp[5].text);
        console.log(chart.Zl().jp[7].text);
    });

    data.sort([{column: 0}]);
    chart.draw(data, options);

    document.getElementById('regression-type').onchange = function() {
        options['trendlines'][0]['type'] = this.value;
        options['trendlines'][1]['type'] = this.value;
        options['trendlines'][2]['type'] = this.value;
        options['trendlines'][3]['type'] = this.value;
        chart.draw(data, options);
    };
}