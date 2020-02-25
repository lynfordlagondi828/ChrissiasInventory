<?php

use FontLib\Table\Type\head;

session_start();
if(!isset($_SESSION["isloggedin"])){

    header('location:login.php');
    exit();
}



require_once 'bakerFunctions.php';
$database = new bakersFunctions();
require_once 'baker-header.php';

if(isset($_POST["submit"])){

	$startDate = trim($_POST["startDate"]);
	$_SESSION["startDate"] = $startDate;
	
	echo '<script>setTimeout(function(){ 
        window.location = "baker-report-result.php"; 
        }, 500);
        </script>
        ';
}
?>

<div class="row">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="glyphicon glyphicon-check"></i>Generate Report
			</div>
			<!-- /panel-heading -->
			<div class="panel-body">
				
			<form class="form-horizontal"  method="POST">
				  <div class="form-group">
				    <label for="startDate" class="col-sm-2 control-label"> Date</label>
				    <div class="col-sm-10">
				      <input type="date" class="form-control" id="startDate" name="startDate" placeholder="Start Date" required />
				    </div>
				  </div>
				  
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" name="submit" class="btn btn-success"> <i class="glyphicon glyphicon-ok-sign"></i> Generate Report</button>
				    </div>
				  </div>
				</form>
			</div>
			<!-- /panel-body -->
		</div>
	</div>
            </div>
        </div>
