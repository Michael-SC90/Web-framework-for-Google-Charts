<?php
    class Html_header {
        var $indent = "\t" * 1;
        var $content = Array();

        public function Html_header() {
            $this->open();
            $this->close();
        }

        public function Html_header($new_content) {
            $this->open();
            include_once __DIR__."$new_content";
            $this->close();
        }

        function open() {
            echo $indent."<Header>\n";
        }

        function close() {
            echo $indent."</Header>\n";
        }

        function get_content() {
            return $this->content;
        }

        function set_content($new_content) {
            array_push($this->content, $new_content);
        }
    }
?>