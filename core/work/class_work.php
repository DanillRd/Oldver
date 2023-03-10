<?php
include_once ($_SERVER['DOCUMENT_ROOT']."/core/class_db.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/core/class_address.php");

class ClassWork
{
    private $db = NULL;
    private $addr = NULL;

    function __construct()
    {
        $this->db = new ClassDB();
        if(!$this->db)
        {
            echo $this->db->lastErrorMsg();
        }

        $this->addr = new ClassAddress();
    }

    function printWorkTable($isTemporary, $address_id)
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
            WHERE "address_id" = $address_id 
            ORDER BY "date" DESC;
            EOF;
        }

        $ret = $this->db->getArray($sql);

        foreach ($ret as $key => $row)
        {
                    
            echo "<tr>";
            $id = $row['id'];
            $echo_id = str_pad($id, 5, "0", STR_PAD_LEFT);
            echo "<td>".$echo_id."</td>";
            if ($isTemporary == true)
            {
                echo "<td>".$this->addr->getAddrById($row['address_id'])."</td>";
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

    function addWork($addr, $description, $comment, $date)
    {
        $description = str_replace("\"", "&quot;", $description);
        $description = str_replace("\'", "&apos;", $description);
        $comment = str_replace("\"", "&quot;", $comment);
        $comment = str_replace("\'", "&apos;", $comment);
        
        $sql =<<<EOF
        INSERT INTO CompletedWorkTemp ('address_id', 'description', 'comment', 'date')
        VALUES ($addr, '$description', '$comment', '$date');
        EOF;

        $this->db->voidQuery($sql);
    }

    function removeWork($isTemporary, $id)
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
        $this->db->voidQuery($sql); 
    }

    function moveWorkFromTempToSite()
    {
        $sql =<<<EOF
        INSERT INTO CompletedWork (address_id, "description", "comment", "date")
        SELECT address_id, "description", "comment", "date" FROM CompletedWorkTemp;
        EOF;

        $this->db->voidQuery($sql); 

        $sql =<<<EOF
        DELETE FROM CompletedWorkTemp;
        EOF;

        $this->db->voidQuery($sql); 

    }

    function getAllAdresses()
    {
        return $this->addr->getAddr2IdArray();
    }
}

?>