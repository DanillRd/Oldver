<?php

$id = $_POST["id"];
 
include_once ($_SERVER['DOCUMENT_ROOT']."/core/class_address.php");
$addresses = new ClassAddress();
$addresses->removeAddress($id);

// Редирект назад к форме
header("Location: /core/address/form_for_address_editing.php");
die();
 
?>
