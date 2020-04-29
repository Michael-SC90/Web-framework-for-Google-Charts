<?php
    class Script {
        var $type;
        var $source;
        var $content_path;

        public function load() {
            $this->open();
            if ($this->content_path) {
                include_once __DIR__.$this->content_path;
            }
            $this->close();
        }

        function open() {
            if ($this->type) {
                if ($this->source) {
                    if ($this->source != '') {
                        echo '<Script type="'.$this->type.'" src="'.$this->source.'">'."\n";
                    }
                    else {
                        echo '<Script type="'.$this->type.'">'."\n";
                    }
                }
                else {
                    echo '<Script type="'.$this->type.'">'."\n";
                }
            }
            else {
                echo "<Script>"."\n";
            }
        }

        function close() {
            echo "</Script>\n";
        }

        function get_type() {
            return $this->type;
        }

        function set_type($new_type) {
            $this->type = $new_type;
        }

        function get_source() {
            return $this->source;
        }

        function set_source($new_source) {
            $this->source = $new_source;
        }
    }
?>