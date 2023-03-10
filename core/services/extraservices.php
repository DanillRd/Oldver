<table class="contentpaneopen">
<tr style="font-family: arial,helvetica,sans-serif;">
    <td valign="top" align="center">
        <p><b>РЕЄСТР</b></p>
        <p><b>послуг по ремонту та внутрішніх санітарно-технічних роботах, що виконуються за рахунок коштів наймачів, орендарів, власників квартир в будинках державної і комунальної власності.</b></p>

<table style="width: 644px; height: 1469px;" align="center" border="1" cellpadding="2" cellspacing="0">
<colgroup><col width="80" /> <col width="315" /></colgroup>
<tbody>
<tr valign="TOP" align="CENTER">
    <td width="80">
        <p>№</p><p>калькуляції</p>
    </td>
    <td width="315">
        <p>Найменування послуги</p>
    </td>
</tr>

<?php

function echoLine($number, $name)
{
    print("<tr valign=\"TOP\">");
    print("<td><p align=\"CENTER\">№$number</p></td>");
    print("<td><p>$name</p></td>");
    print("</tr>\n");
}

include ($_SERVER['DOCUMENT_ROOT']."/core/services/class_services.php");
$services = new ClassServices();

$array_srv = $services->getExtraServices();

foreach($array_srv as $key => $row)
{
    echoLine($row['id'], $row['name']);
}

?>

</tbody>
</table>

</p>
</ol><strong><span style="font-family: arial,helvetica,sans-serif;">КП «ЖРЕУ» виконує роботи по ремонту квартир, офісів, дахів, покрівель ремонт та будівництво доріг, будівництво дач та котеджів згідно окремих договорів.</span></strong>

</td>
</tr>

</table>
