<?php 
include "backend/connect.php";

function uploadFile($array, $allowed_extensions, $upload_dir){
    $profilna = uniqid();
    $client_extension = end(explode('.', $array['name']));

    if(!in_array($client_extension, $allowed_extensions)){
        exit("Nedozovoljen format slike...1");
    }
    $profilna = $profilna.".".$client_extension;

    $tmp_path = $array['tmp_name'];
    $new_photo_path = $upload_dir.$profilna;
    if(!copy($tmp_path, $new_photo_path)){
        exit("Greska pri upload-u slike...2");
    }

    return $new_photo_path;
}

function uploadMoreFiles($allowed_extensions, $upload_dir, $client_filename, $tmp_name, $depth = 0){
    $new_filename = uniqid();
    $client_extension = end(explode('.', $client_filename));

    if(!in_array($client_extension, $allowed_extensions)){
        exit("Nedozovoljen format slike...3");
    }
    $new_filename = $new_filename.".".$client_extension;

    $tmp_path = $tmp_name;
    $new_photo_path = $upload_dir.$new_filename;
    if(!copy($tmp_path, $new_photo_path)){
        exit("Greska pri upload-u slike...4");
    }
    return $new_photo_path;
}

$id = $_POST['id'];

$folder = 'slike/';
if(isset($_POST['registracija']) && $_POST['registracija'] != ''){
    $registracija = $_POST['registracija'];
} else {
    header('location: vozila.php?greska1');
}

if(isset($_POST['proizvodjac_id']) && $_POST['proizvodjac_id'] != ''){
    $proizvodjac_id = $_POST['proizvodjac_id'];
} else {
    header('location: vozila.php?greska2');
}

if(isset($_POST['model']) && $_POST['model'] != ''){
    $model = $_POST['model'];
} else {
    header('location: vozila.php?greska3');
}

if(isset($_POST['godina']) && $_POST['godina'] != ''){
    $godina = $_POST['godina'];
} else {
    header('location: vozila.php?greska4');
}


if(isset($_POST['klasa']) && $_POST['klasa'] != ''){
    $klasa = $_POST['klasa'];
} else {
    header('location: vozila.php?greska5');
}


if(isset($_POST['cijena']) && $_POST['cijena'] != ''){
    $cijena = $_POST['cijena'];
} else {
    header('location: vozila.php?greska6');
}

$dozvoljene_ekstenzije = ['jpg', 'jpeg', 'bmp', 'png', 'gif'];

if(isset($_FILES['profilna']) && $_FILES['profilna']['name'][0] != ''){
    $array = $_FILES["profilna"];
    $profilna = uploadFile($array, $dozvoljene_ekstenzije, $folder);
} else {
    $profilna = "";
}
$sqlProfilna ="";
if($profilna != ''){
    $sqlProfilna = ", profilna='$profilna'";
}
$sql = "UPDATE vozila SET registarski_broj = '$registracija', proizvodjac_id='$proizvodjac_id', model_id='$model', godina='$godina', klasa_id='$klasa', cijena=$cijena $sqlProfilna where ID=$id";

$rez = mysqli_query($db_conn, $sql);

$lastID = mysqli_insert_id($db_conn);
if(isset($_FILES['ostale']) && count($_FILES['ostale']) > 0 && $_FILES['ostale']['name'][0] !="" ){
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
        $sql_attach = "INSERT INTO slike (vozilo_id, path) VALUES ($id, '$path')" ;
        $res = mysqli_query($db_conn, $sql_attach);
    }

    header('location: vozila.php?succes');
      
    
} else {
    header('location: vozila.php?greskaUpdateNemaOstalihSlika');
}

?>