<?php 

include "backend/connect.php";
$alertKlasa = "";
$importKlasa='';
if(isset($_GET['msg']) && $_GET['msg']=="deleteErr"){
  $alertKlasa = "";
} else {
  $alertKlasa = "d-none";
}

if(isset($_GET['upisaniRedovi'])){
  $importKlasa = "";
  $brojUpisanihRedova = $_GET['upisaniRedovi'];
} else {
  $importKlasa = "d-none";
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
  
  <?php $activePage = "Klijenti"; ?>
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
            <div id="" class="alert alert-danger mt-1 text-center <?=$alertKlasa?>">Nije moguce brisanje jer ima zavisnih podataka</div>
            </div>
            <div class="col-12">
            <div id="" class="alert alert-success mt-1 text-center <?=$importKlasa?>">Broj uvezenih redova iz excela je: <?=$brojUpisanihRedova?></div>
            </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="row">
      <div class="col-12">
        <a class='m-3' download href="template.xlsx"><i class="fas fa-download"></i> Exscel template za unos klijenata</a>
        <form action="exelImport.php" method="POST" id="exelForma" enctype="multipart/form-data">
          <label class='ml-3 mt-1' for="exel">Izaberite Excel fajl iz kog cete importovati klijente:</label> <br>
          <input required id="exelFajl" class='mt-1 ml-3' type="file" name="exel" accept=".xls, .xlsx, .csv" id="">
          <div id="alert_exel" class="alert alert-danger mt-1 d-none text-center mt-1 ml-3">Morate izabrati fajl</div> <br>
          <button type="submit" id='exelDugme' class="btn btn-info p-1 mt-1 ml-3"> <i class="fas fa-upload"></i> Ucitaj iz exsela</button>
        </form>
      </div>
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

      <div class="row mb-3">
            <div class="col-12">
               <!-- Button trigger modal -->
                <button onclick="clearInput()" id="dodajKlijentaBtn" type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
                  Novi klijent
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Novi klijent</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                       
                      <form  enctype="multipart/form-data" action="dodajKlijenta.php" id="forma" method="POST">
                        <label for="ime">Ime:</label>
                        <input class="form-control" type="text" placeholder="Unesite ime..." name="ime" id="ime">
                        <div id="alert_ime" class="alert alert-danger mt-1 d-none">Morate unijeti ime</div>
                        <label for="prezime">Prezime:</label>
                        <input class="form-control" type="text" placeholder="Unesite prezime..." name="prezime" id="prezime">
                        <div id="alert_prezime" class="alert alert-danger mt-1 d-none">Morate unijeti prezime</div>
                        <label for="drzava_id">Izaberite drzavu</label>
                        <select name="drzava_id" id="drzava" class="form-control" >
                          <option value="" disabled selected>-izaberite drzavu-</option>
                          <?php 
                          $sql = "SELECT * from drzave";
                          $rez = mysqli_query($db_conn, $sql);
                          while($row = mysqli_fetch_assoc($rez)){
                            $pr_id = $row['ID'];
                            $pr_naz = $row['naziv'];
                            echo "<option value=\"$pr_id\">$pr_naz</option>";
                          }

                          ?>
                        </select>
                        <div id="alert_drzava" class="alert alert-danger mt-1 d-none">Morate izabrati drzavu</div>
                        <label for="pasos">Broj pasosa:</label>
                        <input class="form-control" type="text" placeholder="Unesite broj pasosa..." name="pasos" id="pasos">
                        <div id="alert_pasos" class="alert alert-danger mt-1 d-none">Morate unijeti broj pasosa</div>
                        
                        
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
                    <th>Ime i prezime</th>
                    <th>Drzava</th>
                    <th>Broj pasosa</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>

            <?php 
            
            $sqlKlijenti = "SELECT klijent.*, drzave.naziv FROM klijent join drzave on klijent.drzava_id=drzave.id";
            $res = mysqli_query($db_conn, $sqlKlijenti);
            
            while($klijent = mysqli_fetch_assoc($res)){
                $id = $klijent['ID'];
                $imePrez = $klijent['ime']." ".$klijent['prezime'];
                $drzava = $klijent['naziv'];
                $pasos = $klijent['broj_pasosa'];
                echo "<tr>";
                echo "<td>$imePrez</td>";
                echo "<td>$drzava</td>";
                echo "<td>$pasos</td>";
                echo "<td class=\"text-center\"> <a href=\"izmijeniKlijenta.php?id=$id\" class='mr-2'> <i class=\"nav-icon fas fa-edit\"> </i> </a> <a href=\"izbrisiKlijenta.php?id=$id\"> <i class=\"nav-icon fas fa-trash\"> </i> </a> </td>";
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
<script src="klijenti.js"></script>

<script>

document.getElementById('exelDugme').addEventListener('click', function(e){
  e.preventDefault()
  let greske = 0
  if(document.getElementById('exelFajl').value==''){
              document.getElementById('alert_exel').classList.remove('d-none')
              document.getElementById('exelFajl').classList.add('crveno')
              document.getElementById('exelFajl').classList.remove('zeleno')
              greske++
  } else {
                document.getElementById('alert_pasos').classList.add('d-none')
                document.getElementById('exelFajl').classList.add('zeleno')
                document.getElementById('exelFajl').classList.remove('crveno')
  }
  if(greske==0){
    document.getElementById('exelForma').submit()
  }

})
  




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
