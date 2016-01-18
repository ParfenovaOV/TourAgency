
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
<form method="GET" action="adminmain.php" id="form10">
<div id="menu">


			<ul>
			<li><a href="adminmain.php">     Главная </a></li>
				<li><a href="addtour.php"> Добавить тур    </a></li>
				
			
				<li><a href="reserved.php"> Просмотр броней </a></li>

<?php 
echo "<li class='righ'><a href='exit2.php'> Выйти </a></li>";


 ?>
	</div>
</div>	
<div id="wrapper">

<?php
$connect = mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("tour");

$d=mysql_query("SELECT tour_id, country_name, city_name, hotel_class, hotel_name, date, duration, cost,quantity FROM tour JOIN hotel ON tour.hotel_code=hotel.hotel_code JOIN city ON hotel.city_code=city.city_code JOIN country ON city.country_code=country.country_code ORDER BY country.country_name");

echo '<table cellpadding="0" cellspacing="0" border="0" id="table" class="sortable">
		<thead>
			<tr>
				
				<th><h3>Страна</h3></th>
				<th><h3>Город</h3></th>
				<th><h3>Отель</h3></th>
				
				<th><h3>Дата отправления</h3></th>
				<th><h3>Продолжительность</h3></th>
				<th><h3>Стоимость</h3></th>
				<th><h3>Количество</h3></th>
				<th class="nosort"></th>
				
				
				
			</tr>
		</thead>';

   while ($d1=mysql_fetch_array($d))
   {
   
   echo '<tr>';
   
   
      echo ' <td>' . $d1['country_name'] . '</td>';
	
	  
	  echo '<td>' . $d1['city_name'] . '</td>';
	  echo '<td>' . $d1['hotel_name'] . '</td>';
	  echo '<td>' . $d1['date'] . '</td>';
	  echo '<td>' . $d1['duration'] . '</td>';
	  echo '<td>' . $d1['cost'] . '</td>';
	  echo '<td>' . $d1['quantity'] . '</td>';
	  echo '<td><a href="update.php?a='.$d1[tour_id].'"><img src="img/programms-00016.png" style="width:25px;height:25px;"></a><a href="deletetour.php?a='.$d1[tour_id].'"><img src="img/w512h5121348753302CuteBallStop.png" style="width:25px;height:25px;"></a> </td></tr>';
	 
	  
	  }
	 
	  echo '</tbody>';
   echo '</table>';
   echo '</form>';
   ?>
   <div id="controls">
		<div id="perpage">
			<select onchange="sorter.size(this.value)" style="width:50px;height:25px;">
			<option value="5">5</option>
				<option value="10" selected="selected">10</option>
				<option value="20">20</option>
				<option value="50">50</option>
				<option value="100">100</option>
			</select>
			<span>туров на странице</span>
		</div>
		<div id="navigation">
			<img src="images/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
			<img src="images/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
			<img src="images/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
			<img src="images/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
		</div>
		<div id="text"> Страница <span id="currentpage"></span> из <span id="pagelimit"></span></div>
	</div>
	<script type="text/javascript" src="script.js"></script>
	<script type="text/javascript">
	
  var sorter = new TINY.table.sorter("sorter");
	sorter.head = "head";
	sorter.asc = "asc";
	sorter.desc = "desc";
	sorter.even = "evenrow";
	sorter.odd = "oddrow";
	sorter.evensel = "evenselected";
	sorter.oddsel = "oddselected";
	sorter.paginate = true;
	sorter.currentid = "currentpage";
	sorter.limitid = "pagelimit";
	sorter.init("table",1);
  </script>
  
  
  
  
	
</div>


