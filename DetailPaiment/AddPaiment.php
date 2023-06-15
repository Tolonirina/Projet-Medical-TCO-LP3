<input type="hidden" id="id_NP" value="<?php echo $_POST['id_NP']; ?>" />
<form id="form" data-parsley-validate="" novalidate="">

  <div class="form-group row">
    <label for="CINP" class="col-3 col-lg-3 col-form-label text-left">CIN </label>
    <div class="col-6 col-lg-6">
      <input type="text" class="form-control" disabled="disabled" value="<?php
                                                                          if (isset($_POST['CIN'])) {
                                                                            echo $_POST['CIN'];
                                                                          } ?>" />
    </div>

  </div>



  <div class="form-group row">
    <label for="CINP" class="col-3 col-lg-3 col-form-label text-left">Titre de paiment </label>
    <div class="col-6 col-lg-6">
      <input type="text" class="form-control" disabled="disabled" value="<?php
                                                                          if (isset($_POST['Titre'])) {
                                                                            echo $_POST['Titre'];
                                                                          } ?>" />
    </div>

  </div>



  <div class="form-group row">
    <label for="Poids" class="col-3 col-lg-3 col-form-label text-left">Montant total </label>
    <div class="col-8 col-lg-8">
      <input type="text" disabled="disabled" placeholder="00.00" value="<?php
                                                                        if (isset($_POST['Montant'])) {
                                                                          echo $_POST['Montant'];
                                                                        } ?>" class="form-control col-8 col-lg-8">
    </div>
  </div>




  <div class="form-group row">
    <label for="AvancePai" class="col-3 col-lg-3 col-form-label text-left">Avance </label>
    <div class="col-8 col-lg-8">
      <input id="AvancePaiP" type="number" placeholder="00.00" class="form-control col-9 col-lg-8">
    </div>
  </div>



  <div class="form-group row">
    <label for="ObservationPai" class="col-3 col-lg-3 col-form-label text-left">Observation </label>
    <div class="col-8 col-lg-8">
      <textarea id="ObservationPai" class="form-control"></textarea>
    </div>
  </div>






</form>


<div class="modal-footer">
  <a href="#" class="btn btn-secondary" data-dismiss="modal">Anuller</a>
  <a href="#" onclick="functionAddPaimentI();" class="btn btn-primary">Enregistrer</a>
</div>

<script type="text/javascript">
  function functionAddPaimentI() {
    type = "Insert";

    AvancePai = $("#AvancePaiP").val();

    id_NP = $("#id_NP").val();

    ObservationPai = $("#ObservationPai").val();
    Cin_Con = $("#RecherchePai").val();


    $.ajax({
      type: "POST",
      url: "DetailPaiment/gestPaiment.php",
      data: {
        type: type,
        id_NP: id_NP,
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