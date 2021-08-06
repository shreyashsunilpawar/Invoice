
<?php
include('connection.php');
$bno="SELECT `billno` FROM `invoice_order_item` ORDER BY `billno` DESC LIMIT 1";
$getb=mysqli_query($conn,$bno);
$bill=mysqli_fetch_assoc($getb);
$bill=$bill['billno']+1;
$arr=$_POST['adata'];                              
$companyName=$_POST['companyName'];
$contact_no=$_POST['contact_no'];
$address=$_POST['address'];
$notes=$_POST['notes'];
$subTotal=$_POST['subTotal'];
$taxRate=$_POST['taxRate'];
$taxAmount=$_POST['taxAmount'];
$totalAftertax=$_POST['totalAftertax'];
$amountPaid=$_POST['amountPaid'];
$amountDue=$_POST['amountDue'];

for($i=0;sizeof($arr[$i])!=0;$i++)
{
    $itemNo[]=$arr[$i]["itemNo"];  
    $itemName[]=$arr[$i]["itemName"];
    $itemQty[]=$arr[$i]["itemQty"];
    $itemPrice[]=$arr[$i]["itemPrice"];
    $itemTotal[]=$arr[$i]["itemTotal"];
}

for ($j = 0; $j <count($itemName); $j++) {
    $q="INSERT INTO `invoice_order_item`(`billno`,`item_code`, `item_name`, `order_item_quantity`, `order_item_price`, `order_item_final_amount`) VALUES ('$bill','".$itemNo[$j]."','".$itemName[$j]."','".$itemQty[$j]."','".$itemPrice[$j
    ]."', '".$itemTotal[$j]."')";
    $res=mysqli_query($conn,$q);
    }

    $query="INSERT INTO `invoice_order`(`order_receiver_name`,`contact_no`,`order_receiver_address`, `order_total_before_tax`, `order_total_tax`, `order_tax_per`, `order_total_after_tax`, `order_amount_paid`, `order_total_amount_due`, `note`) VALUES ('$companyName','$contact_no','$address','$subTotal','$taxAmount','$taxRate','$totalAftertax','$amountPaid','$amountDue','$notes')";
    $res1=mysqli_query($conn,$query);    
?>
