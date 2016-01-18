<?php
function generateCode($length=6)
{
$chars="abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPQRSTUVWXYZ0123456789";
$code="";
$clen=strlen($chars)-1;
while (strlen($code)<$length) {
$code .=$chars[mt_rand(0,$clen)];
}
return $code;
}
$connect = mysql_connect("localhost","root","");
mysql_select_db("tour");

if (isset($_POST['enter'])){ 
$query = mysql_query("SELECT * FROM client WHERE login='$_POST[e_login]'");
$user_data = mysql_fetch_array($query);
  if (($user_data["password"] == md5($_POST['e_password']))&&($user_data["login"]!='Admin'))
   { 
   $hash=md5(generateCode(10));
   $a=mysql_query("UPDATE client SET user_hash='".$hash."' WHERE client_id='".$user_data[client_id]."'");
   setcookie("id",$user_data[client_id],time()+60*60*24*30);
   setcookie("hash",$hash,time()+60*60*24*30);
   header("Location: check.php"); exit();
	
   }
   elseif (($user_data["login"]=='Admin')&&($user_data["password"]==$_POST['e_password']))
   {
   $hash=md5(generateCode(10));
   $a=mysql_query("UPDATE client SET user_hash='".$hash."' WHERE client_id='".$user_data[client_id]."'");
   setcookie("id",$user_data[client_id],time()+60*60*24*30);
   setcookie("hash",$hash,time()+60*60*24*30);
   header("Location: check2.php"); exit();
   }
  else {
  echo "<script> history.back(-1); document.write ('Wrong login or password!'); </script>";
  }
   
}
?>