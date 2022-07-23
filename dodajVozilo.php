<?php 
include "backend/connect.php";

function uploadFile($array, $allowed_extensions, $upload_dir){
    $profilna = uniqid();
    $client_extension = end(explode('.', $array['name']));

    if(!in_array($client_extension, $allowed_extensions)){
        exit("Nedozovoljen format slike...");
    }
    $profilna = $profilna.".".$client_extension;

    $tmp_path = $array['tmp_name'];
    $new_photo_path = $upload_dir.$profilna;
    if(!copy($tmp_path, $new_photo_path)){
        exit("Greska pri upload-u slike...");
    }

    return $new_photo_path;
}

function uploadMoreFiles($allowed_extensions, $upload_dir, $client_filename, $tmp_name, $depth = 0){
    $new_filename = uniqid();
    $client_extension = end(explode('.', $client_filename));

    if(!in_array($client_extension, $allowed_extensions)){
        exit("Nedozovoljen format slike...");
    }
    $new_filename = $new_filename.".".$client_extension;

    $tmp_path = $tmp_name;
    $new_photo_path = $upload_dir.$new_filename;
    if(!copy($tmp_path, $new_photo_path)){
        exit("Greska pri upload-u slike...");
    }
    return $new_photo_path;
}


$folder = 'slike/';
if(isset($_POST['registracija']) && $_POST['registracija'] != ''){
    $registracija = $_POST['registracija'];
} else {
    header('location: vozila.php?greska');
}

if(isset($_POST['proizvodjac_id']) && $_POST['proizvodjac_id'] != ''){
    $proizvodjac_id = $_POST['proizvodjac_id'];
} else {
    header('location: vozila.php?greska');
}

if(isset($_POST['model']) && $_POST['model'] != ''){
    $model = $_POST['model'];
} else {
    header('location: vozila.php?greska');
}

if(isset($_POST['godina']) && $_POST['godina'] != ''){
    $godina = $_POST['godina'];
} else {
    header('location: vozila.php?greska');
}


if(isset($_POST['klasa']) && $_POST['klasa'] != ''){
    $klasa = $_POST['klasa'];
} else {
    header('location: vozila.php?greska');
}

if(isset($_POST['cijena']) && $_POST['cijena'] != ''){
    $cijena = $_POST['cijena'];
} else {
    header('location: vozila.php?greska');
}

$dozvoljene_ekstenzije = ['jpg', 'jpeg', 'bmp', 'png', 'gif'];

if(isset($_FILES['profilna']) && $_FILES['profilna'] != ''){
    $array = $_FILES["profilna"];
    $profilna = uploadFile($array, $dozvoljene_ekstenzije, $folder);
    var_dump($profilna);
} else {
    header('location: vozila.php?greska');
}

$sql = "INSERT into vozila(registarski_broj, proizvodjac_id, model_id, godina, klasa_id, cijena,profilna)
VALUES ('$registracija', '$proizvodjac_id', '$model', '$godina', '$klasa', $cijena, '$profilna')";

$rez = mysqli_query($db_conn, $sql);

$lastID = mysqli_insert_id($db_conn);
if(isset($_FILES['ostale']) && count($_FILES['ostale']) > 0){
    $ostale = $_FILES['ostale'];
    // foreach($ostale['tmp_name'] as $file){
    //     $ime = uniqid().".png";
    //     copy($file, $folder.$ime);
    //     $newPhotoPath = $folder.$ime;
    //     $sqlSlike = "INSERT INTO slike (vozilo_id, path) VALUES($lastID, '$newPhotoPath')";
    //     var_dump($sqlSlike);
    //     $rezSlike = mysqli_query($db_conn, $sqlSlike);
    foreach($_FILES['ostale']['name'] as $key => $file_name){
        $path = uploadMoreFiles($dozvoljene_ekstenzije, $folder, $file_name, $_FILES['ostale']['tmp_name'][$key]);
        $sql_attach = "INSERT INTO slike (vozilo_id, path) VALUES ($lastID, '$path')" ;
        $res = mysqli_query($db_conn, $sql_attach);
    }

    header('location: vozila.php?succes');
      
    
} else {
    header('location: vozila.php?greska');
}

?>