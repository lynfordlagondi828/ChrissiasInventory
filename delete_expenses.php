<?php
    session_start();
    if(!isset($_SESSION["isloggedin"])){

        header('location:index.php');
        exit();
    }


    require_once 'bakerFunctions.php';
    $database = new bakersFunctions();
    require_once 'baker-header.php';
    
    //branch id
    $branch_id =  $_SESSION["branch_id"];

    if(isset($_GET["id"])){
        $id = trim($_GET["id"]);
    }

    $id = intval($_GET["id"]);

    $database->deleteExpenses($id);
    echo '<script>setTimeout(function(){ 
        window.location = "baker-expenses.php"; 
        }, 500);
        </script>
        ';

?>