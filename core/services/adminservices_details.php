<?php

$id = $_GET['id'];

include ($_SERVER['DOCUMENT_ROOT']."/core/services/class_services.php");
$services = new ClassServices();

$row = $services->getAdminServiceById($id);

?>


<table class="contentpaneopen">
<tr><td class="contentheading" width="100%"><?php echo $row["name"] ?></td></tr>
</table>

<p><a target="_self" href="/index.php?menu=adminservices">На попередню</a></p>

<table border="1" cellspacing="0" cellpadding="5">
<tr><td width="36">1</td><td width="168">Перелік необхідних документів для отримання послуги</td><td width="468"><?php echo $row["document_list"]?></td></tr>
<tr><td>2</td><td>Місце отримання послуги</td><td><?php echo $row["address_of_service"]?></td></tr>
<tr><td>3</td><td>Оплата за послуги</td><td><?php echo $row["price"]?></td></tr>
<tr><td>4</td><td>Термін виконання</td><td><?php echo $row["time"]?></td></tr>
<tr><td>5</td><td>Відповідальний за виконання</td><td><?php echo $row["execution_officer"]?></td></tr>
<tr><td>6</td><td>Опис дій</td><td><?php echo $row["to_do_list"]?></td></tr>
<tr><td>7</td><td>Місце реєстрації письмового звернення</td><td><?php echo $row["address_of_inquire"]?></td></tr>
<tr><td>8</td><td>Результат послуги</td><td><?php echo $row["result"]?></td></tr>
<tr><td>9</td><td>Причини відмови</td><td><?php echo $row["reasons_for_refusal"]?></td></tr>
<tr><td>10</td><td>Порядок оскарження</td><td><?php echo $row["appeal_procedure"]?></td></tr>
<tr><td>11</td><td>Відповідальність</td><td><?php echo $row["responsibility"]?></td></tr>
<tr><td>12</td><td>Законодавча основа</td><td><?php echo $row["law_basis"]?></td></tr>
</table>


