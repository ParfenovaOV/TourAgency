<?php 
$connect = mysql_connect("localhost","root","");
mysql_select_db("tour");
$a1=$_GET['a'];
if (isset($_POST['reserve']))
{ 
$query1=mysql_query("SELECT MAX(reservation_id) AS reservation_id FROM reservation") or die(mysql_error());
$query2=mysql_fetch_array($query1);
setcookie("reserve",$query2['reservation_id']+1,time()+60*60*24*30);
}

if (isset($_POST[canc]))
{
echo "<script>
history.go(-2);
</script>";
}
elseif (isset($_POST[res]))
{
$b=$_GET['a'];
$query=mysql_query("UPDATE tour SET quantity=quantity-".$_POST[quantity]." WHERE tour_id=".$b."");
$query=mysql_query("INSERT INTO reservation VALUES ('','".$b."','".$_COOKIE[id]."','".date('Y.m.d')."','Неподтверждена','".$_POST[quantity]."')") or die(mysql_error());

$query2=mysql_query("SELECT MAX(reservation_id) AS reservation_id  FROM reservation") or die(mysql_error());
$query2=mysql_fetch_array($query2);

 setcookie("quantity",$_POST[quantity],time()+60*60*24*30);

}
?>
<script>
history.go(-1);
</script>
