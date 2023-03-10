<p align="center"><strong>КП «ЖРЕУ» надає такі послуги з будівництва та ремонту для організацій та населення:</strong></p>
<table border="1" cellspacing="0" cellpadding="5">

<?php

function echoLine($index, $name)
{
    echo "<tr><td width=\"110\">$index</td><td style=\"text-align: left;\" width=\"535\">$name</td></tr>\n";
}

include ($_SERVER['DOCUMENT_ROOT']."/core/services/class_services.php");
$services = new ClassServices();

$array_srv = $services->getRepairServices();

foreach($array_srv as $key => $row)
{
    echoLine($row['index'], $row['name']);
}

?>
</table>
