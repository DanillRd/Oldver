<?php

function print_news($id, $name, $text)
{
    echo "<table class=\"contentpaneopen\"><tr><td class=\"contentheading\" width=\"100%\">";
    echo $name;
    echo "</td></tr></table>";

    echo $text;
    echo "<br>";

    echo "<a href=\"/index.php?menu=news_details&id=$id\" class=\"readon\">Детальніше...</a>";
    echo "<span class=\"article_separator\">&nbsp;</span>";
    echo "<br><br><br>";
}

include ($_SERVER['DOCUMENT_ROOT']."/core/news/class_news.php");
$news = new ClassNews();

if (!isset($_GET['page']))
{
    $page = 0;
}else
{
    $page = $_GET['page'];
}

$res_array = $news->getNewsForPage($page);

foreach ($res_array as $key => $news)
{
    print_news($news["id"], $news["name"], $news["text"]);
}

//print_r($res_array);

$current_page = $page;
$previous_page = $page - 1; if ($previous_page <= 0) {$previous_page = $current_page;}
$next_page = $page + 1;

?>

<table class="contentpaneopen"><tr><td valign="top" align="center">
    <a href="./index.php?menu=news&page=<?php echo $previous_page;?>" > Попередня </a>
    <a href="./index.php?menu=news&page=<?php echo $current_page;?>" > <?php echo $current_page;?> </a>
    <a href="./index.php?menu=news&page=<?php echo $next_page;?>" > Наступна </a>
</td></tr></table>

