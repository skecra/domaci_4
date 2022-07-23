<?php 

include "backend/connect.php";


if(isset($_GET['id']) && $_GET['id'] != ''){
    $id = $_GET['id'];
} else {
    header('location: proizvodjaci.php');
}

$sql = "SELECT * FROM model WHERE ID=$id";
$res = mysqli_query($db_conn, $sql);

$model = mysqli_fetch_assoc($res);
$id = $model['ID'];
$modelNaziv = $model['model'];
$proizvodjac_id = $model['proizvodjac_id'];

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

  <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/css/tom-select.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/js/tom-select.complete.min.js"></script>

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
  
  <?php $activePage = "Modeli"; ?>
  <?php include "./partials/navbar.php"; ?>
  <?php include "./partials/aside.php"; ?>

  <?php 
  

  ?>

  <div class="row">
    <div class="col-6 offset-3 text-center">
        <h3>Izmijeni proizvodjaca</h3>
        <form  enctype="multipart/form-data" action="updateModel.php" id="forma" method="POST">
                        <input type="hidden" name="id" value="<?=$id?>">
                        <label for="model">Model:</label>
                        <input value="<?=$modelNaziv?>" class="form-control" type="text" placeholder="Unesite model..." name="model" id="model">
                        <div id="alert_model" class="alert alert-danger mt-1 d-none">Morate unijeti model</div>
                        <label for="proizvodjac">Proizvodjac:</label>
                        <select name="proizvodjac_id" id="proizvodjac" class="mt-4" onchange="">
                          <option value="" disabled selected>-izaberite proizvodjaca-</option>
                          <?php 
                          $sql = "SELECT * from proizvodjac";
                          $rez = mysqli_query($db_conn, $sql);
                          while($row = mysqli_fetch_assoc($rez)){
                            $select = "";
                            $pr_id = $row['ID'];
                            $pr_naz = $row['naziv'];
                            if($proizvodjac_id==$pr_id){
                                $select = "selected";
                            } else {
                                $select = "";
                            }
                            echo "<option $select value=\"$pr_id\">$pr_naz</option>";
                          }

                          ?>
                        </select>
                        <div id="alert_proizvodjac" class="alert alert-danger mt-1 d-none">Morate izabrati proizvodjaca</div>
                       
                        <button  id="sacuvajVozilo"  class="btn btn-primary mt-3">Save changes</button>
                        
                        
                      </div>

                        </form>




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
<script src="modeli.js?v=1"></script>

<script>






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