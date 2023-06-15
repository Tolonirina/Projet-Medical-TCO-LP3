<?php
include "../connexion.php";
$querypaiU = " select patient.CIN,npaiment.Titre,paiment.MAvance,paiment.Id_Pai,
npaiment.NMonatant,paiment.Obervation
from npaiment
inner join patient on  patient.Id_pat=npaiment.Id_Pats
left join  paiment on paiment.id_NP=npaiment.Id_Np
 where Id_Pai=" . $_POST['Id_Pai'] . "
  ";
$resultPaiU = mysqli_query($con, $querypaiU);
$rowPaiU = $resultPaiU->fetch_assoc();

?>

<input type="hidden" id="Id_Pai" value="<?php echo $_POST['Id_Pai']; ?>" />
<form id="form" data-parsley-validate="" novalidate="">

  <div class="form-group row">
    <label for="CINP" class="col-3 col-lg-3 col-form-label text-left">CIN </label>
    <div class="col-6 col-lg-6">
      <input type="text" class="form-control" disabled="disabled" value="<?php echo $rowPaiU['CIN']; ?>" />
    </div>

  </div>



  <div class="form-group row">
    <label for="CINP" class="col-3 col-lg-3 col-form-label text-left">Titre de paiment </label>
    <div class="col-6 col-lg-6">
      <input type="text" class="form-control" disabled="disabled" value="<?php echo $rowPaiU['Titre']; ?>" />
    </div>

  </div>



  <div class="form-group row">
    <label for="Poids" class="col-3 col-lg-3 col-form-label text-left">Montant total </label>
    <div class="col-8 col-lg-8">
      <input type="text" disabled="disabled" placeholder="00.00" value="<?php echo $rowPaiU['NMonatant']; ?>" class="form-control col-8 col-lg-8">
    </div>
  </div>




  <div class="form-group row">
    <label for="AvancePai" class="col-3 col-lg-3 col-form-label text-left">Avance </label>
    <div class="col-8 col-lg-8">
      <input id="AvancePaiP" value="<?php echo $rowPaiU['MAvance']; ?>" type="number" placeholder="00.00" class="form-control col-9 col-lg-8">
    </div>
  </div>



  <div class="form-group row">
    <label for="ObservationPai" class="col-3 col-lg-3 col-form-label text-left">Observation </label>
    <div class="col-8 col-lg-8">
      <textarea id="ObservationPai" class="form-control"><?php echo str_replace("`", "'", $rowPaiU['Obervation']); ?></textarea>
    </div>
  </div>






</form>


<div class="modal-footer">
  <a href="#" class="btn btn-secondary" data-dismiss="modal">Anuller</a>
  <a href="#" onclick="functionUppPaimentI(<?php echo $rowPaiU['Id_Pai']; ?>);" class="btn btn-primary">Enregistrer</a>
</div>

<script type="text/javascript">
  function functionUppPaimentI(Id_Pai) {
    type = "update";

    AvancePai = $("#AvancePaiP").val();
    TypePaiment = $("#TypePaiment").val();


    ObservationPai = $("#ObservationPai").val();
    Cin_Con = $("#RecherchePai").val();


    $.ajax({
      type: "POST",
      url: "DetailPaiment/gestPaiment.php",
      data: {
        type: type,
        Id_Pai: Id_Pai,
        AvancePai: AvancePai,
        ObservationPai: ObservationPai
      },
      success: function(result) {
        $('.modal-body').html(result);
        $('#paimentPop').modal('hide');
        $("#AffichDetailP").load("DetailPaiment/affichePaime.php?Cin_Con=" + Cin_Con);

      }
    });



  }
</script>