 <?php

    include "../connexion.php";
    $querynNPU = " SELECT CIN , patient.Id_pat,patient.Nom_Pat,patient.Prenom_Pat , npaiment.Id_Np,npaiment.NMonatant,npaiment.Titre,npaiment.Observation
FROM patient inner join npaiment on npaiment.Id_Pats=patient.Id_pat 
and Id_Np=" . $_POST['Id_Np'] . "
 ";
    $resultnPU = mysqli_query($con, $querynNPU);
    $rownp = $resultnPU->fetch_assoc();


    ?>


 <form id="form" data-parsley-validate="" novalidate="">
     <div class="form-group row">
         <label for="CINNP" class="col-3 col-lg-3 col-form-label text-left">CIN</label>
         <div class="col-8 col-lg-8">
             <input disabled="disabled" id="CINNP" value="<?php echo $rownp['CIN']; ?>" type="text" data-parsley-type="" placeholder="CIN" class="form-control">
         </div>
     </div>

     <div class="form-group row">
         <label for="NomNP" class="col-3 col-lg-3 col-form-label text-left">Nom</label>
         <div class="col-8 col-lg-8">
             <input disabled="disabled" id="NomNP" value="<?php echo $rownp['Nom_Pat']; ?>" type="text" required="" data-parsley-type="Medicament1" placeholder="Médicament" class="form-control">
         </div>
     </div>

     <div class="form-group row">
         <label for="PrenonNPai" class="col-3 col-lg-3 col-form-label text-left">Prénom</label>
         <div class="col-8 col-lg-8">
             <input disabled="disabled" id="PrenonNPai" value="<?php echo $rownp['Prenom_Pat']; ?>" type="text" required="" data-parsley-type="Medicament1" placeholder="Médicament" class="form-control">
         </div>
     </div>




     <div class="form-group row">
         <label for="NMontantTo" class="col-3 col-lg-3 col-form-label text-left">Montant total</label>
         <div class="col-8 col-lg-8">
             <input id="NMontantTo" type="number" required="" data-parsley-type="NMontantTo" placeholder="00.00" class="form-control" value="<?php echo $rownp['NMonatant']; ?>">
         </div>
     </div>



     <div class="form-group row">
         <label for="NTitre" class="col-3 col-lg-3 col-form-label text-left">Titre</label>
         <div class="col-8 col-lg-8">
             <input id="NTitre" type="text" required="" data-parsley-type="TitreNPai" placeholder="Titre" class="form-control" value="<?php echo $rownp['Titre']; ?>">
         </div>
     </div>




     <div class="form-group row">
         <label for="ObservationNPaiment" class="col-3 col-lg-3 col-form-label text-left">Observation </label>
         <div class="col-8 col-lg-8">
             <textarea id="ObservationNPaiment" class="form-control"><?php echo str_replace("`", "'", $rownp['Observation']); ?></textarea>

         </div>
     </div>
 </form>


 <div class="modal-footer">
     <a href="#" class="btn btn-secondary" data-dismiss="modal">Anuller</a>
     <a href="#" onclick="functionAddNPaiment(<?php echo $rownp['Id_Np']; ?>);" class="btn btn-primary">Enregistrer</a>
 </div>


 <script type="text/javascript">
     function functionAddNPaiment(Id_Np) {
         type = "update";
         NMontantTo = $("#NMontantTo").val();
         NTitre = $("#NTitre").val();
         observation = $("#ObservationNPaiment").val();


         $.ajax({
             type: "POST",
             url: "Npaiment/gestNpaiment.php",
             data: {
                 type: type,
                 NMontantTo: NMontantTo,
                 NTitre: NTitre,
                 observation: observation,
                 Id_Np: Id_Np
             },
             success: function(result) {

                 $("#AffichNpaiment").load("Npaiment/affichageNpaiment.php");
                 $('#Npaiment').modal('hide');

             }
         });

     }
 </script>