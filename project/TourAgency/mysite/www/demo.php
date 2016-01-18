<?php


require_once( "fpdf/fpdf.php" );

// РќР°С‡Р°Р»Рѕ РєРѕРЅС„РёРіСѓСЂР°С†РёРё

$textColour = array( 0, 0, 0 );
$headerColour = array( 100, 100, 100 );
$tableHeaderTopTextColour = array( 255, 255, 255 );
$tableHeaderTopFillColour = array( 125, 152, 179 );
$tableHeaderTopProductTextColour = array( 0, 0, 0 );
$tableHeaderTopProductFillColour = array( 143, 173, 204 );
$tableHeaderLeftTextColour = array( 99, 42, 57 );
$tableHeaderLeftFillColour = array( 184, 207, 229 );
$tableBorderColour = array( 50, 50, 50 );
$tableRowFillColour = array( 213, 170, 170 );
$reportName = "Р—Р°Р±СЂРѕРЅРёСЂРѕРІР°РЅРЅС‹Рµ С‚СѓСЂС‹";
$reportNameYPos = 10;
$logoFile = "logo.png";
$logoXPos = 10;
$logoYPos = 10;
$logoWidth = 110;
$columnLabels = array( "Q1", "Q2", "Q3", "Q4" );
$rowLabels = array( "SupaWidget", "WonderWidget", "MegaWidget", "HyperWidget" );
$chartXPos = 20;
$chartYPos = 250;
$chartWidth = 160;
$chartHeight = 80;
$chartXLabel = "Product";
$chartYLabel = "2009 Sales";
$chartYStep = 20000;

$chartColours = array(
                  array( 255, 100, 100 ),
                  array( 100, 255, 100 ),
                  array( 100, 100, 255 ),
                  array( 255, 255, 100 ),
                );

$data = array(
          array( 9940, 10100, 9490, 11730 ),
          array( 19310, 21140, 20560, 22590 ),
          array( 25110, 26260, 25210, 28370 ),
          array( 27650, 24550, 30040, 31980 ),
        );

// РљРѕРЅРµС† РєРѕРЅС„РёРіСѓСЂР°С†РёРё


/**
  РЎРѕР·РґР°РµРј С‚РёС‚СѓР»СЊРЅСѓСЋ СЃС‚СЂР°РЅРёС†Сѓ
**/

$pdf = new FPDF( 'P', 'mm', 'A4' );
$pdf->AddFont('ArialMT','','arial.php');
$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
$pdf->AddPage();

// Р›РѕРіРѕС‚РёРї
$pdf->Image( $logoFile, $logoXPos, $logoYPos, $logoWidth );

// РќР°Р·РІР°РЅРёРµ РѕС‚С‡РµС‚Р°
$pdf->SetFont( 'ArialMT','','arial.php');
$pdf->Ln( $reportNameYPos );
$pdf->Cell( 0, 15, $reportName, 0, 0, 'C' );


/**
  РЎРѕР·РґР°РµРј РєРѕР»РѕРЅС‚РёС‚СѓР», Р·Р°РіРѕР»РѕРІРѕРє Рё РІРІРѕРґРЅС‹Р№ С‚РµРєСЃС‚
**/

$pdf->AddPage();
$pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
$pdf->SetFont( 'ArialMT','','arial.php' );
$pdf->Cell( 0, 15, $reportName, 0, 0, 'C' );
$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
$pdf->SetFont( 'ArialMT','','arial.php');
$pdf->Write( 19, "2009 Was A Good Year" );
$pdf->Ln( 16 );
$pdf->SetFont( 'ArialMT','','arial.php');
$pdf->Write( 6, "Despite the economic downturn, WidgetCo had a strong year. Sales of the HyperWidget in particular exceeded expectations. The fourth quarter was generally the best performing; this was most likely due to our increased ad spend in Q3." );
$pdf->Ln( 12 );
$pdf->Write( 6, "2010 is expected to see increased sales growth as we expand into other countries." );


/**
  РЎРѕР·РґР°РµРј С‚Р°Р±Р»РёС†Сѓ
**/

$pdf->SetDrawColor( $tableBorderColour[0], $tableBorderColour[1], $tableBorderColour[2] );
$pdf->Ln( 15 );

// РЎРѕР·РґР°РµРј СЃС‚СЂРѕРєСѓ Р·Р°РіРѕР»РѕРІРєРѕРІ
$pdf->SetFont( 'ArialMT','','arial.php' );

// РЇС‡РµР№РєР° "PRODUCT"
$pdf->SetTextColor( $tableHeaderTopProductTextColour[0], $tableHeaderTopProductTextColour[1], $tableHeaderTopProductTextColour[2] );
$pdf->SetFillColor( $tableHeaderTopProductFillColour[0], $tableHeaderTopProductFillColour[1], $tableHeaderTopProductFillColour[2] );
$pdf->Cell( 46, 12, " PRODUCT", 1, 0, 'L', true );

// РћСЃС‚Р°Р»СЊРЅС‹Рµ СЏС‡РµР№РєРё Р·Р°РіРѕР»РѕРІРєРѕРІ
$pdf->SetTextColor( $tableHeaderTopTextColour[0], $tableHeaderTopTextColour[1], $tableHeaderTopTextColour[2] );
$pdf->SetFillColor( $tableHeaderTopFillColour[0], $tableHeaderTopFillColour[1], $tableHeaderTopFillColour[2] );

for ( $i=0; $i<count($columnLabels); $i++ ) {
  $pdf->Cell( 36, 12, $columnLabels[$i], 1, 0, 'C', true );
}

$pdf->Ln( 12 );

// РЎРѕР·РґР°РµРј СЃС‚СЂРѕРєРё СЃ РґР°РЅРЅС‹РјРё

$fill = false;
$row = 0;

foreach ( $data as $dataRow ) {

  // Create the left header cell
  $pdf->SetFont( 'ArialMT', '', 15 );
  $pdf->SetTextColor( $tableHeaderLeftTextColour[0], $tableHeaderLeftTextColour[1], $tableHeaderLeftTextColour[2] );
  $pdf->SetFillColor( $tableHeaderLeftFillColour[0], $tableHeaderLeftFillColour[1], $tableHeaderLeftFillColour[2] );
  $pdf->Cell( 46, 12, " " . $rowLabels[$row], 1, 0, 'L', $fill );

  // Create the data cells
  $pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
  $pdf->SetFillColor( $tableRowFillColour[0], $tableRowFillColour[1], $tableRowFillColour[2] );
  $pdf->SetFont( 'ArialMT','','119379869a251bdd6a14438b3c5514f2_arial.php' );

  for ( $i=0; $i<count($columnLabels); $i++ ) {
    $pdf->Cell( 36, 12, ( '$' . number_format( $dataRow[$i] ) ), 1, 0, 'C', $fill );
  }

  $row++;
  $fill = !$fill;
  $pdf->Ln( 12 );
}


/***
  РЎРѕР·РґР°РµРј РіСЂР°С„РёРє
***/

// Р’С‹С‡РёСЃР»СЏРµРј РјР°СЃС€С‚Р°Р± РїРѕ РѕСЃРё X
$xScale = count($rowLabels) / ( $chartWidth - 40 );

// Р’С‹С‡РёСЃР»СЏРµРј РјР°СЃС€С‚Р°Р± РїРѕ РѕСЃРё Y

$maxTotal = 0;

foreach ( $data as $dataRow ) {
  $totalSales = 0;
  foreach ( $dataRow as $dataCell ) $totalSales += $dataCell;
  $maxTotal = ( $totalSales > $maxTotal ) ? $totalSales : $maxTotal;
}

$yScale = $maxTotal / $chartHeight;

// Р’С‹С‡РёСЃР»СЏРµРј С€РёСЂРёРЅСѓ СЃС‚РѕР»Р±С†Р°
$barWidth = ( 1 / $xScale ) / 1.5;

// Р”РѕР±Р°РІР»СЏРµРј РѕСЃРё:

$pdf->SetFont( 'ArialMT', '', 10 );

// РћСЃСЊ X
$pdf->Line( $chartXPos + 30, $chartYPos, $chartXPos + $chartWidth, $chartYPos );

for ( $i=0; $i < count( $rowLabels ); $i++ ) {
  $pdf->SetXY( $chartXPos + 40 +  $i / $xScale, $chartYPos );
  $pdf->Cell( $barWidth, 10, $rowLabels[$i], 0, 0, 'C' );
}

// РћСЃСЊ Y
$pdf->Line( $chartXPos + 30, $chartYPos, $chartXPos + 30, $chartYPos - $chartHeight - 8 );

for ( $i=0; $i <= $maxTotal; $i += $chartYStep ) {
  $pdf->SetXY( $chartXPos + 7, $chartYPos - 5 - $i / $yScale );
  $pdf->Cell( 20, 10, '$' . number_format( $i ), 0, 0, 'R' );
  $pdf->Line( $chartXPos + 28, $chartYPos - $i / $yScale, $chartXPos + 30, $chartYPos - $i / $yScale );
}

// Р”РѕР±Р°РІР»СЏРµРј РјРµС‚РєРё РѕСЃРµР№
$pdf->SetFont( 'ArialMT', '', 12 );
$pdf->SetXY( $chartWidth / 2 + 20, $chartYPos + 8 );
$pdf->Cell( 30, 10, $chartXLabel, 0, 0, 'C' );
$pdf->SetXY( $chartXPos + 7, $chartYPos - $chartHeight - 12 );
$pdf->Cell( 20, 10, $chartYLabel, 0, 0, 'R' );

// РЎРѕР·РґР°РµРј СЃС‚РѕР»Р±С†С‹ РіСЂР°С„РёРєР°
$xPos = $chartXPos + 40;
$bar = 0;

foreach ( $data as $dataRow ) {

  // Р’С‹С‡РёСЃР»СЏРµРј СЃСѓРјРјР°СЂРЅРѕРµ Р·РЅР°С‡РµРЅРёРµ РґР»СЏ РїСЂРѕРґСѓРєС‚Р°
  $totalSales = 0;
  foreach ( $dataRow as $dataCell ) $totalSales += $dataCell;

  // Р’С‹РІРѕРґРёРј СЃС‚РѕР»Р±РµС†
  $colourIndex = $bar % count( $chartColours );
  $pdf->SetFillColor( $chartColours[$colourIndex][0], $chartColours[$colourIndex][1], $chartColours[$colourIndex][2] );
  $pdf->Rect( $xPos, $chartYPos - ( $totalSales / $yScale ), $barWidth, $totalSales / $yScale, 'DF' );
  $xPos += ( 1 / $xScale );
  $bar++;
}


/***
  Р’С‹РІРѕРґРёРј PDF
***/

$pdf->Output( "report.pdf", "I" );

?>

