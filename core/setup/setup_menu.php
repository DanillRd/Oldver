<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
</head>
<body>

<form action="/index.php" method="POST">
<p align="center"><input type="submit" value="Вернуться на сайт" name="submit"></p>
</form>
<br>
<br>

<table border="1" cellspacing="0" cellpadding="5" align="center">

<tr>
    <td>Форма для добавления выполненных работ</td>
    <td>
        <form action="/core/work/form_for_adding_completed_work.php" method="POST">
        <p align="center"><input type="submit" value="Перейти" name="submit"></p>
        </form>
    </td>
</tr>

<tr>
    <td>Форма для добавления новостей</td>
    <td>
        <form action="/core/news/form_for_adding_news.php" method="POST">
        <p align="center"><input type="submit" value="Перейти" name="submit"></p>
        </form>
    </td>
</tr>

<tr>
    <td>Форма для манипуляций с адресами</td>
    <td>
        <form action="/core/address/form_for_address_editing.php" method="POST">
        <p align="center"><input type="submit" value="Перейти" name="submit"></p>
        </form>
    </td>
</tr>
<!--
<tr>
    <td>Доступ к файловой системе</td>
    <td>
        <form action="./mfm.php" method="POST">
        <p align="center"><input type="submit" value="Перейти" name="submit"></p>
        </form>
    </td>
</tr>-->

<tr>
    <td>Форма для правки цен (кошториси)</td>
    <td>
        <form action="/core/prices_and_documents/form_for_price_editing.php" method="POST">
        <p align="center"><input type="submit" value="Перейти" name="submit"></p>
        </form>
    </td>
</tr>

<tr>
    <td>Форма для манипуляций с контрактами и требованиями</td>
    <td>
        <form action="/core/prices_and_documents/form_for_contracts_adding.php" method="POST">
        <p align="center"><input type="submit" value="Перейти" name="submit"></p>
        </form>
    </td>
</tr>

<tr>
    <td>Форма для правки расписания проверки дымовых и вентиляционных каналов</td>
    <td>
        <form action="/core/schedules_maintenance/form_for_chimneys_editing.php" method="POST">
        <p align="center"><input type="submit" value="Перейти" name="submit"></p>
        </form>
    </td>
</tr>

<tr>
    <td>Форма для правки расписания сантехнического обслуживания</td>
    <td>
        <form action="/core/schedules_maintenance/form_for_plumbing_editing.php" method="POST">
        <p align="center"><input type="submit" value="Перейти" name="submit"></p>
        </form>
    </td>
</tr>

<tr>
    <td>Форма для правки расписания уборки</td>
    <td>
        <form action="/core/schedules_maintenance/form_for_cleaning_editing.php" method="POST">
        <p align="center"><input type="submit" value="Перейти" name="submit"></p>
        </form>
    </td>
</tr>

</table>
<!--
<br><br>
<form action="setup_upload.php" method="post" enctype="multipart/form-data">
Выберите БД для загрузки на сайт:
<input type="file" name="fileToUpload" id="fileToUpload">
<input type="submit" value="Загрузить" name="submit">
</form>
<br>
Загрузить БД с сайта:
<hr>
<a href="./jreu.db">Текущая версия</a>
<hr>
<a href="./jreu_backup.db">Архивная версия</a>
-->

</body>
</html>
