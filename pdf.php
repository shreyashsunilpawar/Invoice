<?php
$conn=mysqli_connect("localhost","root","","phpzag_demo");
$qu="SELECT * FROM `invoice_order` ORDER BY user_id DESC LIMIT 1";
$re=mysqli_query($conn,$qu);
$TOTAL=mysqli_fetch_assoc($re);

$q="SELECT * FROM `invoice_order_item` WHERE billno=(SELECT `billno` FROM `invoice_order_item` ORDER BY billno DESC LIMIT 1)";

$r=mysqli_query($conn,$q);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="css/pdf.css" />
    <script src="js/pdf.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

</head>

<body>
    <div class="container d-flex justify-content-center mt-50 mb-50">
        <div class="row">
            <div class="col-md-12 text-right mb-3">
                <button class="btn btn-primary" id="download"> download pdf</button>
            </div>
            <div class="col-md-12">
                <div class="card" id="invoice">
                    <div class="card-header bg-transparent header-elements-inline">
                        <h6 class="card-title text-primary">Sale invoice</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-4 pull-left">

                                    <ul class="list list-unstyled mb-0 text-left">
                                        <li>Admin</li>
                                        <li>abc@gmail.com</li>
                                        <li>plot no 101,new road,new Delhi</li>
                                        <li>123456890</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-4 ">
                                    <div class="text-sm-right">
                                        <h4 class="invoice-color mb-2 mt-md-2">Invoice #<?php echo $TOTAL['user_id'];?></h4>
                                        <ul class="list list-unstyled mb-0">
                                            <li>Date: <span class="font-weight-semibold"><?php echo $TOTAL['order_date'];?></span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-md-flex flex-md-wrap">
                            <div class="mb-4 mb-md-2 text-left"> <span class="text-muted">Invoice To:</span>
                                <ul class="list list-unstyled mb-0">
                                    <li>
                                        <h5 class="my-2"><?php echo $TOTAL['order_receiver_name'];?></h5>
                                    </li>
                                    <li><span class="font-weight-semibold"><?php echo $TOTAL['order_receiver_address'];?></span></li>
                                    <li> </li>
                                    <li>   </li>

                                    <li><?php echo $TOTAL['contact_no'];?></li>
                                    
                                </ul>
                            </div>
                            <div class="mb-2 ml-auto"> <span class="text-muted">Payment Details:</span>
                                <div class="d-flex flex-wrap wmin-md-400">
                                    <ul class="list list-unstyled mb-0 text-left">
                                        <li>
                                            <h5 class="my-2">Total Due:</h5>
                                        </li>
                                        
                                    </ul>
                                    <ul class="list list-unstyled text-right mb-0 ml-auto">
                                        <li>
                                            <h5 class="font-weight-semibold my-2"><?php echo $TOTAL['order_total_amount_due'];?></h5>
                                        </li>
                                        
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <br>
                        <br>
                        <table class="table table-lg">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                              $n=0;
                              while($T=mysqli_fetch_assoc($r))
                              {?>
                                <tr>
                                    <td>
                                        <h6 class="mb-0"><?php echo $T['item_name']; ?></h6>
                                    </td>
                                    <td><?php echo $T['order_item_quantity'];?></td>
                                    <td><?php echo $T['order_item_price'];?></td>
                                    <td><?php echo $T['order_item_final_amount'];?></span></td>
                                </tr>
                                <?php } ?>
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="card-body">
                        <div class="d-md-flex flex-md-wrap">
                            <div class="pt-2 mb-3 wmin-md-400 ml-auto">
                                <h6 class="mb-3 text-left">Total due</h6>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th class="text-left">Subtotal:</th>
                                                <td class="text-right"><?php echo $TOTAL['order_total_before_tax'];?></td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Tax: <span class="font-weight-normal">(<?php echo $TOTAL["order_tax_per"];?>%)</span></th>
                                                <td class="text-right"><?php echo $TOTAL['order_total_tax'];?></td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Total:</th>
                                                <td class="text-right text-primary">
                                                    <h5 class="font-weight-semibold"><?php echo $TOTAL['order_total_after_tax'];?></h5>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                        </div>
                    </div>
                    
            </div>
        </div>
    </div>
</body>

</html>