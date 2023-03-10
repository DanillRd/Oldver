<p align="center"><strong> Виконання планових та ремонтних робiт</strong></p>

<table border="1" cellpadding="20" cellspacing="11" align="center">
    <tr>
        <td>Адреса будинку</td>
        <td>Роботи за адресою</td>
    </tr>


<?php  

include_once ($_SERVER['DOCUMENT_ROOT']."/core/work/class_work.php");
$work = new ClassWork();

function echoLine($address, $address_id)
{
    echo "<tr>";
    echo "<td>$address</td>";
    echo "<td><a href=\"./index.php?menu=works_at_address&address_id=".$address_id."\">Проглянути</a></td>";
    echo "</tr>\n";
}

$addrs = $work->getAllAdresses();
        
foreach ($addrs as $key => $value)
{
   echoLine($key, $value);
}

?>

</table>
