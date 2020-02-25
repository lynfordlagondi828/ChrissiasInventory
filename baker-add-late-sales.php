<?php

session_start();
if(!isset($_SESSION["isloggedin"])){

    header('location:index.php');
    exit();
}

require_once 'bakerFunctions.php';
$database = new bakersFunctions();
require_once 'baker-header.php';

$branch_id =  $_SESSION["branch_id"];

if(isset($_POST["submit"])){
    
    $created_at = trim($_POST["created_at"]);
    
    $_SESSION["created_at"] = $created_at;
    
   echo '<script>setTimeout(function(){ 
        window.location = "upload-late-sales.php"; 
        }, 500);
        </script>
        ';
}
?>


<div class="row">
            <div class="modal-dialog">
                
                    <!-- /panel-heading -->
			<div class="panel-body">
				
                <form class="form-horizontal" method="post">

                    

                      <div class="form-group">
                        <label for="startDate" class="col-sm-2 control-label">Select Date</label>
                        <div class="col-sm-10">
                          <input type="date" class="form-control" id="created_at" name="created_at" placeholder="Start Date" required />
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" name="submit" class="btn btn-primary"> Continue</button>
                        </div>
                      </div>
                    </form>
                </div>
                <!-- /panel-body -->
            </div>
        </div>