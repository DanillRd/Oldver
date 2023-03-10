<?php

include_once ($_SERVER['DOCUMENT_ROOT']."/core/work/class_work.php");
$work = new ClassWork();
include_once ($_SERVER['DOCUMENT_ROOT']."/core/class_address.php");
$addr = new ClassAddress();

$id = $_GET['address_id'];

$address = $addr->getAddrById($id);


echo "<p align=\"center\"><strong> Виконання планових та ремонтних робiт за адресою ".$address."</strong></p>";


$work->printWorkTable(false, $id);


