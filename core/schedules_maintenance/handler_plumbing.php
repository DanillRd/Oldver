<?php

include_once ($_SERVER['DOCUMENT_ROOT']."/core/schedules_maintenance/class_schedules.php");
$schedules = new ClassSchedules();

$action_type = $_POST["ACTION_TYPE"];
$id = $_POST["address_id"];
switch ($action_type)
{
    case "ADD":
    {
        $schedules->addSchedule("PLUMBING", $id);
    }break;
    case "DEL":
    {
        $schedules->delSchedule("PLUMBING", $id);
    }break;
    case "EDIT":
    {
        $schedules-> updatePlumbingWithAddressId($id, $_POST["flat_quantity"], 
        $_POST["m1"], $_POST["m2"], $_POST["m3"], $_POST["m4"], $_POST["m5"], 
        $_POST["m6"], $_POST["m7"], $_POST["m8"], $_POST["m9"], $_POST["m10"],
        $_POST["m11"], $_POST["m12"]); 
    }break;
}

// Редирект назад к форме
header("Location: ./form_for_plumbing_editing.php?addr_id=".$id);
die();
?>

