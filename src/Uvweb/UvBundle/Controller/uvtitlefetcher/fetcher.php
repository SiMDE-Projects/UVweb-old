<?php

// Include the library
include('simple_html_dom.php');
 
// Retrieve the DOM from a given URL
$html = file_get_html('http://cap.utc.fr/portail_UV/detailuv.php?uv=BL01&page=uv&lang=FR');


// Find the DIV tag with an id of "myId"
$e = $html->find('span#titre'));
$arr = split(" - ", $e->innertext);
echo $arr[1];

?>