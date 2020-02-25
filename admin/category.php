<?php

session_start();
if(!isset($_SESSION["isloggedin"])){

    header('location:index.php');
    exit();
}


require_once 'includes/DbFunctions.php';
$database = new DbFunctions();
$result = $database->display_category();
require_once 'header.php';

//branch id
$branch_id =  $_SESSION["branch_id"];


?>


<!DOCTYPE html>
<html>
<head>
	<title>Bread Name </title>
	
</head>
<body>
	<div class="container well">
    
		<h1 class="text-center">My Products</h1>
		    <div class="row">
                <div class="panel-heading">
                    	
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6" align='left'> 
                        <a class="btn btn-primary" href="add_category.php"><span class="glyphicon glyphicon-plus"></span>Add</a>
					
					</div>
					<div><p></p></div>
                </div>
			<div class="col-md-10">
				<nav aria-label="Page navigation">
					
				</nav>
            </div>
          
			
		</div>
		<div style="height: 600px; overflow-y: auto;">
			<table id="" class="table table-striped table-bordered">
	        	<thead>
	                <tr>
                    <th>Name</th>
                     <th>Price</th>
                    <th>Actions</th>
	              	</tr>
	          	</thead>
                  <tbody>
	        		<?php foreach($result as $cat) :  ?>
		        		<tr>
                            <td><?php echo htmlentities($cat["category_name"]); ?></td>
                             <td><?php echo htmlentities($cat["price"]); ?></td>
                            <td>
                                <a class="btn btn-success" href="edit-category.php?id=<?php echo htmlentities($cat["id"]); ?>"><span class="glyphicon glyphicon-pencil"> </span></a>
                                <a class="btn btn-danger" href="delete-category.php?id=<?php echo htmlentities($cat["id"]); ?>" onclick="return confirm('Are you sure?');"><span class="glyphicon glyphicon-trash"> </span></a>
                            </td>
                            
		        		</tr>
	        		<?php endforeach; ?>
	        	</tbody>
      		</table>
		</div>

</body>
</html>

