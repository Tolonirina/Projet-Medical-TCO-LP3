<?php
include "../connexion.php";
$queryVisite = " select count(*)as count , patient.Sexe  , consultation.Type_Cons from consultation
inner join patient on consultation.Id_pat=patient.Id_Pat where 1=1";
if (isset($_GET['TypeConslViste']) and trim($_GET['TypeConslViste'] != "")) {
  $queryVisite .= " and     Type_Cons = '" . $_GET['TypeConslViste'] . "'";
}

if (isset($_GET['sexViste']) and trim($_GET['sexViste'] != "")) {
  $queryVisite .= " and     Sexe like '%" . $_GET['sexViste'] . "%'";
}



if (isset($_GET['dateSV1']) and trim($_GET['dateSV1']) != "" && isset($_GET['dateSV2']) and trim($_GET['dateSV2'] != "")) {
  $date1 = strtr($_GET['dateSV1'], '/', '-');
  $date1 = date('Y/m/d', strtotime($date1));

  $date2 = strtr($_GET['dateSV2'], '/', '-');
  $date2 = date('Y/m/d', strtotime($date2));

  $queryVisite .= " and     Date_Cons between  '" . $date1 . "' and  '" . $date2 . "'";
}

$queryVisite .= " group by patient.Sexe,consultation.Type_Cons";
$resultViste = mysqli_query($con, $queryVisite);
$counts = 0;

$sexF = 0;
$sexM = 0;

$TypeC = 0;
$TypeCon = 0;

?>
<br /><br />
<div class=" col-lg-10 col-lg-10 col-lg-10 col-lg-10 col-10" style="margin-left: 6%;">
  <div class="card">
    <h5 class="card-header">Nombre de visite par :</h5>
    <div class="card-body">
      <table class="table">
        <thead>
          <tr>

            <th scope="col">Type de visite</th>
            <th scope="col">Sexe</th>

            <th scope="col">Nombre</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($rowvisite = $resultViste->fetch_assoc()) {
            $counts += $rowvisite['count'];

          ?>

            <tr class="table-primary">
              <th scope="row">
                <?php if ($rowvisite['Type_Cons'] == "0") {
                  echo "Nouvelle consultation";
                  $TypeC += $rowvisite['count'];
                } else {
                  echo "Contrôle";
                  $TypeCon += $rowvisite['count'];
                } ?>
              </th>
              <td><?php
                  if ($rowvisite['Sexe'] == "F") {
                    $sexF += $rowvisite['count'];
                  } else {
                    $sexM += $rowvisite['count'];
                  }
                  echo $rowvisite['Sexe']; ?></td>


              <td><?php echo $rowvisite['count']; ?></td>

            </tr>
          <?php } ?>


        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="container" style="width: 80%;">
  <div id="chartContainerTypeDVise" style="height: 260px; width: 50%; float: left;margin-left: -4%;"> </div>
  <div id="chartContainerNFM" style="height: 260px;width: 50%; float: right;"> </div>

</div>

<input type="hidden" id="sexF" value="<?php echo $sexF; ?>">
<input type="hidden" id="sexM" value="<?php echo $sexM; ?>">

<input type="hidden" id="Controle" value="<?php echo $TypeCon; ?>">
<input type="hidden" id="Consultation" value="<?php echo $TypeC; ?>">
<br /><br />
<div id="NobreDvisiteparMois" style="margin-top: 2%;height: 260px; width: 80%; float: right;margin-right: 11.5%;"> </div>


<?php

$queryVisite = " select count(*)  as count ,DATE_FORMAT(Date_Cons, '%M') as dateF from consultation
inner join patient on consultation.Id_pat=patient.Id_Pat where 1=1";

if (isset($_GET['TypeConslViste']) and trim($_GET['TypeConslViste'] != "")) {
  $queryVisite .= " and     Type_Cons = '" . $_GET['TypeConslViste'] . "'";
}

if (isset($_GET['sexViste']) and trim($_GET['sexViste'] != "")) {
  $queryVisite .= " and     Sexe like '%" . $_GET['sexViste'] . "%'";
}



if (isset($_GET['dateSV1']) and trim($_GET['dateSV1']) != "" && isset($_GET['dateSV2']) and trim($_GET['dateSV2'] != "")) {
  $date1 = strtr($_GET['dateSV1'], '/', '-');
  $date1 = date('Y/m/d', strtotime($date1));

  $date2 = strtr($_GET['dateSV2'], '/', '-');
  $date2 = date('Y/m/d', strtotime($date2));

  $queryVisite .= " and     Date_Cons between  '" . $date1 . "' and  '" . $date2 . "'";
}

$queryVisite .= " group by Date_Cons ";



$resultViste = mysqli_query($con, $queryVisite);


?>



<script>
  getpchartnobreVisite();
  getpchartnobreTypeDviste();
  getPchartMonth();

  function getpchartnobreVisite() {

    sexF = $("#sexF").val();
    sexM = $("#sexM").val();

    total = +sexF + +sexM;
    sexF = Math.floor((sexF * 100) / total);
    sexM = Math.floor((sexM * 100) / total);

    var chart = new CanvasJS.Chart("chartContainerNFM", {

      title: {
        text: "Visite par sexe"
      },
      data: [ //array of dataSeries
        { //dataSeries object
          startAngle: 25,
          toolTipContent: "<b>{label}</b>: {y}%",

          indexLabelFontSize: 16,
          indexLabel: "{label} - {y}%",
          /*** Change type "area" to "bar", "area", "line" or "pie"***/
          type: "pie",
          dataPoints: [{
              label: "F",
              y: sexF
            },
            {
              label: "M",
              y: sexM
            },

          ]
        }
      ]
    });

    chart.render();

  }

  //
  function getpchartnobreTypeDviste() {

    Controle = $("#Controle").val();
    Consultation = $("#Consultation").val();

    total = +Controle + +Consultation;
    Controle = Math.floor((Controle * 100) / total);
    Consultation = Math.floor((Consultation * 100) / total);

    var chart = new CanvasJS.Chart("chartContainerTypeDVise", {

      title: {
        text: "Visite par Type"
      },
      data: [ //array of dataSeries
        { //dataSeries object
          startAngle: 25,
          toolTipContent: "<b>{label}</b>: {y}%",

          indexLabelFontSize: 16,
          indexLabel: "{label} - {y}%",
          /*** Change type "column" to "bar", "area", "line" or "pie"***/
          type: "pie",
          dataPoints: [{
              label: "Contrôle",
              y: Controle
            },
            {
              label: "Consultation",
              y: Consultation
            },

          ]
        }
      ]
    });

    chart.render();

  }

  ///////////////////// Get Par month //////////////////////////////

  function getPchartMonth() {

    Controle = $("#Controle").val();
    Consultation = $("#Consultation").val();


    var chart = new CanvasJS.Chart("NobreDvisiteparMois", {

      title: {
        text: "Visite par année"
      },
      data: [ //array of dataSeries
        { //dataSeries object
          startAngle: 25,
          toolTipContent: "<b>{label}</b>: {y}%",

          indexLabelFontSize: 10,
          indexLabel: "{label} - {y}",
          /*** Change type "column" to "bar", "area", "line" or "pie"***/
          type: "column",
          dataPoints: [
            <?php while ($rowvisite = $resultViste->fetch_assoc()) {
              echo "
         { label: '" . utf8_encode($rowvisite['dateF']) . "', y:
          " . floor(($rowvisite['count'] * 100) / $counts) . " },";
            }
            ?>

          ]
        }
      ]
    });

    chart.render();

  }
</script>