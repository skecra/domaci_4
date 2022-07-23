<?php 

include "backend/connect.php";

if(isset($_GET['id']) && $_GET['id'] != ''){
    $id = $_GET['id'];
} else {
    header("location: modeli.php");
}

$sql = "DELETE FROM model WHERE id = $id";
try{
    $rez = mysqli_query($db_conn, $sql);
    } catch(Exception $e){
        header("location:modeli.php?msg=deleteErr");
        exit;
    }

header("location: modeli.php");



?>


