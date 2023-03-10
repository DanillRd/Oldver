<?php

$id = $_GET['id'];

include ($_SERVER['DOCUMENT_ROOT']."/core/news/class_news.php");
$news = new ClassNews();

$row = $news->getNews($id);

?>

<table class="contentpaneopen">
<tr>
    <td class="contentheading" width="100%"><?php echo $row['name']; ?></td>
</tr>
</table>

<table class="contentpaneopen">

<tr>
<td valign="top"><?php echo $row['text']; ?></td>
</tr>
</table>
