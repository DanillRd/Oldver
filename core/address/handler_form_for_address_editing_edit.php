<?php
 
$id = $_POST["id"];
$addr = $_POST["addr"];
$addr_1c = $_POST["addr_1c"];
$prices = false; if (isset($_POST["prices"]))  {$prices = true;}
$chimneys = false; if (isset($_POST["chimneys"]))  {$chimneys = true;}
$cleaning = false; if (isset($_POST["cleaning"]))  {$cleaning = true;}
$plumbing = false; if (isset($_POST["plumbing"]))  {$plumbing = true;}

include_once ($_SERVER['DOCUMENT_ROOT']."/core/class_address.php");
$addresses = new ClassAddress();
 
$addresses->renameAddress($id, $addr, $addr_1c, $prices, $chimneys, $cleaning, $plumbing);

// Редирект назад к форме
header("Location: /core/address/form_for_address_editing.php");
die();
 
?>
