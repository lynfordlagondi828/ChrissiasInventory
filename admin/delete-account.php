<?php
    
    session_start();
    if(!isset($_SESSION["isloggedin"])){

        header('location:index.php');
        exit();
    }

    require_once 'includes/DbFunctions.php';
    $database = new DbFunctions();
    require_once 'header.php';

    
        
    if(isset($_GET["id"])){

        $id = $_GET["id"];
    }

    $id = intval($_GET["id"]);

    $database->deleteSingleAdminAccount($id);
    echo '<script>setTimeout(function(){ 
        window.location = "admin-account.php"; 
        }, 500);
    
    </script>
    ';
?>