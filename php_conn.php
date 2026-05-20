<?php
$link = mysql_connect('10.247.197.16', 'namdb', 'EnCrPt$1N2@M3');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully';
mysql_close($link);
?>
