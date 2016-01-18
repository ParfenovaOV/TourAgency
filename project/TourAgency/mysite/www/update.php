<?php
$connect = mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("tour");

$a=$_GET['a'];
$query=mysql_query("SELECT  article, country_name,city_name, hotel_name, hotel_class, date, duration, cost, description, img, quantity FROM tour JOIN hotel ON tour.hotel_code=hotel.hotel_code JOIN city ON hotel.city_code=city.city_code JOIN country ON city.country_code=country.country_code WHERE tour.tour_id='$_GET[a]'");
$q1=mysql_fetch_array($query);
$b=mysql_query("SELECT city_code FROM city WHERE city_name='$q1[city_name]'");
$b1=mysql_fetch_array($b);

$hotel=$_POST['hotel'];
$date=$_POST['date'];
$duration=$_POST['duration'];
$cost=$_POST['cost'];
$article=$_POST['article'];
$description=$_POST['description'];
$quantity=$_POST['quantity'];
if (isset($_POST['update']))
{
$hotel=$_POST['hotel'];
$date=$_POST['date'];
$duration=$_POST['duration'];
$cost=$_POST['cost'];
$article=$_POST['article'];
$description=$_POST['description'];
$quantity=$_POST['quantity'];
$query=mysql_query("UPDATE tour SET date='$date', duration='$duration', cost='$cost', description='$description',  hotel_code='$hotel', article='$article', quantity='$quantity' WHERE tour_id='$_GET[b]'");
echo "<script>
document.location.href='adminmain.php';
</script>";
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
				<li><a href="adminmain.php">     Главная     </a></li>
				
	</div>
</div>	
<div id="wrapper">

<link rel="stylesheet" type="text/css" href="css/style.css" />
<?php echo'<form enctype="multipart/form-data" method="POST" action="update.php?b='.$a.'">'; ?>
<div class="add">
<p align="center">
Редактирование тура:
</p>

<table align="center">

<tr>
<td class="t2">
Заголовок тура:  </td>
<?php echo " <td><input type='text' name='article' value='$q1[article]' />" ; ?></td>
</tr>

<?php 
$q=mysql_query("SELECT * FROM hotel WHERE hotel.city_code='$b1[city_code]'");
echo "<tr><td class='t2'> Отель: </td>";
echo "<td><select id='hotel' name='hotel' >";

while($object = mysql_fetch_object($q))
{ 
if (($object->hotel_code)<>($q1[hotel_code]))
{
echo "<option value = '$object->hotel_code' > $object->hotel_name </option>";
}
else 
{
echo "<option selected value='".$q1[hotel_code]."'> ".$q1[hotel_name]." </option>";
}}



echo "</td>";

echo "</select></tr>";
echo "</div>";
?>
<tr> <td class="t2">
Дата отправления: </td>
<td> <?php echo " <input type='date' name='date' value='$q1[date]'  /> "; ?></td> </tr>

<tr> <td class="t2">
Продолжительность тура: </td>
<td> <?php echo "<input type='text' name='duration' value='$q1[duration]'  />"; ?> ночей </td>
</tr>

<tr> <td class="t2">
Cтоимость: </td>
<td> <?php echo " <input type='text' name='cost' value='$q1[cost]'  />"; ?> $ </td>
</tr>

<tr> <td class="t2">
Описание: </td>
<td> <?php echo "<textarea name='description' rows=5 cols=30  > $q1[description]
</textarea> "; ?> </td>
</tr>

<tr> <td class="t2">
Количество: </td>
<td> <?php echo " <input type='text' name='quantity' value='$q1[quantity]'  />"; ?> </td>
</tr>


</table>
<br>
<input type="submit" name="update" value="Редактировать"/></a>
</form>
</div>




</div>


