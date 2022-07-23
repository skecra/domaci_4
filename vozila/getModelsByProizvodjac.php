<?php 

include "../backend/connect.php";




if(isset($_GET['proizvodjac_id'])){
    $proizvodjac_id = $_GET['proizvodjac_id'];
}else{
    echo json_encode([]);
    exit;
}
$models = mysqli_query($db_conn, "SELECT * FROM model WHERE proizvodjac_id = $proizvodjac_id ORDER BY model");
$result = [];
while($model = mysqli_fetch_assoc($models)){
    $result[] = $model;
}

echo json_encode($result);




?>