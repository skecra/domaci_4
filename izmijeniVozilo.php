<?php 

include "backend/connect.php";


if(isset($_GET['id']) && $_GET['id'] != ''){
    $id = $_GET['id'];
} else {
    header('location: vozila.php');
}

$sql = "SELECT * FROM vozila WHERE ID=$id";
$res = mysqli_query($db_conn, $sql);

$vozilo = mysqli_fetch_assoc($res);

$registracija = $vozilo['registarski_broj'];
$godina = $vozilo['godina'];
$cijena = $vozilo['cijena'];
$prosli_proizvodjac = $vozilo['proizvodjac_id'];
$klasa_id = $vozilo['klasa_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Rent a Car</title>

  <!-- Google Font: Source Sans Pro -->
  <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/css/tom-select.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/js/tom-select.complete.min.js"></script>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <title>Document</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  
  <?php $activePage = "vozila"; ?>
  <?php include "./partials/navbar.php"; ?>
  <?php include "./partials/aside.php"; ?>

  <?php 
  

  ?>

  <div class="row">
    <div class="col-6 offset-3 text-center">
        <h3>Izmijeni vozilo</h3>
        <form  enctype="multipart/form-data" action="updateVozilo.php" id="forma" method="POST">
                        <label for="registracija">Unesite registracioni broj</label>
                        <input value="<?=$registracija?>" class="form-control" type="text" placeholder="Unesite registracioni broj..." name="registracija" id="registracija">
                        <div id="alert_registracija" class="alert alert-danger mt-1 d-none">Morate unijeti registraciju</div>
                        <label for="proizvodjac_id">Izaberite proizvodjaca</label>
                        <input type="hidden" name="id" value="<?=$id?>" id="">
                        <?php $model_id = $vozilo['model_id']  ?>
                        <select name="proizvodjac_id" id="proizvodjac" class="" onchange="displayModels(<?=$model_id?>)">
                          <?php 
                          $sql = "SELECT * from proizvodjac";
                          $rez = mysqli_query($db_conn, $sql);
                          while($row = mysqli_fetch_assoc($rez)){
                            $select = '';
                            $pr_id = $row['ID'];
                            $pr_naz = $row['naziv'];
                            if($pr_id==$prosli_proizvodjac) { $select = "selected";}
                            echo "<option value=\"$pr_id\" $select >$pr_naz</option>";
                          }

                          ?>
                        </select>
                        <div id="alert_proizvodjac" class="alert alert-danger mt-1 d-none">Morate izabrati proizvodjaca</div>
                        <label for="model">Izaberite model</label>
                        <select name="model" id="modeli" class="form-control">
                            <option value="" disable selected>-izaberite model-</option>
                        </select>
                        <div id="alert_model" class="alert alert-danger mt-1 d-none">Morate izabrati model</div>
                        
                        <label for="model">Unesite godinu proizvodnje</label>
                        <input value="<?=$godina?>" class="form-control" type="number" name="godina" id="godina" placeholder="unesite godinu proizvodnje">
                        <div id="alert_godina" class="alert alert-danger mt-1 d-none">Morate unijeti godinu</div>

                        <label for="model">Izaberite klasu</label>
                        <select name="klasa" id="klasa" class="form-control">
                          <option value="" disabled selected>-izaberite klasu vozila-</option>
                          <?php 
                          
                          $sql = "SELECT * from klasa";
                          $rez = mysqli_query($db_conn, $sql);
                          while($row = mysqli_fetch_assoc($rez)){
                            $selectKlasa = "";
                            $kl_id = $row['ID'];
                            $kl_naz = $row['klasa'];
                            if($klasa_id==$kl_id){ $selectKlasa = "selected"; }
                            echo "<option $selectKlasa value=\"$kl_id\">$kl_naz</option>";
                          }

                          ?>
                        </select>
                        <div id="alert_klasa" class="alert alert-danger mt-1 d-none">Morate izabrati klasu</div>

                        <label for="model">Unesite cijenu vozila po danu</label>
                        <input value=<?=$cijena?> class="form-control" type="number" name="cijena" id="cijena" placeholder="unesite cijenu po danu">
                        <div id="alert_cijena" class="alert alert-danger mt-1 d-none">Morate unijeti cijenu</div>

                        <label for="model">Postavi novu profilnu fotografiju vozila</label>
                        <input accept="image/*" class="form-control" type="file" name="profilna" id="profilna">
                        <div id="alert_profilna" class="alert alert-danger mt-1 d-none">Morate unijeti profilnu</div>

                        <label for="model">Dodaj nove fotografije vozila</label>
                        <input accept="image/*" class="form-control" type="file" name="ostale[]" multiple id="ostale">
                        <a href="obrisiSlikeZaVozilo.php?id=<?=$id?>" class="btn btn-danger mt-2">Obrisi sve slike</a>
                        <button  id="sacuvajVozilo" href="updateVozilo.php?id=<?=$id?>"  class="btn btn-primary mt-2">Izmijeni vozilo</button>

                      </div>
                      
                        
    </div>
  </div>





  <?php include "./partials/footer.php"; ?>
  
  
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<script src="izmijeniVozilo.js"></script>

<script>


displayModels()




  // function submit(){
  //   document.getElementByName('form').submit()
  // }

</script>

<!-- AdminLTE for demo purposes -->
<!-- <script src="dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="dist/js/pages/dashboard.js"></script> -->

</body>
</html>
</html>