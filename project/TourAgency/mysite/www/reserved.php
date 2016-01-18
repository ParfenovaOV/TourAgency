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
<form method="GET" action="reserved.php" id="form10">
<div id="menu">


			<ul>
			<li><a href="adminmain.php">     Главная </a></li>
				<li><a href="addtour.php"> Добавить тур    </a></li>
				
			
				<li><a href="#"><input type="submit" name="report" class="b1" value="Сформировать отчет"></a></li>
</form>
<?php 
echo "<li class='righ'><a href='exit2.php'> Выйти </a></li>";


 ?>
	</div>
</div>	
<div id="wrapper">

<?php
$connect = mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("tour");
$query = mysql_query("SELECT reservation_id, reservation.tour_id, client_fio,reservation.client_id, state, reservation_date,res_quantity, country_name, city_name, hotel_name, date, cost FROM reservation JOIN client ON reservation.client_id=client.client_id JOIN tour ON reservation.tour_id=tour.tour_id JOIN hotel ON tour.hotel_code=hotel.hotel_code JOIN city ON hotel.city_code=city.city_code JOIN country ON city.country_code=country.country_code WHERE date>=".date('Y-m-d')." ORDER BY reservation_id") or die(mysql_error()); 
echo '<table cellpadding="0" cellspacing="0" border="0" id="table" class="sortable">
		<thead>
			<tr>
				
				<th><h3>Клиент</h3></th>
				<th><h3>Тур</h3></th>
				<th><h3>Дата брони</h3></th>
				
				<th><h3>Количество путевок</h3></th>
				<th><h3>Статус</h3></th>
				<th class="nosort"></th>
			
			</tr>
		</thead>';

while ($d1=mysql_fetch_array($query))
   {
   
   echo '<tr>';
      echo '<td><a href="client.php?a='.$d1[client_id].'">'. $d1['client_fio'] . '</a></td>';
	  echo '<td><a href="tour1.php?a='.$d1[tour_id].'">' . $d1['tour_id'] . '</a></td>';
	  $da1 = new DateTime($d1['reservation_date']);
      $da2 = $da1->format('d-m-Y');
	  echo '<td>' . $da2 . '</td>';
	  echo '<td>' . $d1['res_quantity'] . '</td>';
	 // echo '<td><select id="state" name="state">';
	  //$states=array("Неподтверждена","Подтверждена","Оплачена");
	//  echo '<option selected value="4">'.$d1[state].'</option>';
	 // for ($i=0;$i<count($states);$i++)
	  // {
	  // if ($states[$i]!=$d1[state])
	  // {
	  // echo '<option value="'.$i.'">'.$states[$i].'</option>';
	  // }
	  // }
	  echo "<td>".$d1[state]."</td>";
	  
	if ($d1[state]=="Неподтверждена")
	{
	 echo '<td><a href="save.php?a='.$d1[reservation_id].'">Подтвердить бронь</a></td>';
	 }
	 else
	 echo '<td></td>';
echo '</tr>';
	  }
	  
	   echo '</tbody>';
   echo '</table>';
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
			<span>броней на странице</span>
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

<?php
  
echo '<a href="#x" class="overlay" id="win1"></a>';

   echo '<div class="popup">';
  
  if (isset($_GET['report']))
  {
   echo "<script>
document.location.href='#win1';
</script>";
echo "<center>";
echo "Выберите даты для формирования отчета: <br><br>";
echo "<form action='report.php' method='GET'>";
echo "C <input type='date' name='date1'> по <input type='date' name='date2'> <br><br>";

echo "<input type='submit' name='canc' value='Отмена' style='margin-right: 10pt;'>";
echo "<input type='submit' name='report' value='Сформировать отчет'>";
echo "</center>";
echo "</form>";
echo '<a class="close" href="#close"></a>';
}
  
?>	

		

 
