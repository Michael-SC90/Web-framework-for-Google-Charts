<?php
    include_once __DIR__."/script.php";

    class Head {
        var $indent = "\t";
        // var $scripts = Array();

        public function add_content($new_content) {
            array_push($this->scripts, $new_content);
        }

        public function load() {
            $this->open();
            foreach($this->scripts as $script) {
                $script.load();
            }
            $this->close();
        }

        function open() {
            echo "$this->indent"."<Head>\n";
        }

        function close() {
            echo "$this->indent"."</Head>\n";
        }
    }
?>