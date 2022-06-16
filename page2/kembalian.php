<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Penjumlahan Inputbox Secara Otomatis Di HTML, PHP, Dan JQuery</title>
<link href="assets/css/bootstrap.css" rel="stylesheet">
<script src="assets/js/jquery.js"></script>
</head>
<body>
<legend align="center" class="text-success"><?php echo 'Penjumlahan Inputbox Secara Otomatis Di HTML, PHP, Dan JQuery';?></legend>
<form class="form-horizontal" action="" method="post">
	<div class="form-group">
		<label class="col-lg-3 control-label">Sub Total</label>
		<div class="col-lg-3">
			<input type="number" step="any" min="0" name="subtotal" id="subtotal" class="form-control" value="0">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">PPn</label>
		<div class="col-lg-3">
			<input type="number" step="any" min="0" name="ppn" id="ppn" class="form-control" value="0">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">Grand Total</label>
		<div class="col-lg-3">
			<input type="text" name="total" id="total" class="form-control" Readonly value="0">
		</div>
	</div>
</form>
</body>
</html>

<script type="text/javascript">
 $("#subtotal").keyup(function(){   
   var a = parseFloat($("#subtotal").val());
   var b = parseFloat($("#ppn").val());
   var c = a+b;
   $("#total").val(c);
 });
 
 $("#ppn").keyup(function(){
   var a = parseFloat($("#subtotal").val());
   var b = parseFloat($("#ppn").val());
   var c = a+b;
   $("#total").val(c);
 });
</script>