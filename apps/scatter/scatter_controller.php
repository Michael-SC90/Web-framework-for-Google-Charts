<?php
    include_once __DIR__."/../../scripts/connect.php";
    if(!empty($_POST['option'])) {
        $val = $_POST['option'];
        $query = "EXEC usp_el_age @SchoolYear= ".$val.", @County=55;";
        $results  = sqlsrv_query($conn, $query);

        $array = array();
        $cols = array();
        $rows = array();
        $cols[] = array("id"=>"", "label"=>"Student", "pattern"=>"", "type"=>"number");
        $cols[] = array("id"=>"", "label"=>"ELYears", "pattern"=>"", "type"=>"number");

        if ($result === false) {
            die( print_r( sqlsrv_errors(), true) );
        }

        while ($row = sqlsrv_fetch_array($results, SQLSRV_FETCH_ASSOC)) {
            array_push(
                $rows, array(
                    "c"=>array(
                        array("v"=>(int)$row["student"]),
                        array("v"=>(float)$row["elyears"])
                    )
                )
            );
        };
        array_push($array, array("cols"=>$cols, "rows"=>$rows));
        echo json_encode($array, JSON_NUMERIC_CHECK);
    }
?>