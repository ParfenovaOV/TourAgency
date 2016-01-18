<?php 
$connect = mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("tour");
$id = $_GET['ident'];
$a=mysql_query("SELECT img from tour where tour_id='$id'");
$a2=mysql_fetch_array($a);
header("Content-type: image/*");
echo $a2['img'];
?>