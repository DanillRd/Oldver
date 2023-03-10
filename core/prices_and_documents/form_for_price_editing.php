<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>

<form action="/setup.php" method="POST">
<p align="center"><input type="submit" value="Вернуться в админку" name="submit"></p>
</form>

<p align="center"><strong>Форма для редактирования цен</strong></p>

<?php

include_once ($_SERVER['DOCUMENT_ROOT']."/core/prices_and_documents/class_prices.php");
$prices = new ClassPrices();

//$all_data = $prices->getAllPricesWithAddrsForSetup();
$addible_addresses = $prices->getAllAddressesWhichMustHavePricesButHavent();
//print_r($all_data);

// Добавление нового кошториса
echo "<form action=\"/core/prices_and_documents/handler_prices.php\" method=\"POST\">";
echo "<input type=\"hidden\" name=\"ACTION_TYPE\" value=\"ADD\">";
echo "<select required name=\"address_id\" size=\"1\">";
foreach ($addible_addresses as $key => $value)
{
    echo "<option value=\"$key\">$value</option>";
}
echo "</select>";
echo "<input type=\"submit\" value=\"Добавить адрес\" name=\"submit\">";
echo "</form>";

$all_data = $prices->getAllPricesWithAddrsForSetup();

echo "<table border='1' cellspacing='0' cellpadding='5'>";
echo "<tr>";
echo "<th>ID</th>";
echo "<th>Адрес</th>";
echo "<th>Внутр.сис</th>";
echo "<th>Лифты</th>";
echo "<th>Диспетч.</th>";
echo "<th>Вент.</th>";
echo "<th>Пожар</th>";
echo "<th>Рем.внешн</th>";
echo "<th>Рем.внутр</th>";
echo "<th>Рем.пожар</th>";
echo "<th>Уборка двор</th>";
echo "<th>Уборка внутр</th>";
echo "<th>Уборка снег</th>";
echo "<th>Дератизация</th>";
echo "<th>Дезинсекция</th>";
echo "<th>Электр.</th>";
echo "<th>Другое</th>";
echo "<th>Без налогов</th>";
echo "<th>С налогами</th>";
echo "<th>ЖРЕУ</th>";
echo "<th>Всего</th>";
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
    echo "<tr $row_colour_str><form action=\"/core/prices_and_documents/handler_prices.php\" method=\"POST\">";
    echo "<input type=\"hidden\" name=\"ACTION_TYPE\" value=\"EDIT\">";
    echo "<input type='hidden' name='address_id' value='".$row["address_id"]."'>";
    echo "<td>".$row["address_id"]."</td>&nbsp;\n";
    echo "<td>".$row["address_str"]."</td>&nbsp;\n";
    echo "<td>"."<input size=\"4\" type=\"number\" step=\"0.01\" name=\"inside_systems\" value=".$row["inside_systems"]."></td>";
    echo "<td>"."<input size=\"4\" type=\"number\" step=\"0.01\" name=\"lifts\" value=".$row["lifts"]."></td>";
    echo "<td>"."<input size=\"4\" type=\"number\" step=\"0.01\" name=\"dispatching\" value=".$row["dispatching"]."></td>";
    echo "<td>"."<input size=\"4\" type=\"number\" step=\"0.01\" name=\"ventilation\" value=".$row["ventilation"]."></td>";
    echo "<td>"."<input size=\"4\" type=\"number\" step=\"0.01\" name=\"antifire\" value=".$row["antifire"]."></td>";
    echo "<td>"."<input size=\"4\" type=\"number\" step=\"0.01\" name=\"repairment_outside\" value=".$row["repairment_outside"]."></td>";
    echo "<td>"."<input size=\"4\" type=\"number\" step=\"0.01\" name=\"repairment_inside\" value=".$row["repairment_inside"]."></td>";
    echo "<td>"."<input size=\"4\" type=\"number\" step=\"0.01\" name=\"repairment_antifire\" value=".$row["repairment_antifire"]."></td>";
    echo "<td>"."<input size=\"4\" type=\"number\" step=\"0.01\" name=\"cleaning_yard\" value=".$row["cleaning_yard"]."></td>";
    echo "<td>"."<input size=\"4\" type=\"number\" step=\"0.01\" name=\"cleaning_inside\" value=".$row["cleaning_inside"]."></td>";
    echo "<td>"."<input size=\"4\" type=\"number\" step=\"0.01\" name=\"cleaning_snow\" value=".$row["cleaning_snow"]."></td>";
    echo "<td>"."<input size=\"4\" type=\"number\" step=\"0.01\" name=\"deratization\" value=".$row["deratization"]."></td>";
    echo "<td>"."<input size=\"4\" type=\"number\" step=\"0.01\" name=\"disinsection\" value=".$row["disinsection"]."></td>";
    echo "<td>"."<input size=\"4\" type=\"number\" step=\"0.01\" name=\"electricity\" value=".$row["electricity"]."></td>";
    echo "<td>"."<input size=\"4\" type=\"number\" step=\"0.01\" name=\"other\" value=".$row["other"]."></td>";
    echo "<td>"."<input size=\"4\" type=\"number\" step=\"0.01\" name=\"total_without_taxes\" value=".$row["total_without_taxes"]."></td>";
    echo "<td>"."<input size=\"4\" type=\"number\" step=\"0.01\" name=\"total_with_taxes\" value=".$row["total_with_taxes"]."></td>";
    echo "<td>"."<input size=\"4\" type=\"number\" step=\"0.01\" name=\"to_jreu\" value=".$row["to_jreu"]."></td>";
    echo "<td>"."<input size=\"4\" type=\"number\" step=\"0.01\" name=\"total\" value=".$row["total"]."></td>";
    echo "<td>"."<input type=\"submit\" value=\"Редактировать\" name=\"submit\"></td>";
    echo "</form>";

    // Удаление кошториса
    echo "<form action='/core/prices_and_documents/handler_prices.php' method='POST'>";
    echo "<input type='hidden' name='ACTION_TYPE' value='DEL'>";
    echo "<input type='hidden' name='address_id' value='".$row["address_id"]."'>";
    echo "<td><input type='submit' value='Удалить адрес' name='submit'></td>";
    echo "</form></tr>";
}
echo "</table>";
?>
