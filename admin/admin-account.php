<?php

session_start();
if(!isset($_SESSION["isloggedin"])){

    header('location:index.php');
    exit();
}

require_once 'includes/DbFunctions.php';
$database = new DbFunctions();
require_once 'header.php';

$result = $database->displayMyaccounts();

?>


<!DOCTYPE html>
<html>
<head>
	<title>MyAccounts </title>
	
</head>
<body>
	<div class="container well">
    
		<h1 class="text-center">My Accounts</h1>
		    <div class="row">
                <div class="panel-heading">
                    	
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6" align='left'> 
                    <a class="btn btn-primary" href="add-account.php"><span class="glyphicon glyphicon-plus"></span>Add</a>
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
                    <th>Lastname</th>
                    <th>Firstname</th>
                    <th>Middlename</th>
                    <th>Username</th>
                    <th>Actions</th>
	              	</tr>
	          	</thead>
                  <tbody>
	        		<?php foreach($result as $accounts) :  ?>
		        		<tr>
                            <td><?php echo htmlentities($accounts["lastname"]); ?></td>
                            <td><?php echo htmlentities($accounts["firstname"]); ?></td>
                            <td><?php echo htmlentities($accounts["middlename"]); ?></td>
                            <td><?php echo htmlentities($accounts["username"]); ?></td>
                            <td>
                                <a class="btn btn-success" href="edit-account.php?id=<?php echo htmlentities($accounts["id"]); ?>"><span class="glyphicon glyphicon-pencil"> </span></a>
                                <a class="btn btn-danger" href="delete-account.php?id=<?php echo htmlentities($accounts["id"]); ?>" onclick="return confirm('Are you sure?');"><span class="glyphicon glyphicon-trash"> </span></a>
                            </td>
                            
		        		</tr>
	        		<?php endforeach; ?>
	        	</tbody>
      		</table>
		</div>

</body>
</html>
