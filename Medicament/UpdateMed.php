 <?php
    $Medicament = "";
    $Commentaire = "";

    if (isset($_POST['Id_Med'])) {
        include "../connexion.php";
        $queryM = " SELECT `Id_Med`,`Nom_Med`,`Commentaire` FROM `medicament`  ";

        $queryM .= " where Id_Med like'%" . $_POST['Id_Med'] . "%'";
        $result = mysqli_query($con, $queryM);
        $rowM = $result->fetch_assoc();
        $Medicament = $rowM['Nom_Med'];
        $Commentaire = $rowM['Commentaire'];
    }


    ?>
 <input type="hidden" id="id_Med1" value="<?php echo $_POST['Id_Med']; ?>">
 <form id="form" data-parsley-validate="" novalidate="">
     <div class="form-group row">
         <label for="Medicament1" class="col-3 col-lg-3 col-form-label text-left">Médicament</label>
         <div class="col-8 col-lg-8">
             <input id="Medicament1" value="<?php echo $Medicament; ?>" type="text" required="" data-parsley-type="Medicament1" placeholder="Médicament" class="form-control">
         </div>
     </div>
     <div class="form-group row">
         <label for="Commentaire" class="col-3 col-lg-3 col-form-label text-left">Observation </label>
         <div class="col-8 col-lg-8">
             <textarea id="Commentaire" class="form-control"><?php echo $Commentaire; ?></textarea>

         </div>
     </div>
 </form>


 <div class="modal-footer">
     <a href="#" class="btn btn-secondary" data-dismiss="modal">Anuller</a>
     <a href="#" onclick="functionUpdateMedicament();" class="btn btn-primary">Enregistrer</a>
 </div>


 <script type="text/javascript">
     function functionUpdateMedicament() {
         id_Med = $("#id_Med1").val();
         Medicament = $("#Medicament1").val();
         Commentaire = $("#Commentaire").val();
         type = "update";
         $.ajax({
             type: "POST",
             url: "Medicament/TraiMedi.php",
             data: {
                 type: type,
                 Medicament: Medicament,
                 Commentaire: Commentaire,
                 id_Med: id_Med
             },
             success: function(result) {
                 $('#Medicament').modal('hide');
                 $("#AffichM").load("Medicament/affichageM.php");

             }
         });

     }
 </script>