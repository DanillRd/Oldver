<?php
include($_SERVER['DOCUMENT_ROOT']."/core/class_db.php");

class ClassNews
{
    private $db = NULL;
    private $newsPerPage = 5;

    function __construct()
    {
        $this->db = new ClassDB();
        if(!$this->db)
        {
            echo $this->db->lastErrorMsg();
        }
    }

    function addNews($title, $text)
    {
        $sql =<<<EOF
        INSERT
        INTO News ('name', 'text')
        VALUES ("$title", "$text");
        EOF;
        
        $ret = $this->db->voidQuery($sql);
    }

    function getNews($id)
    {
        $sql =<<<EOF
        SELECT * 
        FROM News 
        WHERE "id" = $id;
        EOF;
        
        $ret = $this->db->getArray($sql);
        $result["name"] = $ret[0]["name"];
        $result["text"] = $ret[0]["text"];

        return $result;
    }

    function deleteNews($id)
    {
        $sql =<<<EOF
        DELETE
        FROM News 
        WHERE id = $id;
        EOF;
        
        $this->db->voidQuery($sql); 
    }

    function editNews($id, $title, $text)
    {
        $sql =<<<EOF
        UPDATE News
        SET name = "$title", text = "$text"
        WHERE id = $id;
        EOF;

        $this->db->voidQuery($sql);
    }

    function getNewsForPage($page)
    {
        $sql =<<<EOF
        SELECT * 
        FROM News
        ORDER BY id DESC
        LIMIT $this->newsPerPage OFFSET $page * $this->newsPerPage;
        EOF;
        
        $ret = $this->db->getArray($sql);
        return $ret;
    }

}


?>