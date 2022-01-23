<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<style>
table, th, td {

  padding: 5px;
}



table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<body>
<div style="margin: auto;width: 80%;border:1px solid black">
<form id="form1" name="form1" method="post">
    <table>
    <caption><center><H5><b>JK SUPERMARKET<H5></caption>
    <tr>
        <td>
            <div class="form-group">
                <label for="item">Item Name:</label>
                <input type="text" name="sname" class="form-control" id="name">
            </div>
       </td>
       <td>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" class="form-control" id="quantity">
            </div>
       </td>
        <td>
        <div class="form-group">
            <label for="pwd">Unit Price:</label>
            <input type="number" name="price" class="form-control" id="price" placeholder="$">
        </div>
       </td>
       <td>
        <div class="form-group">
            <label for="pwd">Tax:</label>
            <select id="tax" name="tax" class="form-control">
            <option value="0">0%</option>
            <option value="1">1%</option>
            <option value="5">5%</option>
            <option value="10">10%</option>
            </select>
        </div>
</td>
<td>  <input type="button" name="send" class="btn btn-primary" value="+" id="butsend"></td>
</tr></table>
  
    <input type="hidden" name="inoviceno"  value="" id="inoviceno">

<a href = "javascript:;" class="btn btn-primary" style="float:right" onclick = "this.href='bill.php?invoice=' + document.getElementById('inoviceno').value+'&discount=' + document.getElementById('discount').value" target="_blank">BILL</a>&nbsp;&nbsp;

<input type="button" name="save" class="btn btn-primary" value="SAVE" id="butsave" style="float:right">


    <!-- <a href="bill.php" class="btn btn-primary" style="float:right" target="_blank">BILL</a>   -->
</form>

<table id="table1" name="table1" class="table table-bordered">
    <tbody>
        <tr>
        <th>ID</th>
        <th>Item Name</th>
        <th>Quantity</th>
        <th>Unit Price</th>
        <th>Tax</th>
       
        <th>Sub Total(Without Tax)</th>
        <th>Sub Total(With Tax)</th>
       </tr>
    </tbody>
</table>
</div>
<script>
   $("#table1 > tr > td").change(function() {
     console.log("inside change event");
});


$(document).ready(function() {
    $('#name').val('');
    $('#price').val('');
    $('#quantity').val('');
    $('#tax').val('');
    $('#invoiceno').val('');
    
    var id = 1; 
    var q1sum=0,t1sum=0,tx1sum=0,subsum=0,subwtsum=0,subtt=0;
    
    /*Assigning id and class for tr and td tags for separation.*/
    $("#butsend").click(function() {
        if($('#name').val()==null || $('#quantity').val()==null || $('#price').val()==null || $('#tax').val()==null)
        {
            alert("Invalid details");
            return false;
        }
    var newid = id++; 
    var q1=$("#quantity").val();
    var t1=$("#price").val();
    var tx1=$("#tax").val();
    var sub_total=(parseInt(q1, 10))* (parseInt(t1, 10));
    var sub_total_w_tax=(parseInt(q1, 10))* (parseInt(t1, 10));
    var cost_total=(parseInt(q1, 10))* (parseInt(t1, 10));
    var cost_total_tax=cost_total + cost_total*parseFloat(tx1/100);

   
    q1sum=parseInt(q1sum, 10)+parseInt(q1, 10);
    t1sum=parseInt(t1sum, 10)+parseInt(t1, 10);
    tx1sum=parseInt(tx1sum, 10)+parseInt(tx1, 10);
    subwtsum=parseInt(subwtsum, 10)+parseInt(sub_total_w_tax, 10);
    subsum=parseInt(subsum, 10)+parseInt(sub_total, 10);
    subtt=parseInt(subtt, 10)+parseInt(cost_total_tax, 10);
    var table = $(this).closest('table');
   
    
    $('#tot').remove();
    $('#subtot').remove();
    $('#textsubboxdiv').remove();
    $('#TextDiscountBoxDiv').remove();
    $('#TextBoxDiv').remove();
    $('.discount').remove();
    $('.subt').remove();
    $('.billtot').remove();
    
    $("#table1").append('<tr valign="top" id="'+newid+'">\n\
    <td width="100px" >' + newid + '</td>\n\
    <td width="100px" class="name'+newid+'">' + $("#name").val() + '</td>\n\
    <td width="100px" class="quantity'+newid+'">' + $("#quantity").val() + '</td>\n\
    <td width="100px" class="price'+newid+'">' + $("#price").val() + '</td>\n\
    <td width="100px" class="tax'+newid+'">' + $("#tax").val() + '</td>\n\
    <td width="100px" class="subtotal'+newid+'">' + sub_total + '</td>\n\
    <td width="100px" class="subtotal'+newid+'">' + cost_total_tax + '</td>\n\</tr>');
    // <td width="100px"><a href="javascript:void(0);" class="remCF">Remove</a></td>\n\ </tr>');

    $("#table1").append('<tr valign="top" id="tot">\n\
    <th width="100px" > Item Total </td>\n\
    <td width="100px" class="name'+newid+'"></td>\n\
    <td width="100px" class="quantity'+newid+'">' + q1sum + '</td>\n\
    <td width="100px" class="price'+newid+'">' + t1sum + '</td>\n\
    <td width="100px" class="tax'+newid+'">' + tx1sum + '</td>\n\
    <td width="100px" class="subtotal'+newid+'">' + subwtsum + '</td>\n\
    <td width="100px" class="subtotal'+newid+'">' + cost_total_tax + '</td>\n\</tr>');
  
    // <td width="100px"><a href="javascript:void(0);" class="remCF">Remove</a></td>\n\ </tr>');
  
    $("#table1").append('<tr id="'+ newid+'" class="discount"><td style="width:100px;" align="right">Discount </td><td></td><td></td><td></td><td></td><td></td><td> <input type="text" id="discount" value="" width="100px" onChange="change_send(this.value);" /> </td></tr>');

    $("#table1").append('<tr id="'+ newid+'" class="subt"><td style="width:100px;" align="right">Sub Total </td><td></td><td></td><td></td><td></td><td></td><td> <input type="text" id="subtotal" value="'+ cost_total_tax +'" width="100px" /> </td></tr>');
    
    $("#table1").append('<tr id="'+ newid+'" class="billtot"><td style="width:100px;" align="right">Bill Amount </td><td></td><td></td><td></td><td></td><td></td><td> <input type="text" id="bill" value="'+ cost_total_tax +'" width="100px" /> </td></tr>');

   
    
    });
 

    // $("#table1").on('click', '.remCF', function() {
    // $(this).parent().parent().remove();

    
 
   
    // });
    /*crating new click event for save button*/
    $("#butsave").click(function() {
        if($('#name').val()==null || $('#quantity').val()==null || $('#price').val()==null || $('#tax').val()==null)
        {
            alert("Invalid details");
        }

        if($('#discount').val()==null)
        {
            alert("Please insert discount");
        }
    var lastRowId = $('#table1 tr:last').attr("id"); /*finds id of the last row inside table*/
  
    var name = new Array(); 
    var quantity = new Array();
    var price = new Array();
    var tax = new Array();
    var total = new Array();
   
    for ( var i = 1; i <= lastRowId; i++) {
    
    name.push($("#"+i+" .name"+i).html()); /*pushing all the names listed in the table*/
    quantity.push($("#"+i+" .quantity"+i).html()); /*pushing all the emails listed in the table*/
    price.push($("#"+i+" .price"+i).html()); 
    tax.push($("#"+i+" .tax"+i).html());
  
   
    }
    var name = JSON.stringify(name); 
  
    var quantity = JSON.stringify(quantity);
    var price = JSON.stringify(price);
    var tax = JSON.stringify(tax);
    var subtot=$('#subtotal').val();
    var discount=$('#discount').val();
    var bill=$('#bill').val();
    

    $.ajax({
    url: "save.php",
    type: "post",
    data: {name : name , quantity : quantity,price : price,tax : tax,subtot : subtot,discount : discount,bill : bill},
    success : function(data){
        $('#inoviceno').val(data);
        alert("Saved Successfully"); /* alerts the response from php.*/
    }
    });
    });
});

function change_send(discount)
{
	
	var subtot=$('#subtotal').val();
    var sub=parseFloat(subtot, 10);
    var tot=sub-parseFloat(discount/100);
    $('#bill').val(tot);
}
</script>
</body>
</html>
