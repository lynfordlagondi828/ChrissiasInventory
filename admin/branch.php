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
                        <h2 class="modal-title">Manage Branches</h2>
                    </div>
                    <div class="modal-header">
                        <div class="modal-body">
                            <div id="editContent">
                            
                                    <label id="bid">Branch Name</label>
                                    <input type="text" name="branch_name" id="branch_name" class="form-control" required>
                                  
                                <br>
                                    <label>Address</label>
                                    
                                    <input type="text" name="address" id="address" class="form-control" required>
                                       

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
                            	<h1 class="panel-title">Branch </h1>
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

            $("#branch_name").val("");
            $("#address").val("");
            $("#closeBtn").fadeOut();
            $("#manageBtn").attr('value', 'Save').attr('onclick', "manageData('addNew')").fadeIn();
         
        });

        fetchBranches(0,10);
        
    });

    //fetch all price list
    function fetchBranches(start,limit){

        $.ajax({
            url:'ajax_branch.php',
            method:'POST',
            dataType:'text',
            data:{
                key:'branch_list',
                start:start,
                limit:limit
            },success:function(response){

                if(response != "reachedMax"){

                    $('tbody').append(response);

                    start += limit;
                    fetchBranches(start,limit);
                } else {

                    $(".table").DataTable();
                }
            }
        });
    }

    //Manage Data
    function manageData(key){

        var branch_name = $("#branch_name");
        var address = $("#address");
        var editRowID = $("#editRowID");

        if(isNotEmpty(branch_name) && isNotEmpty(address)){

            $.ajax({
                
                url: 'ajax_branch.php',
                method:'POST',
                dataType:'text',
                data:{
                    key:key,
                    branch_name:branch_name.val(),
                    address:address.val(),
                    rowID:editRowID.val()
                },success:function(response){

                    if(response){
							alert(response);
							$("#tableManager").modal('hide');
							window.location="branch.php";
							
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
                url:'ajax_branch.php',
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
                        
                        $("#showContent").fadeIn();
                        $("#bname").html(response.branch_name);
                        $("#add").html(response.address);
                    
                    } else {
                        $("#editContent").fadeIn();
                            $("#showContent").fadeOut();
                            $("#closeBtn").fadeIn();
                            $("#manageBtn").fadeIn();
                            $("#editRowID").val(rowID);
                            
                            $("#branch_name").val(response.branch_name);
                            $("#address").val(response.address)
                    
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
                url:'ajax_branch.php',
                method:'POST',
                dataType:'text',
                data:{
                    key:'delete',
                    rowID:rowID
                },success:function(response){
                    $("#product_name"+rowID).parent().remove();
                    alert(response);
                    window.location='branch.php';
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
