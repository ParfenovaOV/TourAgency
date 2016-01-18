<?php
$connect = mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("tour");

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
				<li><a href="#">     О сайте     </a></li>
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
echo "<li class='righ'><div class='user'> Здравствуйте, ".$userdata[login]." </div></li>";
}
}
}
else 
 
 echo "<li class='righ'>  <a href='#win2'>     Войти     </a>  </li> ";
 ?>
 
 
 <a href="#x" class="overlay" id="win2"></a>

 </div>
 </div>

 <div id="wrapper">

 <?php 
 $connect = mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("tour");

$country=$_POST['country'];
$city=$_POST['city'];
$hotel_class=$_POST['hotel_class'];
$date1=$_POST['date1'];
$date2=$_POST['date2'];
$duration=$_POST['duration'];
$price1 = $_POST['price1'];
$price2 = $_POST['price2'];

if ($country==0)
$country="country.country_code";
if ($city==0)
$city="city.city_code";
if ($hotel_class==0)
$hotel_class="hotel.hotel_class";
if ($date1==0)
$date1="''";
if ($date2==0)
$date2=date;
if ($price1==0)
$price1="''";
if ($price2==0)
$price2=cost;



if ($duration==0)
{

$query= mysql_query("SELECT tour_id, article, city_name, hotel_name, date, duration, cost FROM tour JOIN hotel ON tour.hotel_code=hotel.hotel_code JOIN city ON hotel.city_code=city.city_code JOIN country ON city.country_code=country.country_code WHERE country.country_code=$country AND city.city_code=$city AND hotel.hotel_class=$hotel_class AND date>=$date1 AND date<=$date2 AND cost>=$price1 AND cost<=$price2") or die(mysql_error());
}
elseif ($duration==1)
{
$query=mysql_query("SELECT tour_id,article, city_name, hotel_name, date, duration, cost FROM tour JOIN hotel ON tour.hotel_code=hotel.hotel_code JOIN city ON hotel.city_code=city.city_code JOIN country ON city.country_code=country.country_code WHERE country.country_code=$country AND city.city_code=$city AND hotel.hotel_class=$hotel_class AND date>=$date1 AND date<=$date2 AND cost>=$price1 AND cost<=$price2 AND duration>=2 AND duration<=6")  or die(mysql_error());
}
elseif ($duration==8)
{
$query=mysql_query("SELECT tour_id,article, city_name, hotel_name, date, duration, cost FROM tour JOIN hotel ON tour.hotel_code=hotel.hotel_code JOIN city ON hotel.city_code=city.city_code JOIN country ON city.country_code=country.country_code WHERE country.country_code=$country AND city.city_code=$city AND hotel.hotel_class=$hotel_class AND date>=$date1 AND date<=$date2 AND cost>=$price1 AND cost<=$price2 AND duration>=8 AND duration<=14")  or die(mysql_error());
}
elseif ($duration==7)
{
$query=mysql_query("SELECT tour_id, city.city_code, article, city_name, hotel_name, date, duration, cost FROM tour JOIN hotel ON tour.hotel_code=hotel.hotel_code JOIN city ON hotel.city_code=city.city_code JOIN country ON city.country_code=country.country_code WHERE country.country_code=$country AND city.city_code=$city AND hotel.hotel_class=$hotel_class AND date>=$date1 AND date<=$date2 AND cost>=$price1 AND cost<=$price2 AND duration=7")  or die(mysql_error());
}
else
{
$query=mysql_query("SELECT tour_id,article, city_name, hotel_name, date, duration, cost FROM tour JOIN hotel ON tour.hotel_code=hotel.hotel_code JOIN city ON hotel.city_code=city.city_code JOIN country ON city.country_code=country.country_code WHERE country.country_code=$country AND city.city_code=$city AND hotel.hotel_class=$hotel_class AND date>=$date1 AND date<=$date2 AND cost>=$price1 AND cost<=$price2 AND duration>=14");
}


if (mysql_num_rows($query)>0){

echo "<h1><p align='center'>Найдено туров: ".mysql_num_rows($query)."</p></h1>";
while ($a2=mysql_fetch_array($query))
{
$ident = $a2['tour_id'];
echo '<div class="article" style="width: 940px; height: auto;">';
echo '<a href="tour.php?a='.$ident.'"> <h2>';
 echo $a2['article']; 

echo '</h2> </a>';
 $ident = $a2['tour_id'];
echo '<img src="img.php?ident='.$ident.'" alt="" width="200px" height="140px"/>';
echo '<p text-align="center">';
echo 'Город:' .$a2['city_name'];
echo '<br> <br>';
echo 'Вылет:' .$a2['date'];
echo '<br> <br>';
echo 'Продолжительность:' .$a2['duration']. ' ночей';
echo '<br> <br>';
echo 'Стоимость:' .$a2['cost']. '$';
echo '</p>';
echo '<div style="clear:both;"> </div>';
echo '</div>';

}
echo "<a href='index.php'> <h2><p align='right' style='margin-right:20px;'>Вернуться к поиску </p></h2></a>";
}
else
{
echo "<h1><p align='center'>  Туров по Вашему запросу не найдено! </p></h1>";
echo "<a href='index.php'> <h2><p align='center' style='margin-right:20px;'>Вернуться к поиску </p></h2></a>";
}




?>

 



</div>


</body>
</html>