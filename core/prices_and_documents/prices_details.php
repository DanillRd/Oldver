<?php

$id = $_GET['house_id'];

include_once ($_SERVER['DOCUMENT_ROOT']."/core/prices_and_documents/class_prices.php");
$prices = new ClassPrices();
$row = $prices->getPricesWithAddressId($id);
?>


<table class="contentpaneopen">
<tr><td class="contentheading" width="100%">Кошторис витрат на утримання будинку та прибудинкової території<br><br> Адреса: <?php echo $prices->getAddressById($id);?></td></tr>
</table>

<p><a target="_self" href="/index.php?menu=prices">На попередню</a></p>

<table border="1" cellspacing="0" cellpadding="5">
<tr>
    <td>Порядковий номер</td>
    <td>Складова витрат на утримання будинку та прибудинкової теріторіїї та поточного ремонту спільного майна будинку (далі -витрати)</td>
    <td>Місячна сума витрат у розрахунку на 1 кв. метр загальної площі житлових приміщень у будинку</td>
    <td>Річна сума складової витрат (гривень)</td>
</tr>
<tr>
    <td><b>I</b></td>
    <th colspan="3">Обов'язковий перелік робіт (послуг)</th>  
</tr>

<tr>
    <td>1</td>
    <td>Технічне обслуговування внутрішньобудинкових систем</td>
    <td><?php echo $row["inside_systems"]?></td>
    <td><?php echo $row["inside_systems"] * 12 ?></td> 
</tr>

<tr>
    <td>2</td>
    <td>Технічне обслуговування ліфтів</td>
    <td><?php echo $row["lifts"]?></td>
    <td><?php echo $row["lifts"] * 12 ?></td> 
</tr>

<tr>
    <td>3</td>
    <td>Обслуговування систем диспетчеризації</td>
    <td><?php echo $row["dispatching"]?></td>
    <td><?php echo $row["dispatching"] * 12 ?></td> 
</tr>

<tr>
    <td>4</td>
    <td>Обслуговування димових  та вентеляційних каналів</td>
    <td><?php echo $row["ventilation"]?></td>
    <td><?php echo $row["ventilation"] * 12 ?></td> 
</tr>

<tr>
    <td>5</td>
    <td>Технічне обслуговування систем противопожежної автоматики та димовидалення, а також іншіх внутрішньобудинкових інженерних систем( у разі їх наявності)</td>
    <td><?php echo $row["antifire"]?></td>
    <td><?php echo $row["antifire"] * 12 ?></td> 
</tr>

<tr>
    <td>6</td>
    <td>Поточний ремонт  конструктивних елементів. Технічних пристроїв будинків та елементів зовнішнього упррядження, що розміщені на закріпленій в установленому порядку прибудинковій теріторій ( в тому числі спортивних, дітячих та іншіх майданчиків)</td>
    <td><?php echo $row["repairment_outside"]?></td>
    <td><?php echo $row["repairment_outside"] * 12 ?></td> 
</tr>

<tr>
    <td>7</td>
    <td>Поточний ремонт внутрішньобудинкових систем</td>
    <td><?php echo $row["repairment_inside"]?></td>
    <td><?php echo $row["repairment_inside"] * 12 ?></td> 
</tr>

<tr>
    <td>8</td>
    <td>Поточний ремонт систем  противопожежної автоматики та димовидалення, а також іншіх внутрішньобудинкових інженерних систем( у разі їх наявності)</td>
    <td><?php echo $row["repairment_antifire"]?></td>
    <td><?php echo $row["repairment_antifire"] * 12 ?></td> 
</tr>

<tr>
    <td>9</td>
    <td>Прибирання прибудинкової теріторії</td>
    <td><?php echo $row["cleaning_yard"]?></td>
    <td><?php echo $row["cleaning_yard"] * 12 ?></td> 
</tr>

<tr>
    <td>10</td>
    <td>Прибирання приміщень загального користування (у тому числі допоміжних)</td>
    <td><?php echo $row["cleaning_inside"]?></td>
    <td><?php echo $row["cleaning_inside"] * 12 ?></td> 
</tr>

<tr>
    <td>11</td>
    <td> Механічне прибирання  снігу, посипання частини прибудинкової теріторії, призначеної для проходу  протиожеледними сумішами.</td>
    <td><?php echo $row["cleaning_snow"]?></td>
    <td><?php echo $row["cleaning_snow"] * 12 ?></td> 
</tr>

<tr>
    <td>12</td>
    <td>Дератизація</td>
    <td><?php echo $row["deratization"]?></td>
    <td><?php echo $row["deratization"] * 12 ?></td> 
</tr>

<tr>
    <td>13</td>
    <td>Дезинсекція</td>
    <td><?php echo $row["disinsection"]?></td>
    <td><?php echo $row["disinsection"] * 12 ?></td> 
</tr>

<tr>
    <td>14</td>
    <td>Придбання електриченої енергії для освітлення місць загального користування, живлення ліфтів та забеспечення функціонування іншого спільного майна багатоквартирного будинку</td>
    <td><?php echo $row["electricity"]?></td>
    <td><?php echo $row["electricity"] * 12 ?></td> 
</tr>

<tr>
    <td><b>II</b></td>
    <td><b>Інші роботи (послуги), понад обов’язковий перелік</b></td>
    <td><?php echo $row["other"]?></td>
    <td><?php echo $row["other"] * 12 ?></td> 
</tr>

<tr>
    <td><b>III</b></td>
    <td><b>Загальна сума витрат без ПДВ</b></td>
    <td><?php echo $row["total_without_taxes"]; ?></td>
    <td><?php echo $row["total_without_taxes"] * 12; ?></td> 
</tr>

<tr>
    <td><b>IV</b></td>
    <td><b>Загальна сума витрат з ПДВ</b></td>
    <td><?php echo $row["total_with_taxes"]; ?></td>
    <td><?php echo $row["total_with_taxes"] * 12 ?></td> 
</tr>

<tr>
    <td></td>
    <td><b>Винагорода управителю 10%  на 1 кв. м.</b></td>
    <td><?php echo $row["to_jreu"] ?></td>
    <td><?php echo $row["to_jreu"] * 12 ?></td> 
</tr>

<tr>
    <td></td>
    <td><b>Всього за 1 кв.м.</b></td>
    <td><?php echo $row["total"] ?></td>
    <td><b><?php echo $row["total"] * 12 ?></b></td> 
</tr>


</table>


