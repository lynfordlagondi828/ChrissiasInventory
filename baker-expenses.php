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

$result = $database->displayExpenses($branch_id);
?>


<!DOCTYPE html>
<html>
<head>
	<title>Expenses </title>
	
</head>
<body>
	<div class="container well">
    
		<h1 class="text-center">Expenses</h1>
		    <div class="row">
                <div class="panel-heading">
                    	
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6" align='left'> 
                        <a class="btn btn-primary" href="baker-add-expenses.php"><span class="glyphicon glyphicon-plus"></span>Add</a>
					
					</div>
					<div><p></p></div>
                </div>
			<div class="col-md-10">
				<nav aria-label="Page navigation">
					
				</nav>
            </div>
          
			
		</div>
	
			<table id="" class="table table-striped table-bordered">
	        	<thead>
	                <tr>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Actions</th>
	              	</tr>
	          	</thead>
                  <tbody>
	        		<?php foreach($result as $expenses) :  ?>
		        		<tr>
                            <td><?php echo htmlentities($expenses["name"]); ?></td>
                            <td><?php echo htmlentities($expenses["amount"]); ?></td>
                            <td><?php echo htmlentities($expenses["created_at"]); ?></td>
                            <td>
                                <a class="btn btn-success" href="edit_expenses.php?id=<?php echo htmlentities($expenses["id"]); ?>"><span class="glyphicon glyphicon-pencil"> </span></a>
                                <a class="btn btn-danger" href="delete_expenses.php?id=<?php echo htmlentities($expenses["id"]); ?>" onclick="return confirm('Are you sure?');"><span class="glyphicon glyphicon-trash"> </span></a>
                            </td>
                            
		        		</tr>
	        		<?php endforeach; ?>
	        	</tbody>
      		</table>

</body>
</html>
