<?php
$dateCons = date("d-m-Y");
$operation = "";
$CIN = "";
?>


<input type="hidden" id="Id_Pat" value="<?php echo $_POST['Id_Pat']; ?>">
<form id="form" data-parsley-validate="" novalidate="">

  <div class="form-group row">
    <label for="CIN" class="col-3 col-lg-3 col-form-label text-left">CIN </label>
    <div class="col-8 col-lg-8">
      <input type="text" id="CIN" class="form-control" disabled="disabled" value="<?php
                                                                                  if (isset($_POST['Cin_p'])) {
                                                                                    echo $_POST['Cin_p'];
                                                                                  } ?>">
    </div>

  </div>

  <div class="form-group row">
    <label for="operation" class="col-3 col-lg-3 col-form-label text-left">Opération</label>
    <div class="col-8 col-lg-8">
      <select class="form-control" id="operation">
        <option value="">Choisez le type </option>
        <option value="0">Nouvelle consultation</option>
        <option value="1">Contrôle</option>
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
    <label for="Poids" class="col-3 col-lg-3 col-form-label text-left">Poids </label>
    <div class="col-8 col-lg-8">
      <input type="text" id="Poids" placeholder="Poids" class="form-control col-8 col-lg-8">
    </div>
  </div>




  <div class="form-group row">
    <label for="Prix" class="col-3 col-lg-3 col-form-label text-left">Prix </label>
    <div class="col-8 col-lg-8">
      <input type="text" id="Prix" placeholder="Prix comme 200.00" class="form-control col-9 col-lg-8">
    </div>
  </div>



  <div class="form-group row">
    <label for="Prix" class="col-3 col-lg-3 col-form-label text-left">Observation </label>
    <div class="col-8 col-lg-8">
      <textarea id="ObservationCons" class="form-control"></textarea>
    </div>
  </div>






</form>


<div class="modal-footer">
  <a href="#" class="btn btn-secondary" data-dismiss="modal">Anuller</a>
  <a href="#" onclick="functionUpdateConsultation();" class="btn btn-primary">Enregistrer</a>
</div>

<script type="text/javascript">
  $(function() {
    $("#dateCons").datepicker();

  });

  function functionUpdateConsultation() {



    Id_Pat = $("#Id_Pat").val();
    type = "Insert";

    Poids = $("#Poids").val();
    Prix = $("#Prix").val();
    ObservationCons = $("#ObservationCons").val();

    operation = $("#operation").val();
    dateCons = $("#dateCons").val();


    if (operation != "" && dateCons) {
      $.ajax({
        type: "POST",
        url: "consultation/gestConsu.php",
        data: {
          type: type,
          Id_Pat: Id_Pat,
          operation: operation,
          dateCons: dateCons,
          ObservationCons: ObservationCons,
          Prix: Prix,
          Poids: Poids
        },
        success: function(result) {
          $('.modal-body').html(result);
          $('#ConsultationPop').modal('hide');
          $("#AffichC").load("consultation/afficheConsu.php");

        }
      });
    } else {
      alert("Choisez le type ou entrez la date correcte *-*");
    }


  }
</script>