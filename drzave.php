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
  
  <?php $activePage = "Drzave"; ?>
  <?php include "./partials/navbar.php"; ?>
  <?php include "./partials/aside.php"; ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
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
                <button onclick="clearInput()" id="dodajKlijentaBtn" type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
                  Nova drzava
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nova drzava</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                       
                      <form  enctype="multipart/form-data" action="dodajDrzavu.php" id="forma" method="POST">
                        <label for="naziv">Naziv:</label>
                        <input class="form-control" type="text" placeholder="Unesite naziv..." name="naziv" id="naziv">
                        <div id="alert_naziv" class="alert alert-danger mt-1 d-none">Morate unijeti naziv</div>
                        
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

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naziv</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>

            <?php 
            
            $sqlDrzava = "SELECT * FROM drzave";
            $res = mysqli_query($db_conn, $sqlDrzava);
            while($drzava = mysqli_fetch_assoc($res)){
                $id = $drzava['ID'];
                $naziv = $drzava['naziv'];
                echo "<tr>";
                echo "<td>$id</td>";
                echo "<td>$naziv</td>";
                echo "<td class=\"text-center\"> <a href=\"izmijenidrzava.php?id=$id\" class='mr-2'> <i class=\"nav-icon fas fa-edit\"> </i> </a> <a href=\"izbrisidrzava.php?id=$id\"> <i class=\"nav-icon fas fa-trash\"> </i> </a> </td>";
                echo "</tr>";
            }

            ?>
               
            </tbody>
        </table>

        <div class="row">
       


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
        <div class="modal-body table-responsive">
        
         <div class="row" id="loadingIcon">
          <div class="col-12 text-center">
            <i class="fas fa-spinner fa-spin fa-3x"></i>
          </div>
         </div>           

          <table class="table table-hover d-none" id="attachmentsTable">
            <thead>
              <tr>
                <th>Sistemsko ime</th>
                <th>Preuzmi</th>
              </tr>
            </thead>
            <tbody id="attachmentsTableBody"></tbody>
          </table>
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
<script src="proizvodjaci.js?v=1"></script>

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
