<?php

use Mpdf\Tag\Tr;

include("connect.php");
require('../fpdf/fpdf.php');

class PDF extends FPDF

{
    function Header()
    {

        $this->AddFont('angsa', '', 'angsab.php');
        $this->SetFont('angsa', '', 15);
        $this->Cell(12);

        $this->Cell(100, 10, 'บันทึกค่าใช้จ่ายโครงการ', 0, 1);

        //dummy cell to give line spacing
        //$this->Cell(0,5,'',0,1);
        //is equivalent to:
        $this->Ln(5);

        // $this->SetFont('Arial', 'B', 11);
        $this->AddFont('angsa', '', 'angsab.php');
        $this->SetFont('angsa', '', 11);

        $this->SetFillColor(255, 161, 245);
        $this->SetDrawColor(0, 0, 0);
        $this->Cell(20, 5, 'NO', 1, 0, 'C', true);
        $this->Cell(40, 5, 'Name', 1, 0, 'C', true);
        $this->Cell(85, 5, 'Desc', 1, 0, 'C', true);
        $this->Cell(25, 5, 'price', 1, 1, 'C', true);
    }
}


//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm
$pdf = new PDF('P', 'mm', 'A4'); //use new class

//define new alias for total page numbers
$pdf->AliasNbPages('{pages}');

$pdf->SetAutoPageBreak(true, 15);
$pdf->AddPage();

// $pdf->SetFont('Arial', '', 9);
$pdf->AddFont('angsa', '', '../fpdf/font/angsab.php');
$pdf->SetFont('angsa', '', 9);
$pdf->SetDrawColor(0, 0, 0);


$query = mysqli_query($conn, "SELECT * FROM `project_hd` JOIN project USING(project_id) JOIN customer USING(cus_id) WHERE project_hd.void = 0");
while ($data = mysqli_fetch_array($query)) {
    $pdf->Cell(40, 5, $data['headcode'], 1, 0);
    $pdf->Cell(85, 5, $data['datesave'], 1, 0);
    $pdf->Cell(85, 5, $data['receiptcode'], 1, 0);
    $pdf->Cell(85, 5, $data['datereceipt'], 1, 0);
    $pdf->Cell(85, 5, $data['project_id'], 1, 0);
    $pdf->Cell(85, 5, $data['totalprice'], 1, 0);
    $pdf->Cell(25, 5, $data['receiptcode'], 1, 1, 'C');
}
$pdf->Cell(40, 10, iconv('UTF-8', 'cp874', $data));
$pdf->Output('Myreport.pdf', 'F');
