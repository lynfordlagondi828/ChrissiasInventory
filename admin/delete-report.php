<?php 
session_start();
    if(!isset($_SESSION["isloggedin"])){
    
        header('location:index.php');
        exit();
    }
    
    
    require_once 'includes/DbFunctions.php';
    $database = new DbFunctions();
    require_once 'header.php';

    //branch id
    $branch_id =  $_SESSION["branch_id"];

    if(isset($_GET["id"])){
        $id = trim($_GET["id"]);
    }

    $id = intval($_GET["id"]);
    
    $database->delete_report($id);
    
    echo '<script>setTimeout(function(){ 
            window.location = "report-result.php"; 
            }, 200);
    
            </script>';
    
?>