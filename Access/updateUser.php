<?php

include "../connexion.php";
$queryUser1 = " SELECT `Id_user`,`UserName`,`Password`,`Specialite`,`FonctionL` FROM `users` 
where Id_user=" . $_POST['Id_user'] . "
";
$resultus1 = mysqli_query($con, $queryUser1);
$rowuse = $resultus1->fetch_assoc();
?>


<input type="hidden" id="Id_user" value="<?php echo $_POST['Id_user']; ?>">
<form id="form" data-parsley-validate="" novalidate="">

  <div class="form-group row">
    <label for="Utilisateur" class="col-3 col-lg-3 col-form-label text-left">Utilisateur </label>
    <div class="col-8 col-lg-8">
      <input type="text" id="Utilisateur" class="form-control" value="<?php echo str_replace("`", "'", $rowuse['UserName']); ?>">
    </div>

  </div>

  <div class="form-group row">
    <label for="Password" class="col-3 col-lg-3 col-form-label text-left">Mot de passe </label>
    <div class="col-8 col-lg-8">
      <input type="Password" id="Password" class="form-control" value="<?php echo str_replace("`", "'", $rowuse['Password']); ?>">
    </div>

  </div>



  <div class="form-group row">
    <label for="FonctionM" class="col-3 col-lg-3 col-form-label text-left">Fonction </label>
    <div class="col-8 col-lg-8">
      <select class="form-control" id="FonctionM">


        <option value="<?php echo str_replace("`", "'", $rowuse['FonctionL']); ?>">
          <?php echo str_replace("`", "'", $rowuse['FonctionL']); ?>
        </option>
        <option value="Médecin">Médecin</option>
        <option value="Assistance">Assistance</option>

      </select>
    </div>
  </div>


  <div class="form-group row">
    <label for="Specialite" class="col-3 col-lg-3 col-form-label text-left">Spécialité</label>
    <div class="col-8 col-lg-8">
      <select class="form-control" id="Specialite">
        <option><?php echo str_replace("`", "'", $rowuse['Specialite']); ?></option>

        <option>Médecin généraliste</option>
        <option>Angiologue</option>
        <option>Cardiologue</option>
        <option>Cancérologue - oncologue</option>
        <option>Dentiste</option>
        <option>Dermatologue</option>
        <option>Diabétologue</option>
        <option>Gastro-entérologue</option>
        <option>Gynécologue-obstétricien</option>
        <option>Neurologue</option>
        <option>Ophtalmologiste</option>
        <option>Orthodontiste</option>
        <option>Oto-rhino-laryngologiste (ORL)</option>
        <option>Pneumologue</option>
        <option>Pharmacien</option>
        <option>Rhumatologue</option>
        <option>Urologue</option>

      </select>
    </div>
  </div>

</form>


<div class="modal-footer">
  <a href="#" class="btn btn-secondary" data-dismiss="modal">Anuller</a>
  <a href="#" onclick="functionUpdateConsultation();" class="btn btn-primary">Enregistrer</a>
</div>

<script type="text/javascript">
  function functionUpdateConsultation() {
    type = "update";

    Utilisateur = $("#Utilisateur").val();
    Id_user = $("#Id_user").val();
    FonctionM = $("#FonctionM").val();
    Specialite = $("#Specialite").val();




    if (FonctionM != "") {

      $.ajax({
        type: "POST",
        url: "Access/getaccess.php",
        data: {
          type: type,
          Utilisateur: Utilisateur,
          FonctionM: FonctionM,
          Specialite: Specialite,
          Id_user: Id_user
        },
        success: function(result) {
          $('.modal-body').html(result);
          $('#DrAccees').modal('hide');
          $("#AffiAccess").load("Access/affiaccess.php");

        }
      });
    } else {
      alert("Choisez Votre fonction  *-*");
    }


  }
</script>