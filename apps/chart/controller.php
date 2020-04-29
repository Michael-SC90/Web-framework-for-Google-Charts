<?php
    class ChartController {

    include_once __DIR__."/../../scripts/connect.php";
    if(!empty($_POST['option'])) {
        $val = $_POST['option'];
        $query = "EXEC usp_age_groups @SchoolYear=".$val.";";
        $results  = sqlsrv_query($conn, $query);

        $array = array();
        $cols = array();
        $rows = array();
        $cols[] = array("id"=>"ID", "label"=>"Years EL", "pattern"=>"", "type"=>"string");
        $cols[] = array("id"=>"x coordinate", "label"=>"EL Start Age", "pattern"=>"", "type"=>"number");
        $cols[] = array("id"=>"y coordinate", "label"=>"Current Age", "pattern"=>"", "type"=>"number");
        $cols[] = array("id"=>"seriesID", "label"=>"Grade", "pattern"=>"", "type"=>"number");
        $cols[] = array("id"=>"size", "label"=>"Student Count", "pattern"=>"", "type"=>"number");

        while ($row = sqlsrv_fetch_array($results, SQLSRV_FETCH_ASSOC)) {
            array_push(
                $rows, array(
                    "c"=>array(
                        array("v"=>(string)$row["cur_participation"]),
                        array("v"=>(int)$row["el_start_age"]),
                        array("v"=>(int)$row["cur_age"]),
                        array("v"=>(int)$row["grade"]),
                        array("v"=>(int)$row["population"])
                    )
                )
            );
        };
        sqlsrv_close($conn);
        $array = array("cols"=>$cols, "rows"=>$rows);
        echo json_encode($array);
    }

    }
?>