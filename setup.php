<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
</head>
<body>
<?php

include_once ($_SERVER['DOCUMENT_ROOT']."/core/class_config.php");
//include ("./function_library.php");
//can_admin();

if (isset($_POST['user']) && isset($_POST['pass']))
{
    $user = $_POST['user'];
    $pass = $_POST['pass'];  

    if($user == "admin" && $pass == "admin")
    {
        header("Location: /core/setup/setup_menu.php");
        die();
    }else
    {
        // Неверный логин или пароль
        header("Location: /setup.php?error=1");
        die();
    }

}

$error_text = "";
if (isset($_GET['error']))
{
    $error_id = $_GET['error'];
    if ($error_id == 1)
    {
       $error_text = "Неверный логин или пароль";
    }
}

?>

<div style='width: 100%; height: 100%;'>
  <div style='width: 400px; 
       height: 250px; 
       overflow:visible; 
       position:absolute; 
       left:50%; 
       top:50%; 
       margin-left:-200px; 
       margin-top:-200px; 
       text-align: center;
       border: 4px double black;
       background: #B0B0B0;
       padding: 10px;
       '>
  
       <form method="POST" action="setup.php"><br>
       Логин:<br> <input type="text" name="user"></input><br>
       Пароль:<br> <input type="password" name="pass"></input>
       <p style='color: #B00000;'><?php echo $error_text;?></p>
       <input type="submit" name="submit" value="Вход"></input>
       </form>
  
    
  </div>
</div>

</body>
</html>

