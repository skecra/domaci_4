<?php 

include "backend/connect.php";

if(isset($_POST['naziv']) && $_POST['naziv'] != ""){
    $naziv = $_POST['naziv'];
}

$sql = "INSERT INTO drzave (naziv) VALUES ('$naziv')";
$res = mysqli_query($db_conn, $sql);
if($res){
    header("location: drzave.php?success");
} else {
    header("location: drzave.php?err");
}


?>