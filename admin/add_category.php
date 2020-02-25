<?php

session_start();
if(!isset($_SESSION["isloggedin"])){

    header('location:index.php');
    exit();
}


require_once 'includes/DbFunctions.php';
$database = new DbFunctions();
require_once 'header.php';

//branch id
$branch_id =  $_SESSION["branch_id"];

if(isset($_POST["submit"])){
    
    $category_name = trim($_POST["category_name"]);
    $price = trim($_POST["price"]);
    
    $database->add_category($category_name,$price);
    
     echo '<script>setTimeout(function(){ 
            window.location = "category.php"; 
            }, 500);
    
    </script>';
}
  


?>


<div class="row">
            <div class="modal-dialog">
                <div class="modal-content">
                <a href="category.php"><span class="glyphicon glyphicon-chevron-left"></span>Return</a>
                    <div class="modal-header">
                        <h2 class="modal-title">Add Bread</h2>
                     
                    </div>
                    <!-- /panel-heading -->
			<div class="panel-body">
				
                <form class="form-horizontal" method="post">

                      <div class="form-group">
                        <label for="startDate" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Name" required />
                        </div>
                      </div>
                      
                       <div class="form-group">
                        <label for="startDate" class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" id="price" name="price" placeholder="price" required />
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