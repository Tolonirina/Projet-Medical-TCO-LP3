                                                         <label for="operation" class="col-9 col-lg-9 col-form-label text-center">

                                                             <b style="color: red;">voulez vous vraiment effectuer cette action ?<b>

                                                         </label>

                                                         <div class="modal-footer">
                                                             <a href="#" class="btn btn-secondary" data-dismiss="modal">Anuller</a>
                                                             <a href="#" onclick="FunctionDeletPat(<?php echo $_POST['idPas']; ?>);" class="btn btn-danger">Supprimer</a>
                                                         </div>



                                                         <script type="text/javascript">
                                                             function FunctionDeletPat(idPas) {
                                                                 type = "Delete";
                                                                 $.ajax({
                                                                     type: "POST",
                                                                     url: "Patient/MesajourPa.php",
                                                                     data: {
                                                                         type: type,
                                                                         idPas: idPas
                                                                     },
                                                                     success: function(result) {
                                                                         $("#AffichP").load("Patient/affichage.php");
                                                                         $('#exampleModal').modal('hide');

                                                                     }
                                                                 });
                                                             }
                                                         </script>