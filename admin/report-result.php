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

    $result = $database->GenerateReport($branch_id,$startDate);

    $getch = $database->getNameOfBranch($branch_id);

    $name = $getch["branch_name"];
    $address = $getch["address"];

   

?>

<body>
                    <style>
	    @media print {
  #printPageButton {
    display: none;
  }
}
	</style>

	<div class="container well">

        <h3>
            <?php echo $name; ?>
            <?php echo $address; ?>
        </h3>
		<h4 class="text-center">
          Reports for <?php echo $startDate ?>
        </h4>
		    
        
        <?php if(count($result)>0): ?>
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
                    <th></th>
	              	</tr>
	          	</thead>
                  <tbody>
	        		<?php foreach($result as $res) :  ?>
		        		<tr>
                            <td><?php echo htmlentities($res["product_name"]); ?></td>
                            <td><?php echo htmlentities($res["beginning"]); ?></td>
                            <td><?php echo htmlentities($res["from_branch"]); ?></td>
                            <td><?php echo htmlentities($res["num_of_kilos"]); ?></td>
                            <td><?php echo htmlentities($res["quantity"]); ?></td>
                            <td><?php echo htmlentities($res["total"]); ?></td>
                            <td><?php echo htmlentities($res["unsold_goods"]); ?></td>
                            <td><?php echo htmlentities($res["pullout"]); ?></td>
                            <td><?php echo htmlentities($res["price"]); ?></td>
                            <td><?php echo htmlentities($res["sales"]); ?></td>
                            <td><?php echo htmlentities($res["date"]); ?></td>
                            <td>
                                 <a class="btn btn-danger" id="printPageButton" href="delete-report.php?id=<?php echo htmlentities($res["id"]); ?>" onclick="return confirm('Are you sure?');"><span class="glyphicon glyphicon-trash"> </span></a>
                            </td>
                        </tr>
                       
                       
                    <?php endforeach; ?>
                </tbody>
              </table>

            
              <div>
                <u>
                  <p align="right" style="font-size:30px;color:black">Total Sales: ₱
                    <?php  
                      $sales = $database->compute_total_sales($branch_id,$startDate);
                      echo $sales;
                    ?>
                  </p>
                </ul>
                
                <div align="left">
                     <h4>Actual Cash: ₱
                <?php  
                  $actual_cash = $database->actual_cash($branch_id,$startDate);
                  $cash = $actual_cash["amount"];
                  echo $cash;
                ?>
              </h4>
                
              <h4>Total Expenses: ₱
                <?php  
                  $expense = $database->compute_total_expenses($branch_id,$startDate); 
                  echo $expense;
                ?>
              </h4>
                <u>
                  <h4>Total Cash Advance: ₱
                 
                    <?php  
                        $ca = $database->compute_total_CA($branch_id,$startDate); 
                        echo $ca;
                     ?>
                     
                  </h4>
                </u>
                
              <p style="font-size:30px;color:black">
                    <u>
                      Total Sales of the Day : ₱
                    <?php 
                      
                      $total = $cash + $expense + $ca;
                      echo $total . ".00";
                  
                       
                    ?>
                    </u>
              </p>
                </div>
              
             
              
              <p align="center" style="font-size:40px;color:red">
                    <u>
                      Final Total : ₱
                    <?php 
                      
                     $final_total = $total - $sales;
                      
                      echo $final_total . ".00";
                  
                       
                    ?>
                    </u>
              </p>
              
               <p align="center" style="font-size:50px;color:blue">
                    <u>
                      Remarks:
                    <?php 
                    //If  total sales is greater than sales of the day = Short
                    
                       if($sales > $total){
                           echo "Short";
                           
                       }
                       else if($sales == $total){
                           echo "Balance";
                           
                       }
                       
                       else{
                            echo "Over";
                       }
                       
                       
                    ?>
                    </u>
              </p>

             
                  
                   <button id="printPageButton" type="submit" onclick="window.print()" name="submit" class="btn btn-info"> <i class="glyphicon glyphicon-print"></i> Print</button>
                
           
              </div>
            
               <?php else: ?>
                <p style="color:red;">No Records.....</a></p>
            <?php endif ?>
</body>
</html>