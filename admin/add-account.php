<?php

   session_start();
    if(!isset($_SESSION["isloggedin"])){

        header('location:index.php');
       exit();
    }

    require_once 'includes/DbFunctions.php';
    $database = new DbFunctions();
    require_once 'header.php';

        
   

     $err_msg = "";

if(isset($_POST["submit"])){

    $lastname = $_POST["lastname"];
    $firstname = $_POST["firstname"];
    $middlename = $_POST["middlename"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    if($database->chekcAdminUserName($username)){

        $err_msg = "Unable to add account. " . $username . " already exists.";

    } else {

        $database->user_registration($lastname,$firstname,$middlename,$username,$password);
        
        echo '<script>setTimeout(function(){ 
          window.location = "admin-account.php"; 
          }, 500);
      
      </script>
      ';
    }
}

?>


<div class="row">
            <div class="modal-dialog">
                <div class="modal-content">
                <a href="admin-account.php"><span class="glyphicon glyphicon-chevron-left"></span>Return</a>
                    <div class="modal-header">
                        <h2 class="modal-title">Add Admin Account</h2>
                     
                    </div>
                    <!-- /panel-heading -->
			<div class="panel-body">
				
                <form class="form-horizontal" method="post">

                      <div class="form-group">
                        <label for="startDate" class="col-sm-2 control-label">Lastname</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="name" name="lastname" placeholder="Lastname" required />
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="startDate" class="col-sm-2 control-label">Firstname</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="firstname" placeholder="Firstname" required />
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="startDate" class="col-sm-2 control-label">Middlename</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="middlename" placeholder="Middlename" required />
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="startDate" class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="username" placeholder="Username" required />
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="startDate" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="password" placeholder="Password" required />
                        </div>
                      </div>

                     
                      
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" name="submit" class="btn btn-success"> <i class="glyphicon glyphicon-floppy-saved"></i> Save</button>
                        <p><?php echo $err_msg; ?></p>
                        </div>
                      </div>
                    </form>
                </div>
                <!-- /panel-body -->
            </div>
        </div>