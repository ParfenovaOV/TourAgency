<head>
 <title> Турагентство </title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<link rel="stylesheet" type="text/css" href="css/style.css" />

 </head>
<?php 

$connect = mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("tour");
echo '<a href="#x" class="overlay" id="win1"></a>';
echo '<div class="popup">';
$a=$_GET['a'];
echo "<script>
document.location.href='#win1';
</script>";
   echo ' <p align="center">';
     echo 'Вы уверены, что хотите удалить данный тур?';
	echo ' </p>';
	 
echo '<table border="1"  >';
   echo '<thead>';
   echo '<tr>';
   echo '<th > Страна </th>';
   echo '<th> Город</th>';
   echo '<th>Отель</th>';
   echo '<th> Дата отправления</th>';
    echo '<th>Продолжительность</th>';
	 echo '<th>Стоимость</th>';
	 
   echo '</tr>';
   echo '</thead>';
   echo '<tbody>';
 

   
   
   
    $d2=mysql_query("SELECT  country_name, city_name, hotel_name, date, duration, cost FROM tour JOIN hotel ON tour.hotel_code=hotel.hotel_code JOIN city ON hotel.city_code=city.city_code JOIN country ON city.country_code=country.country_code WHERE tour.tour_id=$a");
     $d3=mysql_fetch_array($d2);
   
   
   echo '<tr>';
   
      echo ' <td>' . $d3['country_name'] . '</td>';
	
	  
	  echo '<td>' . $d3['city_name'] . '</td>';
	  echo '<td>' . $d3['hotel_name'] . '</td>';
	  echo '<td>' . $d3['date'] . '</td>';
	  echo '<td>' . $d3['duration'] . '</td>';
	  echo '<td>' . $d3['cost'] . '</td>';
	  
	  
	  
	  
	  echo '</tbody>';
   echo '</table>';
   echo '<br><br>';
    echo '<center>';
	echo '<form  method="POST"><input type="submit" name="canc" value="Отмена" style="margin-right:10pt;">';
	echo '<input type="submit" name="del" value="Удалить тур"></center>';
	echo '</form>';
	if (isset($_POST['del']))
	{
	
	$a=mysql_query("DELETE FROM tour WHERE tour_id=$a");
	 echo "<script>
document.location.href='adminmain.php';
</script>";
	}
	else if (isset($_POST['canc']))
	{
	  echo "<script>
document.location.href='adminmain.php';
</script>";
}
echo '</form>';
	echo '</div>';
	?>
</div>
