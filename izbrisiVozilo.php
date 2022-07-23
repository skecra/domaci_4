<?php 

include "backend/connect.php";

if(isset($_GET['id']) && $_GET['id'] != ''){
    $id = $_GET['id'];
} else {
    header("location: vozila.php");
}

$sql = "DELETE FROM vozila WHERE id = $id";
try{
    $rez = mysqli_query($db_conn, $sql);
    } catch(Exception $e){
        header("location:vozila.php?msg=deleteErr");
        exit;
    }


    header("location: vozila.php");



?>


