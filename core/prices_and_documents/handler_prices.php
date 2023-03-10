<?php

include_once ($_SERVER['DOCUMENT_ROOT']."/core/prices_and_documents/class_prices.php");
$prices = new ClassPrices();

$action_type = $_POST["ACTION_TYPE"];
$id = $_POST["address_id"];
switch ($action_type)
{
    case "ADD":
    {
        $prices->addPrice($id);
    }break;
    case "DEL":
    {
        $prices->delPrice($id);
    }break;
    case "EDIT":
    {
        $prices-> updatePriceWithAddressId($id, $_POST["inside_systems"], 
        $_POST["lifts"], $_POST["dispatching"], 
        $_POST["ventilation"], $_POST["antifire"],
        $_POST["repairment_outside"], $_POST["repairment_inside"],
        $_POST["repairment_antifire"], $_POST["cleaning_yard"],
        $_POST["cleaning_inside"], $_POST["cleaning_snow"],
        $_POST["deratization"], $_POST["disinsection"],
        $_POST["electricity"], $_POST["other"],
        $_POST["total_without_taxes"], $_POST["total_with_taxes"],
        $_POST["to_jreu"], $_POST["total"]); 
    }break;
}

// Редирект назад к форме
header("Location: ./form_for_price_editing.php?addr_id=".$id);
die();
?>

