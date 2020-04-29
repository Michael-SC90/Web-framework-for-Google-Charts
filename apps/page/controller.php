<?php
    ini_set('display_errors', 'On');
    include_once __DIR__."/../../scripts/connect.php";
    include_once __DIR__."/../page/head.php";
    include_once __DIR__."/../page/script.php";
    $google_api = new Script("text/javascript", "https://www.gstatic.com/charts/loader.js");
    $jquery_api = new Script("text/javascript", "//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js");
    $buildChart = new Script("text/javascript", '', "/draw.php");
    $head = new Head();
    $head->add_content($google_api);
    $head->add_content($jquery_api);
    $head->add_content($buildChart);
    $body = new Body("/view.php");
    $page = new Page($head, $body);
    $page->load();
?>