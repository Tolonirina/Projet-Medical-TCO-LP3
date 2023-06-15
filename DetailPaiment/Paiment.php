<center>
  <table style="width: 90%;">
    <tr>
      <td style="width: 16%;">
        <div id="custom-search" class="top-search-bar">
          <input id="RecherchePai" style="margin-bottom: 8%;" class="form-control" type="text" placeholder="Recherche par  CIN">
        </div>
      </td>


      <td style="width: 16%;">
        <div id="custom-search" class="top-search-bar">
          <input id="TitreDPaiment" style="margin-bottom: 8%;" class="form-control" type="text" placeholder="Titre de paiment">
        </div>
      </td>

      <td style="width: 1%;"> </td>
      <td style="width: 12%;">
        <input type="text" class="form-control col-10 col-lg-10 dateP" placeholder="date 1" id="datePai1">
      </td>

      <td style="width: 1%;">à </td>
      <td style="width: 12%;">
        <input type="text" placeholder="date 2" class="form-control col-9 col-lg-9 dateP" id="datePai2">
      </td>
      <td style="width: 10%;"><button class="btn btn-primay" onclick="functionRecherchPaimei();">Recherche</button> </td>

    </tr>
  </table>
</center>




<div class="modal fade" id="paimentPop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Gestion des Paiments</h5>
        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>
      </div>
      <div class="modal-body">

      </div>
    </div>
  </div>
</div>


<div id="AffichDetailP">
  <?php include "affichePaime.php"; ?>

</div>




<script>
  $(".dateP").datepicker();

  function functionRecherchPaimei() {
    Cin_Con = $("#RecherchePai").val();
    typeP = $("#TitreDPaiment").val();
    date1 = $("#datePai1").val();
    date2 = $("#datePai2").val();

    $("#AffichDetailP").load("DetailPaiment/affichePaime.php?typeP=" + typeP + "&Cin_Con=" + "&date1=" + date1 + "&date2=" + date2);
  }








  $('#TitreDPaiment').keypress(function(e) {
    var key = e.which;
    if (key == 13) // the enter key code
    {

      typeP = $("#TitreDPaiment").val();
      $("#AffichDetailP").load("DetailPaiment/affichePaime.php?typeP=" + typeP);

    }
  });




  $('#RecherchePai').keypress(function(e) {
    var key = e.which;
    if (key == 13) // the enter key code
    {

      Cin_Con = $("#RecherchePai").val();
      $("#AffichDetailP").load("DetailPaiment/affichePaime.php?Cin_Con=" + Cin_Con);

    }
  });
</script>