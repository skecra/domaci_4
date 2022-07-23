<?php 

include "backend/connect.php";


if(isset($_POST['model']) && $_POST['model'] != ""){
    $model = $_POST['model'];
} else {
    header("location: modeli.php?greska1");
}

if(isset($_POST['proizvodjac_id']) && $_POST['proizvodjac_id'] != ""){
    $proizvodjac_id = $_POST['proizvodjac_id'];
} else {
    header("location: modeli.php?greska1");
}

$sql = "INSERT INTO model (model, proizvodjac_id) VALUES ('$model', $proizvodjac_id)";
$res = mysqli_query($db_conn, $sql);
if($res){
    header("location: modeli.php?success");
} else  {
    header("location: modeli.php?err");
}


?>