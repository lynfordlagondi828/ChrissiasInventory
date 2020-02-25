<?php

session_start();
if(!isset($_SESSION["isloggedin"])){

    header('location:index.php');
    exit();
}



require_once 'includes/DbFunctions.php';
$database = new DbFunctions();
require_once 'header.php';


if(isset($_GET["id"])){

	$id = $_GET["id"];
}

$id = intval($_GET["id"]);


$limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 5000;
$page = isset($_GET['page']) ? $_GET['page'] : 1;

$start = ($page - 1) * $limit;


$result = $database->getAllProducts($id,$start,$limit);




?>

<!DOCTYPE html>
<html>
<head>
<title>My Products </title>

</head>
<body>
<div class="container well">

	<h1 class="text-center">Products</h1>
		<div class="row">
			
		
	  
		<div class="text-center" style="margin-top: 20px; " class="col-md-2">
			<form method="post" action="#">
					<select name="limit-records" id="limit-records">
						<option disabled="disabled" selected="selected">---Limit Records---</option>
						<?php foreach([10,100,500,1000,5000] as $limit): ?>
							<option <?php if( isset($_POST["limit-records"]) && $_POST["limit-records"] == $limit) echo "selected" ?> value="<?= $limit; ?>"><?= $limit; ?></option>
						<?php endforeach; ?>
					</select>
				</form>
			</div> 
	</div>
	<div style="height: 600px; overflow-y: auto;">
		<table id="" class="table table-striped table-bordered">
			<thead>
				<tr>
				<th>Product</th>
				<th>Beginning</th>
				<th>From Main</th>
				<th>Kilo/s</th>
				<th>Quantity</th>
				<th>Total</th>
				<th>Unsold/Closing</th>
				<th>Pullout</th>
				<th>Price</th>
				<th>Sales</th>
				<th>Date</th>
				  </tr>
			  </thead>
			  <tbody>
				<?php foreach($result as $product) :  ?>
					<tr>
						<td><?php echo htmlentities($product["product_name"]); ?></td>
						<td><?php echo htmlentities($product["beginning"]); ?></td>
						<td><?php echo htmlentities($product["from_branch"]); ?></td>
						<td><?php echo htmlentities($product["num_of_kilos"]); ?></td>
						<td><?php echo htmlentities($product["quantity"]); ?></td>
						<td><?php echo htmlentities($product["total"]); ?></td>
						<td><?php echo htmlentities($product["unsold_goods"]); ?></td>
						<td><?php echo htmlentities($product["pullout"]); ?></td>
						<td><?php echo htmlentities($product["price"]); ?></td>
						<td><?php echo htmlentities($product["sales"]); ?></td>
						<td><?php echo htmlentities($product["date"]); ?></td>

					
						
					</tr>
				<?php endforeach; ?>
			</tbody>
		  </table>
	</div>

	<script type="text/javascript">
$(document).ready(function(){
	$("#limit-records").change(function(){
		$('form').submit();
	})
})
</script>
</body>
</html>
