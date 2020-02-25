<?php

    session_start();
    if(!isset($_SESSION["isloggedin"])){

        header('location:login.php');
        exit();
    }



    require_once 'bakerFunctions.php';
    $database = new bakersFunctions();
    require_once 'baker-header.php';

    $branch_id = $_SESSION["branch_id"];
    $startDate = $_SESSION["startDate"];

    $result = $database->bakerGenerateReport($branch_id,$startDate);

    if(isset($_POST["send"])){
        
       
        
        foreach($result as $product){

           $pname =  $product["product_name"];
           $beginning =  $product["beginning"]; 
           $from =  $product["from_branch"]; 
           $num_of_kilos = $product["num_of_kilos"];
           $quantity = $product["quantity"]; 
           $total = $product["total"]; 
           $unsold_goods = $product["unsold_goods"];
           $price = $product["price"]; 
           $pullout =  $product["pullout"]; 
           
           $sales = $product["sales"]; 
           $date = $product["date"]; 

           if($database->check_reportsIfExists($branch_id,$pname,$beginning,$from,$num_of_kilos,$quantity,$total,$unsold_goods,$price,
           $pullout,$sales,$date)){

                

           } else {
            $database->add_reports($branch_id,$pname,$beginning,$from,$num_of_kilos,$quantity,$total,$unsold_goods,$price,
            $pullout,$sales,$date);
            
           }

        }
        
        
        $cash_on_hand = trim($_POST["cash_on_hand"]);
        
        if($database->check_insert_actual_cash($branch_id,$cash_on_hand,$date)){
          
            
           // $database->update_insert_actual_cash($branch_id,$date,$cash_on_hand);
           
        }else{
            
            
              $database->insert_actual_cash($branch_id,$cash_on_hand,$date);
        }
       

       
     
    }

    

?>

<body>
	<div class="container well">
    
		<h1 class="text-center">Reports for <?php echo $startDate ?></h1>
		    
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
                    <th>Date</th>
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
                            <td><?php echo htmlentities($res["date"]); ?></td>
                        </tr>
                       
                       
                    <?php endforeach; ?>
                </tbody>
              </table>
              
            <div align="center">
            <h3>Report Status:
                
                <?php
                     $status = $database->status($branch_id,$startDate); 
                     $set = $status["status"];
                     
                ?>

                <p
                     <i class="glyphicon glyphicon-check"><?php echo $set;  ?></i>
                </p>
               
            </h3>

           

              
                <form method="post">
                 <button class="btn btn-success" name="send"><span class="glyphicon glyphicon-send "> Send</span></button>
                
                 <?php if($database->check_report_status($branch_id,$startDate)): ?>
                    
                  
                   
               <?php else: ?>
               <input type="number" name="cash_on_hand" placeholder="Actual Cash on Hand" required>
               
                </form>
                 <?php endif ?>
               
               
               
                
            </div>
               <?php else: ?>
                <p style="color:red;">No Records.....</a></p>
            <?php endif ?>
</body>
</html>