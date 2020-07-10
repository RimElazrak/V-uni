<?php
$now = DateTime::createFromFormat('U.u', microtime(true));
$current= $now->format("Y-m-d H:i:s");
echo $current;
?>