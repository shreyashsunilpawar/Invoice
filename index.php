<?php
include('header.php');
include('connection.php');
$qu="SELECT * FROM `product`";
$re=mysqli_query($conn,$qu);
while ($item = $re->fetch_array()) {
    $products[] = $item;
}
$bno="SELECT `billno` FROM `invoice_order_item` ORDER BY `billno` DESC LIMIT 1";
$getb=mysqli_query($conn,$bno);
$bill=mysqli_fetch_assoc($getb);
$bill=$bill['billno']+1;?>
<script>
console.log(<?php echo $bill;?>);
</script>

<title>Invoice System with PHP & MySQL</title>
<script src="js/invoice.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="css/style.css" rel="stylesheet">
<link href="css/style1.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<body style="background: lemonchiffon">
	
<div class="invoice-container">
	<form action="<?php echo $_SERVER['PHP_SELF'];?>" id="invoice-form" method="post" class="invoice-form"> 
    <div class="load-animate animated fadeInUp">
			<div class="row">
			
			<input id="currency" type="hidden" value="$">
			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<h3>From,</h3>
					Admin <br>	
					plot no 101,new road,new Delhi<br>	
					 123456890<br>
					abc@gmail.com<br>	
				</div>
                
				
				
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 pull-right">
					<h3>To,</h3>
					
					<div class="fo">
						<input type=""  name="companyName" id="companyName"  autocomplete="off" required />
                        <label for="name" class="label-name">
                        <span class="content-name">Name</span>
		                </label>
					</div>
                    <br>
                    <div class="fo">
						<input type=""  name="contact_no"  id="contact_no" autocomplete="off" required />
                        <label for="name" class="label-name">
                        <span class="content-name">Contact No</span>
		                </label>
					</div>
                    <br>
					<div class="form-group">
						<textarea class="form-control" rows="3" name="address" id="address" placeholder="Your Address"></textarea>
					</div>
                    
					
				</div>
			</div>
			<div class="row" style="display: block;">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="invoice-body">
					<table id="invoiceItem">	
					<thead>
                    <th style="padding-left:12px;">PRODUCT</th>
                    <th>UNIT</th>
                    <th>PRICE</th>
                    <th>AMOUNT</th>
                    <th style="text-align: right;">ACTION</th>
                </thead>						
				<tbody id="table-body">	
							<tr class="item-row"></tr>
							<tr style="padding-left: 20px">
                    <td class="dashed "><div class="float">
                        <a href="#" class="float" id="add-row">
                            <span class="material-icons plus" onclick="addItems()">add</span>
                        </a>
						
                    </div>
                </td>
				<td class="dashed"></td>
                    <td class="dashed"></td>
                    <td class="dashed"></td>
                    <td class="dashed"></td>
                </tr>
                           <?php //}?>
							
						   
						   </tbody>								
					</table>
				    </div>
				</div>
			</div>
			<div class="row">	
				<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
					<h3>Notes: </h3>
					<div class="form-group">
						<textarea class="form-control txt" rows="5" name="notes" id="notes" placeholder="Your Notes"></textarea> 
					</div>
					<br>
					<div class="form-group">
						<input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="form-control" name="userId">
						<a href="#" id="save-button" class="btn btn-success submit_btn invoice-save-btm" name="invoice_btn">Save<i class="fa fa-save" style="color:yellow"></i></a>&nbsp;<a href="pdf.php" onclick="resetf()" id="genrate-pdf" class="btn btn-info submit_btn invoice-save-btm" >Genrate<i class="material-icons" style="color:red">picture_as_pdf</i></a> 					
					</div>
					
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" id="shadow">
					<span class="form-inline">
						<div class="form-group">
							
							<div class="input-group">
							<label>Subtotal:</label><input value="" type="number" class="no" name="subTotal" id="subTotal" placeholder="Subtotal">
							</div>
						</div>
						
						<div class="form-group" >
						
							<div class="input-group">
							
							<label>GST/NON-GST: &nbsp;</label>	<select  id="gst1" name="gst" onchange="gst123()"><option value="gst">GST</option><option value="nongst">NON GST</option></select>
								
							</div>
						</div>
						<div id="gst12">
						<div class="form-group">
							<label>Tax Rate: &nbsp;</label>
							<div class="input-group">
								<input value="" type="number" class="tax" name="taxRate" id="taxRate" placeholder="Tax Rate">
								<div class="input-group-addon">%</div>
							</div>
						</div>
						<div class="form-group">
							<label>Tax Amount: &nbsp;</label>
							<div class="input-group">
								<input value="" type="number" class="no" name="taxAmount" id="taxAmount" placeholder="Tax Amount">
							</div>
						</div>
						</div>							
						<div class="form-group">
							<label>Total: &nbsp;</label>
							<div class="input-group">
								<input value="" type="number" class="no" name="totalAftertax" id="totalAftertax" placeholder="Total">
							</div>
						</div>
						<div class="form-group">
							<label>Amount Paid: &nbsp;</label>
							<div class="input-group">
								<input value="" type="number" class="no" name="amountPaid" id="amountPaid" placeholder="Amount Paid">
							</div>
						</div>
						<div class="form-group">
							<label>Amount Due: &nbsp;</label>
							<div class="input-group">
								<input value="" type="number" class="no" name="amountDue" id="amountDue" placeholder="Amount Due">
							</div>
						</div>
					</span>
				</div>
			</div>
            <div class="clearfix"></div>		      	
		</div>
	</form>			
</div>
</div>
</body>	
<?php include('footer.php');?>
<?PHP
if(isset($_POST['invoice_btn1']))
{
    $companyName=$_POST['companyName'];
    $contact_no=$_POST['contact_no'];
	$productno=$_POST['productCode'];
	$productName=$_POST['productName'];
    $address=$_POST['address'];
    $subTotal=$_POST['subTotal'];
    $taxAmount=$_POST['taxAmount'];
    $taxRate=$_POST['taxRate'];
    $totalAftertax=$_POST['totalAftertax'];
    $amountPaid=$_POST['amountPaid'];
    $amountDue=$_POST['amountDue'];
    $notes=$_POST['notes'];
	$qty=$_POST['qty'];
	$price=$_POST['price'];
    $total=$_POST['total'];

	?>
	<script>
	alert("<?php echo $price; ?>");	</script>
	<?php
	$productname=$_POST['productName'];

 $query="INSERT INTO `invoice_order`(`order_receiver_name`,`contact_no`,`order_receiver_address`, `order_total_before_tax`, `order_total_tax`, `order_tax_per`, `order_total_after_tax`, `order_amount_paid`, `order_total_amount_due`, `note`) VALUES ('$companyName','$contact_no','$address','$subTotal','$taxAmount','$taxRate','$totalAftertax','$amountPaid','$amountDue','$notes')";
 $res=mysqli_query($conn,$query);
 if($res)
 {?>
 <script>
 alert("data inserted!");
 </script><?php
 }else {?>
 <script>
 alert("data not inserted!");
 </script>
<?php
 } 
}
?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript">
        var products = <?php echo json_encode($products); ?>;
		
		
        $(document).ready(function(){
            var firstEleId = products[0]['id'];
            //By default add one ele to table
            $(".item-row:last").after(`
                <tr class="item-row" id="${firstEleId}">
                    <td>
                        <select class="product-left" id="itemName${firstEleId}" name="productName[${firstEleId}]" onchange="getPrice(this,${firstEleId})">
                            <option selected>Select item</option>
                            <?php
                            foreach ($products as $rec) : ?>
                            <option value="<?php echo $rec['price']; ?>"><?php echo $rec['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <input type="text" class="unit" name="qty[${firstEleId}]" id="itemQty${firstEleId}" autocomplete="off">
                    </td>
                    <td>
                        <input type="text" class="price" name="price[${firstEleId}]" id="itemPrice${firstEleId}" readonly>
                    </td>
                    <td>
                        <input type="text" class="amount" name="total[${firstEleId}]" id="itemTotal${firstEleId}" readonly>
                    </td>
					<td style="text-align: right;"><span class="material-icons"  id="index${firstEleId}" onclick="removeItems1(this)">delete_outline</span></td>
                </tr>
				
            `);
        })

		$(document).on('blur', "[id^=itemQty]", function(){
		calculateTotal();
	});	
	$(document).on('blur', "[id^=itemPrice]", function(){
		calculateTotal();
	});	
	$(document).on('blur', "#taxRate", function(){		
		calculateTotal();
	});	
	$(document).on('blur', "#amountPaid", function(){
		var amountPaid = $(this).val();
		var totalAftertax = $('#totalAftertax').val();	
		if(amountPaid && totalAftertax) {
			totalAftertax = totalAftertax-amountPaid;			
			$('#amountDue').val(totalAftertax);
		} else {
			$('#amountDue').val(totalAftertax);
		}	
	});

        //Add items dynamically inside tbody
        function addItems(){
            var max = products.length;
            var totalElements = $('.item-row').length;
            var nextEleId = parseInt($(".item-row:last").attr('id')) + 1;

            if(totalElements <= max){
                $(".item-row:last").after(`
                    <tr class="item-row" id="${nextEleId}">
                        
                        <td>
                            <select class="product-left" id="itemName${nextEleId}" name="productName[${nextEleId}]" onchange="getPrice(this,${nextEleId})">
                                <option selected>Select item</option>
                                <?php
                                foreach ($products as $rec) : ?>
                                <option value="<?php echo $rec['price']; ?>"><?php echo $rec['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="unit" name="qty[${nextEleId}]" id="itemQty${nextEleId}" autocomplete="off">
                        </td>
                        <td>
                            <input type="text" class="price" name="price[${nextEleId}]" id="itemPrice${nextEleId}" readonly>
                        </td>
                        <td>
                            <input type="text" class="amount" name="total[${nextEleId}]" calculateTotal(); id="itemTotal${nextEleId}" readonly>
                        </td>
						<td style="text-align: right;"><span class="material-icons" onclick="removeItems1(this)">delete_outline</span></td>
						</tr>
                `);
            }else{
                alert('Max ' + (max) + ' products available');
            }
        }

        


		
		
        
        

		
    </script>