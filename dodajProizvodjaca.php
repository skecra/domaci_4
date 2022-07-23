<?php 

include "backend/connect.php";

if(isset($_POST['naziv']) && $_POST['naziv'] != ""){
    $naziv = $_POST['naziv'];
} else {
    header("location: proizvodjaci.php?err");
}

$sql = "INSERT INTO proizvodjac (naziv) VALUES ('$naziv')";
$res = mysqli_query($db_conn, $sql);
if($res){
    header("location: proizvodjaci.php?success");
} else {
    header("location: proizvodjaci.php?error");
}


?>