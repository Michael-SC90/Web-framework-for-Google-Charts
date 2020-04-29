<?php
    class Footer {
        var $indent = "\t" * 1;

        public function Footer($new_content) {
            this->open();
            include_once __DIR__."$new_content";
            this->close();
        }

        function open() {
            echo $indent."<Footer>\n";
        }

        function close() {
            echo $indent."</Footer>\n";
        }
    }
?>