<?php
include "../connexion.php";
$queryVisiteR = " select count(*) as count ,DATE_FORMAT(DateRend, '%M') as dateF  from rendezvous 
inner join patient on patient.Id_pat=rendezvous.Id_Pat where 1=1

";


if (isset($_GET['sexViste']) and trim($_GET['sexViste'] != "")) {
  $queryVisiteR .= " and     Sexe like '%" . $_GET['sexViste'] . "%'";
}



if (isset($_GET['dateSV1']) and trim($_GET['dateSV1']) != "" && isset($_GET['dateSV2']) and trim($_GET['dateSV2'] != "")) {
  $date1 = strtr($_GET['dateSV1'], '/', '-');
  $date1 = date('Y/m/d', strtotime($date1));

  $date2 = strtr($_GET['dateSV2'], '/', '-');
  $date2 = date('Y/m/d', strtotime($date2));

  $queryVisiteR .= " and     DateRend between  '" . $date1 . "' and  '" . $date2 . "'";
}


$queryVisiteR .= " group by DATE_FORMAT(DateRend, '%M') ";
$resultVisteR = mysqli_query($con, $queryVisiteR);
$resultVisteR1 = mysqli_query($con, $queryVisiteR);
$counts = 0;



?>
<br /><br />
<div class=" col-lg-10 col-lg-10 col-lg-10 col-lg-10 col-10" style="margin-left: 6%;">
  <div class="card">
    <h5 class="card-header">Rendez-vous : :</h5>
    <div class="card-body">
      <table class="table">
        <thead>
          <tr>


            <th scope="col">Mois </th>

            <th scope="col">Nombre</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($rowvisite = $resultVisteR->fetch_assoc()) {


          ?>
            <tr class="table-success">
              <th scope="row"><?php echo utf8_encode($rowvisite['dateF']); ?> </th>
              <td><?php echo $rowvisite['count'];
                  $counts += $rowvisite['count'];
                  ?></td>

            </tr>
          <?php } ?>


        </tbody>
      </table>
    </div>
  </div>
</div>


<div id="NobreDvisiteparMoisRend" style="margin-top: 2%;height: 260px; width: 80%; float: right;margin-right: 11.5%;"> </div>




<script type="text/javascript">
  getPchartMonthRen();

  function getPchartMonthRen() {

    var chart = new CanvasJS.Chart("NobreDvisiteparMoisRend", {

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
            <?php while ($rowvisite = $resultVisteR1->fetch_assoc()) {
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