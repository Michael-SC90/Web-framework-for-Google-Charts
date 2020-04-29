<?php
    include_once __DIR__."/connect.php";
    $clear_json = "EXEC usp_clear_json_storage;";
    sqlsrv_query($conn, $clear_json);
    sqlsrv_close();
?>
DEBUG: chart cache has been cleared.