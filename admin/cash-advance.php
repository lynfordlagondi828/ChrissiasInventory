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

$result = $database->displayExpenses($id);

$get = $database->getNameOfBranch($id);

$name = $get["branch_name"];
$address = $get["address"];

$result = $database->displayCahsAdvance($id);
?>


<!DOCTYPE html>
<html>
<head>
	<title>Cash Advance </title>
	<style>
	    @media print {
  #printPageButton {
    display: none;
  }
}
	</style>
	
</head>
<body>
	<div class="container well">
    
    <h1 class="text-center">Cash Advance of
			 <?php
			  echo $name;
			  echo "  ";
			  echo $address;
			  ?>
		</h1>
		    <div class="row">
                <div class="panel-heading">
                    	
                    
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
	              	</tr>
	          	</thead>
                  <tbody>
	        		<?php foreach($result as $expenses) :  ?>
		        		<tr>
                            <td><?php echo htmlentities($expenses["name"]); ?></td>
                            <td><?php echo htmlentities($expenses["amount"]); ?></td>
                            <td><?php echo htmlentities($expenses["created_at"]); ?></td>
                            
                            
		        		</tr>
	        		<?php endforeach; ?>
	        	</tbody>
      		</table>
      		  
                  
                    
                   <button id="printPageButton" type="submit" onclick="window.print()" name="submit" class="btn btn-info"> <i class="glyphicon glyphicon-print"></i> Print</button>
                  
                
                  
                 

</body>
</html>
