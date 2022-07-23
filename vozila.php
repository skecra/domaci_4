<?php 

include "backend/connect.php";
$alertKlasa = "";
if(isset($_GET['msg']) && $_GET['msg']=="deleteErr"){
  $alertKlasa = "";
} else {
  $alertKlasa = "d-none";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Rent a Car</title>

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
  <style>
    .alert {
      font-size: 15px;
      padding: 5px;
    }

    .crveno {
      border: 2px solid red;
    }
    .zeleno {
      border: 2px solid green;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  
  <?php $activePage = "Vozila"; ?>
  <?php include "./partials/navbar.php"; ?>
  <?php include "./partials/aside.php"; ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-3">
            <h1 class="m-0"><?=$activePage?></h1>

          </div><!-- /.col -->

        </div><!-- /.row -->
        <div class="col-12">
            <div id="alert_registracija" class="alert alert-danger mt-1 text-center <?=$alertKlasa?>">Nije moguce brisanje jer ima zavisnih podataka</div>
            </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

      <div class="row mb-3">
            <div class="col-12">
               <!-- Button trigger modal -->
                <button onclick="clearInput()" id="dodajVoziloBtn" type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
                  Dodaj vozilo
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Novo vozilo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                       
                      <form  enctype="multipart/form-data" action="dodajVozilo.php" id="forma" method="POST">
                        <label for="registracija">Unesite registracioni broj</label>
                        <input class="form-control" type="text" placeholder="Unesite registracioni broj..." name="registracija" id="registracija">
                        <div id="alert_registracija" class="alert alert-danger mt-1 d-none">Morate unijeti registraciju</div>
                        <label for="proizvodjac_id">Izaberite proizvodjaca</label>
                        <select name="proizvodjac_id" id="proizvodjac" class="" onchange="displayModels()">
                          <option value="" disabled selected>-izaberite proizvodjaca-</option>
                          <?php 
                          $sql = "SELECT * from proizvodjac";
                          $rez = mysqli_query($db_conn, $sql);
                          while($row = mysqli_fetch_assoc($rez)){
                            $pr_id = $row['ID'];
                            $pr_naz = $row['naziv'];
                            echo "<option value=\"$pr_id\">$pr_naz</option>";
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
                        <input class="form-control" type="number" name="godina" id="godina" placeholder="unesite godinu proizvodnje">
                        <div id="alert_godina" class="alert alert-danger mt-1 d-none">Morate unijeti godinu</div>

                        <label for="model">Izaberite klasu</label>
                        <select name="klasa" id="klasa" class="form-control">
                          <option value="" disabled selected>-izaberite klasu vozila-</option>
                          <?php 
                          
                          $sql = "SELECT * from klasa";
                          $rez = mysqli_query($db_conn, $sql);
                          while($row = mysqli_fetch_assoc($rez)){
                            $kl_id = $row['ID'];
                            $kl_naz = $row['klasa'];
                            echo "<option value=\"$kl_id\">$kl_naz</option>";
                          }

                          ?>
                        </select>
                        <div id="alert_klasa" class="alert alert-danger mt-1 d-none">Morate izabrati klasu</div>

                        <label for="model">Unesite cijenu vozila po danu</label>
                        <input class="form-control" type="number" name="cijena" id="cijena" placeholder="unesite cijenu po danu">
                        <div id="alert_cijena" class="alert alert-danger mt-1 d-none">Morate unijeti cijenu</div>

                        <label for="model">Unesite profilnu fotografiju vozila</label>
                        <input accept="image/*" class="form-control" type="file" name="profilna" id="profilna">
                        <div id="alert_profilna" class="alert alert-danger mt-1 d-none">Morate unijeti profilnu</div>

                        <label for="model">Unesite ostale fotografije vozila</label>
                        <input accept="image/*" class="form-control" type="file" name="ostale[]" multiple id="ostale">

                      </div>
                      <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button  id="sacuvajVozilo"  class="btn btn-primary">Save changes</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>



        <div class="row">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Vozilo</th>
                    <th>Godiste</th>
                    <th>Cijena po danu</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>

            <?php 
            
            $sqlVozila = "SELECT vozila.*, proizvodjac.naziv, model.model FROM vozila join proizvodjac on vozila.proizvodjac_id=proizvodjac.id join model on vozila.model_id=model.id";
            $res = mysqli_query($db_conn, $sqlVozila);
            
            while($vozilo = mysqli_fetch_assoc($res)){
                $ime = $vozilo['naziv']." ".$vozilo['model'];
                $godiste = $vozilo['godina'];
                $cijena = $vozilo['cijena'];
                $id = $vozilo['ID'];
                echo "<tr>";
                echo "<td>$ime</td>";
                echo "<td>$godiste</td>";
                echo "<td>$cijena €</td>";
                echo "<td class=\"text-center\"> <a href=\"izmijeniVozilo.php?id=$id\" class='mr-2'> <i class=\"nav-icon fas fa-edit\"> </i> </a> <a href=\"izbrisiVozilo.php?id=$id\"> <i class=\"nav-icon fas fa-trash\"> </i> </a> </td>";
                echo "</tr>";
            }

            ?>
               
            </tbody>
        </table>


 
        


          


</div>
<!-- kraj ovog diva->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include "./partials/footer.php"; ?>
  
  <div class="modal fade" id="attachmentsModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Priloženi fajlovi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
     
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- ./wrapper -->

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
<script src="vozila.js"></script>

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
