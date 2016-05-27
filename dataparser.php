<?php

include 'simple_html_dom.php';
$html = str_get_html($string);
$row = $html->find('tr');
foreach ($rows as $row) {
 foreach ($row->children() as $cell) {
   echo $cell->plaintext;

  }
}
 ?>
