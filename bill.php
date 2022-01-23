<?php
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf([
    'tempDir' => __DIR__ . '/tmp'
]);
$mpdf->AddPage();

$mpdf->SetFont('Arial','B',14);

$mpdf->Cell(130 ,5,'JK SUPERMARKET',0,0);
$mpdf->Cell(59 ,5,'INVOICE',0,1);

$mpdf->SetFont('Arial','',12);

$mpdf->Cell(130 ,5,'EDAMATTAM',0,0);
$mpdf->Cell(59 ,5,'',0,1);//end of line

$mpdf->Cell(130 ,5,'Bharanaganm, Kerala, 686651]',0,0);
$mpdf->Cell(25 ,5,'Date',0,0);

$today = date('d-m-Y');
$mpdf->Cell(34 ,5,$today,0,1);//end of line

$mpdf->Cell(130 ,5,'Phone [+9400623012]',0,0);
$mpdf->Cell(25 ,5,'Invoice No',0,0);
$mpdf->Cell(34 ,5,'[1234567]',0,1);//end of line

$mpdf->Cell(130 ,5,'Fax [+12345678]',0,0);


$mpdf->Cell(189 ,10,'',0,1);//end of line



//make a dummy empty cell as a vertical spacer
$mpdf->Cell(189 ,10,'',0,1);//end of line

//invoice contents
$mpdf->SetFont('Arial','B',12);
$inoviceno = json_decode($_GET["invoice"]);
$discount = json_decode($_GET["discount"]);

$conn = mysqli_connect("localhost","root","root","shop");
// echo $conn;
// echo "uuu";die;
// //Check for connection error
if($conn->connect_error){
  die("Error in DB connection: ".$conn->connect_errno." : ".$conn->connect_error);    
}
// // Select data from MySQL database

$select = "SELECT * FROM `invoice` WHERE invoice_number='".$inoviceno."'";

$result = $conn->query($select);
$data = array();


$mpdf->Cell(80 ,5,'Item Name',1,0);
$mpdf->Cell(25 ,5,'Quantity',1,0);
$mpdf->Cell(25 ,5,'Unit Price',1,0);
$mpdf->Cell(25 ,5,'Tax',1,0);
$mpdf->Cell(34 ,5,'Total',1,1);

$mpdf->SetFont('Arial','',12);
$sub_total=0;
$bill_amount=0;
while($row = $result->fetch_object()){
$mpdf->Cell(80 ,5,$row->item_name,1,0);
$mpdf->Cell(25 ,5,$row->quantity,1,0,'C');
$mpdf->Cell(25 ,5,'$'.$row->price,1,0,'R');
$mpdf->Cell(25 ,5,$row->tax.'%',1,0,'R');


$cost_total1=$row->quantity * $row->price;
$cost_total2=$cost_total1+($row->price/100);

$sub_total=$sub_total+$cost_total2;





$mpdf->Cell(34 ,5,'$'.$cost_total2,1,1,'R');
// $sum_total=$sum_total + $cost_total_tax;
// $sub_total=$row->quantity * $row->price;
// $sub_total_sum=$sub_total + ($sub_total*($row->tax/100));


}

$bill_amount=$sub_total-($discount/100);
//end of line


//summary


$mpdf->Cell(130 ,5,'',0,0);
$mpdf->Cell(25 ,5,'Subtotal',0,0);
$mpdf->Cell(4 ,5,'$',1,0);
$mpdf->Cell(30 ,5,$sub_total,1,1,'R');//end of line

$mpdf->Cell(130 ,5,'',0,0);
$mpdf->Cell(25 ,5,'Discount',0,0);
$mpdf->Cell(4 ,5,'$',1,0);
$mpdf->Cell(30 ,5,$discount,1,1,'R');//end of line

$mpdf->Cell(130 ,5,'',0,0);
$mpdf->Cell(25 ,5,'Bill Amount',0,0);
$mpdf->Cell(4 ,5,'$',1,0);
$mpdf->Cell(30 ,5,$bill_amount,1,1,'R');//end of line

$mpdf->Cell(10 ,5,'',0,0);
$mpdf->Cell(25 ,5,'Thank you for your business',0,0);


    $mpdf->Output();
    ?>

