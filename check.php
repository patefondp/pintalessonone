<?php
include_once 'index.php';

function checkVar($a) {
    if(isset($a) AND trim($a) !=''){
    return trim($a);
}
else {
    exit("Problem");
}
}

$n1 = checkVar($_POST['name']);
$n2 = checkVar($_POST['email']);
$n3 = checkVar($_POST['comment']);

?> 