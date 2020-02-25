<?php

session_start();
if(!isset($_SESSION["isloggedin"])){

    header('location:index.php');
    exit();
}

require_once 'includes/DbFunctions.php';
$database = new DbFunctions();
require_once 'header.php';

?>


<div class="container"> 
        <div id="tableManager" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Manage Users</h2>
                    </div>
                    <div class="modal-header">
                        <div class="modal-body">
                            <div id="editContent">

                                    <select name="branch_id" id="branch_id" class="form-control" required>
                                            <option value="">Select Branch</option>
                                            <?php
                                               echo $database->fetch_branch_to_user_registration();
                                            ?>
                                    </select>

                                    <label>Last Name</label>
                                    <input type="text" name="lastname" id="lastname" class="form-control" required>
                                  
                                <br>
                                    <label>Firstname</label>
                                    
                                    <input type="text" name="firstname" id="firstname" class="form-control" required>
                                <br>
                                <label>Middlename</label>
                                <input type="text" name="middlename" id="middlename" class="form-control" required>
                                <br>
                                <label>Username</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                                <br>
                                <label>Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                               


                                    <input type="hidden" id="editRowID" value="0">
							</div>
							
							<div id="showContent" style="display:none;">
                                <p id="bname">
                                </p>
                                <p id="add">
                                    
                                    </p>
                            </div>

                        
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-primary" data-dismiss="modal" value="Close" id="closeBtn" style="display: none;">
                            <input type="button" id="manageBtn" onclick="manageData('addNew')" value="Save" class="btn btn-success">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-50 col-md-offset-0">
            <div class="panel panel-default">
                    <div class="panel-heading">
                    	<div class="row">
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-6">
                            	<h1 class="panel-title">Users </h1>
                            </div>
                        
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6" align='right'> 
                               
                                <button type="button" name="add" id="addNew" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>Add</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel-body">
                    <table id="table" class="table table-responsive table-bordered">
                        <thead>    
                            <tr>
                               
                                <th>Lastname</th>
                                <th>Firstname</th>
                                <th>Middlename</th>
                                <th>Fullname</th>
                                <th>Username</th>
                                <th>Branch Name</th>
                                <th>Address</th>
                                <th>Actions</th>
                            </tr>
                        <thead>    
                        <tbody>
                        </tbody>
                    </table>
                        </div></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){

        $("#addNew").on('click', function(){
            $("#tableManager").modal('show');
                $("#closeBtn").fadeIn();

        });

        $("#tableManager").on('hidden.bs.modal',function(){

            $("#editContent").fadeIn();
            $("#editRowID").val(0);
            
            $("#showContent").fadeOut();
            $("#branch_id").val("");
            $("#lastname").val("");
            $("#firstname").val("");
            $("#middlename").val("");
            $("#username").val("");
            $("#password").val("");
                            
            $("#closeBtn").fadeOut();
            $("#manageBtn").attr('value', 'Save').attr('onclick', "manageData('addNew')").fadeIn();
         
        });

        fetchBakersAccount(0,10);
        
    });

    //fetch all price list
    function fetchBakersAccount(start,limit){

        $.ajax({
            url:'ajax_user.php',
            method:'POST',
            dataType:'text',
            data:{
                key:'user_list',
                start:start,
                limit:limit
            },success:function(response){

                if(response != "reachedMax"){

                    $('tbody').append(response);

                    start += limit;
                    fetchBakersAccount(start,limit);
                } else {

                    $(".table").DataTable();
                }
            }
        });
    }

    //Manage Data
    function manageData(key){

        var branch_id = $("#branch_id");
        var lastname = $("#lastname");
        var firstname = $("#firstname");
        var middlename = $("#middlename");
        var username = $("#username");
        var password = $("#password");

        var editRowID = $("#editRowID");

        if(isNotEmpty(branch_id) && isNotEmpty(lastname) && isNotEmpty(firstname) && isNotEmpty(middlename) && isNotEmpty(username)
                && isNotEmpty(password)){

            $.ajax({
                
                url: 'ajax_user.php',
                method:'POST',
                dataType:'text',
                data:{
                    key:key,
                    branch_id:branch_id.val(),
                    lastname:lastname.val(),
                    firstname:firstname.val(),
                    middlename:middlename.val(),
                    username:username.val(),
                    password:password.val(),
                    rowID:editRowID.val()
                },success:function(response){

                    if(response){
							alert(response);
							$("#tableManager").modal('hide');
							window.location="user.php";
							
                    	}
                    
						else {
							
							alert(response);
							$("#name_"+editRowID.val()).html(name.val())

							$("#tableManager").modal('hide');
							$("#manageBtn").attr('value', 'Save').attr('onclick', "manageData('addNew')");
						}
                }
            });
        }
    }

    //Edit 
    function ViewOreditRow(rowID, type){

        $.ajax({
                url:'ajax_user.php',
                method:'POST',
                dataType:'json',
                data:{
                    key:'get_single_row',
                    rowID:rowID
                },success:function(response){

                    if (type == "view") {
                        $("#editContent").fadeOut();
                        $("#manageBtn").fadeOut();
                        $("#closeBtn").fadeIn();
                        
                     
                    
                    } else {
                        $("#editContent").fadeIn();
                            $("#showContent").fadeOut();
                            $("#closeBtn").fadeIn();
                            $("#manageBtn").fadeIn();
                            $("#editRowID").val(rowID);
                            
                            $("#branch_id").val(response.branch_id);
                            $("#lastname").val(response.lastname);
                            $("#firstname").val(response.firstname);
                            $("#middlename").val(response.middlename);
                            $("#username").val(response.username);
                            $("#password").val();
                    
                        $("#manageBtn").attr('value', 'Save Changes').attr('onclick', "manageData('updateRow')");
                    }
                 //   $(".modal-title").html(response.);
                    $("#tableManager").modal('show');
                }
        });
    }

    //Delete Record
    function deleteRow(rowID){
                                
        if(confirm("Are you sure?")){
            $.ajax({
                url:'ajax_user.php',
                method:'POST',
                dataType:'text',
                data:{
                    key:'delete',
                    rowID:rowID
                },success:function(response){
                    $("#product_name"+rowID).parent().remove();
                    alert(response);
                    window.location='user.php';
                }
            });
        }
    }
        
    //caller
	function isNotEmpty(caller){

        if(caller.val() ==''){
            
            caller.css('border','1px solid red');
            return false;
        } else 
            caller.css('border','');
        return true;
    }

</script>
