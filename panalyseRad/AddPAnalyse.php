 <?php
    $Medicament = "";
    $Commentaire = ""; ?>
 <form id="form" data-parsley-validate="" novalidate="">
     <div class="form-group row">
         <label for="TitrePAn" class="col-3 col-lg-3 col-form-label text-left">Titre</label>
         <div class="col-8 col-lg-8">
             <input id="TitrePAn" value="" type="text" required="" data-parsley-type="TitrePAn" placeholder="Analyse ou Radiologique" class="form-control">
         </div>
     </div>


     <div class="form-group row">
         <label for="TypeAnalyseRad" class="col-3 col-lg-3 col-form-label text-left">Type : </label>
         <div class="col-8 col-lg-8">
             <select class="form-control" id="TypeAnalyseRad">
                 <option value="">Choiser le type :</option>
                 <option value="Analyse">Analyse</option>
                 <option value="Radiologique">Radiologique</option>

             </select>

         </div>
     </div>




     <div class="form-group row">
         <label for="observationAnalyse" class="col-3 col-lg-3 col-form-label text-left">Observation </label>
         <div class="col-8 col-lg-8">
             <textarea id="observationAnalyse" class="form-control"></textarea>

         </div>
     </div>
 </form>


 <div class="modal-footer">
     <a href="#" class="btn btn-secondary" data-dismiss="modal">Anuller</a>
     <a href="#" onclick="functionInsertPaalyse();" class="btn btn-primary">Enregistrer</a>
 </div>


 <script type="text/javascript">
     function functionInsertPaalyse() {
         TitrePAn = $("#TitrePAn").val();
         TypeAnalyseRad = $("#TypeAnalyseRad").val();

         observation = $("#observationAnalyse").val();
         type = "Insert";
         if (TypeAnalyseRad != "" && TypeAnalyseRad) {
             $.ajax({
                 type: "POST",
                 url: "panalyseRad/getPanalyse.php",
                 data: {
                     type: type,
                     TitrePAn: TitrePAn,
                     TypeAnalyseRad: TypeAnalyseRad,
                     observation: observation
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