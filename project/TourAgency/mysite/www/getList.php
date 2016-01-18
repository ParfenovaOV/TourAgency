<?php 
$connect = mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("tour");

// Если выбрано значение первого списка - формируем второй список
if ( !isset($_GET['city']) ) {
  // Получаем из БД список производителей
  $query = 'SELECT * FROM city             
            WHERE city.country_code='.$_GET['category'].'';
  $res = mysql_query( $query );
  $makerOptions = '<option value="0">Выберите</option>';
  while ( $mkr = mysql_fetch_array( $res ) ) {
    $makerOptions = $makerOptions.'<option value="'.$mkr['city_id'].'">'.$mkr['city_name'].'</option>';
  }
  $response = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'.
              '<response>'.
                '<action>'.
                'makeMakerList'.
                '</action>'.
                '<options>'.
                $makerOptions.
                '</options>'.
              '</response>';
} else { // Если выбрано значение из списка производителей - формируем список товаров
  $query = 'SELECT * FROM hotel
            WHERE hotel_code='.$_GET['city'].'';
  $res = mysql_query( $query ); 
  $productOptions = '<option value="0">Выберите</option>';
  while( $prd = mysql_fetch_array( $res ) ) {
    $productOptions = $productOptions.'<option value="'.$prd['hotel_code'].'">'.$prd['hotel_name'].'</option>';
  }
  $response = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'.
              '<response>'.
                '<action>'.
                'makeProductList'.
                '</action>'.
                '<options>'.
                $productOptions.
                '</options>'.
              '</response>';
}

header('Content-Type: text/xml');
echo $response;
?>



