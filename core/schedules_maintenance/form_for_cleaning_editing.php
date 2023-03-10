<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>

<form action="/setup.php" method="POST">
<p align="center"><input type="submit" value="Вернуться в админку" name="submit"></p>
</form>

<p align="center"><strong>Форма для редактирования расписания уборки</strong></p>

<?php

include_once ($_SERVER['DOCUMENT_ROOT']."/core/schedules_maintenance/class_schedules.php");
$schedules = new ClassSchedules();
$addible_addresses = $schedules->getAllAddressesWhichMustHaveScheduleButHavent("CLEANING");

// Добавление нового адреса
echo "<form action=\"/core/schedules_maintenance/handler_chimneys.php\" method=\"POST\">";
echo "<input type=\"hidden\" name=\"ACTION_TYPE\" value=\"ADD\">";
echo "<select required name=\"address_id\" size=\"1\">";
foreach ($addible_addresses as $key => $value)
{
    echo "<option value=\"$key\">$value</option>";
}
echo "</select>";
echo "<input type=\"submit\" value=\"Добавить адрес\" name=\"submit\">";
echo "</form>";

$all_data = $schedules->getScheduleDataForSetup("CLEANING");

echo "<table border='1' cellspacing='0' cellpadding='5'>";
echo "<tr>";
echo "<th>ID</th>";
echo "<th>Адрес</th>";
echo "<th>Дороги</th>";
echo "<th>Газоны</th>";
echo "<th>Спорт. площадки</th>";
echo "<th>Листья</th>";
echo "<th>Подметание маршей</th>";
echo "<th>Мытьё маршей</th>";
echo "<th>Подметание потолка</th>";
echo "<th>Окна</th>";
echo "<th>Двери</th>";
echo "<th>Подвал</th>";
echo "<th>Песок</th>";
echo "<th>Снег</th>";
echo "<th>Лёд</th>";
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
    echo "<tr $row_colour_str><form action=\"/core/schedules_maintenance/handler_cleaning.php\" method=\"POST\">";
    echo "<input type=\"hidden\" name=\"ACTION_TYPE\" value=\"EDIT\">";
    echo "<input type='hidden' name='address_id' value='".$row["address_id"]."'>";
    echo "<td>".$row["address_id"]."</td>&nbsp;\n";
    echo "<td>".$row["address_str"]."</td>&nbsp;\n";
    echo "<td><input size='25' name='cleaning_roads' value='".$row["cleaning_roads"]."'></td>";
    echo "<td><input size='25' name='cleaning_lawns' value='".$row["cleaning_lawns"]."'></td>";
    echo "<td><input size='25' name='cleaning_sport' value='".$row["cleaning_sport"]."'></td>";
    echo "<td><input size='25' name='cleaning_leaves' value='".$row["cleaning_leaves"]."'></td>";
    echo "<td><input size='15' name='wet_swipping_stairs_1' value='".$row["wet_swipping_stairs_1"]."'></td>";
    echo "<td><input size='15' name='wet_swipping_stairs_2' value='".$row["wet_swipping_stairs_2"]."'></td>";
    echo "<td><input size='5' name='swipping_walls' value='".$row["swipping_walls"]."'></td>";
    echo "<td><input size='5' name='wet_cleaning_windows' value='".$row["wet_cleaning_windows"]."'></td>";
    echo "<td><input size='25' name='wet_cleaning_doors' value='".$row["wet_cleaning_doors"]."'></td>";
    echo "<td><input size='25' name='sweeping_basements' value='".$row["sweeping_basements"]."'></td>";
    echo "<td><input size='25' name='sanding' value='".$row["sanding"]."'></td>";
    echo "<td><input size='25' name='cleaning_snow' value='".$row["cleaning_snow"]."'></td>";
    echo "<td><input size='25' name='cleaning_lids_ice' value='".$row["cleaning_lids_ice"]."'></td>";
    
    echo "<td>"."<input type=\"submit\" value=\"Редактировать\" name=\"submit\"></td>";
    echo "</form>";

    // Удаление кошториса
    echo "<form action='/core/schedules_maintenance/handler_cleaning.php' method='POST'>";
    echo "<input type='hidden' name='ACTION_TYPE' value='DEL'>";
    echo "<input type='hidden' name='address_id' value='".$row["address_id"]."'>";
    echo "<td><input type='submit' value='Удалить адрес' name='submit'></td>";
    echo "</form></tr>";
}
echo "</table>";
?>
