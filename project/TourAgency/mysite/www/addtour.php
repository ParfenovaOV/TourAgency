<?php
$connect = mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("tour");
if (isset($_POST['add']))
{

$hotel=$_POST['hotel'];

$date=$_POST['date'];
$duration=$_POST['duration'];
$cost=$_POST['cost'];
$article=$_POST['article'];
$description=$_POST['description'];
 $image = file_get_contents( $_FILES['image']['tmp_name'] );
     
      $image = mysql_escape_string( $image );



echo "<script>
document.location.href='adminmain.php';
</script>";
}
?>


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
				<li><a href="adminmain.php">     Главная     </a></li>
				
	</div>
</div>	
<div id="wrapper">

<link rel="stylesheet" type="text/css" href="css/style.css" />
<form enctype='multipart/form-data' method="POST" action="addtour.php">
<div class="add">
<p align="center">
Добавление нового тура:
</p>

<table align="center">

<tr>
<td class="t2">
Заголовок тура:  </td>
<td><input type="text" name="article" style="width:250px;" required /> </td>
</tr>


<?php 
echo "<tr><td class='t2'> Cтрана: </td>";
$country=mysql_query("SELECT * from country");
echo "<td><select  id='country' >";
echo "<optionselected value='0'> </option>";
$res=mysql_query("SELECT * FROM country ORDER BY country_name");

while ($row = mysql_fetch_array($res)){

$select_operator .= "<option value='".$row['country_code']."'";

if($row['country_code'] ==  $_REQUEST['operator']) $select_operator .= " selected ";

$select_operator .= "> ".$row['country_name']."</option>";

}

echo $select_operator;
echo "</td>";
echo "</select>";
echo "</tr>";

echo "<tr><td class='t2'> Город: </td>";


echo "<td><select id='city' name='city' >";
echo " </td>";


echo "</select></tr>";
echo "</div>";

echo "<tr><td class='t2'> Отель: </td>";
echo "<td><select id='hotel' name='hotel' >";
echo "</td>";

echo "</select></tr>";
echo "</div>";
?>
<tr> <td class="t2">
Дата отправления: </td>
<td> <input type='date' name='date' required />  </td> </tr>

<tr> <td class="t2">
Продолжительность тура: </td>
<td> <input type="text" name="duration" required /> ночей </td>
</tr>

<tr> <td class="t2">
Cтоимость: </td>
<td> <input type="text" name="cost" required /> $ </td>
</tr>

<tr> <td class="t2">
Описание: </td>
<td> <textarea name="description" rows=5 cols=30 required> 
</textarea> </td>
</tr>

<tr> <td class="t2">
Изображение: </td>
<td>  <input type="file" name="image" />
 </td>
</tr>

</table>

<input type="submit" name="add" value="Добавить"/></a>
</form>
<?php
if (isset($_POST['add']))
{ echo "<script>
document.location.href='adminmain.php';
</script>";
}
?>
</div>




</div>

<script>
(function () {
    // Будем работать в соответствии с требованиями современного стандарта
    // ECMAScript. Включим строгий режим.
    "use strict";
    // Весь наш основной сценарий будет работать уже после загрузки документа
    jQuery(function () {
        // Пишем обработчик события для выбора значения в первом списке
        // Нас интересует событие изменения значения поля
        $( '#country' ).change(function () {
            // При изменении значения первого списка мы должны удалить
            // все имеющиеся значения во втором и третьем, а также
            // сделать их неактивными
            $( '#city, #hotel' ).find( 'option:not(:first)' )    // Ищем все теги option, не являющиеся тегом по умолчанию
                .remove()   // Удаляем эти теги
                // Чтобы сделать поля неактивными, неправильно менять значение атрибута disabled
                // Теперь нам нужно изменять значение свойства disabled объектов полей списка,
                // так как мы работаем с ними через библиотеку jQuery
                .end()      // Возвращаемся к исходному объекту
                .prop( 'disabled',true );       // Делаем поля неактивными
            // Сохраним выбранное значение списка в переменную
			
            var country_id = $(this).find("option:selected").val();
			
            // Если выбрано значение по умолчанию, ничего не делаем
            if (country_id == 0) { return; }
            // В ином случае нам необходимо отправить запрос на сервер
            // AJAX-запрос к серверу мы выполним, используя метод jQuery ajax()
            $.ajax({
                type: "POST",   // Тип запроса
                url: "query.php",   // Путь к сценарию, обработающему запрос
                dataType: "json",   // Тип данных, в которых сервер должен прислать ответ
                data: "query=getcity&country_id=" + country_id,  // Строка POST-запроса
                
                success: function ( data ) { // Обработчик, который будет запущен после успешного запроса
                    // В ответ на наш запрос сервер должен прислать массив значений
                    // Мы его вставим в поле второго списка с помощью цикла for
                    for ( var i = 0; i < data.length; i++ ) {
                        // Каждое полученное значение вставим в список видов транспорта
                        $( '#city' ).append( '<option value="' + data[i].city_id + '">' + data[i].city + '</option>' );
                    }
                    // После того, как мы сформировали список, мы можем сделать его активным
                    // обратившись к его свойству disabled
                    $( '#city' ).prop( 'disabled', false ); // Включаем поле
                }
            });
        });
        // Пишем обработчик события для выбора значения во втором списке
        // Нас интересует событие изменения значения поля
        $( '#city' ).change(function () {
            // При изменении значения второго списка мы должны удалить
            // все имеющиеся значения в третьем, а также
            // сделать его неактивными
            $( '#hotel' ).find( 'option:not(:first)' )   // Ищем все теги option, не являющиеся тегом по умолчанию
                .remove()   // Удаляем эти теги
                // Чтобы сделать поле неактивным, неправильно менять значение атрибута disabled
                // Теперь нам нужно изменять значение свойства disabled объекта поля списка,
                // так как мы работаем с ним через библиотеку jQuery
                .end()      // Возвращаемся к исходному объекту
                .prop( 'disabled',true );       // Делаем поле неактивным
            // Сохраним выбранное значение списка в переменную
            var city_id = $(this).find("option:selected").val();
            // Сохраним выбранное значение типа транспорта в переменную
            
            // Если выбрано значение по умолчанию, ничего не делаем
            if (city_id == 0) { return; }
            // В ином случае нам необходимо отправить запрос на сервер
            // AJAX-запрос к серверу мы выполним, используя метод jQuery ajax()
            $.ajax({
                type: "POST",   // Тип запроса
                url: "query.php",   // Путь к сценарию, обработающему запрос
                dataType: "json",   // Тип данных, в которых сервер должен прислать ответ
                data: "query=gethotel&city_id=" + city_id , // Строка POST-запроса
               
                success: function ( data1 ) { // Обработчик, который будет запущен после успешного запроса
                    // В ответ на наш запрос сервер должен прислать массив значений
                    // Мы его вставим в поле третьего списка с помощью цикла for
                    for ( var i = 0; i < data1.length; i++ ) {
                        // Каждое полученное значение вставим в список категорий транспорта
                        $( '#hotel' ).append( '<option value="' + data1[i].hotel_id + '">' + data1[i].hotel + ' ' + data1[i].h_class + ' ' + '*' + '</option>' );
                    }
                    // После того, как мы сформировали список, мы можем сделать его активным
                    // обратившись к его свойству disabled
                    $( '#hotel' ).prop( 'disabled', false ); // Включаем поле
                }
            });
        });
        // Никакие обработчичик для поля третьего списка не нужны
    }); // Функция ожидания загрузки документа jQuery
})(); // Немедленно вызываемая функция
</script>

