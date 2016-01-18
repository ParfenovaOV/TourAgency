<html>
<head>
 <title> Турагентство </title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 

<link rel="stylesheet" type="text/css" href="css/style.css" />
<script src="http://yandex.st/jquery/1.10.2/jquery.min.js"></script>
 </head>
 
 <body> 
 
 <?php
$connect = mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("tour");
echo '<a href="#x" class="overlay" id="win1"></a>';
echo '<div class="popup">';
$a=$_GET['a'];
echo "<script>
document.location.href='#win1';
</script>";
   echo ' <center>';
     echo '<h2>Информация о туре: </h2>';
	echo ' </center>';
	
	echo '<table border="1"  >';
   echo '<thead>';
   echo '<tr>';
   echo '<th > Страна </th>';
   echo '<th> Город</th>';
   echo '<th>Отель</th>';
   echo '<th>Дата вылета</th>';
    echo '<th>Продолжительность</th>';
	 echo '<th>Стоимость</th>';
	  echo '<th>Количество путевок</th>';
	  
	   
	 
	   
	 
   echo '</tr>';
   echo '</thead>';
   echo '<tbody>';
   
    $d=mysql_query("SELECT tour_id, country_name, city_name, hotel_class, hotel_name, date, duration, cost,quantity FROM tour JOIN hotel ON tour.hotel_code=hotel.hotel_code JOIN city ON hotel.city_code=city.city_code JOIN country ON city.country_code=country.country_code WHERE tour.tour_id=".$a."");

	 $d3=mysql_fetch_array($d);
	  echo '<tr>';
   
      echo ' <td>' . $d3['country_name'] . '</td>';
	  echo '<td>' . $d3['city_name'] . '</td>';
	  echo '<td>' . $d3['hotel_name'] .' '.$d3['hotel_class'].'* </td>';
	  $da1 = new DateTime($d3['date']);
      $da2 = $da1->format('d-m-Y'); 
      echo '<td>' .$da2.'</td>';
	  echo '<td>' . $d3['duration']. '</td>';
	  echo '<td>' . $d3['cost'] . '</td>';
	  echo '<td>' . $d3['quantity'] . '</td>';
	  
	  
	  echo '</tbody>';
   echo '</table>';

?>
 <a class="close" href="reserved.php"></a>
</div>
</body>
