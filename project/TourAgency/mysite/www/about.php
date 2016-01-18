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
echo "<li class='righ'><div class='user'> Здравствуйте, ".$userdata[login]." </div></li>";
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
<h2 align="left">•	Для чего на сайте необходима авторизация? </h2> 
<p align="justify"> Авторизация необходима для выполнения процедуры онлайн-бронирования путевки. Все остальные функции сайта доступны и неавторизованным пользователям. </p>

<h2 align="left">•	Как зарегистрироваться на сайте? </h2> 
<p align="justify">Для регистрации нажмите кнопку "Войти" в правом верхнем углу главной страницы сайта: </p>
<img src="1.png" width="580px" height="250px" align="center">
<p align="justify">Появится окно авторизации. Для регистрации на сайте Вам необходимо нажать ссылку "Зарегистрироваться".</p>
<img src="2.png" width="580px" height="250px" align="center">
<p align="justify">Откроется окно регистрации. В нем вам необходимо заполнить все поля и нажать на кнопку "Зарегистрироваться". </p>
<img src="3.png" width="580px" height="250px" align="center">
<p align="justify">При успешной регистрации Вы будете перенаправлены на предыдущую страницу</p>
<h2 align="left">•	Как забронировать путевку? </h2> 
<p align="justify">Для того, чтобы забронировать путевку, Вам необходимо предварительно авторизоваться/зарегистрироваться в системе:</p>
<img src="4.png" width="580px" height="250px" align="center">
<p align="justify">После успешной авторизации на сайте у Вас появится возможность забронировать путевку на любой выбранный тур. Страница просмотра тура будет выглядеть следующим образом:</p>
<img src="5.png" width="580px" height="250px" align="center">
<p align="justify" >При нажатии на кнопку "Забронировать путевку" Вам выводится сообщение об успешной брони и ее номер:</p>
<img src="6.png" width="580px" height="250px" align="center">
<h2 align="left">•	Как оплатить путевку? </h2> 
<p align="justify" >Оплатить путевку можно в нашем агентстве, сообщив менеджеру номер брони. Подтверждение брони также доступно только при личном посещении турагентства. </p>
<h2 align="left">•	Как подобрать тур? </h2> 
<p align="justify" >Вы можете подобрать интересующий Вас тур, заполнив некоторые, наиболее интересующие Вас поля  в форме поиска. Остальные поля Вы можете оставить пустыми: </p>
<img src="7.png" width="250px" height="350px" align="center">





