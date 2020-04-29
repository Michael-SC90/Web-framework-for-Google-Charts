<?php
    include_once __DIR__."/../../scripts/connect.php";
    if(!empty($_POST['option'])) {
        $val = $_POST['option'];
        // check for existing dataset stored in database
        $chartType = 'line';
        $check = "EXEC usp_get_chart_json @Value = ".$val.", @Type='".$chartType."';";
        $stmt = sqlsrv_query($conn, $check);
        if (sqlsrv_fetch($stmt)) {
            echo sqlsrv_get_field($stmt, 0, SQLSRV_PHPTYPE_STRING( SQLSRV_ENC_CHAR ));
        }
        else {
            $query = "EXEC usp_county_pop_ary @CountyID=".$val.";";
            $results  = sqlsrv_query($conn, $query);

            $array = array();
            $cols = array();
            $rows = array();
            $cols[] = array("id"=>"", "label"=>"Year", "pattern"=>"", "type"=>"number");
            $cols[] = array("id"=>"", "label"=>"< 4 Years", "pattern"=>"", "type"=>"number");
            $cols[] = array("id"=>"", "label"=>"4-5 Years", "pattern"=>"", "type"=>"number");
            $cols[] = array("id"=>"", "label"=>"> 5 Years", "pattern"=>"", "type"=>"number");
            $cols[] = array("id"=>"", "label"=>"Total", "pattern"=>"", "type"=>"number");

            while ($row = sqlsrv_fetch_array($results, SQLSRV_FETCH_ASSOC)) {
                array_push(
                    $rows, array(
                        "c"=>array(
                            array("v"=>(int)$row["school_year"]),
                            array("v"=>(int)$row["learner"]),
                            array("v"=>(int)$row["atrisk"]),
                            array("v"=>(int)$row["longterm"]),
                            array("v"=>((int)$row["learner"] + (int)$row["atrisk"] + (int)$row["longterm"]))
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