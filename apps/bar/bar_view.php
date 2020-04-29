<?php
    ini_set('display_errors', 'On');
    include_once __DIR__."/../../scripts/connect.php";
    include_once __DIR__."/../page/head.php";
    include_once __DIR__."/../page/script.php";
    echo "<!DOCTYPE html>\n";
    echo '<html lang="en-US">'."\n";
    $head = new Head();
    $geocharts = new Script();
    $geocharts->set_type("text/javascript");
    $geocharts->set_source("https://www.gstatic.com/charts/loader.js");
    $jquery = new Script();
    $jquery->set_type("text/javascript");
    $jquery->set_source("//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js");
    $buildChart = new Script();
    $buildChart->set_type("text/javascript");
    $head->open();
    $geocharts->open();
    $geocharts->close();
    $jquery->open();
    $jquery->close();
    $buildChart->open();
    include_once __DIR__."/bar_model.php";
    $buildChart->close();
    $head->close();
    echo "<body>\n";
?>
    <!-- Populate dropdown menu button with sql query results. -->
    <div class="county">
        <label>County</label>
        <select id="countySelect" name="county" onchange="drawChart(this.value);">
            <option value="">Select County</option>
            <?php
                $query = "EXEC usp_lst_counties;";
                $results = sqlsrv_query($conn, $query);
                while ($row = sqlsrv_fetch_array($results, SQLSRV_FETCH_ASSOC)) {
            ?>
            <option value="<?php echo $row["CountyID"]; ?>"><?php echo $row["County"]; ?></option>
            <?php
                }
            ?>
        </select>
    </div>
    <div class="regression">
        <label>Regression Type</label>
        <select id="regression-type">
            <option value="linear">Linear</option>
            <option value="exponential">Exponential</option>
            <option value="polynomial">Polynomial</option>
        </select>
    </div>
    <div id="open_new" style="width: 900px; height: 500px;"></div>
<?php
    echo "\n</body>\n</html>";
?>