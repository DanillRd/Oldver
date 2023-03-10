<?php

include_once ($_SERVER['DOCUMENT_ROOT']."/core/schedules_maintenance/class_schedules.php");
$schedules = new ClassSchedules();

$action_type = $_POST["ACTION_TYPE"];
$id = $_POST["address_id"];
switch ($action_type)
{
    case "ADD":
    {
        $schedules->addSchedule("CLEANING", $id);
    }break;
    case "DEL":
    {
        $schedules->delSchedule("CLEANING", $id);
    }break;
    case "EDIT":
    {
        $schedules-> updateCleaningWithAddressId($id, $_POST["cleaning_roads"], 
        $_POST["cleaning_lawns"], $_POST["cleaning_sport"], $_POST["cleaning_leaves"],
        $_POST["wet_swipping_stairs_1"], $_POST["wet_swipping_stairs_2"], 
        $_POST["swipping_walls"], $_POST["wet_cleaning_windows"], 
        $_POST["wet_cleaning_doors"], $_POST["sweeping_basements"], 
        $_POST["sanding"], $_POST["cleaning_snow"], $_POST["cleaning_lids_ice"]); 
    }break;
}

// Редирект назад к форме
header("Location: ./form_for_cleaning_editing.php?addr_id=".$id);
die();
?>

