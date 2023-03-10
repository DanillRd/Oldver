<?php

function can_admin()
{
    $can = true;
    
    if ($can == false)
    {
        header("Location: ./setup_unavailable.php");
        die();
    }

}


class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('./jreu.db');
    }
}

function getDB()
{
    $db = new MyDB();
    if(!$db)
    {
        echo $db->lastErrorMsg();
    }else
    {
        return $db;
    }
}

function getAddr2IdArray($db)
{
$sql =<<<EOF
SELECT "id", "address" FROM Address2Id
ORDER BY "address" ASC;
EOF;

   $result;
   $ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) )
   {
        $result[$row['address']] = $row['id'];
   }
   
   return $result; 
}

function getWorkClass2IdArray($db)
{
$sql =<<<EOF
SELECT "id", "class_of_work" FROM ClassesOfWork;
EOF;

   $result;
   $ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) )
   {
        $result[$row['class_of_work']] = $row['id'];
   }
   
   return $result; 
}

function getWorkSubclass2IdArray($db)
{
$sql =<<<EOF
SELECT "id", "subclass_of_work" FROM SubclassesOfWork;
EOF;

   $result;
   $ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) )
   {
        $result[$row['subclass_of_work']] = $row['id'];
   }
   
   return $result; 
}

function getAddrById($db, $id)
{
$sql =<<<EOF
SELECT "address" FROM Address2id WHERE "id"=$id;
EOF;

   $ret = $db->query($sql);
   $row = $ret->fetchArray(SQLITE3_ASSOC);
   
   $address_text = $row['address'];

   return $address_text;
}

function getAddrIdByName($db, $name, $if1C = false)
{
    $addr_col_name = "address";
    if ($if1C == true)
    {
        $addr_col_name = "address_1C";
    }
    
$sql =<<<EOF
SELECT id FROM Address2id WHERE $addr_col_name = "$name";
EOF;

   $ret = $db->query($sql);
   if ($ret->numColumns() > 0)
   {
      // have rows
      $row = $ret->fetchArray(SQLITE3_ASSOC);
      $address_id = $row["id"];
      return $address_id;
   }else
   {
       return false;
   } 
}

function getClassOfWorkById($db, $id)
{
$sql =<<<EOF
SELECT "class_of_work" FROM ClassesOfWork WHERE "id"=$id;
EOF;

   $ret = $db->query($sql);
   $row = $ret->fetchArray(SQLITE3_ASSOC);
   
   $class_text = $row['class_of_work'];

   return $class_text;
}

function getSubclassOfWorkById($db, $id)
{
$sql =<<<EOF
SELECT "subclass_of_work" FROM SubclassesOfWork WHERE "id"=$id;
EOF;

   $ret = $db->query($sql);
   $row = $ret->fetchArray(SQLITE3_ASSOC);
   
   $subclass_text = $row['subclass_of_work'];

   return $subclass_text;
}

function printTableWithWorkWhichIsDone($db, $isTemporary, $address_id)
{
    // if $isTemporary == true, тогда выгребаем временную БД 
    // иначе работаем с основной базой и ограничиваем по адресу.
     
    
    
    echo "<table id=\"table_work_is_done\" border=\"1\" cellpadding=\"5\" cellspacing=\"0\" align=\"center\">";
    echo "<tr>";
    
        echo "<td>№</td>";
        if ($isTemporary == true)
        {
           echo "<td>Адреса</td>"; 
        }
        echo "<td>Вид робiт</td>";
        echo "<td>Додатковий опис</td>";
        echo "<td>Дата</td>";
        if ($isTemporary == true)
        {
            echo "<td>Настройки</td>";
        }
    echo "</tr>";

if ($isTemporary == true)
{
$sql =<<<EOF
SELECT "id", "address_id", "description", "comment", "date" 
FROM CompletedWorkTemp 
ORDER BY "date" DESC;
EOF;
}else
{
$sql =<<<EOF
SELECT "id", "address_id", "description", "comment", "date" 
FROM CompletedWork 
WHERE "address_id"=$address_id 
ORDER BY "date" DESC;
EOF;
}

   $ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) )
   {
        
        echo "<tr>";
        $id = $row['id'];
        $echo_id = str_pad($id, 5, "0", STR_PAD_LEFT);
        echo "<td>".$echo_id."</td>";
        if ($isTemporary == true)
        {
            echo "<td>".getAddrById($db, $row['address_id'])."</td>";
        }
        echo "<td>".$row['description']."</td>";
        echo "<td>".$row['comment']."</td>";
        echo "<td>".$row['date']."</td>";
        if ($isTemporary == true)
        {
            
            echo "<td>";
            echo "<a href=\"./handler_form_for_adding_completed_work_removing_from_temp.php?id=$id\">Удалить</a>";
            echo "</td>";
        }
        echo "</tr>\n";
   }    
   
   echo "</table>";

}

function addWorkIsDone($db, $addr, $description, $comment, $date)
{
    $description = str_replace("\"", "&quot;", $description);
    $description = str_replace("\'", "&apos;", $description);
    $comment = str_replace("\"", "&quot;", $comment);
    $comment = str_replace("\'", "&apos;", $comment);
    $sql =<<<EOF
INSERT INTO CompletedWorkTemp ('address_id', 'description', 'comment', 'date')
VALUES ($addr, '$description', '$comment', '$date');
EOF;

   $ret = $db->query($sql);
}

function removeWorkById($db, $isTemporary, $id)
{

if ($isTemporary == false)
{
$sql =<<<EOF
DELETE FROM CompletedWork WHERE id=$id;
EOF;
}else
{
$sql =<<<EOF
DELETE FROM CompletedWorkTemp WHERE id=$id;
EOF;

}
   $ret = $db->query($sql); 
}

function moveWorkFromTempToSite($db)
{
$sql =<<<EOF
INSERT INTO CompletedWork (address_id, "description", "comment", "date")
SELECT address_id, "description", "comment", "date" FROM CompletedWorkTemp;
EOF;

$ret = $db->query($sql); 

$sql =<<<EOF
DELETE FROM CompletedWorkTemp;
EOF;

$ret = $db->query($sql); 

}

function addAddress($db, $address, $address_1C)
{
$sql =<<<EOF
INSERT INTO Address2id ('address', 'address_1C')
VALUES ("$address", "$address_1C");
EOF;

$ret = $db->query($sql);

}

function renameAddress($db, $id, $address, $address_1C)
{
$sql =<<<EOF
UPDATE Address2id
SET address = "$address", address_1C= "$address_1C"
WHERE id = $id;
EOF;

$ret = $db->query($sql);

}

function removeAddress($db, $id)
{
$sql =<<<EOF
DELETE FROM Address2id WHERE id = $id;
EOF;

$ret = $db->query($sql);

}

function getPricesWithAddressId($db, $id)
{
    
    
    $is_addr= $db->query("select count(*) as numRows FROM Prices_new WHERE address_id=$id;"); 
    $rows = $is_addr->fetchArray(SQLITE3_ASSOC);
    
    if ($rows["numRows"] == 0)
    {
        $sql_new =<<<EOF
        INSERT INTO Prices_new ('address_id') VALUES($id);
        EOF;
        
        $ret = $db->query($sql_new);
    }  
     
    $sql_get =<<<EOF
    SELECT * FROM Prices_new WHERE address_id=$id;
    EOF;
    
    $ret = $db->query($sql_get);
    $row = $ret->fetchArray(SQLITE3_ASSOC);
    return $row;
}

 
function updatePriceWithAddressId($db, $addr_id, $inside_systems, 
                                $lifts, $dispatching, 
                                $ventilation, $antifire,
                                $repairment_outside, $repairment_inside,
                                $repairment_antifire, $cleaning_yard,
                                $cleaning_inside, $cleaning_snow,
                                $deratization, $disinsection,
                                $electricity, $else,
                                $total_without_taxes, $total_with_taxes,
                                $to_jreu, $total)
{
$sql =<<<EOF
UPDATE Prices_new
SET 
    inside_systems = $inside_systems,
    lifts = $lifts,
    dispatching = $dispatching, 
    ventilation = $ventilation, antifire = $antifire,
    repairment_outside = $repairment_outside,
    repairment_inside = $repairment_inside,
    repairment_antifire = $repairment_antifire,
    cleaning_yard = $cleaning_yard,
    cleaning_inside = $cleaning_inside,
    cleaning_snow = $cleaning_snow, deratization = $deratization,
    disinsection = $disinsection, electricity = $electricity,
    'else' = $else, total_without_taxes = $total_without_taxes,
    total_with_taxes = $total_with_taxes, to_jreu = $to_jreu, total = $total
WHERE address_id = $addr_id;
EOF;

$ret = $db->query($sql);    
    
}

function addNews($db, $title, $text)
{
    $sql =<<<EOF
    INSERT INTO News ('name', 'text')
    VALUES ("$title", "$text");
    EOF;
    
    $ret = $db->query($sql);
}

function getNews($db, $id)
{
    $sql =<<<EOF
    SELECT * FROM News WHERE "id"=$id;
    EOF;
    
    $ret = $db->query($sql);
    $row = $ret->fetchArray(SQLITE3_ASSOC);
       
    return $row;
}

function deleteNews($db, $id)
{
    $sql =<<<EOF
    DELETE FROM News WHERE id=$id;
    EOF;
    
    $db->query($sql); 
}

function editNews($db, $id, $title, $text)
{
    $sql =<<<EOF
    UPDATE News
    SET name = "$title", text= "$text"
    WHERE id = $id;
    EOF;

    $db->query($sql);
}




?>
