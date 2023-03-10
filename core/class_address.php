<?php
include_once ($_SERVER['DOCUMENT_ROOT']."/core/class_db.php");

class ClassAddress
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

    function getAllAdresses()
    {
        $sql =<<<EOF
        SELECT * 
        FROM Address2Id
        ORDER BY "address" ASC;
        EOF;

        $result = array();
        $ret = $this->db->getArray($sql);

        return $ret;
    }

    function getAddr2IdArray($type = "ALL", $flip = false, $universum_minus_data = false)
    {
        // TYPE == ALL, PRICES, CHIMNEYS, PLUMBING, CLEANING
        $sql_where = "";
        $universum_minus_data_str = " = ";
        if ($universum_minus_data)
        {
            $universum_minus_data_str = " != ";
        }

        switch ($type)
        {
            case "PRICES":      $sql_where = "WHERE prices".$universum_minus_data_str."TRUE"; break;
            case "CHIMNEYS":    $sql_where = "WHERE schedule_chimneys".$universum_minus_data_str."TRUE"; break;
            case "PLUMBING":    $sql_where = "WHERE schedule_plumbing".$universum_minus_data_str."TRUE"; break;
            case "CLEANING":    $sql_where = "WHERE schedule_cleaning".$universum_minus_data_str."TRUE"; break;
        }

        
        $sql =<<<EOF
        SELECT "id", "address" 
        FROM Address2Id
        $sql_where
        ORDER BY "address" ASC;
        EOF;
    
        $result = array();
        $ret = $this->db->getArray($sql);

        foreach ($ret as $index => $row)
        {
            if ($flip == false)
            {
                $result[$row['address']] = $row['id'];
            }else
            {
                $result[$row['id']] = $row['address'];
            }
        }
      
        return $result; 
    }

    function getAddrById($id, $if1C = false)
    {
        $addr_col_name = "address";
        if ($if1C == true)
        {
            $addr_col_name = "address_1C";
        }
        
        $sql =<<<EOF
        SELECT $addr_col_name 
        FROM Address2id 
        WHERE "id" = $id;
        EOF;

        $ret = $this->db->getArray($sql);
        $address_text = $ret[0][$addr_col_name];

        return $address_text;
    }

    function getAddrIdByName($name, $if1C = false)
    {
        $addr_col_name = "address";
        if ($if1C == true)
        {
            $addr_col_name = "address_1C";
        }
        
        $sql =<<<EOF
        SELECT id 
        FROM Address2id 
        WHERE $addr_col_name = "$name";
        EOF;

        $ret = $this->db->getArray($sql);
        if (sizeof($ret) > 0)
        {
            return $ret[0]["id"];
        }else
        {
            return false;
        } 
    }
    
    function addAddress($address, $address_1C)
    {
        if ($address_1C == NULL || $address_1C == "")
        {
            $address_1C = $address;
        }
        
        $sql =<<<EOF
        INSERT INTO Address2id ('address', 'address_1C')
        VALUES ("$address", "$address_1C");
        EOF;
   
        $this->db->voidQuery($sql);
    }
    
    function renameAddress($id, $address, $address_1C, $prices, $chimneys, $cleaning, $plumbing)
    {
        $prices_str = "false";      if ($prices){$prices_str = "true";}
        $chimneys_str = "false";    if ($chimneys){$chimneys_str = "true";}
        $cleaning_str = "false";    if ($cleaning){$cleaning_str = "true";}
        $plumbing_str = "false";    if ($plumbing){$plumbing_str = "true";}
        
        $sql =<<<EOF
        UPDATE Address2id
        SET address = "$address", address_1C= "$address_1C", 
            prices = $prices_str, schedule_chimneys = $chimneys_str, 
            schedule_cleaning = $cleaning_str, schedule_plumbing = $plumbing_str
        WHERE id = $id;
        EOF;

        echo $sql;
    
        $this->db->voidQuery($sql);
    }
    
    function removeAddress($id)
    {
        $sql =<<<EOF
        DELETE 
        FROM Address2id 
        WHERE id = $id;
        EOF;
    
        $this->db->voidQuery($sql);
    
    }

    function getAllAddressesWhichMustHaveFilledInDataButHavent($type)
    {
        $db_name = "";
        switch ($type)
        {
            case "PRICES":      $db_name = "Prices_new"; break;
            case "CHIMNEYS":    $db_name = "РасписаниеВентиляция"; break;
            case "PLUMBING":    $db_name = "РасписаниеСантехника"; break;
            case "CLEANING":    $db_name = "РасписаниеУборка"; break;
        }

        $sql_get =<<<EOF
        SELECT * FROM $db_name;
        EOF;
        
        $ret = $this->db->getArray($sql_get);

        $addr = new ClassAddress();
        $id2addr = $addr->getAddr2IdArray($type, true);

        foreach ($ret as $index => $value)
        {
            // Пробегаемся по тем адресам, к которым есть цены и удаляем
            // их номера из списка ВСЕХ адресов у которых ДОЛЖНЫ быть цены.
            $id = $value["address_id"];
            unset($id2addr[$id]);
        }
        return $id2addr;
    }
}
?>