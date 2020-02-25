<?php

    require_once 'includes/DbFunctions.php';
    $database = new DbFunctions();

    if(isset($_POST["key"])){

        if($_POST["key"] == "branch_list"){

            $start =trim($_POST["start"]);
            $limit = trim($_POST["limit"]);
            $result = $database->get_all_branch($start,$limit);


            if(count($result)>0){

                $response ="";
    
                foreach($result as $key){

                
    
                    $response .='
                        <tr>
                            <td>'.$key['branch_name'].'</td>
                            <td>'.$key['address'].'</td>
                            <td>
                                <button onClick="ViewOreditRow('.$key['id'].', \'edit\')">
                                <span class="glyphicon glyphicon-edit"></span>
                                </button>
                                <button onClick="deleteRow('.$key['id'].')"">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </button>
                                <a class="btn btn-success" href="product.php?id='.$key['id'].'">Products</a>
                                <a class="btn btn-primary" href="expenses.php?id='.$key['id'].'">Expenses</a>
                                <a class="btn btn-warning" href="cash-advance.php?id='.$key['id'].'">Cash Advance</a>
                                <a class="btn btn-danger" href="report.php?id='.$key['id'].'">Generate Report</a>
                                  <a class="btn btn-info" href="cash_report.php?id='.$key['id'].'">Generate Cash Advance</a>
                              
                               
                              
                            </td>
                        </tr>
                    ';
                }
                exit($response);
            } else {
                exit("reachedMax");
            }
        }

       

        //create branch
        if($_POST["key"] == "addNew"){

            $branch_name = trim($_POST["branch_name"]);
            $address = trim($_POST["address"]);

            $database->create_branch($branch_name,$address);
            exit("success");
        }

        //get single branch
         //get single row
         if($_POST["key"] == "get_single_row"){

            $rowID = trim($_POST["rowID"]);
            $rows = $database->get_single_branch($rowID);

            $jsonArray = array(
                "branch_name" =>$rows["branch_name"],
                "address" => $rows["address"],

            );
            exit(json_encode($jsonArray));
        }

        //delete branch
        if($_POST["key"] == "delete"){

            $rowID = trim($_POST["rowID"]);
            $database->delete_branch($rowID);
            exit('success');
        }

        //update branch
        if($_POST["key"] == "updateRow"){

            $rowID = trim($_POST["rowID"]);
            $branch_name = trim($_POST["branch_name"]);
            $address = trim($_POST["address"]);

            $database->update_branch_info($rowID,$branch_name,$address);
            exit('success');
        }

       
    }
?>





















