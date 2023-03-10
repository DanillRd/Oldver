<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>

<form action="/setup.php" method="POST">
<p align="center"><input type="submit" value="Вернуться в админку" name="submit"></p>
</form>

<p align="center"><strong>Форма для манипуляций с адресами</strong></p>

<br>

<p align="center"><strong>Добавление нового адреса</strong></p>
<form action="./handler_form_for_address_editing_add.php" method="POST">
<p align="center">Адрес:    <input size="30" type="text" name="addr"></input>&nbsp;&nbsp;&nbsp;
Адрес_1C: <input size="30" type="text" name="addr_1c"></input><br><br>
<input type="submit" value="Добавить" name="submit"></p>
</form>
<br><br>

<p align="center"><strong>Редактирование существующих адресов</strong></p>

<?php
include_once ($_SERVER['DOCUMENT_ROOT']."/core/class_address.php");

$addresses = new ClassAddress();
$result = $addresses->getAllAdresses();

foreach ($result as $key => $row)
{
  echo "<form action=\"./handler_form_for_address_editing_edit.php\" method=\"POST\">\n";
  echo "№=".$row['id']."&nbsp;&nbsp;&nbsp;\n";
  echo "<input type=\"hidden\" name=\"id\" value=".$row['id'].">\n";
  echo "Адрес: <input size=\"30\" type=\"text\" name=\"addr\" value=\"".$row['address']."\">&nbsp;&nbsp;&nbsp;\n";
  echo "Адрес_1C: <input size=\"30\" type=\"text\" name=\"addr_1c\" value=\"".$row['address_1C']."\">&nbsp;&nbsp;&nbsp;\n";
  
  $prices_checked = "";
  if ($row['prices'] == true) $prices_checked = " checked ";
  echo "<input type=\"checkbox\" name=\"prices\" ".$prices_checked.">\n";
  echo "<label for=\"prices\">Кошториси</label>\n";

  $chimneys_checked = "";
  if ($row['schedule_chimneys'] == true) $chimneys_checked = " checked ";
  echo "<input type=\"checkbox\" name=\"chimneys\" ".$chimneys_checked.">\n";
  echo "<label for=\"chimneys\">Вентиляция</label>\n";

  $cleaning_checked = "";
  if ($row['schedule_cleaning'] == true) $cleaning_checked = " checked ";
  echo "<input type=\"checkbox\" name=\"cleaning\" ".$cleaning_checked.">\n";
  echo "<label for=\"cleaning\">Уборка</label>\n";

  $plumbing_checked = "";
  if ($row['schedule_plumbing'] == true) $plumbing_checked = " checked ";
  echo "<input type=\"checkbox\" name=\"plumbing\" ".$plumbing_checked.">\n";
  echo "<label for=\"plumbing\">Сантехника</label>\n";
  
  
  echo "<input type=\"submit\" value=\"Сохранить\" name=\"submit\">\n";
  echo "</form>\n";

  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n";
  echo "<form action=\"./handler_form_for_address_editing_remove.php\" method=\"POST\">\n";
  echo "<input type=\"hidden\" name=\"id\" value=".$row['id'].">\n";
  echo "<input type=\"submit\" value=\"Удалить\" name=\"submit\">\n";
  echo "</form><hr>\n";
}
   
?>

