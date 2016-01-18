<head>
 <title> Турагентство </title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<link rel="stylesheet" type="text/css" href="css/style.css" />

 </head>
<?php 


$connect = mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("tour");
$a=$_GET['a'];
$query=mysql_query("UPDATE reservation SET state='Подтверждена' WHERE reservation_id=".$a."");
echo "<script>
document.location.href='reserved.php';
</script>";

?>