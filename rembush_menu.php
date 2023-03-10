<?php
    include_once ($_SERVER['DOCUMENT_ROOT']."/core/class_config.php");

    $prefix = $GLOBALS['SITE_PREFIX'];
    $jreu = $GLOBALS['JREU_PREFIX'];
    $rembush = $GLOBALS['REMBUSH_PREFIX'];

    function writeLink($type, $name_inner, $name_interface)
    {
        $style = "";
        if ($type == "parent") $style = "";
    }
?>

<tr>
<td class="maincontent_border_left">&nbsp;</td>
<td class="maincontent">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td valign="top" class="left_table">
<div id="left">
<div class="moduletable_menu">
<h3>Головне меню</h3>
<ul class="menu">
<li class="item42"><a href="./index.php?menu=news"><span>Новини</span></a></li>
<li class="item42"><a href="./index.php?menu=laws"><span>Законодавча база</span></a></li>
    <li rel="48" class="parent  item47"><a href="./index.php?menu=adminservices" class="topdaddy"><span>Послуги</span></a>
<ul>
    <li class="item48"><a href="./index.php?menu=adminservices"><span>Адміністративні послуги</span></a></li>
    <li class="item50"><a href="./index.php?menu=prices"><span>Послуга з управлiння</span></a></li>
</ul>
</li>

<li class="parent  item52"><a href="./index.php?menu=contactdetails" class="topdaddy"><span>Контакти</span></a>
<ul>
    <li class="item54"><a href="./index.php?menu=contactdetails"><span>Контакти, реквізити</span></a></li>
    <li class="item53"><a href="./index.php?menu=workschedule"><span>Графік роботи та прийому</span></a></li>
</ul>

<li class="parent  item52"><a href="./index.php?menu=schedules_chimneys" class="topdaddy">Графік</a>
<ul>
    <li class="item54"><a href="./index.php?menu=schedules_cleaning">​Графік прибирання</a></li>
</ul></li>
<ul>
    <li class="item54"><a href="./index.php?menu=schedules_chimneys">​Графік огляду вентеляційних каналів</a></li>
</ul></li>
<ul>
    <li class="item54"><a href="./index.php?menu=schedules_plumbing">​Графік сантехнічного огляду</a></li>
</ul></li>

    <li class="item54"><a href="./index.php?menu=all_works">Виконання планових та ремонтних робіт</a></li>
</li>
    <li class="item54"><a href="./index.php?menu=financial_statements">​Фінансова звітність</a></li>
</li>
	<li class="item54"><a href="./index.php?menu=rembush_job">​Робота</a></li>
</li></ul>
</div>

</td>
<td valign="top" class="mainbody">

<table width="98%" border="0" align="center" cellpadding="4" cellspacing="0">
<tr>
<td>
</td>
<td>
</td>
</tr>
</table>
<div id="mainbody">
