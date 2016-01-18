<?php
$connect = mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("tour");
setcookie("reserve", "", time() - 3600*24*30*12, "/");
setcookie("quantity", "", time() - 3600*24*30*12, "/");
?>
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
				
<?php 
if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{
$query=mysql_query("SELECT * FROM client WHERE client_id='".intval($_COOKIE[id])."'");
$userdata=mysql_fetch_array($query);
if (($userdata['user_hash'] == $_COOKIE['hash']))
{
{

echo "<li class='righ'><a href='exit.php'> Выйти </a></li>";
echo "<li class='righ'><a href='personal.php'> Личный кабинет  </a></li>";
}
}
}
else 
 
 echo "<li class='righ'>  <a href='#win2'>     Войти     </a>  </li> ";
 ?>
 
 
 
 <a href="#x" class="overlay" id="win2"></a>
<div class="popup">

 <div> <h2> Вход на сайт </h2> </div>
<form method="POST" action="autor.php">
<div><p text-align="center"><input type="text" name="e_login" placeholder="Логин" required/> </p> </div>
<div> <input type="password" name="e_password" placeholder="Пароль" required/> </div>
<div> <p text-align="center"><input type="submit" name="enter" value="Войти"/> </p> </div>
</form>
<div><a href="register.php"> Зарегистрироваться </a> </div>
<a class="close" href="#close"></a>
		</div>
</ul>


		
</div>
</div>
<div id="wrapper">
<div class= "content">


<?php 
$b=$_GET['a'];
 $a=mysql_query("SELECT tour_id,article, country_name, city_name, hotel_name, hotel_class, date, duration, cost, description, quantity FROM tour JOIN hotel ON tour.hotel_code=hotel.hotel_code JOIN city ON hotel.city_code=city.city_code JOIN country ON city.country_code=country.country_code WHERE tour.tour_id='$b'");
 $a1=mysql_fetch_array($a);
 echo "<div class='tour'>";
 echo "<h1> ".$a1[article]."</h1>";
echo '<img src="img.php?ident='.$b.'" onClick="resisize(img);" alt="" width="400px" height="310px" >';
echo "<p align='left'>";
echo "Страна: ".$a1[country_name]."<br><br>";
echo "Город: " .$a1[city_name]."<br><br>";
echo "Отель: " .$a1[hotel_name]." " .$a1[hotel_class]."*<br><br>";
echo "Вылет: " .$a1[date]. "<br><br>";
echo "Продолжительность: " .$a1[duration]. " ночей<br><br>";
echo "Стоимость: " .$a1[cost]. " $<br><br>";
echo "Доступное количество путевок: " .$a1[quantity]." <br><br>";
echo "".$a1[description]." <br><br>";
echo "</div>";
 
if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{if (isset($_COOKIE['reserve']))
{

echo '<a href="#x" class="overlay" id="win3"> </a>';
 echo '<div class="popup">';
 echo "<script>
document.location.href='#win3';
</script>";
echo "Выберите количество путевок для брони: <br><br>";
echo "<form action='reserve.php?a=".$b."' method='POST'>";
echo "<select name='quantity' id='quantity' style='width: 40pt;'>";
for ($i=$a1[quantity];$i>0;$i--)
{
echo "<option value='".$i."'> ".$i." </option>";
}
echo "</select>";
echo "<br><br>";
echo "<center>";
echo "<input type='submit' name='canc' value='Отмена' style='margin-right: 10pt; margin-left:50pt;'>";
echo "<input type='submit' name='res' value='Забронировать путевки'>";
echo "</center>";
echo "</form>";
echo '<a class="close" href="#close"></a>';
echo "</div>";


}
else
{
echo "<form method='POST' action='reserve.php?a=".$b."'>";
echo "<input type='submit' name='reserve' value='Забронировать путевку'>";
echo "</form>";
}
}
else 
{
echo "Вы можете забронировать путевку на этот тур, если";
echo "<a href='#win2'> АВТОРИЗУЕТЕСЬ </a> на нашем сайте";
}

if (isset($_COOKIE[quantity]))
{
$query1=mysql_query("SELECT MAX(reservation_id) AS reservation_id FROM reservation") or die(mysql_error());
$query2=mysql_fetch_array($query1);
echo "<p style='color: red;'>Вы успешно забронировали ".$_COOKIE[quantity]." путевок на данный тур. Номер Вашей брони: ".$query2['reservation_id']."</p>";

}



 ?>








