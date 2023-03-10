<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>

<form action="/setup.php" method="POST">
<p align="center"><input type="submit" value="Вернуться в админку" name="submit"></p>
</form>

<p align="center"><strong>Форма для редактирования расписания сантехнического обслуживания</strong></p>

<?php

include_once ($_SERVER['DOCUMENT_ROOT']."/core/schedules_maintenance/class_schedules.php");
$schedules = new ClassSchedules();
$addible_addresses = $schedules->getAllAddressesWhichMustHaveScheduleButHavent("PLUMBING");

// Добавление нового адреса
echo "<form action=\"/core/schedules_maintenance/handler_plumbing.php\" method=\"POST\">";
echo "<input type=\"hidden\" name=\"ACTION_TYPE\" value=\"ADD\">";
echo "<select required name=\"address_id\" size=\"1\">";
foreach ($addible_addresses as $key => $value)
{
    echo "<option value=\"$key\">$value</option>";
}
echo "</select>";
echo "<input type=\"submit\" value=\"Добавить адрес\" name=\"submit\">";
echo "</form>";

$all_data = $schedules->getScheduleDataForSetup("PLUMBING");

echo "<table border='1' cellspacing='0' cellpadding='5'>";
echo "<tr>";
echo "<th>ID</th>";
echo "<th>Адрес</th>";
echo "<th>Квартиры</th>";
echo "<th>m1</th>";
echo "<th>m2</th>";
echo "<th>m3</th>";
echo "<th>m4</th>";
echo "<th>m5</th>";
echo "<th>m6</th>";
echo "<th>m7</th>";
echo "<th>m8</th>";
echo "<th>m9</th>";
echo "<th>m10</th>";
echo "<th>m11</th>";
echo "<th>m12</th>";
echo "<th></th>";
echo "<th></th>";
echo "</tr>";

$row_colour = true;
$row_colour_str = "";

foreach ($all_data as $key => $row)
{
    $row_colour = !$row_colour;
    if ($row_colour)
    {
        $row_colour_str = "bgcolor='#D3D3D3'";
    }else
    {
        $row_colour_str = "";
    }
    echo "<tr $row_colour_str><form action=\"/core/schedules_maintenance/handler_plumbing.php\" method=\"POST\">";
    echo "<input type=\"hidden\" name=\"ACTION_TYPE\" value=\"EDIT\">";
    echo "<input type='hidden' name='address_id' value='".$row["address_id"]."'>";
    echo "<td>".$row["address_id"]."</td>&nbsp;\n";
    echo "<td>".$row["address_str"]."</td>&nbsp;\n";
    echo "<td><input size='4' type='number' step='1' name='flat_quantity' value=".$row["flat_quantity"]."></td>";
    echo "<td><input size='1' name='m1' value='".$row["m1"]."'></td>";
    echo "<td><input size='1' name='m2' value='".$row["m2"]."'></td>";
    echo "<td><input size='1' name='m3' value='".$row["m3"]."'></td>";
    echo "<td><input size='1' name='m4' value='".$row["m4"]."'></td>";
    echo "<td><input size='1' name='m5' value='".$row["m5"]."'></td>";
    echo "<td><input size='1' name='m6' value='".$row["m6"]."'></td>";
    echo "<td><input size='1' name='m7' value='".$row["m7"]."'></td>";
    echo "<td><input size='1' name='m8' value='".$row["m8"]."'></td>";
    echo "<td><input size='1' name='m9' value='".$row["m9"]."'></td>";
    echo "<td><input size='1' name='m10' value='".$row["m10"]."'></td>";
    echo "<td><input size='1' name='m11' value='".$row["m11"]."'></td>";
    echo "<td><input size='1' name='m12' value='".$row["m12"]."'></td>";
    
    echo "<td>"."<input type=\"submit\" value=\"Редактировать\" name=\"submit\"></td>";
    echo "</form>";

    // Удаление кошториса
    echo "<form action='/core/schedules_maintenance/handler_plumbing.php' method='POST'>";
    echo "<input type='hidden' name='ACTION_TYPE' value='DEL'>";
    echo "<input type='hidden' name='address_id' value='".$row["address_id"]."'>";
    echo "<td><input type='submit' value='Удалить адрес' name='submit'></td>";
    echo "</form></tr>";
}
echo "</table>";
?>
