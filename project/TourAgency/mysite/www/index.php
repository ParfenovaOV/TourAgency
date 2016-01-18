<?php
$connect = mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("tour");

?>
<html>
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
<div id="menu">


			<ul>
				<li><a href="index.php">     Главная     </a></li>
				<li><a href="about.php">     О сайте     </a></li>
				<li><a href="#">     Контакты     </a></li>
<?php 
if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{
$query=mysql_query("SELECT * FROM client WHERE client_id='".intval($_COOKIE[id])."'");
$userdata=mysql_fetch_array($query);
if (($userdata['user_hash'] == $_COOKIE['hash']))
{
{

echo "<li class='righ'><a href='exit.php'> Выйти </a></li>";
echo "<li class='righ'><a href='personal.php'> Личный кабинет пользователя ".$userdata[login]." </a></li>";
}
}
}
else 
 
 echo "<li class='righ'>  <a href='#win2'>     Войти     </a>  </li> ";
 ?>
 
 
 <a href="#x" class="overlay" id="win2"></a>
<div class="popup">

 <div> <h2> Вход на сайт: </h2> </div>
<form method="POST" action="autor.php">
<div><p text-align="center"><input type="text" name="e_login" placeholder="Логин" required/> </p> </div>
<div> <input type="password" name="e_password" placeholder="Пароль" required/> </div>
<div> <p text-align="center"><input type="submit" name="enter" value="Войти"/> </p> </div>
</form>
<div><a href="register.php"> Зарегистрироваться </a> </div>
<a class="close" href="#close"></a>
		</div>
</ul>


		
</div>
</div>

<div id="wrapper">
<div class= "content">
<div class="left">

<?php 
 $a=mysql_query("SELECT tour_id,article, city_name, hotel_name, date, duration, cost FROM tour JOIN hotel ON tour.hotel_code=hotel.hotel_code JOIN city ON hotel.city_code=city.city_code JOIN country ON city.country_code=country.country_code WHERE quantity>0");
while ($a2=mysql_fetch_array($a))
{
$ident = $a2['tour_id'];
echo '<div class="article">';
echo '<a href="tour.php?a='.$ident.'"> <h2>';
 echo $a2['article']; 

echo '</h2> </a>';
 $ident = $a2['tour_id'];
echo '<img src="img.php?ident='.$ident.'" alt="" width="180px" height="140px"/>';
echo '<p text-align="center">';
echo 'Город:' .$a2['city_name'];
echo '<br> <br>';
echo 'Вылет:' .$a2['date'];
echo '<br> <br>';
echo 'Продолжительность:' .$a2['duration']. ' ночей';
echo '<br> <br>';
echo 'Стоимость:' .$a2['cost']. ' $';
echo '</p>';
echo '<div style="clear:both;"> </div>';
echo '</div>';
}


?>

 

 </div>
 
</div>
<div class="right"> 
<div class="right_menu">
<div id='search'>
</div>
<div class='a'>
<h2> Поиск туров: </h2>
<form action="search.php" method="POST" id="dynamic_selects">
<?php

echo "<div class='row'>";
echo "<label for='country'> Страна: </label>";
echo "<select  id='country' name='country' >";
echo "<option selected value='0'> Любая </option>";
$res=mysql_query("SELECT * FROM country ORDER BY country_name");

while ($row = mysql_fetch_array($res)){

$select_operator .= "<option value='".$row['country_code']."'";

if($row['country_code'] ==  $_REQUEST['operator']) $select_operator .= " selected ";

$select_operator .= "> ".$row['country_name']."</option>";

}

echo $select_operator;




echo "</select>";
echo "</div>";

echo "<div class='row'>";
echo "<label for='city'> Город: </label>";

echo "<select id='city' name='city' >";
echo "<option value='0'> Любой </option>";


echo "</select>";
echo "</div>";


echo "<div class='row'>";
echo "<label for='hot'> Категория отеля: </label>";
echo "<select name='hotel_class' id='hotel_class' class='h'>";
echo "<option value='0'> Любая </option>";
echo "<option value='2'> 2 * </option>";
echo "<option value='3'> 3 * </option>";
echo "<option value='4'> 4 * </option>";
echo "<option value='5'> 5 * </option>";
echo "</select></div>";

echo "<div class='row'>";
echo "<label for='city'> Вылет от: </label>";
echo "<input type='date' name='date1' class='d'>";
echo "</div>";

echo "<div class='row'>";
echo "<label for='city'> Вылет до: </label>";
echo "<input type='date' name='date2' class='d'>";
echo "</div>";

echo "<div class='row'>";
echo "<label for='city'> Длительность: </label>";
echo "<select name='duration' id='duration' class='m'>";
echo "<option value='0'> Любая </option>";
echo "<option value='1'> 2-6 ночей </option>";
echo "<option value='7'> 7 ночей </option>";
echo "<option value='8'> 8-13 ночей </option>";
echo "<option value='15'> >14 ночей </option>";
echo "</select></div>";


echo "<div class='row'>";
echo "<label for='city'> Цена от: </label>";
echo "<input type='text' class='d' name='price1' style='width: 50px;'> $ ";
echo "<label for='city'> до: </label>";
echo "<input type='text' class='d' name='price2' style='width: 50px' > $ ";
echo "</div>";


echo "<br>";
echo "<input type='submit' name='search' value='Найти' style='width: 80px; height: 30px; font: 12pt Arial; margin-top: -23px;'>";

if (isset($_POST['search']))
{
echo "<script>
document.location.href='search.php';
</script>"; }
echo "</div>";
?>
</form>
<script>
(function () {
   
    "use strict";
   
    jQuery(function () {
        $( '#country' ).change(function () {
     
            $( '#city, #hotel' ).find( 'option:not(:first)' )  
                .remove()  
                .end()     
                .prop( 'disabled',true );     
            var country_id = $(this).find("option:selected").val();
			if (country_id==0) {return;}
            $.ajax({
                type: "POST",  
                url: "query.php",  
                dataType: "json",  
                data: "query=getcity&country_id=" + country_id, 
                
                success: function ( data ) { 
                    for ( var i = 0; i < data.length; i++ ) {
                       
                        $( '#city' ).append( '<option value="' + data[i].city_id + '">' + data[i].city + '</option>' );
                    }
                  
                    $( '#city' ).prop( 'disabled', false ); 
                }
            });
        });
      
        $( '#city' ).change(function () {
           
            $( '#hotel' ).find( 'option:not(:first)' )   
                .remove()  
                .end()      
                .prop( 'disabled',true );     
            var city_id = $(this).find("option:selected").val();
           
            if (city_id == 0) { return; }
           
            $.ajax({
                type: "POST",  
                url: "query.php",  
                dataType: "json",  
                data: "query=gethotel&city_id=" + city_id , 
               
                success: function ( data1 ) {
                    
                    for ( var i = 0; i < data1.length; i++ ) {
                       
                        $( '#hotel' ).append( '<option value="' + data1[i].hotel_id + '">' + data1[i].hotel + ' ' + data1[i].h_class + ' ' + '*' + '</option>' );
                    }
                   
                    $( '#hotel' ).prop( 'disabled', false ); 
                }
			
            });
		
        });
		$( '#hotel' ).change(function () {
		var hotel_id = $('#hotel').find("option:selected").val();
			$.ajax({
			type:"POST", 
			url: "query.php",
			dataType: "json",
			data: "query=gethotelclass&hotel_id="+hotel_id,
			success: function(data){
			if (data == 0) { $('#hotel_class').prop('disabled', true); } } });
			});
       
    }); 
})();

</script>


 </div>
</div>

<div style="clear:both;"> </div>

 </div>
<div class="footer">.

 </div>

</div>



</body>
</html>
