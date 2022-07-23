<?php 

include "backend/connect.php";

if(isset($_POST['id']) && $_POST['id'] != ""){
    $id = $_POST['id'];
} else {
    header('location: proizvodjaci.php?greska1');
}

if(isset($_POST['model']) && $_POST['model'] != ""){
    $model = $_POST['model'];
} else {
    header('location: proizvodjaci.php?greska2');
}

if(isset($_POST['proizvodjac_id']) && $_POST['proizvodjac_id'] != ""){
    $proizvodjac_id = $_POST['proizvodjac_id'];
} else {
    header('location: proizvodjaci.php?greska2');
}

$sql = "UPDATE model SET model = '$model', proizvodjac_id = $proizvodjac_id WHERE ID = $id";
$res = mysqli_query($db_conn, $sql); 
if($res){
    header("location: modeli.php?success");
} else {
    header("location: modeli.php?err");
}
?>