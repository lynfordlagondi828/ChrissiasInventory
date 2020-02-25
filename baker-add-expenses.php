<?php

session_start();
if(!isset($_SESSION["isloggedin"])){

    header('location:index.php');
    exit();
}


require_once 'bakerFunctions.php';
$database = new bakersFunctions();
require_once 'baker-header.php';

//branch id
$branch_id =  $_SESSION["branch_id"];

if(isset($_POST["submit"])){

  $name = trim($_POST["name"]);
  $amount = trim($_POST["amount"]);
  $created_at = trim($_POST["created_at"]);

  if($database->checkExpensesIfAlreadyExists($branch_id,$name,$amount,$created_at)){
    
    echo 'Expenses already added..';

  } else {

      $database->insertBakerExpenses($branch_id,$name,$amount,$created_at);
      echo '<script>setTimeout(function(){ 
        window.location = "baker-expenses.php"; 
        }, 500);
        </script>
        ';

  }

  
}


?>


<div class="row">
            <div class="modal-dialog">
                <div class="modal-content">
                <a href="baker-expenses.php"><span class="glyphicon glyphicon-chevron-left"></span>Return</a>
                    <div class="modal-header">
                        <h2 class="modal-title">Add Expenses</h2>
                     
                    </div>
                    <!-- /panel-heading -->
			<div class="panel-body">
				
                <form class="form-horizontal" method="post">

                      <div class="form-group">
                        <label for="startDate" class="col-sm-2 control-label">Fullname</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="name" name="name" placeholder="Name" required />
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="startDate" class="col-sm-2 control-label">Amount ₱</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" id="amount" name="amount" placeholder="0.00" required />
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="startDate" class="col-sm-2 control-label"> Date</label>
                        <div class="col-sm-10">
                          <input type="date" class="form-control" id="created_at" name="created_at" placeholder="Start Date" required />
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" name="submit" class="btn btn-success"> <i class="glyphicon glyphicon-floppy-saved"></i> Save</button>
                        </div>
                      </div>
                    </form>
                </div>
                <!-- /panel-body -->
            </div>
        </div>