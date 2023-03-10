<?php

include_once ($_SERVER['DOCUMENT_ROOT']."/core/class_config.php");

class ClassDB extends SQLite3
{
    function __construct()
    {
        $db_name = $_SERVER['DOCUMENT_ROOT']."/".$GLOBALS['SITE_PREFIX']."db.db";
        $this->open($db_name);
    }

    function __destruct()
    {
        $this->close();
    }

    function getArray($query)
    {
        $ret = $this->query($query);
        if ($ret == false)
        {
            echo $this->lastErrorMsg();
            return false;
        }else
        {
            $result_array = array();
            while($row = $ret->fetchArray(SQLITE3_ASSOC) )
            {
                $result_array[] = $row;
            }
            return $result_array;
        }
    }

    function voidQuery($query)
    {
        $ret = $this->query($query);
        if ($ret == false)
        {
            echo $this->lastErrorMsg();
        }  
    }

    function countRows($table, $condition)
    {
        $sql_query =<<<EOF
        SELECT count(*) 
        AS countRows 
        FROM $table 
        WHERE $condition;
        EOF;

        $res_array = $this->getArray($sql_query);
        if (count($res_array) == 1)
        {
            return $res_array[0]["countRows"];
        }else
        {
            return 0;
        }
    }
}

?>