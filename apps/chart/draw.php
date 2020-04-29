<!-- Prepare line chart for display -->
google.charts.load('current', {'packages':['corechart']});

function drawChart(choice) {
    // Prepare data for loading.
    var ChartData = $.ajax({
        type: 'POST',
        url: "controller.php",
        data: { 'option': choice },
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
    var data = new google.visualization.DataTable(ChartData);
    var options = {
          title: 'English Learner Population over Time',
          curveType: 'function',
          legend: { position: 'bottom' },
          backgroundColor: '#F0F0F0',
          fontSize: '16',
    };

    var chart = new google.visualization.LineChart(document.getElementById('open_new'));
    chart.draw(data, options);
}