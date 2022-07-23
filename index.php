<?php 

include "backend/connect.php";


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
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  
  <?php $activePage = "dashboard"; ?>
  <?php include "./partials/navbar.php"; ?>
  <?php include "./partials/aside.php"; ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Rezervacije</h1>
          </div><!-- /.col -->
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

      <div class="row mb-3">
            <div class="col-12">
                <a href="prikazVozila.php" class="btn btn-primary float-right">Nova rezervacija</a>
            </div>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Vozilo</th>
                    <th>Ime klijenta</th>
                    <th>Rezervisano od</th>
                    <th>Rezervisano do</th>
                    <th>Ukupna cijena</th>
                    <th>Otkazano</th>
                    <th>Otkazi</th>
                </tr>
            </thead>

            <tbody>

            <?php 
            
            $sql = "SELECT rezervacije.*, klijent.ime, klijent.prezime, vozila.proizvodjac_id, vozila.model_id, proizvodjac.naziv, model.model
                FROM rezervacije 
                JOIN vozila on rezervacije.vozilo_id=vozila.ID 
                JOIN klijent on rezervacije.klijent_id=klijent.ID 
                JOIN proizvodjac on vozila.proizvodjac_id=proizvodjac.ID 
                JOIN model on vozila.model_id=model.ID ORDER BY rezervacije.otkazano;";

            $res = mysqli_query($db_conn, $sql);
            while($row = mysqli_fetch_assoc($res)){
              $klasa='';
              $otkazano = '';
              $dugme = '';
              $id = $row['ID'];
              if($row['otkazano'] == "false"){
                $klasa = "table-success";
                $otkazano = "NE";
                $dugme = "<a href=\"otkazi.php?id=$id\" class=\"btn btn-danger\">X</a>";
              } else {
                $klasa = "table-secondary";
                $otkazano = "DA";
                $dugme = "";
              }
              $vozilo = $row['naziv']." ".$row['model'];
              $ime = $row['ime']." ".$row['prezime'];
              $datum_od = $row['rezervisano_od'];
              $datum_do = $row['rezervisano_do'];
              $ukupna_cijena = $row['ukupna_cijena']." €";
              echo "<tr class='$klasa'>";
              echo "<td>$vozilo</td>";
              echo "<td>$ime</td>";
              echo "<td>$datum_od</td>";
              echo "<td>$datum_do</td>";
              echo "<td>$ukupna_cijena</td>";
              echo "<td>$otkazano</td>";
              echo "<td> $dugme </td>";

              echo "</tr>";
            }
            
            
            ?>
               
            </tbody>
        </table>

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

<script>
  async function displayAttachments(expense_id){
    let response = await fetch("<?=$appUrl?>/expenses/get_attachments.php?expense_id="+expense_id);
    let responseJSON = await response.json();

    let tableHTML = '';
    responseJSON.forEach( (att) => {
      let downloadBtn = `<a download href="${att.path}" class="btn btn-sm btn-success" >preuzmi</a>`;
      tableHTML += `<tr> <td>${att.path}</td> <td>${downloadBtn}</td> </tr>`;
    })

    document.getElementById("attachmentsTableBody").innerHTML = tableHTML;
    document.getElementById("attachmentsTable").classList.remove('d-none');
    document.getElementById("loadingIcon").classList.add('d-none');

  }
</script>

<!-- AdminLTE for demo purposes -->
<!-- <script src="dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="dist/js/pages/dashboard.js"></script> -->

</body>
</html>
