<?php
$myfile = fopen("profileInfo.txt", "r") or die("Unable to open file!");
echo fread($myfile,filesize("profileInfo.txt"));
fclose($myfile);
?>