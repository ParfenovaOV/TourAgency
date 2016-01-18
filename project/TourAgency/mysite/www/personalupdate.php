<?php 
$connect = mysql_connect("localhost","root","");
mysql_select_db("tour");?>

<html>
<head>
 <title> Турагентство </title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script src="http://yandex.st/jquery/1.10.2/jquery.min.js"></script>
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
				<li class='righ'><a href='exit2.php'> Выйти </a></li>
<li class='righ'><a href='personal.php'>Личный кабинет</a> </li>
	</div>
</div>	
	
<div id="wrapper">
<form method="post" action="personalupdate.php">
<table align="center">
<?php
$query=mysql_query("SELECT * FROM client WHERE client_id=".$_COOKIE[id]."");
$a=mysql_fetch_array($query);
$da1 = new DateTime($a['client_birthday']);
$da2 = $da1->format('d-m-Y');
$da3 = new DateTime($a['kogda_vydan']);
$da4 = $da3->format('d-m-Y');

echo '<tr> <td class="t2"> ФИО: </td><td><input type="text" name="username"  size="50" value="'.$a[client_fio].'" required /> </td> </tr>';
echo '<tr> <td class="t2">Логин:</td><td><input type="text" name="login"  size="50" value="'.$a[login].'" required /></td> </tr>';
echo '<tr> <td class="t2">Пароль: </td> <td> <input type="password" name="password" value="'.($a[password]).'" size="50" required /> </td> </tr>';
echo '<tr> <td class="t2">Подтвердите пароль:</td><td><input type="password" name="r_password"  size="50" value="'.$a[password].'" required/> </td> </tr>';
echo '<tr> <td class="t2"> Номер телефона: </td><td><input type="text" name="phone"  size="50" value="'.$a[phone].'" /> </td> </tr>';
echo '<tr> <td class="t2"> Дата рождения: </td><td> <input type="text" name="birth" size="50" value="'.$da2.'" required readonly/> </td> </tr>';
echo '<tr> <td class="t2"> Место работы: </td><td><input type="text" name="job"  size="50" value="'.$a[job].'"required/> </td></tr>';
echo '<tr> <td class="t2">Серия паспорта: </td><td> <input type="text" name="passport_seria"  size="50" value="'.$a[passport_seria].'" required/> </td></tr>';
echo '<tr> <td class="t2"> Номер паспорта: </td><td> <input type="text" name="passport_number"  size="50" value="'.$a[passport_nomer].'" required/> </td> </tr>';
echo '<tr> <td class="t2"> Кем выдан: </td><td> <input type="text" name="kem_vidan"  size="50" value="'.$a[kem_vydan].'" required/> </td></tr>';
echo '<tr> <td class="t2"> Когда выдан: </td><td> <input type="text" name="kogda"  size="50" value="'.$da4.'" required/> </td></tr>';
echo '<tr> <td class="t2"> Серия загранпаспорта: </td><td> <input type="text" name="f_p_seria" size="50" value="'.$a[foreign_passport_seria].'" required/> </td></tr>';
echo '<tr> <td class="t2"> Номер загранпаспорта: </td><td> <input type="text" name="f_p_nomer"  size="50" value="'.$a[foreign_passport_nomer].'" required/> </td></tr> ';
?>
</table>
<br>
<div> 
<input type="submit" name="canc" value="Отмена">
<input type="submit" name="submit" value="Сохранить изменения">

</div>
<br>
</form>
</div>
</div>
</body>

<?php
if (isset($_POST[canc]))
{
echo "<script>
document.location.href='personal.php';
</script>";

}
elseif (isset($_POST[submit]))
{
if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))

    {
        $err[] = "Логин может состоять только из букв английского алфавита и цифр";
    }
if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
    {
        $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
    }
	$query1 = mysql_query("SELECT COUNT(client_id),client_id FROM client WHERE login='".mysql_real_escape_string($_POST['login'])."'");
	$q=mysql_fetch_array($query1);

    if((mysql_result($query1, 0) > 0)&&($q['client_id']!=$_COOKIE['id']))
    {
        $err[] = "Пользователь с таким логином уже существует в базе данных";
    }
	if (!($_POST[password]==$_POST[r_password]))
	{
	$err[] = "Пароли должны совпадать!";
	}
if (count($err) == 0) 
{
 $query=mysql_query("UPDATE client SET client_fio='".$_POST[username]."', passport_seria='".$_POST[passport_seria]."', passport_nomer='".$_POST[passport_number]."', kem_vydan='".$_POST[kem_vidan]."', kogda_vydan='".$_POST[kogda]."', client_birthday='".$_POST[birth]."', foreign_passport_seria='".$_POST[f_p_seria]."', foreign_passport_nomer='".$_POST[f_p_nomer]."', job='".$_POST[job]."', login='".$_POST[login]."', password='".$_POST[password]."', phone='".$_POST[phone]."' WHERE client_id='".$_COOKIE[id]."'");
echo "<script>
document.location.href='personal.php';
</script>";
}
else 
{
print "<b>При редактировании личных данных произошли следующие ошибки:</b><br>";

        foreach($err AS $error)
        {
            print $error."<br>";
        }

 }
}

?>
