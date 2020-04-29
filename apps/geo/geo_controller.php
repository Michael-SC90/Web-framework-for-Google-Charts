<?php
    include_once __DIR__."/../../scripts/connect.php";
    if(!empty($_POST['option'])) {
        $val = $_POST['option'];
        // check for existing dataset stored in database
        $chartType = 'geo';
        $check = "EXEC usp_get_chart_json @Value = ".$val.", @Type='".$chartType."';";
        $stmt = sqlsrv_query($conn, $check);
        if (sqlsrv_fetch($stmt)) {
            echo sqlsrv_get_field($stmt, 0, SQLSRV_PHPTYPE_STRING( SQLSRV_ENC_CHAR ));
        }
        else {
            $query = "EXEC usp_el_pop @SchoolYear=".$val.";";
            $results  = sqlsrv_query($conn, $query);

            $array = array();
            $cols = array();
            $rows = array();
            $cols[] = array("id"=>"", "label"=>"County", "pattern"=>"", "type"=>"string");
            $cols[] = array("id"=>"", "label"=>"EL Population", "pattern"=>"", "type"=>"number");

            while ($row = sqlsrv_fetch_array($results, SQLSRV_FETCH_ASSOC)) {
                array_push(
                    $rows, array(
                        "c"=>array(
                            array("v"=>(string)$row["county"]),
                            array("v"=>(int)$row["population"])
                        )
                    )
                );
            };
            $array = array("cols"=>$cols, "rows"=>$rows);
            $json_data = json_encode($array);
            $ins_json = "EXEC usp_add_chart_json @Id=".$val.", @Type='".$chartType."', @Json='".$json_data."';";
            sqlsrv_query($conn, $ins_json);
            sqlsrv_close($conn);
            echo $json_data;
        }
    }
?>