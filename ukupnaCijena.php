<?php

include "backend/connect.php";



function dateDiff($date1, $date2)
{
    $date1_ts = strtotime($date1);
    $date2_ts = strtotime($date2);
    $diff = $date2_ts - $date1_ts;
    return round($diff / 86400);
}



if(isset($_GET['vozilo_id'])){
    $id = $_GET['vozilo_id'];
}else{
    echo json_encode([]);
    exit;
}

if(isset($_GET['datum_od'])){
    $datum_od = $_GET['datum_od'];
}else{
    echo json_encode([]);
    exit;
}

if(isset($_GET['datum_do'])){
    $datum_do = $_GET['datum_do'];
}else{
    echo json_encode([]);
    exit;
}

$sql = "SELECT * FROM vozila WHERE ID=$id";

$rez = mysqli_query($db_conn, $sql);
$vozilo = mysqli_fetch_assoc($rez);

$niz = [];
$brojDana = dateDiff($datum_od, $datum_do);
$ukupno = $brojDana * $vozilo['cijena'];
$niz[]=$ukupno;
echo json_encode($niz);
?>