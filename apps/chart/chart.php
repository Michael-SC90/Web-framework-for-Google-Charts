<?php
    include_once __DIR__."/../page/page.php";

    class Chart {
        var $package;
        var $mapsApiKey;
        var $type;
        var $options;


        function Chart($new_type) {
            $this->type = $new_type;
            if ($new_type == 'GeoChart') {
                $this->package = 'geochart';
                $this->mapsApiKey = 'AIzaSyCucRkAZOkWKLUR6ayZ83dSew4OCsFkLyY';
            }
            $this->set_options($new_type);
        }

        function load() {
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
        }

        function set_options($type) {
            switch ($type) {
                case 'line':
                    $this->options = "{"+
                          "title: 'English Learner Population over Time',"+
                          "curveType: 'function',"+
                          "legend: { position: 'bottom' },"+
                          "backgroundColor: '#F0F0F0',"+
                          "fontSize: '16',"+
                    "}";
                     break;
                case 'bubble':
                    $this->options = '{'+
                        "'title': 'EL Start Age Proportion to Grade Population',"+
                        "'tooltip': {'trigger': 'auto'},"+
                        "'hAxis': {'title': 'Student Age at time of EL Program Enrollment'},"+
                        "'vAxis': {'title': 'Current Age'},"+
                        "'bubble': {"+
                           "'textStyle': {"+
                               "'fontName': 'Times-Roman'"+
                           "}"+
                        "},"+
                        "'backgroundColor': '#F0F0F0',"+
                        "'height': '600',"+
                        "'width': '1000',"+
                        "'fontSize': '16'"+
                    "}";
                    break;
                case 'geo':
                    $this->options = "{"+
                        //sizeAxis: { minValue: 0, maxValue: 100 }, // for proportional markers
                        "region: 'US-CA',"+ // California
                        "displayMode: 'markers',"+
                        "resolution: 'provinces',"+
                        "colorAxis: {colors: ['#e7711c', '#4374e0']}"+ // orange to blue
                    "}";
                    break;
            }
        }
    }
?>