<?php
$nameArr = json_decode($_POST["name"]);
$quantityArr = json_decode($_POST["quantity"]);
$priceArr = json_decode($_POST["price"]);
$taxArr = json_decode($_POST["tax"]);
$discount = json_decode($_POST["subtotal"]);
$discount = json_decode($_POST["discount"]);
$bill = json_decode($_POST["bill"]);

$con=mysqli_connect("localhost","root","root","shop");
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


$res = mysqli_query($con, "SELECT count(*) FROM invoice");
$count=mysqli_num_rows ( $res );
if($count == 0)
$invoice_number=1000;
else
{
    $res = mysqli_query($con, "SELECT invoice_number FROM invoice ORDER BY invoice_number desc  ");
 
    $row = $res -> fetch_row();
    $invoice_number=$row[0]+1;
}
for ($i = 0; $i < count($nameArr); $i++) {
if(($nameArr[$i] != "")){ /*not allowing empty values and the row which has been removed.*/






$sql="INSERT INTO invoice (item_name,quantity,price,tax,invoice_number)
VALUES
('$nameArr[$i]','$quantityArr[$i]','$priceArr[$i]','$taxArr[$i]','$invoice_number')";
if (!mysqli_query($con,$sql))
{
die('Error: ' . mysqli_error($con));
}
}
}
// Print "Data added Successfully !";
echo $invoice_number;
// mysqli_close($con);
?>
