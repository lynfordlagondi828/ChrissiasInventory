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


//post method
if(isset($_POST["submit"])){

    $product_id = trim($_POST["product_id"]);
    //get_pname
    $pname = $database->get_price($product_id);
    $product_name = $pname["category_name"];

    $beginning = trim($_POST["beginning"]);
    $from_branch = trim($_POST["from_branch"]);
    $num_of_kilos = trim($_POST["num_of_kilos"]);

    $quantity = trim($_POST["quantity"]);

    $total = $beginning + $from_branch + $quantity;

    $unsold_goods = trim($_POST["unsold_goods"]);

    //pricing
    $price_data = $database->get_price($product_id);
    $price = $price_data["price"];


    $pullout = trim($_POST["pullout"]);

    $partial_total = $total - $pullout;

    $final_total = $partial_total - $unsold_goods;

    $sales = $final_total * $price;

    $date = date("Y/m/d");

    $database->add_products($branch_id,$product_name,$beginning,$from_branch,$num_of_kilos,
    $quantity,$total,$unsold_goods,$price,$pullout,$sales,$date);



    echo '<script>setTimeout(function(){
            window.location = "baker-product.php";
            }, 500);

    </script>
   ';
}


?>
<div class="row">
            <div class="modal-dialog">
                <div class="modal-content">
                <a href="baker-product.php"><span class="glyphicon glyphicon-chevron-left"></span>Return</a>
                    <div class="modal-header">
                        <h2 class="modal-title">Add Product</h2>

                    </div>
                    <div class="modal-header">
                        <div class="modal-body">
                        <form method="POST">
                        <label>Date</label>
                                <h3>Today is <?php $date = date("Y/m/d"); echo $date; ?></h3>
                        <br>

                            <label>Product Name</label>
                            <select name="product_id" id="product_id" class="form-control" required>
                                            <option value="">Select Product</option>
                                            <?php
                                               echo $database->fetchCategory();
                                            ?>
                                    </select>
                                <br>

                            <table>
                                <tr>
                                    <td>
                                        <label>Beginning</label>
                                        <input type="number" name="beginning" id="beginning" class="form-control" required>
                                    </td>
                                    <td>&nbsp;</td>

                                    <td>
                                    <label>From Main</label>
                                        <input type="number" name="from_branch" id="from" class="form-control" required>
                                    </td>
                                    
                                  <td>&nbsp;</td>
                                    <td>
                                        <label>Num of kilo/s</label>
                                        <input type="number" name="num_of_kilos" id="num_of_kilos" class="form-control" required>
                                    </td>
                                    
                                      <td>&nbsp;</td>
                                    <td>
                                        <label>Quantity</label>
                                        <input type="number" name="quantity" id="quantity" class="form-control" required>
                                    </td>
                                    
                                    
                                   
                                    
                                   
                                    
                                  
                                </tr>
                              


                            </table>


                        <table>
                            <tr>
                                 <td>&nbsp;</td>
                                    <td>
                                        <label>Unsold goods</label>
                                        <input type="number" name="unsold_goods" id="unsold" class="form-control" required>

                                    </td>
                                    
                                      <td>&nbsp;</td>
                                    <td>
                                        <label>Pullout</label>
                                        <input type="number" name="pullout" id="pullout" class="form-control" required>
                                    </td>



                            </tr>
                        </table>


                        </div>
                        <button class="btn btn-success" name="submit"><span class="glyphicon glyphicon-ok"> SAVE</span></button>


                    </form>
                </div>
            </div>
        </div>
