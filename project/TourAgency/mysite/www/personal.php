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
<?php
$myquery=mysql_query("SELECT * FROM client WHERE client_id=".$_COOKIE[id]."");
$query=mysql_fetch_array($myquery);
?>
<div id="menu">


			<ul>
				<li><a href="index.php">     Главная     </a></li>
				<li><a href="about.php">     О сайте     </a></li>
				<li><a href="#">     Контакты     </a></li>

<li class='righ'><a href='exit2.php'> Выйти </a></li>
<li class='righ'><a href='personalupdate.php'>Редактировать личные данные</a> </li>
</div>
</div>

<div id='wrapper'>

<h1 align='center'>Вы забронировали следующие туры:</h1>
<?php

$a=mysql_query("SELECT reservation_date,res_quantity,state,reservation_id,reservation.tour_id, article, date, city_name, country_name, hotel_name, duration, cost, description FROM reservation JOIN client ON reservation.client_id=client.client_id JOIN tour ON reservation.tour_id=tour.tour_id JOIN hotel ON tour.hotel_code=hotel.hotel_code JOIN city ON hotel.city_code=city.city_code JOIN country ON city.country_code=country.country_code WHERE reservation.client_id=".intval($_COOKIE[id])."");


 while ($a2=mysql_fetch_array($a))
{
$ident = $a2['tour_id'];
echo '<div class="article2" id="article">';
echo '<form method="POST" action="personal.php?c='.$a2[reservation_id].'&b='.$a2[res_quantity].'">';
 $ident = $a2['tour_id'];
echo '<img src="img.php?ident='.$ident.'" alt="" width="400px" height="325px"/>';
echo '<div style="text-align:left">';
echo 'Номер брони: '.$a2[reservation_id];
echo '<br> <br>';
echo 'Статус брони: '.$a2[state];
echo '<br> <br>';
$da1 = new DateTime($a2['reservation_date']);
$da2 = $da1->format('d-m-Y');
echo 'Дата брони: ' .$da2;
echo '<br><br>';
echo 'Количество забронированных путевок: '.$a2[res_quantity];
echo '<br> <br>';
echo 'Страна: ' .$a2['country_name'];
echo '<br> <br>';
echo 'Город: ' .$a2['city_name'];
echo '<br> <br>';
$da1 = new DateTime($a2['date']);
$da2 = $da1->format('d-m-Y');
echo 'Вылет: ' .$da2;
echo '<br> <br>';
echo 'Продолжительность: ' .$a2['duration']. ' ночей';
echo '<br> <br>';
echo 'Стоимость: ' .$a2['cost']. ' $';
echo '<br> <br>';
echo  $a2['description'];

$b=$a2[res_quantity];
echo '<center><input type="submit" name="update" value="Изменить количество путевок" style="margin-top: 10pt; margin-right: 10pt;">';
echo '<input type="submit" name="refuse" value="Отказаться от брони" style="margin-top: 10pt;"></center>';
echo '</form>';
echo '</div>';
echo '<div style="clear:both;"> </div>';
echo '</div>';

if (isset($_POST[refuse]))
{
echo '<a href="#x" class="overlay" id="win1"></a>';
echo '<div class="popup">';
echo "<script>
document.location.href='#win1';
</script>";
   echo ' <p align="center">';
     echo 'Вы уверены, что хотите отказаться от брони?';
	
	echo '<form  method="POST" action="refuse.php?a='.$_GET['c'].'""> <input type="submit" name="ref" value="Отказаться" style="margin-left: 15pt; margin-right: 15pt; margin-top: 20pt;">';
	echo '<input type="submit" name="canc" value="Отмена"></p>';
	echo '</form>';
	echo '<a class="close" href="#close"></a>';
	echo ' </p>';
	echo '</div>';
	}
	
	elseif (isset($_POST[update]))
	{
	echo '<a href="#x" class="overlay" id="win2"></a>';
echo '<div class="popup">';

echo "<script>
document.location.href='#win2';
</script>";
   echo ' <p align="center">';
     echo 'Выберите необходимое количество путевок:';
	
	echo '<form  method="POST" action="update_quant.php?a='.$_GET[c].'""> ';
	echo '<select name="quantity" id="quantity">';
	for ($i=1;$i<$_GET[b];$i++)
	{ echo '<option value='.$i.'>'.$i.'</option>';
    }	
	echo '<option selected value='.$_GET[b].'>'.$_GET[b].'</option>';
	for ($i=$_GET[b]+1;$i<6;$i++)
	{
	echo '<option value='.$i.'>'.$i.'</option>';
	}
	echo '</select>';	
	echo '<br>';
	echo '<input type="submit" name="update" value="Изменить" style="margin-left: 15pt; margin-right: 15pt; margin-top: 20pt;">';
	echo '<input type="submit" name="cancel" value="Отмена"></p>';
	echo '</form>';
	echo '<a class="close" href="#close"></a>';
	echo ' </p>';
	echo '</div>';
	}
}	
?>
</div>


</div>
</body>
</html>