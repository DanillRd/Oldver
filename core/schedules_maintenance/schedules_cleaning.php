<p align="center"><strong> ГРАФІК</strong></p>
<p align="center">Роботи робітників з комплексного прибирання багатоквартирних будинків</p>


<table border="1" cellpadding="5" cellspacing="0" align="center">
    <tr>
        <td>Адреса будинку</td>
        <td>Прибирання закріплених підїздних шляхів до житлових будинків</td>
        <td>Прибирання сміття з газонів</td>
        <td>Прибирання територій спортивних майданчиків, що знаходяться на прибудинковій території</td>
        <td>Прибирання прибудинкової території від опалого листя</td>
        <td>Вологе підмітання сходових площадок і маршів будинку(2 рази на тиждень)</td>
        <td>Миття вестибюлів, сходових площадок і маршів, масляних панелей( 1 раз на місяць)</td>
        <td>Обмітання пилу, павутиння та бруду зі стін, стелі, дверей, підвіконь місць загального користування( 1 раз на місяць)</td>
        <td>Вологе прибирання підвіконь, віконних решіток, поручнів, поштових скриньок, електрощитових, в місцях загального користування, сходів на горище (1 раз на місяць)</td>
        <td>Миття дверей вікон на сходових площадках і у вестибюлях(1 раз на рік)</td>
        <td>Прибирання горищ, підвалів, технічних поверхів від сміття та сторонніх предметів(в міру необхідності, але не рідше 2-х разів на рік)</td>
        <td>Посипання піском тротуарів, дворових перехідних доріжок, зовнішних східців і площадок на них</td>
        <td>Прибирання тротуарів у дворах від снігу, які входять в прибиральну площу, який щойно випав і згрібання у вали</td>
        <td>Очищення від снігу та льоду кришок водопровідних, каналізаційних,пожежних та інших колодязів, а також поверхневих та інших зливово стічних лотків</td>
     </tr>
 

<?php

include_once ($_SERVER['DOCUMENT_ROOT']."/core/schedules_maintenance/class_schedules.php");
$schedules = new ClassSchedules();

function echoLine($address, $cleaning_roads, $cleaning_lawns, $cleaning_sport, $cleaning_leaves, $wet_swipping_stairs_1, $wet_swipping_stairs_2, $swipping_walls, $wet_cleaning_windows, $wet_cleaning_doors, $sweeping_basements, $sanding, $cleaning_snow, $cleaning_lids_ice)
{
    echo "<tr>";
    echo "<td>$address</td>";
    echo "<td>$cleaning_roads</td>";
    echo "<td>$cleaning_lawns</td>";
    echo "<td>$cleaning_sport</td>";
    echo "<td>$cleaning_leaves</td>";
    echo "<td>$wet_swipping_stairs_1</td>";
    echo "<td>$wet_swipping_stairs_2</td>";
    echo "<td>$swipping_walls</td>";
    echo "<td>$wet_cleaning_windows</td>";
    echo "<td>$wet_cleaning_doors</td>";
    echo "<td>$sweeping_basements</td>";
    echo "<td>$sanding</td>";
    echo "<td>$cleaning_snow</td>";
    echo "<td>$cleaning_lids_ice</td>";
    echo "</tr>\n";
}

$res = $schedules->getSchedules("CLEANING");

foreach($res as $key => $row)
{
        echoLine($row['address_id'], $row['cleaning_roads'], $row['cleaning_lawns'], $row['cleaning_sport'], $row['cleaning_leaves'], $row['wet_swipping_stairs_1'],$row['wet_swipping_stairs_2'], $row['swipping_walls'], $row['wet_cleaning_windows'], $row['wet_cleaning_doors'], $row['sweeping_basements'], $row['sanding'], $row['cleaning_snow'], $row['cleaning_lids_ice']);        
}

?>

</table>
