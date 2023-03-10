<?php

include_once ($_SERVER['DOCUMENT_ROOT']."/core/work/class_work.php");    
$work = new ClassWork();
 
$work->moveWorkFromTempToSite();
 
// Редирект назад к форме
header("Location: ./form_for_adding_completed_work.php");
die();
?>
