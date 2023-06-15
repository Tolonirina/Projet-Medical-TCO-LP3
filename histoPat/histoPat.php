<center>
  <table style="width: 90%;">
    <tr>
      <td style="width: 16%;">
        <div id="custom-search" class="top-search-bar">
          <input id="RechercheControlhisp" style="margin-bottom: 8%;" class="form-control" type="text" placeholder="Recherche par  CIN">
        </div>
      </td>

      <td style="width: 15%;">
        <select class="form-control" id="TypeConsl1hisp">
          <option value="">Type de visite </option>
          <option value="0">Nouvelle consultation</option>
          <option value="1">Contrôle </option>
        </select>
      </td>
      <td style="width: 1%;"> </td>
      <td style="width: 10%">

        <select id="sexHis" class="form-control">
          <option value="">Sexe</option>
          <option value="Masculin">Masculin</option>
          <option value="Féminin">Féminin</option>
        </select>

      </td>

      <td style="width: 1%;"> </td>
      <td style="width: 12%;">
        <input type="text" class="form-control col-10 col-lg-10" placeholder="date 1" id="dateCons1hisp">
      </td>

      <td style="width: 1%;">à </td>
      <td style="width: 12%;">
        <input type="text" placeholder="date 2" class="form-control col-9 col-lg-9" id="dateCons2hisp">
      </td>
      <td style="width: 10%;"><button class="btn btn-primay" onclick="functionRechercheMul();">Recherche</button> </td>

    </tr>
  </table>
</center>





<div class="modal fade" id="ConsultationPop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Historique des patients </h5>
        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>
      </div>
      <div class="modal-body">

      </div>
    </div>
  </div>
</div>


<div id="AffichHisP">
  <?php include "afficheHisto.php"; ?>

</div>




<script>
  $("#dateCons1hisp").datepicker();
  $("#dateCons2hisp").datepicker();


  function functionRechercheMul() {
    dateCons1 = $("#dateCons1hisp").val();
    dateCons2 = $("#dateCons2hisp").val();
    TypeConsl = $("#TypeConsl1hisp").val();
    Cin_Con = $("#RechercheControlhisp").val();
    sexHis = $("#sexHis").val();
    $("#AffichHisP").load("histoPat/afficheHisto.php?dateCons1=" + dateCons1 + "&dateCons2=" + dateCons2 + "&TypeConsl=" + TypeConsl + "&Cin_Con=" + Cin_Con + "&sexHis=" + sexHis);
  }


  $('#RechercheControlhisp').keypress(function(e) {
    var key = e.which;
    if (key == 13) // the enter key code
    {

      Cin_Con = $("#RechercheControlhisp").val();

      $("#AffichHisP").load("histoPat/afficheHisto.php?Cin_Con=" + Cin_Con);

    }
  });
</script>