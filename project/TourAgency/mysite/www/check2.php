<?php
$connect = mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("tour");
if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{
$query=mysql_query("SELECT * FROM client WHERE client_id='".intval($_COOKIE[id])."'");
$userdata=mysql_fetch_array($query);
if (($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['client_id'] !== $_COOKIE['id']))
{
setcookie("id", "", time() - 3600*24*30*12, "/");

        setcookie("hash", "", time() - 3600*24*30*12, "/");

        print "Ошибка!";
		}
		
		 

    else

    {
echo "<script>
document.location.href='adminmain.php';
</script>";
    }
	}
	?>
