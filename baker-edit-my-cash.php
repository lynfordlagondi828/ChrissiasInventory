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

    if(isset($_GET["id"])){
        $id = trim($_GET["id"]);
    }

    $id = intval($_GET["id"]);

    $exp = $database->singleMyCash($branch_id,$id);
    $amount = $exp["amount"];

    //post to edit expenses
    if(isset($_POST["submit"])){

        $amount = trim($_POST["amount"]);

        $database->editMyCash($id,$amount);
        echo '<script>setTimeout(function(){ 
          window.location = "baker-my-cash.php"; 
          }, 500);
          </script>
          ';
    }
?>


<div class="row">
            <div class="modal-dialog">
                <div class="modal-content">
                <a href="baker-my-cash.php"><span class="glyphicon glyphicon-chevron-left"></span>Return</a>
                    <div class="modal-header">
                        <h2 class="modal-title">Edit</h2>
                     
                    </div>
                    <!-- /panel-heading -->
			<div class="panel-body">
				
                <form class="form-horizontal" method="post">

                     

                      <div class="form-group">
                        <label for="startDate" class="col-sm-2 control-label">Amount ₱</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" id="amount" name="amount" value="<?php echo htmlentities($amount); ?>"/>
                        </div>
                      </div>

                     
                      
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" name="submit" class="btn btn-info"> <i class="glyphicon glyphicon-floppy-saved"></i> Save</button>
                        </div>
                      </div>
                    </form>
                </div>
                <!-- /panel-body -->
            </div>
        </div>