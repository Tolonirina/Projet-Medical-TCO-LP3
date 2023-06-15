 <form id="form" data-parsley-validate="" novalidate="">
     <div class="form-group row">
         <label for="CINNP" class="col-3 col-lg-3 col-form-label text-left">CIN</label>
         <div class="col-8 col-lg-8">
             <input disabled="disabled" id="CINNP" value="<?php echo $_POST['Cin']; ?>" type="text" data-parsley-type="" placeholder="CIN" class="form-control">
         </div>
     </div>

     <div class="form-group row">
         <label for="NomNP" class="col-3 col-lg-3 col-form-label text-left">Nom</label>
         <div class="col-8 col-lg-8">
             <input disabled="disabled" id="NomNP" value="<?php echo $_POST['Nom']; ?>" type="text" required="" data-parsley-type="Medicament1" placeholder="Médicament" class="form-control">
         </div>
     </div>

     <div class="form-group row">
         <label for="PrenonNPai" class="col-3 col-lg-3 col-form-label text-left">Prénom</label>
         <div class="col-8 col-lg-8">
             <input disabled="disabled" id="PrenonNPai" value="<?php echo $_POST['Prenom']; ?>" type="text" required="" data-parsley-type="Medicament1" placeholder="Médicament" class="form-control">
         </div>
     </div>




     <div class="form-group row">
         <label for="NMontantTo" class="col-3 col-lg-3 col-form-label text-left">Montant total</label>
         <div class="col-8 col-lg-8">
             <input id="NMontantTo" type="number" required="" data-parsley-type="NMontantTo" placeholder="00.00" class="form-control">
         </div>
     </div>



     <div class="form-group row">
         <label for="NTitre" class="col-3 col-lg-3 col-form-label text-left">Titre</label>
         <div class="col-8 col-lg-8">
             <input id="NTitre" type="text" required="" data-parsley-type="TitreNPai" placeholder="Titre" class="form-control">
         </div>
     </div>




     <div class="form-group row">
         <label for="ObservationNPaiment" class="col-3 col-lg-3 col-form-label text-left">Observation </label>
         <div class="col-8 col-lg-8">
             <textarea id="ObservationNPaiment" class="form-control"></textarea>

         </div>
     </div>
 </form>


 <div class="modal-footer">
     <a href="#" class="btn btn-secondary" data-dismiss="modal">Anuller</a>
     <a href="#" onclick="functionAddNPaiment(<?php echo $_POST['Id_Pat']; ?>);" class="btn btn-primary">Enregistrer</a>
 </div>


 <script type="text/javascript">
     function functionAddNPaiment(Id_Pat) {
         type = "Insert";
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
                 Id_Pat: Id_Pat
             },
             success: function(result) {

                 $("#AffichNpaiment").load("Npaiment/affichageNpaiment.php");
                 $('#Npaiment').modal('hide');

             }
         });

     }
 </script>