 <?php
    include "../connexion.php";
    $queryPAnalU = " SELECT `id_PAR`,`NomPar`,`Type`,`Observation` FROM `paramanalyse` 
where id_PAR=" . $_POST['id_PAR'] . "
 ";


    $resultPAnaU = mysqli_query($con, $queryPAnalU);
    $rowPAnaU = $resultPAnaU->fetch_assoc();
    ?>
 <form id="form" data-parsley-validate="" novalidate="">
     <div class="form-group row">
         <label for="TitrePAn" class="col-3 col-lg-3 col-form-label text-left">Titre</label>
         <div class="col-8 col-lg-8">
             <input id="TitrePAnU" value="<?php echo str_replace("`", "", $rowPAnaU['NomPar']); ?>" type="text" required="" data-parsley-type="TitrePAn" placeholder="Analyse ou Radiologique" class="form-control">
         </div>
     </div>


     <div class="form-group row">
         <label for="TypeAnalyseRad" class="col-3 col-lg-3 col-form-label text-left">Type : </label>
         <div class="col-8 col-lg-8">
             <select class="form-control" id="TypeAnalyseRadU">
                 <option value="<?php echo str_replace("`", "", $rowPAnaU['Type']); ?>"><?php echo str_replace("`", "", $rowPAnaU['Type']); ?></option>
                 <option value="Analyse">Analyse</option>
                 <option value="Radiologique">Radiologique</option>

             </select>

         </div>
     </div>




     <div class="form-group row">
         <label for="observationAnalyse" class="col-3 col-lg-3 col-form-label text-left">Observation </label>
         <div class="col-8 col-lg-8">
             <textarea id="observationAnalyseU" class="form-control"><?php echo str_replace("`", "", $rowPAnaU['Observation']); ?></textarea>

         </div>
     </div>
 </form>


 <div class="modal-footer">
     <a href="#" class="btn btn-secondary" data-dismiss="modal">Anuller</a>
     <a href="#" onclick="functionUpdatetPaalyse(<?php echo $_POST['id_PAR']; ?>);" class="btn btn-primary">Enregistrer</a>
 </div>


 <script type="text/javascript">
     function functionUpdatetPaalyse(id_PAR) {
         TitrePAn = $("#TitrePAnU").val();
         TypeAnalyseRad = $("#TypeAnalyseRadU").val();
         observation = $("#observationAnalyseU").val();

         type = "update";
         if (TypeAnalyseRad != "" && TypeAnalyseRad) {
             $.ajax({
                 type: "POST",
                 url: "panalyseRad/getPanalyse.php",
                 data: {
                     type: type,
                     TitrePAn: TitrePAn,
                     TypeAnalyseRad: TypeAnalyseRad,
                     observation: observation,
                     id_PAR: id_PAR
                 },
                 success: function(result) {
                     $('#ParaANaRadion').modal('hide');
                     $("#AffichPAR").load("panalyseRad/affichagePA.php");

                 }
             });
         } else {
             alert("Choiser le type (*-*)");
         }

     }
 </script>