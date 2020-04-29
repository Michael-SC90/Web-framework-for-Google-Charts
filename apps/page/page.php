<?php
    include_once __DIR__."/../page/head.php";
    include_once __DIR__."/../page/header.php";
    include_once __DIR__."/../page/body.php";
    include_once __DIR__."/../page/footer.php";


    class Page {
        private html_head = new Head();
        private html_header = new Html_header();
        private html_body = new Body();
        private html_footer = new Footer();

        public function load() {
            $this->open();
            $this->html_head->load();
            if ($this->html_header) {
                $this->html_header->load();
            }
            $this->html_body->load();
            if ($this->html_footer) {
                $this->html_footer->load();
            }
            $this->close();
        }

        function open() {
            echo "<!DOCTYPE html>\n";
            echo '<html lang="en-US">'."\n";
        }

        function close() {
            echo "</html>";
        }
    }
?>