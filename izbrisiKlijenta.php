<?php 

include "backend/connect.php";

if(isset($_GET['id']) && $_GET['id'] != ''){
    $id = $_GET['id'];
} else {
    header("location: klijenti.php");
}

$sql = "DELETE FROM klijent WHERE id = $id";
try{
    $rez = mysqli_query($db_conn, $sql);
    } catch(Exception $e){
        header("location:klijenti.php?msg=deleteErr");
        exit;
    }

header("location: klijenti.php");



?>


