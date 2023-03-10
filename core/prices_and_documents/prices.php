<p align="center"><strong> Кошториси, договори та вимоги</strong></p>
<table border="1" cellspacing="0" cellpadding="5">
<tr>
<td  width="170"><p align="center"><b>Адреса</b></p></td>
<td><p align="center"><b>Договiр на надання послуги з управлiння багатоквартирним будинком</b></p></td>
<td><p align="center"><b>Вимоги до якості послуги з управління будинком</b></p></td>
<td><p align="center"><b>Кошторис витрат на утримання будинку та прибудинкової території</b></p></td>
<td><p align="center"><b>Звiт про використання коштів за квартал </b></p></td>
<td><p align="center"><b>Звiт про використання коштів за рiк</b></p></td>
</tr>

<?php

include_once ($_SERVER['DOCUMENT_ROOT']."/core/prices_and_documents/class_prices.php");
$prices = new ClassPrices();

function echoLine($prices_class, $address, $address_id)
{
    echo "<tr>";
    echo "<td>$address</td>";
    echo "<td>".$prices_class->getFileLink("CONTRACT", $address_id)."</td>";
    echo "<td>".$prices_class->getFileLink("REQUIREMENTS", $address_id)."</td>";
    echo "<td><a href=\"./index.php?menu=prices_details&house_id=$address_id\">Проглянути</a></td>";
    echo "<td>".$prices_class->getFileLink("REPORT6", $address_id)."</td>";
    echo "<td>".$prices_class->getFileLink("REPORT12", $address_id)."</td>";
    echo "</tr>\n";
}


$addr_array = $prices->getAllAddresses();

foreach($addr_array as $addr => $id)
{
    echoLine($prices, $addr, $id);
}


?>

</table>
