<?php
echo $_GET['name'];
header('Content-disposition: attachment; filename = '.$_GET['name'].'');
header('Content-type: application/pdf');
header('Content-Type: application/octet-stream');
readfile('upload/'.$_GET['name'].'');