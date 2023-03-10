<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>

<form action="/setup.php" method="POST">
<p align="center"><input type="submit" value="Вернуться в админку" name="submit"></p>
</form>



<p align="center"><strong>Форма для манипуляций с контрактами и требованиями</strong></p>


<?php
include_once ($_SERVER['DOCUMENT_ROOT']."/core/class_config.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/core/class_address.php");


$addr = new ClassAddress();

$addresses = $addr->getAddr2IdArray("ALL");

    function echoDownloadForm($addr_id, $type)
    {
      $filename_end = "";
      $accept = "";
      switch ($type)
      {
        case "contract":
          $filename_end = "contract.pdf";
          $accept = ".pdf";
        break;
        
        case "requirements":
          $filename_end = "requirements.doc";
          $accept = ".doc";
        break;

        case "report6":
          $filename_end = "report6.xls";
          $accept = ".xls,.xlsx";
        break;

        case "report12":
          $filename_end = "report12.xls";
          $accept = ".xls,.xlsx";
        break;
      }

      $filename = $_SERVER['DOCUMENT_ROOT']."/documents/".$GLOBALS['SITE_PREFIX']."документи_за_адресою/".$addr_id."-".$filename_end;
      $filename_html = "/documents/".$GLOBALS['SITE_PREFIX']."документи_за_адресою/".$addr_id."-".$filename_end;
      
      
      echo "<form action=\"./handler_form_for_contracts_adding.php\" method=\"POST\" enctype=\"multipart/form-data\">";
      if (file_exists($filename))
      {
        $unixtime = filectime ($filename);
        $date = new DateTime("@$unixtime");
        $string_date = $date->format('Y-m-d');

        echo "<a href=\"".$filename_html."\">".$string_date."</a>";

      }else
      {
        echo "Файл не существует";
      }

      echo "<input type=\"hidden\" name=\"filename\" value=\"".$filename."\">";
      echo "<input type=\"file\" accept=\"".$accept."\"name=\"fileToUpload\" id=\"fileToUpload\">";
      echo "<input type=\"submit\" value=\"Загрузить\" name=\"submit\">";
      echo "</form>";
    }

    echo "<table border='1' cellspacing='0' cellpadding='5' align='center'>";
    echo "<tr>";
    echo "  <th>id</th>";
    echo "  <th>Адрес</th>";
    echo "  <th>Контракт</th>";
    echo "  <th>Требования</th>";
    echo "  <th>Отчёт-6</th>";
    echo "  <th>Отчёт-12</th>";
    echo "</tr>";

    foreach ($addresses as $addr_name => $addr_id)
    {
      echo "<tr>";
        echo "<td>";
          echo $addr_id;
        echo "</td>";

        echo "<td>";
          echo $addr_name;
        echo "</td>";

        echo "<td>";
          echoDownloadForm($addr_id, "contract");
        echo "</td>";

        echo "<td>";
          echoDownloadForm($addr_id, "requirements");
        echo "</td>";

        echo "<td>";
          echoDownloadForm($addr_id, "report6");
        echo "</td>";

        echo "<td>";
          echoDownloadForm($addr_id, "report12");
        echo "</td>";

      echo "</tr>";
    }
 ?>

