<?php
 
//print_r($_POST);
$title = $_POST["title"];
$text = $_POST["news"];
$editing = false;
$id = NULL;

if (isset($_POST["id"]))
{
  $editing = true;
  $id = $_POST["id"];
}

include ($_SERVER['DOCUMENT_ROOT']."/core/news/class_news.php");
$news = new ClassNews();

if ($editing == true)
{
  $news->editNews($id, $title, $text);
}else
{
  $news->addNews($title, $text);
}

// Редирект назад к форме
header("Location: /core/news/form_for_adding_news.php");
die();
 
?>
