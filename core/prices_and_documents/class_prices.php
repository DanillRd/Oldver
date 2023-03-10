<?php
include_once ($_SERVER['DOCUMENT_ROOT']."/core/class_config.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/core/class_db.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/core/class_address.php");

class ClassPrices
{
    private $db = NULL;

    function __construct()
    {
        $this->db = new ClassDB();
        if(!$this->db)
        {
            echo $this->db->lastErrorMsg();
        }
    }

    function addPrice($id)
    {
        $sql =<<<EOF
        INSERT 
        INTO Prices_new ('address_id') 
        VALUES($id);
        EOF;
        
        $this->db->voidQuery($sql);
    }

    function delPrice($id)
    {
        $sql =<<<EOF
        DELETE
        FROM Prices_new 
        WHERE address_id = $id;
        EOF;
            
        $this->db->voidQuery($sql);
    }



    function getPricesWithAddressId($id)
    {
        if ($this->db->countRows("Prices_new", "address_id = ".$id) == 0)
        {
            $this->addPrice($id);
        }  
        
        $sql_get =<<<EOF
        SELECT * FROM Prices_new WHERE address_id=$id;
        EOF;

        $ret = $this->db->getArray($sql_get);
        $row = $ret[0];
        return $row;
    }

    function getAllPricesWithAddrsForSetup()
    {
        $sql_get =<<<EOF
        SELECT * FROM Prices_new;
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

    function getAllAddressesWhichMustHavePricesButHavent()
    {
        $addr = new ClassAddress();
        $id2addr = $addr->getAllAddressesWhichMustHaveFilledInDataButHavent("PRICES");
        return $id2addr;
    }

 
    function updatePriceWithAddressId($addr_id, $inside_systems, 
                                    $lifts, $dispatching, 
                                    $ventilation, $antifire,
                                    $repairment_outside, $repairment_inside,
                                    $repairment_antifire, $cleaning_yard,
                                    $cleaning_inside, $cleaning_snow,
                                    $deratization, $disinsection,
                                    $electricity, $other,
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
        other = $other, total_without_taxes = $total_without_taxes,
        total_with_taxes = $total_with_taxes, to_jreu = $to_jreu, total = $total
    WHERE address_id = $addr_id;
    EOF;
    $this->db->voidQuery($sql);    
        
    }

    function getFileLink($type, $address_id)
    {
        $suffix = "";
        $file_extension = array();

        switch ($type)
        {
            case "CONTRACT":
            {
                $suffix = "contract";
                $file_extension[] = ".pdf";
            }break;
            case "REQUIREMENTS":
            {
                $suffix = "requirements";
                $file_extension[] = ".doc";
            }break;
            case "REPORT6":
            {
                $suffix = "report6";
                $file_extension[] = ".xls";
                $file_extension[] = ".xlsx";
            }break;
            case "REPORT12":
            {
                $suffix = "report12";
                $file_extension[] = ".xls";
                $file_extension[] = ".xlsx";
            }break;
        }

        foreach ($file_extension as $ext)
        {
            $filename_without_ext = "/documents/".$GLOBALS['SITE_PREFIX']."документи_за_адресою/".$address_id."-".$suffix;
            foreach ($file_extension as $key => $ext)
            {
                $filename = $filename_without_ext.$ext;
                if (file_exists($_SERVER['DOCUMENT_ROOT'].$filename))
                {
                    $result = "<a href=\"".$filename."\">Завантажити</a>";
                    return $result;
                }
            }
            
            if ($type == "REQUIREMENTS")
            {
                $filename = "/documents/".$GLOBALS['SITE_PREFIX']."документи_за_адресою/requirements_default.doc";
                $result = "<a href=\"".$filename."\">Завантажити</a>";
                return $result;
            }else
            {
                return "";
            }
        }
        
        

    }

    function getAllAddresses()
    {
        $addr = new ClassAddress();
        return $addr->getAddr2IdArray("PRICES");
    }

    function getAddressById($id)
    {
        $addr = new ClassAddress();
        return $addr->getAddrById($id);
    }



}


?>