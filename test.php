<?php

$comment = $_GET['comment'];
$product_id = $_GET['id'];

$command = escapeshellcmd("python3 textblob/python.py $comment $product_id");
$ratings = shell_exec($command);

echo $ratings;

?>
