<?php

session_start();
if(!isset($_SESSION["isloggedin"])){

    header('location:index.php');
    exit();
}



require_once 'bakerFunctions.php';
$database = new bakersFunctions();
require_once 'baker-header.php';

$branch_id = $_SESSION["branch_id"];
$keyword = '';

	$limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 5000;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    
    $start = ($page - 1) * $limit;
	
	if(isset($_GET["submit"])){

		$keyword = trim($_GET["keyword"]);

		
	}

	if($keyword == '')
  
	$result = $database->getAllProducts($branch_id,$start,$limit);
	else 
	$result = $database->searchNow($keyword,$branch_id);


	$total = $database->getTotalProducts();
    $pages = ceil( $total / $limit );

	$Previous = $page - 1;
	$Next = $page + 1;
	


?>

<!DOCTYPE html>
<html>
<head>
	<title>My Products </title>
	<style>

		body{
		background: #f2f2f2;
		font-family: 'Open Sans', sans-serif;
		}

		.search {
		width: 100%;
		position: relative;
		display: flex;
		}

		.searchTerm {
		width: 30%;
		border: 3px solid #00B4CC;
		border-right: none;
		padding: 5px;
		height: 30px;
		border-radius: 5px 0 0 5px;
		outline: none;
		color: #000;
		}

				
		.searchButton {
		width: 40px;
		height: 30px;
		border: 1px solid #00B4CC;
		background: #00B4CC;
		text-align: center;
		color: #fff;
		border-radius: 0 5px 5px 0;
		cursor: pointer;
		font-size: 20px;
		}
	</style>

</head>
<body>
	<div class="container well">
    
		<h1 class="text-center">Sales Products</h1>
		<a class="btn btn-primary" href="baker-add_product.php"><span class="glyphicon glyphicon-plus"></span>Add</a>
        <a class="btn btn-success" href="baker-add-late-sales.php"><span class="glyphicon glyphicon-plus"></span>Add late sales</a>
             
		    <div class="row">
			
                <div class="panel-heading">
				
                </div>
			<div class="col-md-10">
			<form method="get">

				<div class="wrap">
						<div class="search">
						<label>Search </label>
							<input type="date" name="keyword" class="searchTerm"">
							<button name="submit" class="searchButton">
								Go
							</button>
						</div>
				</div>
			</form>
				</div>
          
			<div class="text-center" style="margin-top: 20px; " class="col-md-2">
				
            </div> 
		</div>
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
                    <th>Date</th>
                    <th>Actions</th>
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
                            <td><?php echo htmlentities($product["date"]); ?></td>

                            <td>
                                
                                 <a class="btn btn-success" href="edit_products.php?id=<?php echo htmlentities($product["id"]); ?>"><span class="glyphicon glyphicon-pencil"> </span></a>
                              
                                
                                <a class="btn btn-danger" href="delete_products.php?id=<?php echo htmlentities($product["id"]); ?>" onclick="return confirm('Are you sure?');"><span class="glyphicon glyphicon-trash"> </span></a>
                            </td>
                            
		        		</tr>
	        		<?php endforeach; ?>
	        	</tbody>
      		</table>

		<script type="text/javascript">
	$(document).ready(function(){
		$("#limit-records").change(function(){
			$('form').submit();
		})
	})
</script>
</body>
</html>
