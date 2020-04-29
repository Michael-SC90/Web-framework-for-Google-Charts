<?php
    echo "\n";
    $label
    $query

?>
<!-- Populate dropdown menu button with sql query results. -->
<div class="chart_filter">
    <label>Academic Year</label>
    <select id="chartSelect" onchange="drawChart(this.value)">
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
<div id="dashboard_div" style ="width: 800px; height: 550px;">
  <div id="filter_div"></div>
  <div id="chart_div"></div>
</div>