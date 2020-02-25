<?php
session_start();
if(!isset($_SESSION["isloggedin"])){

    header('location:index.php');
    exit();
}

require_once 'bakerFunctions.php';
$database = new bakersFunctions();
require_once 'baker-header.php';

if(isset($_GET["id"])){

    $id = trim($_GET["id"]);
}

$id = intval($_GET["id"]);

$item = $database->getSingleProduct($id);

    $product_name = $item["product_name"];
    $beginning = $item["beginning"];
    $from_branch = $item["from_branch"];
    $num_of_kilos = $item["num_of_kilos"];

    $quantity = $item["quantity"];

    $total = $beginning + $from_branch + $quantity;

    $unsold_goods = $item["unsold_goods"];
    $price = $item["price"];
    $pullout = $item["pullout"];

    $partial_total = $total - $pullout;

    $sales = $partial_total * $price;

    $date = $item["date"];


    
//post method
if(isset($_POST["submit"])){


    $product_name = trim($_POST["product_name"]);
    $beginning = trim($_POST["beginning"]);
    $from_branch = trim($_POST["from_branch"]);
    $num_of_kilos = trim($_POST["num_of_kilos"]);

    $quantity = trim($_POST["quantity"]);

    $total = $beginning + $from_branch + $quantity;

    $unsold_goods = trim($_POST["unsold_goods"]);
    $price = trim($_POST["price"]);
    $pullout = trim($_POST["pullout"]);

    $partial_total = $total - $pullout;

    $final_total = $partial_total - $unsold_goods;

    $sales = $final_total * $price;

    $date = trim($_POST["date"]);

    $database->edit_products($id,$product_name,$beginning,$from_branch,$num_of_kilos,
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
                <a href="product.php"><span class="glyphicon glyphicon-chevron-left"></span>Return</a>
                    <div class="modal-header">
                        <h2 class="modal-title">Edit Product</h2>
                     
                    </div>
                    <div class="modal-header">
                        <div class="modal-body">
                        <form method="POST">
                        <label>Date</label>
                        
                                <input type="date" name="date" id="date" class="form-control" value="<?php echo htmlentities($date); ?>">   
                        <br>

                            <label>Product Name</label>
                                <input type="text" readonly="readonly" name="product_name" id="product_name" class="form-control" value="<?php echo htmlentities($product_name); ?>">   
                            <br>

                            <table>
                                <tr>
                                    <td>
                                        <label>Beginning</label>
                                        <input type="number" name="beginning" id="beginning" class="form-control" value="<?php echo htmlentities($beginning); ?>">
                                    </td>
                                    <td>&nbsp;</td>

                                    <td>
                                    <label>From Main</label>
                                        <input type="number" name="from_branch" id="from" class="form-control" value="<?php echo htmlentities($from_branch); ?>">
                                    </td>
                                    <td>&nbsp;</td>

                                    <td>
                                        <label>Number of kilo/s</label>
                                        <input type="number" name="num_of_kilos" id="num_of_kilo" class="form-control" value="<?php echo htmlentities($num_of_kilos); ?>">
                            
                                    </td>
                            </table>
                           
                            
                        <table>
                            <tr>
                                <td>
                                    <label>Quantity</label>
                                    <input type="number" name="quantity" id="quantity" class="form-control" value="<?php echo htmlentities($quantity); ?>">
                           
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Unsold goods</label>
                                    <input type="number" name="unsold_goods" id="unsold" class="form-control" value="<?php echo htmlentities($unsold_goods); ?>">
                        
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    
                                    <input type="hidden"  name="price" id="price" class="form-control" value="<?php echo htmlentities($price); ?>">
                                </td>
                            </tr>
                        </table>
                        
                        <td>
                            <label>Pullout</label>
                            <input type="number" name="pullout" id="pullout" class="form-control" value="<?php echo htmlentities($pullout); ?>">
                        </td>
                        </div>
                        <button class="btn btn-success" name="submit"><span class="glyphicon glyphicon-ok"> SAVE</span></button>
                        
                        
                    </form>
                </div>
            </div>
        </div>