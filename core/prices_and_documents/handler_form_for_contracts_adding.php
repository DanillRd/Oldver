<?php    
    $target_file = $_POST["filename"];
    echo $target_file;
    $err = move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
    if ($err == true)
    {
        //echo "Файл ". basename( $_FILES["fileToUpload"]["name"]). " был успешно загружен.";
        // Редирект назад к форме
        header("Location: ./form_for_contracts_adding.php");
        die();
    } else
    {
        echo "Ошибка копирования.".$err;
        echo "<a href=\"./form_for_contracts_adding.php\">Возврат</a>";
    }
 
?>


