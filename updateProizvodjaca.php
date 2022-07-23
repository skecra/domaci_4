<?php 

include "backend/connect.php";

if(isset($_POST['id']) && $_POST['id'] != ""){
    $id = $_POST['id'];
} else {
    header('location: proizvodjaci.php?greska1');
}

if(isset($_POST['naziv']) && $_POST['naziv'] != ""){
    $naziv = $_POST['naziv'];
} else {
    header('location: proizvodjaci.php?greska2');
}

$sql = "UPDATE proizvodjac SET naziv = '$naziv' WHERE ID = $id";
$res = mysqli_query($db_conn, $sql); 
if($res){
    header("location: proizvodjaci.php?success");
} else {
    header("location: proizvodjaci.php?err");
}
?>