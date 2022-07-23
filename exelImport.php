<?php 
error_reporting(0);


include "backend/connect.php";
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


function brisanjePraznihNizova($input) {
    return is_array($input) ? array_filter($input, 
        function (& $value) { return $value = brisanjePraznihNizova($value); }
    ) : $input;
}


if(isset($_FILES['exel'])){
    $file = $_FILES['exel']['name'];
} else {
    header("location: klijenti.php?greska");
}
$file = $_FILES['exel']['name'];
$extension = pathinfo($file, PATHINFO_EXTENSION);

if($extension == 'csv'){
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();

} else if ($extension == 'xls'){
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();


} else if ($extension == 'xlsx'){
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();


}
$spreadSheet = $reader->load( $_FILES['exel']['tmp_name']);
$sheetData = $spreadSheet->getActiveSheet()->toArray();
$sheetData = brisanjePraznihNizova($sheetData);
$sql = "";

$upit = "SELECT * FROM klijent";
$rezultat1 = mysqli_query($db_conn, $upit);
$pocetniBrojRedova = mysqli_num_rows($rezultat1);

foreach($sheetData as $i => $row){
    if($i == 0){

    } else {
        $sql .= "('$row[1]', '$row[2]', $row[3], '$row[4]')," ;
    }
    }

    $sqlUpit = "INSERT INTO klijent (ime, prezime, drzava_id, broj_pasosa) VALUES ".$sql;
    $sqlUpit = rtrim($sqlUpit, ",");
    $res = mysqli_query($db_conn, $sqlUpit);
    if($res){
        $upit2 = "SELECT * FROM klijent";
        $rezultat2 = mysqli_query($db_conn, $upit2);
        $upisaniRedovi = mysqli_num_rows($rezultat2)- $pocetniBrojRedova;
        $url = "klijenti.php";
        echo "<a href=\"klijenti.php?upisaniRedovi=$upisaniRedovi\" id=\"dugme\"></a>";
        echo "<script>";
        echo " document.getElementById('dugme').click() ";
        echo "</script>";
        exit();
    } else {
        header("location: klijenti.php?greskaSaUpisivanjem");
    }

    


?>