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
echo '<div class="popup1">';
$a=$_GET['a'];
echo "<script>
document.location.href='#win1';
</script>";
   echo ' <center>';
     echo '<h2>Информация о клиенте: </h2>';
	echo ' </center>';
	
	echo '<table border="1"  >';
   echo '<thead>';
   echo '<tr>';
   echo '<th > ФИО </th>';
   echo '<th> Серия паспорта</th>';
   echo '<th>Номер паспорта</th>';
   echo '<th>Выдан </th>';
    echo '<th>Дата рождения</th>';
	 echo '<th>Серия загранпаспорта</th>';
	  echo '<th>Номер загранпаспорта</th>';
	   echo '<th>Место работы</th>';
	   
	 
	   
	 
   echo '</tr>';
   echo '</thead>';
   echo '<tbody>';
   
     $query=mysql_query("SELECT * FROM client WHERE client_id=".$a."");
	 $d3=mysql_fetch_array($query);
	  echo '<tr>';
   
      echo ' <td>' . $d3['client_fio'] . '</td>';
	  echo '<td>' . $d3['passport_seria'] . '</td>';
	  echo '<td>' . $d3['passport_nomer'] . '</td>';
	  $da1 = new DateTime($d3['kogda_vydan']);
      $da2 = $da1->format('d-m-Y'); 
      echo '<td>' . $d3['kem_vydan'] .' '. $da2.'</td>';
	  $da1 = new DateTime($d3['client_birthday']);
      $da2 = $da1->format('d-m-Y'); 
	  echo '<td>' . $da2 . '</td>';
	  echo '<td>' . $d3['foreign_passport_seria'] . '</td>';
	  echo '<td>' . $d3['foreign_passport_nomer'] . '</td>';
	  echo '<td>' . $d3['job'] . '</td>';
	  
	  echo '</tbody>';
   echo '</table>';

?>
 <a class="close" href="reserved.php"></a>
</div>
</body>
