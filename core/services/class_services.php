<?php
include($_SERVER['DOCUMENT_ROOT']."/core/class_db.php");

class ClassServices
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

    function getAdminServiceHeaders()
    {
        $sql =<<<EOF
        SELECT "id", "index", "name", "law_basis", "supervisor" 
        FROM AdminServices;
        EOF;

        $ret = $this->db->getArray($sql);

        return $ret;
    }

    function getAdminServiceById($id)
    {
        $sql =<<<EOF
        SELECT * 
        FROM AdminServices 
        WHERE id = $id;
        EOF;

        $ret = $this->db->getArray($sql);
        return $ret[0];
    }

    function getExtraServices()
    {
        $sql =<<<EOF
        SELECT * from ExtraServices;
        EOF;
        
        $ret = $this->db->getArray($sql);
        return $ret;
    }

    function getRepairServices()
    {
        $sql =<<<EOF
        SELECT * from RepairServices;
        EOF;
        
        $ret = $this->db->getArray($sql);
        return $ret;
    }

}