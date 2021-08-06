
function resetf(){
	document.getElementById("invoice-form").reset();
}

function gst123()
{
	var v=document.getElementById("gst1").value;
	if(v=="nongst")
	{
		document.getElementById("gst12").style.display="none";
	}
	else
	{
		document.getElementById("gst12").style.display="inline";
	}
}


function removeItems1(e){
	var table=document.getElementById('invoiceItem');
	var a=e.closest("tr").rowIndex;
	table.deleteRow(a);
    calculateTotal();
}

//Get price of selected item
function getPrice(element,id){
	var price = $('#itemName'+ id + ' option:selected').val();
	var priceEle = $('#itemPrice'+id).val(price);
}

function calculateTotal(){
var totalAmount = 0; 
$("[id^='itemPrice']").each(function() {
var id = $(this).attr('id');
id = id.replace("itemPrice",'');
var price = $('#itemPrice'+id).val();
var quantity  = $('#itemQty'+id).val();
if(!quantity) {
	quantity = 1;
}
var total = price*quantity;
$('#itemTotal'+id).val(parseFloat(total));
totalAmount += total;			
});
$('#subTotal').val(parseFloat(totalAmount));	
var taxRate = $("#taxRate").val();
var subTotal = $('#subTotal').val();	
if(subTotal) {
var taxAmount = subTotal*taxRate/100;
$('#taxAmount').val(taxAmount);
subTotal = parseFloat(subTotal)+parseFloat(taxAmount);
$('#totalAftertax').val(subTotal);		
var amountPaid = $('#amountPaid').val();
var totalAftertax = $('#totalAftertax').val();	
if(amountPaid && totalAftertax) {
	totalAftertax = totalAftertax-amountPaid;			
	$('#amountDue').val(totalAftertax);
} else {		
	$('#amountDue').val(subTotal);
}
}
}


//Insert items to DB
function insertItems(){
	var insertArr = [];
	$.each($('.item-row'), function() {
		var id = $(this).attr('id');
		if(id){
			var item_no = $('#itemNo' + id).val();
			var item_name = $('#itemName'+ id + ' option:selected').text();
			var item_qty = $('#itemQty' + id).val();
			var item_price = $('#itemPrice' + id).val();
			var item_total = $('#itemTotal' + id).val();

			var obj = {
				"itemNo": item_no,
				"itemName": item_name,
				"itemQty": item_qty,
				"itemPrice": item_price,
				"itemTotal": item_total
			}
			insertArr.push(obj);
		}
	});
	//console.log(insertArr);
}
$(document).ready(function()
{
	document.getElementById("genrate-pdf").style.display="none";
   $("#save-button").on("click",function(){	
	document.getElementById("genrate-pdf").style.display="inline";
	var companyName= $('#companyName').val();
	var contact_no= $('#contact_no').val(); 
	var address= $('#address').val(); 
	var notes= $('#notes').val(); 
	var subTotal= $('#subTotal').val(); 
	var taxRate= $('#taxRate').val(); 
	var taxAmount= $('#taxAmount').val(); 
	var totalAftertax= $('#totalAftertax').val(); 
	var amountPaid= $('#amountPaid').val(); 
	var amountDue= $('#amountDue').val();
	var insertArr = [];
	$.each($('.item-row'), function() {
		var id = $(this).attr('id');
		if(id){
			var item_no = $('#itemNo' + id).val();
			var item_name = $('#itemName'+ id + ' option:selected').text();
			var item_qty = $('#itemQty' + id).val();
			var item_price = $('#itemPrice' + id).val();
			var item_total = $('#itemTotal' + id).val();

			var obj = {
				"itemNo": item_no,
				"itemName": item_name,
				"itemQty": item_qty,
				"itemPrice": item_price,
				"itemTotal": item_total
			}
			insertArr.push(obj);
		}
	});
	//console.log(insertArr);

	   $.ajax({
		url:"load.php",
		type:"POST",
		data:{adata:insertArr,companyName:companyName,contact_no:contact_no,address:address,notes:notes,subTotal:subTotal,taxRate:taxRate,taxAmount:taxAmount,totalAftertax:totalAftertax,amountPaid:amountPaid,amountDue:amountDue},
		success: function(){
          alert("data inserted");
		}
	   });
	   document.getElementById("save-button").style.display="none";
   })
   
});
