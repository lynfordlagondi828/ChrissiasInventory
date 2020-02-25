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

$result = $database->getMyCash($branch_id);

?>


<!DOCTYPE html>
<html>
<head>
	<title>Expenses </title>
	
</head>
<body>
	<div class="container well">
    
		<h1 class="text-center">My Cash</h1>
		    <div class="row">
                <div class="panel-heading">
                    	
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6" align='left'> 
                       
					
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
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Actions</th>
	              	</tr>
	          	</thead>
                  <tbody>
	        		<?php foreach($result as $expenses) :  ?>
		        		<tr>
                            <td><?php echo htmlentities($expenses["amount"]); ?></td>
                            <td><?php echo htmlentities($expenses["date"]); ?></td>
                            <td>
                                <a class="btn btn-success" href="baker-edit-my-cash.php?id=<?php echo htmlentities($expenses["id"]); ?>"><span class="glyphicon glyphicon-pencil"> </span></a>
                            </td>
                            
		        		</tr>
	        		<?php endforeach; ?>
	        	</tbody>
      		</table>
		</div>

</body>
</html>
