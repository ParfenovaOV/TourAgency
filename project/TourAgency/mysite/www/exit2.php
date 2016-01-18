<?php
$connect = mysql_connect("localhost","root","");
mysql_select_db("tour");

setcookie("id", "", time() - 3600*24*30*12, "/");

        setcookie("hash", "", time() - 3600*24*30*12, "/");
	



echo "<script>
document.location.href='index.php';
</script>";
?>