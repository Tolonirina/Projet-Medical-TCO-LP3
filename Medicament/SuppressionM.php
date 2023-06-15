                                                         <label for="operation" class="col-9 col-lg-9 col-form-label text-center">

                                                             <b style="color: red;">voulez vous vraiment effectuer cette action ?<b>

                                                         </label>

                                                         <div class="modal-footer">
                                                             <a href="#" class="btn btn-secondary" data-dismiss="modal">Anuller</a>
                                                             <a href="#" onclick="FunctionDeleteMed(<?php echo $_POST['Id_Med']; ?>);" class="btn btn-danger">Supprimer</a>
                                                         </div>



                                                         <script type="text/javascript">
                                                             function FunctionDeleteMed(Id_Med) {
                                                                 type = "Delete";
                                                                 $.ajax({
                                                                     type: "POST",
                                                                     url: "Medicament/TraiMedi.php",
                                                                     data: {
                                                                         type: type,
                                                                         Id_Med: Id_Med
                                                                     },
                                                                     success: function(result) {

                                                                         $("#AffichM").load("Medicament/affichageM.php");
                                                                         $('#Medicament').modal('hide');

                                                                     }
                                                                 });
                                                             }
                                                         </script>