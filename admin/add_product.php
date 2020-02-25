<?php

session_start();
if(!isset($_SESSION["isloggedin"])){

    header('location:login.php');
    exit();
}

require_once 'includes/DbFunctions.php';
$database = new DbFunctions();
require_once 'baker-header.php';

?>
<div class="row">
            <div class="modal-dialog">
                <div class="modal-content">
                <a href="product.php"><span class="glyphicon glyphicon-chevron-left"></span>Return</a>
                    <div class="modal-header">
                        <h2 class="modal-title">Add Product</h2>
                     
                    </div>
                    <div class="modal-header">
                        <div class="modal-body">
                        <form method="POST">
                        <label>Date</label>
                                <input type="date" name="date" id="date" class="form-control" required>   
                            <br>

                            <label>Product Name</label>
                                <input type="number" name="product_name" id="product_name" class="form-control" required>   
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
                                        <input type="number" name="from" id="from" class="form-control" required>
                                    </td>
                                    <td>&nbsp;</td>

                                    <td>
                                        <label>Number of kilo/s</label>
                                        <input type="number" name="num_of_kilo" id="num_of_kilo" class="form-control" required>
                            
                                    </td>
                            </table>
                           
                            
                        <table>
                            <tr>
                                <td>
                                    <label>Quantity</label>
                                    <input type="number" name="quantity" id="quantity" class="form-control" required>
                           
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Unsold goods</label>
                                    <input type="number" name="unsold" id="unsold" class="form-control" required>
                        
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Pullout</label>
                                    <input type="number" name="pullout" id="pullout" class="form-control" required>
                                </td>
                            </tr>
                        </table>
                        
                        <td>
                            <label>Price</label>
                            <input type="number" name="price" id="price" class="form-control" required>
                        </td>
                        </div>
                        <button class="btn btn-success" name="submit"><span class="glyphicon glyphicon-ok"> SAVE</span></button>
                        
                        
                    </form>
                </div>
            </div>
        </div>