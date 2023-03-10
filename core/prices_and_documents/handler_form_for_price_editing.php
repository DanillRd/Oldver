<?php
 //print_r($_POST);
 
 include ("function_library.php");
 
 $db = getDB();
 
 updatePriceWithAddressId($db,  $_POST["addr_id"], $_POST["inside_systems"], 
                                $_POST["lifts"], $_POST["dispatching"], 
                                $_POST["ventilation"], $_POST["antifire"],
                                $_POST["repairment_outside"], $_POST["repairment_inside"],
                                $_POST["repairment_antifire"], $_POST["cleaning_yard"],
                                $_POST["cleaning_inside"], $_POST["cleaning_snow"],
                                $_POST["deratization"], $_POST["disinsection"],
                                $_POST["electricity"], $_POST["else"],
                                $_POST["total_without_taxes"], $_POST["total_with_taxes"],
                                $_POST["to_jreu"], $_POST["total"]); 
 $db->close();

 // Редирект назад к форме
 header("Location: ./form_for_price_editing.php?addr_id=".$_POST["addr_id"]);
 die();


?>

