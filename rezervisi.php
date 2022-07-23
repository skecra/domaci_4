<?php 

include "backend/connect.php";



if(isset($_POST['klijent_id']) && $_POST['klijent_id'] != "" ){
    $klijent_id = $_POST['klijent_id'];
} else {
    header("location: detaljiVozila.php?greska&&id=$vozilo_id");
}
if(isset($_POST['datum_od']) && $_POST['datum_od'] != "" ){
    $datum_od = $_POST['datum_od'];
} else {
    header("location: detaljiVozila.php?greska&&id=$vozilo_id");
}
if(isset($_POST['datum_do']) && $_POST['datum_do'] != "" ){
    $datum_do = $_POST['datum_do'];
} else {
    header("location: detaljiVozila.php?greska&&id=$vozilo_id");
}
if(isset($_POST['ukupnaCijena']) && $_POST['ukupnaCijena'] != "" ){
    $ukupnaCijena = $_POST['ukupnaCijena'];
} else {
    header("location: detaljiVozila.php?greska&&id=$vozilo_id");
}
if(isset($_POST['vozilo_id']) && $_POST['vozilo_id'] != "" ){
    $vozilo_id = $_POST['vozilo_id'];
} else {
    header("location: detaljiVozila.php?greska&&id=$vozilo_id");
}

$sql = "INSERT INTO 
rezervacije (klijent_id, vozilo_id, rezervisano_od, rezervisano_do, ukupna_cijena)
VALUES ($klijent_id, $vozilo_id, '$datum_od', '$datum_do', $ukupnaCijena)  ";

$res = mysqli_query($db_conn, $sql);
if($res){
    header("location: index.php?success");
} else {
    header("location: index.php?err");
}

?>