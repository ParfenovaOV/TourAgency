<head>
 <title> Турагентство </title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<link rel="stylesheet" type="text/css" href="css/style.css" />

 </head>
<?php
$connect = mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("tour");
echo '<a href="#x" class="overlay" id="win1"></a>';
 if (isset($_POST[cancel]))
 {
   echo "<script>
   document.location.href='personal.php';
   </script>";
 }
 elseif (isset($_POST[update]))
 {
 $query=mysql_query("UPDATE reservation SET res_quantity=".$_POST[quantity]." WHERE reservation_id=".$_GET[a]."");
  echo "<script>
document.location.href='personal.php';
</script>";
 }	
	?>