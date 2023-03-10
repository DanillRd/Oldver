<?php
 
//print_r($_POST);
$addr = $_POST["addr"];
$description = $_POST["description"];
$comment = $_POST["comment"];
$date = $_POST["date"];
 
include_once ($_SERVER['DOCUMENT_ROOT']."/core/work/class_work.php");    
$work = new ClassWork();
 
$work->addWork($addr, $description, $comment, $date);
 
// Редирект назад к форме
header("Location: ./form_for_adding_completed_work.php");
die();
 
?>
