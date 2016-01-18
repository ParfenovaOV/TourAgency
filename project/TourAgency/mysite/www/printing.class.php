<?php
$connect = mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("tour");


class Printing extends FPDF {
    function Title($title,$image, $company_name,$company_adres,$company_tel,$company_site) {
      $this->Image($image,6,6,60,20);
        $this->Cell(70); // выводим пустую €чейку, ширина которой 30
        $this->SetFont('Arial-BoldMT','',10); // задаем шрифт, и размер шрифта
        $this->Cell(30,4,$company_name,0,0,'L',0); // выводим название компании
        $this->Cell(120);
        $this->SetFillColor(187,189,189);  // задаем цвет заливки следующих €чеек (R,G,B)
        $this->Cell(50,4,$title,0,0,'C',1); // выводим наименование компании
        $this->ln(); // переходим на следующую строку
        $this->Cell(70);
        $this->SetFont('ArialMT','',10);
        $this->Cell(40,4,$company_adres,0,10,'L',0); // выводим адрес компании
        $this->Cell(40,4,$company_tel,0,10,'L',0); // выводим телфон компании
        $this->Cell(40,4,$company_site,0,10,'L',0); // выводим адрес сайта компании
        $this->ln();
        $this->ln(); 
    }
function OutputTable($header,$query) {
        $w=array(25,60,25,25,25,30,27,22,25,10); // ћассив с шириной столбцов
        $this->Cell(10);
        $this->SetFont('Arial-BoldMT','',11);
        for($i=0;$i<count($header);$i++){$this->Cell($w[$i],7,$header[$i],1,0,'C');}
        $this->Ln();
        $this-> SetFont('ArialMT','',10);
		$a=0;
        while($array = mysql_fetch_array($query))
             {
              $this->Cell(10);
              $this->Cell(25,4,$array['reservation_id'],1,0,'C',0);
              $this->Cell(60,4,$array['client_fio'],1,0,'L',0);
			  $da1 = new DateTime($array['reservation_date']);
              $da2 = $da1->format('d-m-Y');
			  $this->Cell(25,4,$da2,1,0,'C',0);
              $this->Cell(25,4,$array['country_name'],1,0,'C',0);
              $this->Cell(25,4,$array['city_name'],1,0,'C',0);
              $this->Cell(30,4,$array['hotel_name'],1,0,'C',0,1);
			  $da1 = new DateTime($array['date']);
              $da2 = $da1->format('d-m-Y'); 
			  $this->Cell(27,4,$da2,1,0,'C',0);
              $this->Cell(22,4,$array['cost'],1,0,'C',0,1);
			  $this->Cell(25,4,$array['res_quantity'],1,0,'C',0,1);
              $this->ln();
			  $a=$a+$array['cost']*$array['res_quantity'];
             }
			 $this->Cell(10);
			 $this->SetFont('Arial-BoldMT','',11);
			 $this->Cell(239,7,'»того:',1,0,'L');
			  $this->Cell(25,7,$a.' $',1,0,'C',0,1);
    }
}
?>