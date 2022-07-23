<?php 

include "backend/connect.php";


if(isset($_POST['ime']) && $_POST['ime'] != ''){
    $ime = $_POST['ime'];
} else {
    header('location: klijenti.php?greska');
}

if(isset($_POST['prezime']) && $_POST['prezime'] != ''){
    $prezime = $_POST['prezime'];
} else {
    header('location: klijenti.php?greska');
}

if(isset($_POST['drzava_id']) && $_POST['drzava_id'] != ''){
    $drzava_id = $_POST['drzava_id'];
} else {
    header('location: klijenti.php?greska');
}

if(isset($_POST['pasos']) && $_POST['pasos'] != ''){
    $pasos = $_POST['pasos'];
} else {
    header('location: klijenti.php?greska');
}


$sql = " INSERT INTO klijent(ime, prezime, drzava_id, broj_pasosa) VALUES('$ime', '$prezime', $drzava_id, '$pasos')";
$rez = mysqli_query($db_conn, $sql);
if($rez){
    header("location: klijenti.php?success");
} else{
    header("location: klijenti.php?err");
}

?>