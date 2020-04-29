<?php
/*
    Constructs site using components from segments/main.
*/
if (!isset($_SERVER['PATH_INFO']))  // Ensure PATH_INFO is declared and not null.
{
    include 'segments/main/head.php';
    echo "\n";
    include 'segments/main/header.php';
    echo "\n";
    include 'segments/main/menu.php';
    echo '<div id="content_frame" style="height:600">';
    echo "\t".'<iframe src="pages/paper.pdf" name="content_frame" id="site_content" scrolling="no" onload="resizeIframe(this)" style="height:1000;width:1200;"></iframe>';
    echo "</div>";
    include 'segments/main/footer.php';
}
?>