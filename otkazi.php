<?php 

include "backend/connect.php";

if(isset($_GET['id']) && $_GET['id'] != ''){
    $id = $_GET['id'];
} else {
    header('location: index.php?err');
}

$sql = "UPDATE rezervacije SET otkazano='true' WHERE ID=$id";
$res = mysqli_query($db_conn, $sql);
if($res){
    header('location: index.php?suc1');
}else {
    header('location: index.php?err1');
}


?>