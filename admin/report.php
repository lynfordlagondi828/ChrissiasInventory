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

    $id = trim($_GET["id"]);
}

$id = intval($_GET["id"]);

if(isset($_POST["submit"])){

	$startDate = trim($_POST["startDate"]);
    $_SESSION["startDate"] = $startDate;

    //ids
    $_SESSION["id"] = $id;

    
	

	echo '<script>setTimeout(function(){ 
		window.location = "report-result.php"; 
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


