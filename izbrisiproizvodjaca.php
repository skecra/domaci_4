<?php 

include "backend/connect.php";

if(isset($_GET['id']) && $_GET['id'] != ''){
    $id = $_GET['id'];
} else {
    header("location: proizvodjaci.php");
}

$sql = "DELETE FROM proizvodjac WHERE id = $id";
try{
    $rez = mysqli_query($db_conn, $sql);
    } catch(Exception $e){
        header("location:proizvodjaci.php?msg=deleteErr");
        exit;
    }


    header("location: proizvodjaci.php");



?>


