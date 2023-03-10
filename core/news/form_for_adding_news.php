<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>

<script type="text/javascript">
  function copy()
  {
    var textarea = document.getElementById("text");
    var preview = document.getElementById("preview");
    
    preview.innerHTML = textarea.value;
  }
</script>

<?php
  
  $editing = false;
  $id = 0;

  if (isset($_POST["id"]))
  {
    include ($_SERVER['DOCUMENT_ROOT']."/core/news/class_news.php");
    $news = new ClassNews();
    $editing = true;
    $id = $_POST["id"];
    $new_array = $news->getNews($id);
    $name = $new_array["name"];
    $text = $new_array["text"];
  }

?>

<form action="/setup.php" method="POST">
<p align="center"><input type="submit" value="Вернуться в админку" name="submit"></p>
</form>

<form action="/index.php" method="POST">
<p align="center"><input type="submit" value="Вернуться на сайт" name="submit"></p>
</form>

<p align="center"><strong>Редактирование или удаление новости</strong></p>

<form action="/core/news/form_for_adding_news.php" method="POST">
    <p align="center">№:<input required size="10" type="text" name="id" value="<?php if($editing){echo $id;}?>"></input>
    <input type="submit" value="Редактировать новость" name="submit"></p>
</form>

<form action="/core/news/handler_form_for_removing_news.php" method="POST">
    <p align="center">№:<input required size="10" type="text" name="id"</input>
    <input type="submit" value="Удалить новость" name="submit"></p>
</form>

<p align="center"><strong> Форма добавления новостей</strong></p>

<form action="/core/news/handler_form_for_adding_news.php" method="POST">
    <?php
      if($editing)
      {
        echo "<input type=\"hidden\" name=\"id\" value=\"$id\">\n";
      }
    
    ?>
    <p align="center">Заголовок:<p>
    <p align="center"><input required size="100" type="text" name="title" value="<?php if($editing){echo $name;}?>"></input><br></p>
    <p align="center">Тело новости:<p>
    <p align="center"><textarea required id="text" name="news" rows="20" cols="150"><?php if($editing){echo $text;}?></textarea></p>
    <p align="center"><input type="submit" value="Подтвердить новость" name="submit"></p>
</form>

<p align="center">
    <button onclick="copy()">Предпросмотр</button>
    <br>
    Предпросмотр:
    <div id="preview"></div>
</p>

<hr>
<p align="center"><strong>Памятка по основным тегам</strong></p>

&ltb&gt жирный текст &lt/b&gt          <b>жирный текст</b><br>
&lti&gt жирный текст &lt/i&gt          <i>курсив</i><br>

<br>
&ltul&gt<br>
&nbsp;&nbsp;&nbsp;&nbsp;&ltli&gtПример&lt/li&gt<br>
&nbsp;&nbsp;&nbsp;&nbsp;&ltli&gtМаркированного&lt/li&gt<br>
&nbsp;&nbsp;&nbsp;&nbsp;&ltli&gtСписка&lt/li&gt<br>
&lt/ul&gt

<br>

<ul>
<li>Пример</li>
<li>Маркированного</li>
<li>Списка</li>
</ul>

Для нумерованного списка испольуется &ltol&gt вместо &ltul&gt

<ol>
<li>Пример</li>
<li>Нумерованного</li>
<li>Списка</li>
</ol>

Степень (например для квадратных или кубических метров) можно записать так: 15м&ltsup&gt2&lt/sup&gt => 15м<sup>2</sup>


</html>
