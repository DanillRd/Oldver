<?php
$addr = $_POST["addr"];
$add_1c = $_POST["addr_1c"];

include_once ($_SERVER['DOCUMENT_ROOT']."/core/class_address.php");
$addresses = new ClassAddress();

$addresses->addAddress($addr, $add_1c); 

// Редирект назад к форме
header("Location: /core/address/form_for_address_editing.php");
die();
 
?>
