<p align="center"><strong> Реєстр адміністративних послуг</strong></p>
<table border="1" cellspacing="0" cellpadding="5">
<tr>
<td width="47"> <p align="center"><b>№ з/п</b></p></td>
<td width="57"> <p align="center"><b>Шифр</b></p></td>
<td width="227"><p align="center"><b>Назва послуги</b></p></td>
<td width="217"><p align="center"><b>Нормативно-правова база</b></p></td>
<td width="170"><p align="center"><b>Керівник процесу</b></p></td>
</tr>


<?php

function echoLine($id, $index, $name, $law_basis, $supervisor)
{
    echo "<tr>";
    echo "<td>$id</td>";
    echo "<td>$index</td>";
    echo "<td><a href=\"./index.php?menu=adminservices_details&id=$id\">$name</a></td>";
    echo "<td>$law_basis</td>";
    echo "<td>$supervisor</td>";
    echo "</tr>\n";
}

include ($_SERVER['DOCUMENT_ROOT']."/core/services/class_services.php");
$services = new ClassServices();

$array_srv = $services->getAdminServiceHeaders();

foreach ($array_srv as $key => $row)
{
    echoLine($row['id'], $row['index'], $row['name'], $row['law_basis'], $row['supervisor']);        
}

?>

</table>
