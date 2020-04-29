<?php
    /*
        Database connection settings.
    */

    $server = '192.168.1.25';
    $connOptions = array(
        "Database" => "Capstone",
        "Uid" => "ws01",
        "PwD" => "p455word!",
    );
    $conn = sqlsrv_connect($server, $connOptions);
?>
