<?php
    class Body {
        var $indent = "\t" * 1;
        var $content_path;

        function load($content_path) {
            $this->open();
            include_once __DIR__.$content_path;
            $this->close();
        }

        function open() {
            echo $indent."<Body>\n";
        }

        function close() {
            echo $indent."</Body>\n";
        }
    }
?>