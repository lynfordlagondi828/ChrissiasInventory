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
$database->delete_single_product($id);
echo '<script>setTimeout(function(){ 
    window.location = "baker-product.php"; 
    }, 500);

</script>
';

?>