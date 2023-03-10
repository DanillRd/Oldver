<?php
 
$id = $_POST["id"];

include ($_SERVER['DOCUMENT_ROOT']."/core/news/class_news.php");
$news = new ClassNews();

$news->deleteNews($id);

// Редирект назад к форме
header("Location: /core/news/form_for_adding_news.php");
die();
 
?>
