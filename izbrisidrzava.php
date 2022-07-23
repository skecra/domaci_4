<?php 

include "backend/connect.php";

if(isset($_GET['id']) && $_GET['id'] != ''){
    $id = $_GET['id'];
} else {
    header("location: drzave.php");
}

$sql = "DELETE FROM drzave WHERE id = $id";
try{
    $rez = mysqli_query($db_conn, $sql);
    } catch(Exception $e){
        header("location:drzave.php?msg=deleteErr");
        exit;
    }

header("location: drzave.php");



?>


