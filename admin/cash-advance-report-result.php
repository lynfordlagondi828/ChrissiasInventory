<?php

    session_start();
    if(!isset($_SESSION["isloggedin"])){

        header('location:login.php');
        exit();
    }



    require_once 'includes/DbFunctions.php';
    $database = new DbFunctions();
    require_once 'header.php';

    $branch_id = $_SESSION["id"];

    $startDate = $_SESSION["startDate"];
    $endDate = $_SESSION["endDate"];

    $result = $database->generateCashAdvance($startDate,$endDate,$branch_id);



    $getch = $database->getNameOfBranch($branch_id);

    $name = $getch["branch_name"];
    $address = $getch["address"];

   

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
	        		<?php foreach($result as $cash) :  ?>
		        		<tr>
                            <td><?php echo htmlentities($cash["name"]); ?></td>
                            <td><?php echo htmlentities($cash["amount"]); ?></td>
                            <td><?php echo htmlentities($cash["created_at"]); ?></td>
                            
                            
		        		</tr>
	        		<?php endforeach; ?>
	        	</tbody>
      		</table>
      		<button id="printPageButton" type="submit" onclick="window.print()" name="submit" class="btn btn-info"> <i class="glyphicon glyphicon-print"></i> Print</button>

</body>
</html>
