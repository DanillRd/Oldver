<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<?php
 
include_once ($_SERVER['DOCUMENT_ROOT']."/core/work/class_work.php");    
$work = new ClassWork();
include_once ($_SERVER['DOCUMENT_ROOT']."/core/class_address.php");    
$addr = new ClassAddress();
 
//print_r($_POST);
$work_raw = $_POST["work_raw"];
$lines_array = explode("\n", $work_raw);
 
$total_result = array();
 
foreach ($lines_array as $line) 
{
    $parsed_line_array = str_getcsv ($line, $delimiter=';', $enclosure='"', $escape = '\\');
    $myDateTime = DateTime::createFromFormat('d.m.Y H:i:s', $parsed_line_array[0]);
 
    $newDateString = $myDateTime->format('Y-m-d');
    $line_result["date"] = $newDateString;
    
    $line_result["address"] = $parsed_line_array[1];
    $line_result["msg"] = $parsed_line_array[2];
    $line_result["comment"] = $parsed_line_array[2];
    
    $total_result[] = $line_result;
}
 
 // проверяем наличие и корректность адресов
 $usable_result = array();
 $wrong_addr_array = array();
 foreach ($total_result as $line)
 {
     $check_addr = $line["address"];
     $test = $addr->getAddrIdByName($check_addr, true);
     if ($test == false)
     {
         // такого имени нет
         $wrong_addr_array[$check_addr] = false;
     }else
     {
        $line["address"] = $test;
        $usable_result[] = $line;
     }
 }
     
if (count($wrong_addr_array) > 0)
{
    // У нас есть непонятные адреса. Выводим их и завершаем работу.
    echo "<p align=\"center\"><strong>Ошибка<br> следующие адреса 1С не найдены в БД:<br></strong></p>";
    
    foreach ($wrong_addr_array as $key => $res)
    {
        echo "<p align=\"center\">|".$key."|</p>";
    }
    
    echo "<form action=\"./setup.php\" method=\"POST\">";
    echo "<p align=\"center\"><input type=\"submit\" value=\"Вернуться в админку\" name=\"submit\"></p>";
    echo "</form>";
}else
{
    // В кои-то веки всё нормально. Заносим в БД
    foreach ($usable_result as $line)
    {
        $work->addWork($line["address"], $line["msg"], $line["comment"], $line["date"]);
    }
    
    header("Location: ./form_for_adding_completed_work.php");
    die();
}

?>
