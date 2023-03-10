<p align="center"><strong> ГРАФІК</strong></p>
<p align="center">Технічного обслуговування внутрішньобудинкової системи водопостачання, водовідведення, центрального опалення та електропостачання(крім квартирних мереж)</p>


<table border="1" cellpadding="10" cellspacing="5" align="center">
    <tr>
        <td rowspan="2">Адреса будинку</td>
        <td rowspan="2">К-ть квартир</td>
        <th colspan="12">Місяць перевірки</th>
    </tr>
    <tr>
        <th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th><th>10</th><th>11</th><th>12</th>
    </tr>


<?php


include_once ($_SERVER['DOCUMENT_ROOT']."/core/schedules_maintenance/class_schedules.php");
$schedules = new ClassSchedules();

function echoLine($address, $flats, $m1, $m2, $m3, $m4, $m5, $m6, $m7, $m8, $m9, $m10, $m11, $m12)
{
    echo "<tr>";
    echo "<td>$address</td>";
    echo "<td>$flats</td>";
    echo "<td>$m1</td>";
    echo "<td>$m2</td>";
    echo "<td>$m3</td>";
    echo "<td>$m4</td>";
    echo "<td>$m5</td>";
    echo "<td>$m6</td>";
    echo "<td>$m7</td>";
    echo "<td>$m8</td>";
    echo "<td>$m9</td>";
    echo "<td>$m10</td>";
    echo "<td>$m11</td>";
    echo "<td>$m12</td>";
    echo "</tr>\n";
}

$res = $schedules->getSchedules("PLUMBING");

foreach($res as $key => $row)
{
    echoLine($row['address_id'], $row['flat_quantity'], $row['m1'], $row['m2'], $row['m3'], $row['m4'], $row['m5'], $row['m6'], $row['m7'], $row['m8'], $row['m9'], $row['m10'], $row['m11'], $row['m12']);        
}
?>

</table>

<ul>
 <li>Огляд обладнання системи холодного водопостачання місць загального користування до вхідного крану в квартиру -- <strong>a</strong></li>
 <li>Огляд системи водовідведення до відвідного колодязя -- <strong>b</strong></li>
 <li>Огляд обладнання системи централізованого опалення в місцях загального користування -- <strong>c</strong></li>
 <li>Перевірка  ізоляції трубопроводів в місцях загального користування -- <strong>d</strong></li>
 <li>Обхід, огляд, перевірка роботи та технічного стану електромереж, силових установок тощо( до точки розподілу на квартири) -- <strong>1 раз на тиждень</strong> </li>
</ul>

