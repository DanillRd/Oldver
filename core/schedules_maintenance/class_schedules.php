<?php
include_once ($_SERVER['DOCUMENT_ROOT']."/core/class_config.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/core/class_db.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/core/class_address.php");

class ClassSchedules
{
    private $db = NULL;
    private $classAddr = NULL;

    function __construct()
    {
        $this->db = new ClassDB();
        if(!$this->db)
        {
            echo $this->db->lastErrorMsg();
        }

        $this->classAddr = new classAddress();
    }

    function getSchedules($type)
    {
        $db_name = "";
        switch ($type)
        {
            case "CHIMNEYS":    $db_name = "РасписаниеВентиляция"; break;
            case "PLUMBING":    $db_name = "РасписаниеСантехника"; break;
            case "CLEANING":    $db_name = "РасписаниеУборка"; break;
        }

        $addresses = $this->classAddr->getAddr2IdArray($type, true);
        
        $sql =<<<EOF
        SELECT * 
        FROM $db_name 
        EOF;

        $ret = $this->db->getArray($sql);

        foreach ($ret as $key => $row)
        {
            $addr_id = $row["address_id"];
            if (!isset($addresses[$addr_id]))
            {
                unset($ret[$key]);
            }else
            {
                $ret[$key]["address_id"] = $addresses[$addr_id];
            }
        }

        return $ret;
    }

    function getAllAddressesWhichMustHaveScheduleButHavent($type)
    {
        $addr = new ClassAddress();
        $id2addr = $addr->getAllAddressesWhichMustHaveFilledInDataButHavent($type);
        return $id2addr;
    }

    function getScheduleDataForSetup($type)
    {
        $db_name = "";
        switch ($type)
        {
            case "CHIMNEYS":    $db_name = "РасписаниеВентиляция"; break;
            case "PLUMBING":    $db_name = "РасписаниеСантехника"; break;
            case "CLEANING":    $db_name = "РасписаниеУборка"; break;
        }
        
        $sql_get =<<<EOF
        SELECT * FROM $db_name;
        EOF;
        
        $ret = $this->db->getArray($sql_get);

        $addr = new ClassAddress();
        $id2addr = $addr->getAddr2IdArray("ALL", true);

        foreach ($ret as $key => $row)
        {
            $addr_str = "<font color='red'>NA</font>";
            if (isset($id2addr[$row["address_id"]]))
            {
                $addr_str = $id2addr[$row["address_id"]];
            }
            $ret[$key]["address_str"] = $addr_str;
        }

        include_once ($_SERVER['DOCUMENT_ROOT']."/core/function_sort.php");
        $ret = array_sort($ret, "address_str", $order=SORT_ASC);
        return $ret;
    }

    function addSchedule($type, $id)
    {
        $db_name = "";
        switch ($type)
        {
            case "CHIMNEYS":    $db_name = "РасписаниеВентиляция"; break;
            case "PLUMBING":    $db_name = "РасписаниеСантехника"; break;
            case "CLEANING":    $db_name = "РасписаниеУборка"; break;
        }

        $sql =<<<EOF
        INSERT 
        INTO $db_name ('address_id') 
        VALUES($id);
        EOF;
        
        $this->db->voidQuery($sql);
    }

    function delSchedule($type, $id)
    {
        $db_name = "";
        switch ($type)
        {
            case "CHIMNEYS":    $db_name = "РасписаниеВентиляция"; break;
            case "PLUMBING":    $db_name = "РасписаниеСантехника"; break;
            case "CLEANING":    $db_name = "РасписаниеУборка"; break;
        }

        $sql =<<<EOF
        DELETE
        FROM $db_name 
        WHERE address_id = $id;
        EOF;
            
        $this->db->voidQuery($sql);
    }

    function updateChimneysWithAddressId($id, $flat_quantity, 
                                    $PG, $GK, $boiler, $material,
                                    $m1, $m2, $m3, $m4, $m5, $m6,
                                    $m7, $m8, $m9, $m10, $m11, $m12)
    {
        $sql =<<<EOF
        UPDATE РасписаниеВентиляция
        SET 
            flat_quantity = $flat_quantity,
            PG = "$PG",
            GK = "$GK", 
            boiler = "$boiler", material = "$material",
            m1 = "$m1", m2 = "$m2", m3 = "$m3", m4 = "$m4", m5 = "$m5", 
            m6 = "$m6", m7 = "$m7", m8 = "$m8", m9 = "$m9", m10 = "$m10", 
            m11 = "$m11", m12 = "$m12" 
        WHERE address_id = $id;
        EOF;

        //echo $sql;

        $this->db->voidQuery($sql);    
        
    }

    function updatePlumbingWithAddressId($id, $flat_quantity, 
                                    $m1, $m2, $m3, $m4, $m5, $m6,
                                    $m7, $m8, $m9, $m10, $m11, $m12)
    {
        $sql =<<<EOF
        UPDATE РасписаниеСантехника
        SET 
            flat_quantity = $flat_quantity,
            m1 = "$m1", m2 = "$m2", m3 = "$m3", m4 = "$m4", m5 = "$m5", 
            m6 = "$m6", m7 = "$m7", m8 = "$m8", m9 = "$m9", m10 = "$m10", 
            m11 = "$m11", m12 = "$m12" 
        WHERE address_id = $id;
        EOF;

        //echo $sql;

        $this->db->voidQuery($sql);    
        
    }

    function updateCleaningWithAddressId($id, $cleaning_roads, 
                $cleaning_lawns, $cleaning_sport, $cleaning_leaves,
                $wet_swipping_stairs_1, $wet_swipping_stairs_2, 
                $swipping_walls, $wet_cleaning_windows, 
                $wet_cleaning_doors, $sweeping_basements, 
                $sanding, $cleaning_snow, $cleaning_lids_ice)
    {
        $sql =<<<EOF
        UPDATE РасписаниеУборка
        SET 
        cleaning_roads = "$cleaning_roads",
        cleaning_lawns = "$cleaning_lawns",
        cleaning_sport = "$cleaning_sport",
        cleaning_leaves = "$cleaning_leaves",
        wet_swipping_stairs_1 = "$wet_swipping_stairs_1",
        wet_swipping_stairs_2 = "$wet_swipping_stairs_2", 
        swipping_walls = "$swipping_walls",
        wet_cleaning_windows = "$wet_cleaning_windows",
        wet_cleaning_doors = "$wet_cleaning_doors",
        sweeping_basements = "$sweeping_basements",
        sanding = "$sanding",
        cleaning_snow = "$cleaning_snow",
        cleaning_lids_ice = "$cleaning_lids_ice"


        WHERE address_id = $id;
        EOF;

        //echo $sql;

        $this->db->voidQuery($sql);    
        
    }
}

