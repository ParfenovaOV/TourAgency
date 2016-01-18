<?php
$connect = mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("tour");

// if (!isset($_POST['query1']) || !$_POST['query1']) {
	// exit("Нет данных определяющих тип запроса");
}

	// Сохраняем строку запроса данных в отдельной переменной
	$query = $_POST['state_id']; 
	//$query1=$_POST['res_id'];
	$a=mysql_query("UPDATE reservation SET state='".$query."'") or die(mysql_error());
	
	
	
	?>
