

<?php
$connect = mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("tour");

// Проверяем наличие переменной, которая укажет данному сценарию какие именно данные нужны
if (!isset($_POST['query']) || !$_POST['query']) {
	exit("Нет данных определяющих тип запроса");
}
else {
	// Сохраняем строку запроса данных в отдельной переменной
	$query = trim($_POST['query']); // Очищаем от лишних пробелов

	// Определяем тип запроса
	switch($query) {
	case 'getcity':	// Запрос на получение видов транспорта
		// Сохраним в переменную значение выбранного типа транспорта
		$country_id = ($_POST['country_id']); // Очистим его от лишних пробелов
		// Формируем массив с ответом
		$result = NULL;
		$i = 0;
		$a=mysql_query("SELECT * FROM city WHERE city.country_code=".$country_id."");
		while ($a1=mysql_fetch_array($a))
		{
		$result[$i]['city_id']=$a1['city_code'];
		$result[$i]['city']=$a1['city_name'];
		$i++;
		}
	break;
	case 'gethotel':	// Запрос на получение видов транспорта
		// Сохраним в переменные значения выбранных типа транспорта и вида транспорта
		
		$city_id = trim($_POST['city_id']);
		// Формируем массив с ответом
		$result = NULL;
		$i = 0;
		$b=mysql_query("SELECT * FROM hotel WHERE hotel.city_code=".$city_id."");
		while ($b1=mysql_fetch_array($b))
		{ 
		$result[$i]['hotel_id']=$b1['hotel_code'];
		$result[$i]['h_class']=$b1['hotel_class'];
		$result[$i]['hotel']=$b1['hotel_name'];
		$i++;
		}
		
		
		
	break;
	case 'gethotelclass':
	$hotel_id=trim($_POST['hotel_id']);
	$result = NULL;
	if ($hotel_id==0)
	{ $result=1;}
	else {$result=0;}
	break;
	
	}
	
	
}

// Преобразуем данные в формат json, чтобы их смог обработать JavaScript-сценарий, приславший запрос
echo json_encode($result);

/**
 * Данный код не идеален. Сама идея представления исходных данных о транспорте в виде массива очень
 * далека от идеала. И вы должны понимать почему. Данные должны храниться в реляционной базе данных, 
 * а представленный вариант написания сценария является лишь простейшим примером, который не стоит 
 * в таком виде применять на практике. Вы здесь должны лишь понять принципы работы языка и взаимодействия
 * между языками программирования
 */
?>