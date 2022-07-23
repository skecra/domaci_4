<?php 

include "backend/connect.php";

if(isset($_GET['id']) && $_GET['id'] != ""){
    $id = $_GET['id'];
} else {
    header("location: vozila.php?greskaBrisanjeSlika");
}

$sql = "DELETE FROM slike WHERE vozilo_id=$id";
$res = mysqli_query($db_conn, $sql);

if($res){
    header("location: izmijeniVozilo.php?id=$id&&slikeObrisane");
} else {
    header("location: izmijeniVozilo.php?id=$id&&greskaBrisanjeSlika");
}

?>