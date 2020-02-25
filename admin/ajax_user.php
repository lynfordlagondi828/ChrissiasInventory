<?php

    require_once 'includes/DbFunctions.php';
    $database = new DbFunctions();

    if(isset($_POST["key"])){

        if($_POST["key"] == "user_list"){

            $start =trim($_POST["start"]);
            $limit = trim($_POST["limit"]);
            $result = $database->get_all_bakers_account($start,$limit);


            if(count($result)>0){

                $response ="";
    
                foreach($result as $key){
    
                    $response .='
                        <tr>
                            
                            <td>'.$key['lastname'].'</td>
                            <td>'.$key['firstname'].'</td>
                            <td>'.$key['middlename'].'</td>
                            <td>'.$key['fullname'].'</td>
                            <td>'.$key['username'].'</td>
                            <td>'.$key['branch_name'].'</td>
                            <td>'.$key['address'].'</td>
                            <td>
                                <button class="btn btn-info" style="padding:5px; margin:2px" onClick="ViewOreditRow('.$key['id'].', \'edit\')">
                                <span class="glyphicon glyphicon-edit">Change</span>
                                </button>
                                <button class="btn btn-danger" style="padding:5px; margin:2px" onClick="deleteRow('.$key['id'].')"">
                                    <span class="glyphicon glyphicon-remove">Remove</span>
                                </button>

                               
                            </td>
                        </tr>
                    ';
                }
                exit($response);
            } else {
                exit("reachedMax");
            }
        }

        //create users
        if($_POST["key"] == "addNew"){

            $branch_id = trim($_POST["branch_id"]);
            $lastname = trim($_POST["lastname"]);
            $firstname = trim($_POST["firstname"]);
            $middlename = trim($_POST["middlename"]);
            $fullname = " " . $firstname . " " . " " . $middlename . " " . " " . $lastname;
            $username = trim($_POST["username"]);
            $password = trim($_POST["password"]);

            if($database->check_bakers_username_if_exists($username)){

                exit("Sorry! Username exists");

            } else {

                $database->create_bakers_account($branch_id,$lastname,$firstname,$middlename,$fullname,$username,$password);
                exit('success');
            }
        }

        //get single branch
         //get single row
         if($_POST["key"] == "get_single_row"){

            $rowID = trim($_POST["rowID"]);
            $rows = $database->get_single_bakers_account($rowID);

            $jsonArray = array(
                "lastname" =>$rows["lastname"],
                "firstname" =>$rows["firstname"],
                "middlename" =>$rows["middlename"],
                "username" =>$rows["username"],

            );
            exit(json_encode($jsonArray));
        }

        //delete branch
        if($_POST["key"] == "delete"){

            $rowID = trim($_POST["rowID"]);
            $database->delete_bakers_account($rowID);
            exit('success');
        }

        //update branch
        if($_POST["key"] == "updateRow"){

            $rowID = trim($_POST["rowID"]);
            $branch_id = trim($_POST["branch_id"]);
            $lastname = trim($_POST["lastname"]);
            $firstname = trim($_POST["firstname"]);
            $middlename = trim($_POST["middlename"]);
            $username = trim($_POST["username"]);
            $password = trim($_POST["password"]);

            $database->update_bakers_account_info($rowID,$branch_id,$lastname,$firstname,$middlename,$username,$password);

            exit('success');
        }

        //delete bakers account
        if($_POST["key"]=="delete"){
            
            $rowID = trim($_POST["rowID"]);
            $database->delete_bakers_account($rowID);
            exit("success");
        }

       
    }
?>





















