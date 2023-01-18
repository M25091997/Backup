<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test</title>
</head>
<body>

</body>
</html>

<script src="//code.jquery.com/jquery-2.2.3.min.js"></script>

<script type="text/javascript">
	

	$(document).ready(function(){
		var dataString ='';
	$.ajax({ /*AJAX */ type: "POST", 
		url: 'https://cityindia.in/api/app/get-product.php?id=882', 
		dataType: 'json', 
		data: dataString, 
		success: function(product_json) { console.log(product_json[0].images[0]); }

	}); 
});

</script>