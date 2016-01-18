<?php
$connect = mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("tour");
mysql_query("SET NAMES cp1251");
$date1=$_GET['date1'];
$date2=$_GET['date2'];
if ($date1==0)
{$date1="''";}
if ($date2==0)
{$date2=reservation_date;}

 if (isset($_GET['canc']))
	{
	  echo "<script>
document.location.href='reserved.php';
</script>";
} else
{

define('FPDF_FONTPATH','FPDF/font/');
require('FPDF/fpdf.php');   
require('printing.class.php');
$printing = new Printing();
$printing->Open();
 // Подключаем кириллические шрифты
$printing->AddFont('ArialMT','','arial.php');
$printing->AddFont('Arial-BoldMT','','arialbd.php');
$printing->AddFont('Arial-BoldItalicMT','','arialbi.php');
$printing->AddPage(L); //Добавляем страничку в документ
$printing->Title('Отчет по броням', 'logo2.jpg' ,'ООО "Надежда"','г. Иваново ул. Бубнова д.22 ','тел. 024-263','www.hope.ru'); // Выводим заголовок воспользовавшись новым методом
$header = array("Номер брони", "Клиент", "Дата брони","Страна", "Город","Отель", "Дата вылета", "Стоимость", "Количество"); // Все заголовки столбцов загоняем в массив
$query = mysql_query("SELECT reservation_id, client_fio, reservation_date,res_quantity, country_name, city_name, hotel_name, date, cost FROM reservation JOIN client ON reservation.client_id=client.client_id JOIN tour ON reservation.tour_id=tour.tour_id JOIN hotel ON tour.hotel_code=hotel.hotel_code JOIN city ON hotel.city_code=city.city_code JOIN country ON city.country_code=country.country_code WHERE reservation_date>='$date1' AND reservation_date<='$date2' ORDER BY reservation_id") or die(mysql_error()); 
$printing->OutputTable($header,$query);
$printing->Output();// Выводим документ в браузер

}
?>