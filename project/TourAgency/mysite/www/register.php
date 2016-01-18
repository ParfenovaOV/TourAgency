<?php
$connect = mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("tour");


function generateCode($length=6)
{
$chars="abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPQRSTUVWXYZ0123456789";
$code="";
$clen=strlen($chars)-1;
while (strlen($code)<$length) {
$code .=$chars[mt_rand(0,$clen)];
}
return $code;
}

if (isset($_POST['submit']))
{
$username = $_POST['username'];
$login = $_POST['login'];
$password = $_POST['password'];
$r_password = $_POST['r_password'];
$phone = $_POST['phone'];
$birth = $_POST['birth'];
$job = $_POST['job'];
$passport_seria = $_POST['passport_seria'];
$passport_number = $_POST['passport_number'];
$kem_vidan = $_POST['kem_vidan'];
$kogda = $_POST['kogda'];
$f_p_seria = $_POST['f_p_seria'];
$f_p_nomer = $_POST['f_p_nomer'];
  if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))

    {

        $err[] = "Логин может состоять только из букв английского алфавита и цифр";

    }
if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)

    {

        $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";

    }
	
	
	
	$query1 = mysql_query("SELECT COUNT(client_id) FROM client WHERE login='".mysql_real_escape_string($_POST['login'])."'");

    if(mysql_result($query1, 0) > 0)

    {

        $err[] = "Пользователь с таким логином уже существует в базе данных";

    }
	if (count($err) == 0) {
$password = md5($password);
$query = mysql_query("INSERT INTO client VALUES ('', '$username', '$passport_seria', '$passport_number', '$kem_vidan', '$kogda', '$birth', '$f_p_seria', '$f_p_nomer', '$job', '$login', '$password', '','$phone')") or die(mysql_error());
$query = mysql_query("SELECT * FROM client WHERE login='$_POST[login]'");
$user_data = mysql_fetch_array($query);
  if ($user_data["password"] == md5($_POST['password']))
   { 
   $hash=md5(generateCode(10));
   $a=mysql_query("UPDATE client SET user_hash='".$hash."' WHERE client_id='".$user_data[client_id]."'");
   setcookie("id",$user_data[client_id],time()+60*60*24*30);
   setcookie("hash",$hash,time()+60*60*24*30);
   
   header("Location: check3.php"); exit();
    } 

else die("Пароли должны соответствовать!");
}
else 
{

        print "<b>При регистрации произошли следующие ошибки:</b><br>";

        foreach($err AS $error)

        {

            print $error."<br>";

        }

    }



}
?>
<head>
 <title> Турагентство </title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 

<link rel="stylesheet" type="text/css" href="css/style.css" />
 </head>

 <body> 
 


<div id="wrapper-bg"> 
<div id="wrapper-bg2"> 
<div id="img">
<a href='index.php'><img src='css/logo.png'></a>
</div>
<div id="menu">


			<ul>
				<li><a href="index.php">     Главная     </a></li>
				<li><a href="about.php">     О сайте     </a></li>
				<li><a href="#">     Контакты     </a></li>
				
	</div>
</div>	
	
<div id="wrapper">
<form method="post" action="register.php">
<table align="center">
<tr> <td class="t2"> ФИО: </td><td><input type="text" name="username"  size="50" required/> </td> </tr>
<tr> <td class="t2">Логин:</td><td><input type="text" name="login"  size="50" required/></td> </tr>
<tr> <td class="t2">Пароль: </td> <td> <input type="password" name="password"  size="50" required/> </td> </tr>
<tr> <td class="t2">Подтвердите пароль:</td><td><input type="password" name="r_password"  size="50" required/> </td> </tr>
<tr> <td class="t2"> Номер телефона: </td><td><input type="text" name="phone"  size="50" required/> </td> </tr>
<tr> <td class="t2"> Дата рождения: </td><td> <input type="text" name="birth" size="50" required/> </td> </tr>
<tr> <td class="t2"> Место работы: </td><td><input type="text" name="job"  size="50" required/> </td></tr> 
<tr> <td class="t2">Серия паспорта: </td><td> <input type="text" name="passport_seria"  size="50" required/> </td></tr>
<tr> <td class="t2"> Номер паспорта: </td><td> <input type="text" name="passport_number"  size="50" required/> </td> </tr>
<tr> <td class="t2"> Кем выдан: </td><td> <input type="text" name="kem_vidan"  size="50" required/> </td></tr>
<tr> <td class="t2"> Когда выдан: </td><td> <input type="text" name="kogda"  size="50" required/> </td></tr>
<tr> <td class="t2"> Серия загранпаспорта: </td><td> <input type="text" name="f_p_seria" size="50" required/> </td></tr>
<tr> <td class="t2"> Номер загранпаспорта: </td><td> <input type="text" name="f_p_nomer"  size="50" required/> </td></tr>
</table>
<br>
<div> <input type="submit" name="submit" value="Зарегистрироваться">
</div>
</form>
</div>
</div>