<?php
 
 include ("function_library.php");
 $db = getDB();
 
$sql =<<<EOF
SELECT * FROM WorkIsDone;
EOF;

   $result = array();
   $ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) )
   {
        $row_result = array();
        $row_result["address_id"] = $row['address_id'];
        $row_result["description"] = getSubclassOfWorkById($db, $row['subclass']);
        $row_result["comment"] = $row['comment'];
        $row_result["date"] = $row['date'];
        
        $result[] = $row_result;
   }
   
   foreach ($result as $row)
   {
       //print_r($row);
       $addr = $row["address_id"];
       $desc = $row["description"];
       $comm = $row["comment"];
       $date = $row["date"];
       
       $sql =<<<EOF
INSERT INTO CompletedWork ('address_id', 'description', 'comment', 'date')
VALUES ($addr, '$desc', '$comm', '$date');
EOF;
      // echo $sql;

   $ret = $db->query($sql);
         
   }
   
$db->close();

 
 ?>
