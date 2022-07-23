<?php 

include "backend/connect.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Rent a Car</title>





  <link href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="Stylesheet"
        type="text/css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/css/tom-select.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/js/tom-select.complete.min.js"></script>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

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
    .zeleno select{
      border: 2px solid green;
    }

    

  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  
  <?php $activePage = "Rezervacije"; ?>
  <?php include "./partials/navbar.php"; ?>
  <?php include "./partials/aside.php"; ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Detalji vozila</h1>
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
               <!-- Button trigger modal -->
                <button onclick="clearInput()" id="dodajVoziloBtn" type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
                  Rezervisi vozilo
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Rezervacija</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                       
                      <form  enctype="multipart/form-data" action="rezervisi.php" id="forma" method="POST">
                        <label for="klijent_id">Izaberite klijenta:</label>
                        <select name="klijent_id" id="select-klijent" placeholder="Izaberite klijenta...">
                            <option value="" disabled selected>-izaberite klijenta-</option>
                           <?php 
                           
                           $sqlKlijenti = "SELECT * FROM klijent";
                           $resKlijent = mysqli_query($db_conn, $sqlKlijenti);
                           while($klijent = mysqli_fetch_assoc($resKlijent)){
                            $idKlijent = $klijent['ID'];
                            $imeKlijent = $klijent['ime']." ".$klijent['prezime'];
                            echo "<option value=\"$idKlijent\"> $imeKlijent </option>";
                           }
                           
                           ?>
                        </select>
                        <input type="hidden" value="<?=$id?>" id="skriveni" name="vozilo_id">
                        <div id="alert_klijent" class="alert alert-danger mt-1 d-none">Morate izabrati klijenta</div>
                        <label for="datum_od">Datum pocetka rezervacije:</label>
                        <input type="text" class="form-control" name="datum_od" id="datum_od" placeholder="izaberite pocetni datum rezervacije">
                        <div id="alert_datum_od" class="alert alert-danger mt-1 d-none">Morate pravilno izabrati pocetni datum rezervacije</div>
                        <label for="datum_do">Datum kraja rezervacije:</label>
                        <input onchange="prikaziCijenu()" type="text" class="form-control" name="datum_do" id="datum_do" placeholder="izaberite krajnji datum rezervacije">
                        <div id="alert_datum_do" class="alert alert-danger mt-1 d-none">Morate pravilno izabrati krajnji datum rezervacije</div>
                        
                        <p class="mt-4" id="paragrafUkupno">Ukupno: </p>
                        <input type="text" readonly id="ukupnaCijena" name="ukupnaCijena">

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
            <div class="col-8 ">
            <div id="carouselExampleControls" class="carousel slide text-center" data-ride="carousel">
                <div class="carousel-inner">
                    

                    <?php 
                          if(isset($_GET['id']) && $_GET['id']!=''){
                            $id = $_GET['id'];
                        }


                        $sqlSlike = "SELECT * from slike where vozilo_id=$id";
                        $resSlike = mysqli_query($db_conn, $sqlSlike);
                        $slikeHTML = '';
                        while($slikeDruge = mysqli_fetch_assoc($resSlike)){
                            $slikaDruga = $slikeDruge['path'];
                            $slikeHTML.="<div class=\"carousel-item\">
                            <img  class=\"d-block w-100\" src=\"$slikaDruga\" alt=\"First slide\">
                            </div>";
                        }


                        $sqlVozila = "SELECT * FROM vozila join proizvodjac on vozila.proizvodjac_id=proizvodjac.id join model on vozila.model_id=model.id join klasa on vozila.klasa_id=klasa.id  WHERE vozila.id=$id";
                        $rez = mysqli_query($db_conn, $sqlVozila);
                        while($row = mysqli_fetch_assoc($rez)){
                          $id = $row['ID'];
                          $slika = $row['profilna'];
                          $vozilo = $row['naziv']." ".$row['model'];
                          $godiste = $row['godina'];
                          $klasa = $row['klasa'];
                          $cijena = $row['cijena'];
                    
                    echo " <div class=\"carousel-item active text-canter mr-3\">
                    <img  class=\"d-block w-100\" height=\"400px\" src=\"$slika\" alt=\"First slide\">
                    </div>";

                    echo $slikeHTML;



                    // $sqlSlike = "SELECT * from slike where vozilo_id=$id";
                    // $resSlike = mysqli_query($db_conn, $sqlSlike);
                    // while($slika = mysqli_fetch_assoc($resSlike)){
                    //     echo " <div class=\"carousel-item\">
                    //     <img width=550 height=400 class=\"d-block w-100\" src=\"$slika\" alt=\"First slide\">
                    //     </div> ";
                    // }

                }
                    ?>


                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>

                
    </div>

    </div>
    <div class="col-4">
        <h4 class="mr-4"><?=$vozilo?></h4> <hr>
        <p class=''> Godiste: <?=$godiste?></p>  
        <p class=''> Klasa: <?=$klasa?></p>  
        <p class=''> Cijena po danu: <?=$cijena?>€</p>  
              </div>
    </div>
    
    

    

          


</div>
<!-- kraj ovog diva->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include "./partials/footer.php"; ?>
  

     
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
<script src="detaljiVozila.js"></script>


<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>


  




  // function submit(){
  //   document.getElementByName('form').submit()
  // }

</script>




<script language="javascript">






    $(document).ready(function () {

        var baseUrl = "http://localhost/rentAcar/";
        var dates = [];
        async function prikaziCijenu(){
            let vozilo_id = window.location.href.slice(-2);
            let datum_od = document.getElementById("datum_od").value;
            let datum_do = document.getElementById("datum_do").value;
            let response = await fetch("http://localhost/rentAcar/rezervisaniDatumi.php?id="+vozilo_id);
            let rezultat = await response.json();
            dates = rezultat
            console.log(dates)
        }

        prikaziCijenu()
        //make an array of disable dates

        function disableDates(date) {
        var string = $.datepicker.formatDate('yy-mm-d', date);
        return [dates.indexOf(string) == -1];
        }

     
        $("#datum_od").datepicker({
            beforeShowDay: disableDates,
            dateFormat: 'yy-mm-d',
            minDate: 0

        });

        $("#datum_do").datepicker({
            beforeShowDay: disableDates,
            dateFormat: 'yy-mm-d',
            minDate: 0

        });

    });

    $(document).ready(function () {
        $("#datum_do").datepicker({
            minDate: 0,
            dateFormat: 'yy-mm-dd'
        });
    });

    $(function() {
               $("#datum_od").datepicker({ dateFormat: "yy-mm-dd" }).val()
       });


    let vozilo_id = window.location.href.slice(-2);
    document.getElementById('skriveni').value = vozilo_id


       let nesto = document.getElementById('sacuvajVozilo')
        nesto.addEventListener('click', function(e){
            let greske = 0
    e.preventDefault();
    let klijent = document.getElementById('select-klijent')
    let datum_od = document.getElementById('datum_od')
    let datum_do = document.getElementById('datum_do')
    let ukupnaCijena = document.getElementById('ukupnaCijena')
    console.log(ukupnaCijena.value)
        if(klijent.value==''){
        document.getElementById('alert_klijent').classList.remove('d-none')
        klijent.style.border = "2px solid red";
        greske++
        } else {
          document.getElementById('alert_klijent').classList.add('d-none')
          klijent.classList.add('zeleno')
          klijent.classList.remove('crveno')
        }
        if(datum_od.value=='' || ukupnaCijena.value < 0 || ukupnaCijena.value == 0 ){
          document.getElementById('alert_datum_od').classList.remove('d-none')
          datum_od.classList.add('crveno')
          datum_od.classList.remove('zeleno')
          greske++
          } else {
            document.getElementById('alert_datum_od').classList.add('d-none')
            datum_od.classList.add('zeleno')
            datum_od.classList.remove('crveno')
          }
          if(datum_do.value=='' || ukupnaCijena.value < 0 || ukupnaCijena.value == 0){
            document.getElementById('alert_datum_do').classList.remove('d-none')
            datum_do.classList.add('crveno')
            datum_do.classList.remove('zeleno')
            greske++
            } else {
              document.getElementById('alert_datum_do').classList.add('d-none')
              datum_do.classList.add('zeleno')
              datum_do.classList.remove('crveno')
            }

            if(greske==0){
                      document.getElementById('forma').submit()
                    }
        })
        function clearInput(){
            document.querySelectorAll('input').forEach(input => {
                input.value=""
                input.classList.remove('zeleno')
                input.classList.remove('crveno')
            });

            document.querySelectorAll('.alert').forEach(alert => {
                alert.classList.add('d-none')
            });


            document.querySelectorAll('select').forEach(select=>{
                select.value = ""
                select.classList.remove('zeleno')
                select.classList.remove('crveno')
            })
            document.getElementById('skriveni').value = vozilo_id

}

</script>


<!-- AdminLTE for demo purposes -->
<!-- <script src="dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="dist/js/pages/dashboard.js"></script> -->

</body>
</html>
