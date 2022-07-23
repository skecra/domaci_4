<?php 

include "backend/connect.php";

if(isset($_POST['id']) && $_POST['id'] != ""){
    $id = $_POST['id'];
} else {
    header('location: klijenti.php?greska1');
}

if(isset($_POST['ime']) && $_POST['ime'] != ""){
    $ime = $_POST['ime'];
} else {
    header('location: klijenti.php?greska2');
}

if(isset($_POST['prezime']) && $_POST['prezime'] != ""){
    $prezime = $_POST['prezime'];
} else {
    header('location: klijenti.php?greska3');
}

if(isset($_POST['drzava_id']) && $_POST['drzava_id'] != ""){
    $drzava_id = $_POST['drzava_id'];
} else {
    header('location: klijenti.php?greska4');
}

if(isset($_POST['pasos']) && $_POST['pasos'] != ""){
    $pasos = $_POST['pasos'];
} else {
    header('location: klijenti.php?greska5');
}

$sql = "UPDATE klijent SET ime = '$ime', prezime = '$prezime', drzava_id = '$drzava_id', broj_pasosa = '$pasos' WHERE id = $id";
$res = mysqli_query($db_conn, $sql);

if($res){
    header("location: klijenti.php?success");
} else {
    header("location: klijenti.php?err");
}

?>