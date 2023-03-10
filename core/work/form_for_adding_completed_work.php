<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>

<form action="/setup.php" method="POST">
<p align="center"><input type="submit" value="Вернуться в админку" name="submit"></p>
</form>

<form action="/index.php" method="POST">
<p align="center"><input type="submit" value="Вернуться на сайт" name="submit"></p>
</form>

<p align="center"><strong> Форма добавления информации о плановых и ремонтных роботах</strong></p>

<form action="./handler_form_for_adding_completed_work.php" method="POST">



<?php

include_once ($_SERVER['DOCUMENT_ROOT']."/core/work/class_work.php");    
$work = new ClassWork();

    // Получаем список адресов и формируем выпадающее меню
    
    echo "<br>Адрес: ";
    
    $addrArray = $work->getAllAdresses();
    
    //print_r($addrArray);
    
    echo "<select required name=\"addr\" size=\"1\">";
    foreach ($addrArray as $key => $value)
    {
        echo "<option value=\"$value\">$key</option>";
    }
    echo "</select>";
    
    echo "<br>";
    
    echo "Вид работы: <input required size=\"100\" type=\"text\" name=\"description\"></input><br/>";
    echo "Комментарий: <input size=\"100\" type=\"text\" name=\"comment\"></input><br/>";
    
    echo "<br>";
    echo "<br>";
    echo "<br>Дата выполнения работ: ";
    echo "<input required type=\"date\" name=\"date\">";
    
    echo "<p align=\"center\"><input type=\"submit\" value=\"Сохранить\" name=\"submit\"></p>";
    
    echo "<br>";
    echo "<br>";
    echo "</form>";
?>
<hr>
<br>
<p align="center">
    <strong>Форма добавления работ из базы 1С</strong><br>
    Формат CSV, разделитель ";", 4 колонки: дата, адрес, описание, комментарий
</p>

<form action="./handler_form_for_adding_completed_work_1c.php" method="POST">
    <p align="center"><textarea id="text" name="work_raw" rows="2" cols="150"></textarea></p>
    <p align="center"><input type="submit" value="Сохранить" name="submit"></p>
</form> 
<hr>
<br>  
<p align="center"><strong>Список работ во временной БД</strong></p>   



    <p align="center">    
    
    Сортировка &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; по №:&nbsp;
    <input type="button" value="↥" onclick="sort(0, true);" />
    <input type="button" value="↧" onclick="sort(0, false);"/>
    
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;по адресу:&nbsp;
    <input type="button" value="↥" onclick="sort(1, true);" />
    <input type="button" value="↧" onclick="sort(1, false);"/>
    
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;по дате:&nbsp;
    <input type="button" value="↥" onclick="sort(5, true);" />
    <input type="button" value="↧" onclick="sort(5, false);"/>
    
    </p>
    <br>
    
<?php    $work->printWorkTable(true, NULL); ?>
    
    <form action="./handler_form_for_adding_completed_work_moving_from_temp.php" method="POST">
    <p align="center"><input type="submit" value="Перенести на сайт" name="submit"></p>
    </form>


<script>
    function sort (column, up)
    {
        let plus = 1;
        let minus=-1;
        
        if (up == false)
        {
            plus =-1;
            minus= 1;
        }
        
        let sortedRows = Array.from(table_work_is_done.rows)
        .slice(1)
        .sort((rowA, rowB) => rowA.cells[column].innerHTML > rowB.cells[column].innerHTML ? plus : minus);

       table_work_is_done.tBodies[0].append(...sortedRows);
    }
</script>

</html>
