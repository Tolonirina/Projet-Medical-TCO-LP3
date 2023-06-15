 <form id="form" data-parsley-validate="" novalidate="">
     <div class="form-group row">
         <label for="CINP" class="col-3 col-lg-3 col-form-label text-left">CIN</label>
         <div class="col-8 col-lg-8">
             <input id="CINP" type="text" required="" data-parsley-type="CIN" placeholder="CIN" class="form-control">
         </div>
     </div>
     <div class="form-group row">
         <label for="NomP" class="col-3 col-lg-3 col-form-label text-left">Nom</label>
         <div class="col-8 col-lg-8">
             <input id="NomP" type="text" required="" placeholder="Nom" class="form-control">
         </div>
     </div>
     <div class="form-group row">
         <label for="PrenomPa" class="col-3 col-lg-3 col-form-label text-left">Prénom</label>
         <div class="col-8 col-lg-8">
             <input id="PrenomPa" type="text" required="" data-parsley-type="url" placeholder="Prénom" class="form-control">
         </div>
     </div>

     <div class="form-group row">
         <label for="DateNaissancePI" class="col-3 col-lg-3 col-form-label text-left">Date Naissance</label>
         <div class="col-8 col-lg-8"><input id="DateNaissancePI" type="text" class="form-control">
         </div>
     </div>

     <div class="form-group row">
         <label for="SexeP" class="col-3 col-lg-3 col-form-label text-left">Sexe </label>
         <div class="col-8 col-lg-8">
             <select id="SexeP" class="form-control">
                 <option>M</option>
                 <option>F</option>
             </select>
         </div>
     </div>

     <div class="form-group row">
         <label for="telephoneP" class="col-3 col-lg-3 col-form-label text-left">Téléphone</label>
         <div class="col-8 col-lg-8">
             <input id="telephoneP" type="text" required="" data-parsley-type="telephoneP" placeholder="Téléphone" class="form-control">
         </div>
     </div>

     <div class="form-group row">
         <label for="Adreese" class="col-3 col-lg-3 col-form-label text-left">Adreese </label>
         <div class="col-8 col-lg-8">
             <input id="AdreeseP" type="text" required="" data-parsley-type="AdreeseP" placeholder="Adreese" class="form-control">
         </div>
     </div>

     <div class="form-group row">
         <label for="Email" class="col-3 col-lg-3 col-form-label text-left">Email</label>
         <div class="col-8 col-lg-8">
             <input id="EmailP" type="text" required="" data-parsley-type="EmailP" placeholder="Email" class="form-control">
         </div>
     </div>




 </form>
 </div>
 <div class="modal-footer">
     <a href="#" class="btn btn-secondary" data-dismiss="modal">Anuller</a>
     <a href="#" onclick="functionInsertIntoPa();" class="btn btn-primary">Enregistrer</a>
 </div>



 <script type="text/javascript">
     $(function() {
         $("#DateNaissancePI").datepicker();

     });

     function functionInsertIntoPa() {

         type = "Insert";
         CIN = $("#CINP").val();
         NomP = $("#NomP").val();
         PrenomPa = $("#PrenomPa").val();

         DateNaissance = $("#DateNaissancePI").val();

         telephone = $("#telephoneP").val();
         Adreese = $("#AdreeseP").val();
         Email = $("#EmailP").val();
         SexeP = $("#SexeP").val();

         $.ajax({
             type: "POST",
             url: "Patient/MesajourPa.php",
             data: {
                 type: type,
                 CIN: CIN,
                 NomP: NomP,
                 PrenomPa: PrenomPa,
                 DateNaissance: DateNaissance,
                 telephone: telephone,
                 Adreese: Adreese,
                 Email: Email,
                 SexeP: SexeP
             },
             success: function(result) {
                 $('#exampleModal').modal('hide');
                 $("#AffichP").load("Patient/affichage.php");

             }
         });


     }
 </script>

 </script>