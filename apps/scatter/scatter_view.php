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
    include_once __DIR__."/scatter_model.php";
    $buildChart->close();
    $head->close();
    echo "<body>\n";
?>
        <!-- Populate dropdown menu button with sql query results. -->
        <div class="year">
            <label>Academic Year</label>
            <select id="yearSelect" name="year" onchange="drawChart(this.value)">
                <option value="">Select Year</option>
                <?php
                    $query = "EXEC usp_lst_years;";
                    $results = sqlsrv_query($conn, $query);
                    while ($row = sqlsrv_fetch_array($results, SQLSRV_FETCH_ASSOC)) {
                ?>
                <option value="<?php echo $row["AYID"]; ?>"><?php echo $row["AcademicYear"]; ?></option>
                <?php
                    }
                    sqlsrv_close($conn);
                ?>
            </select>
        </div>
        <div id="open_new" style="width: 800px; height: 500px;"></div>
<?php
    echo "\n</body>\n</html>";
?>