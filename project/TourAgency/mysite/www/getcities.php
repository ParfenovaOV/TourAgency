<?php
$connect = mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("tour");

$a=mysql_query("SELECT * FROM city WHERE city.country_code='$_GET[countryCode]'");


echo "obj.options[obj.options.length] = new Option('Москва','1')";  
  
   


?> 