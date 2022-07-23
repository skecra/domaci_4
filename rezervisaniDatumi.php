<?php 

include "backend/connect.php";

if(isset($_GET['id']) && $_GET['id'] != ''){
    $id = $_GET['id'];
} 

$sql = "select * from rezervacije,
(select adddate('1970-01-01',t4.i*10000 + t3.i*1000 + t2.i*100 + t1.i*10 + t0.i) selected_date from
 (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t0,
 (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t1,
 (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t2,
 (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t3,
 (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t4) v
where selected_date between rezervacije.rezervisano_od and rezervacije.rezervisano_do and vozilo_id=$id and otkazano='false'";

$res = mysqli_query($db_conn, $sql);
$datumiNiz = [];
while($row = mysqli_fetch_assoc($res)){
    // $datumiNiz []= $row['selected_date'];
    $nizDatum = explode("-", $row['selected_date']);
    if($nizDatum[2][0] == 0){
        $nizDatum[2] = str_replace("0","", $nizDatum[2]) ;
    }
    $datum = implode("-", $nizDatum);

    $datumiNiz []= $datum;
}

echo json_encode($datumiNiz);



// select * from rezervacije,
//  (select adddate('1970-01-01',t4.i*10000 + t3.i*1000 + t2.i*100 + t1.i*10 + t0.i) selected_date from
//   (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t0,
//   (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t1,
//   (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t2,
//   (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t3,
//   (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t4) v
//  where selected_date between rezervacije.rezervisano_od and rezervacije.rezervisano_do and vozilo_id=26;

?>