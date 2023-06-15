<?php


$dateCons = date("Y/m/d");
$operation = "";
$CIN = "";
$poids = "";
$Prix = "";
$Observation = "";
include "../connexion.php";
$queryCU = " SELECT CIN,patient.Nom_Pat,patient.Prenom_Pat, consultation.Id_con,patient.Id_Pat,poids,Prix,Observation,DATE_FORMAT(Date_Cons, '%d/%m/%Y') as Date_Cons,`Type_Cons` FROM `patient` 
left join consultation on consultation.Id_pat=patient.Id_Pat
where patient.Id_Pat=" . trim($_POST['Id_Pat']) . " and Id_con=" . trim($_POST['Id_con']) . "
  ";

$resultCU = mysqli_query($con, $queryCU);
$rowCU = $resultCU->fetch_assoc();
$operation = $rowCU['Type_Cons'];
$dateCons = $rowCU['Date_Cons'];
$CIN = $rowCU['CIN'];
$poids = $rowCU['poids'];;
$Prix = $rowCU['Prix'];;
$Observation = str_replace("`", "'", $rowCU['Observation']);

?>

<input type="hidden" id="Id_con" value="<?php echo $_POST['Id_con']; ?>">
<input type="hidden" id="Id_Pat" value="<?php echo $_POST['Id_Pat']; ?>">
<form id="form" data-parsley-validate="" novalidate="">

  <div class="form-group row">
    <label for="CINU" class="col-3 col-lg-3 col-form-label text-left">CIN </label>
    <div class="col-8 col-lg-8">
      <input type="text" id="CINU" class="form-control" disabled="disabled" value="<?php echo $CIN; ?>">
    </div>

  </div>


  <div class="form-group row">
    <label for="operation" class="col-3 col-lg-3 col-form-label text-left">Opération</label>
    <div class="col-8 col-lg-8">


      <select class="form-control" id="operationu">

        <?php if (trim($operation) == 0) {
          echo '<option value="0" selected > Nouvelle consultation</option>';
          echo   '<option value="1"  >Contrôle</option>';
        } else if (trim($operation) == 1) {

          echo   '<option value="1" selected >Contrôle</option>';
          echo '<option value="0" > Nouvelle consultation</option>';
        } ?>





      </select>
    </div>
  </div>

  <div class="form-group row">
    <label for="dateCons" class="col-3 col-lg-3 col-form-label text-left">Date d'opération </label>
    <div class="col-8 col-lg-8">
      <input type="text" id="dateCons" class="form-control" value="<?php echo $dateCons; ?>">
    </div>

  </div>


  <div class="form-group row">
    <label for="PoidsU" class="col-3 col-lg-3 col-form-label text-left">Poids </label>
    <div class="col-8 col-lg-8">
      <input type="text" value="<?php echo $poids; ?>" id="PoidsU" placeholder="Poids" class="form-control col-8 col-lg-8">
    </div>
  </div>




  <div class="form-group row">
    <label for="PrixU" class="col-3 col-lg-3 col-form-label text-left">Prix </label>
    <div class="col-8 col-lg-8">
      <input type="text" id="PrixU" value="<?php echo $Prix; ?>" placeholder="Prix  200.00" class="form-control col-9 col-lg-8">
    </div>
  </div>



  <div class="form-group row">
    <label for="ObservationCons" class="col-3 col-lg-3 col-form-label text-left">Observation </label>
    <div class="col-8 col-lg-8">
      <textarea id="ObservationConsU" class="form-control"><?php echo $Observation; ?></textarea>
    </div>
  </div>


</form>


<div class="modal-footer">
  <a href="#" class="btn btn-secondary" data-dismiss="modal">Anuller</a>
  <a href="#" onclick="functionUpdateConsultation();" class="btn btn-primary">Enregistrer</a>
</div>

<script type="text/javascript">
  $("#dateCons").datepicker();

  function functionUpdateConsultation() {
    Id_con = $("#Id_con").val();
    Id_Pat = $("#Id_Pat").val();
    type = "update";

    Poids = $("#PoidsU").val();
    Prix = $("#PrixU").val();
    ObservationCons = $("#ObservationConsU").val();

    operation = $("#operationu").val();
    dateCons = $("#dateCons").val();

    $.ajax({
      type: "POST",
      url: "consultation/gestConsu.php",
      data: {
        Id_con: Id_con,
        Id_Pat: Id_Pat,
        operation: operation,
        dateCons: dateCons,
        type: type,
        Poids: Poids,
        Prix: Prix,
        ObservationCons: ObservationCons
      },
      success: function(result) {
        $('.modal-body').html(result);
        $('#ConsultationPop').modal('hide');
        $("#AffichC").load("consultation/afficheConsu.php");

      }
    });


  }
</script>