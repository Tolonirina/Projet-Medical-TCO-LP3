                                                         <label for="operation" class="col-9 col-lg-9 col-form-label text-center">

                                                             <b style="color: red;">voulez vous vraiment effectuer cette action ?<b>

                                                         </label>

                                                         <div class="modal-footer">
                                                             <a href="#" class="btn btn-secondary" data-dismiss="modal">Anuller</a>
                                                             <a href="#" onclick="FunctionDeleteNPai(<?php echo $_POST['Id_Np']; ?>);" class="btn btn-danger">Supprimer</a>
                                                         </div>



                                                         <script type="text/javascript">
                                                             function FunctionDeleteNPai(Id_Np) {
                                                                 type = "Delete";
                                                                 $.ajax({
                                                                     type: "POST",
                                                                     url: "Npaiment/gestNpaiment.php",
                                                                     data: {
                                                                         type: type,
                                                                         Id_Np: Id_Np
                                                                     },
                                                                     success: function(result) {


                                                                         $("#AffichNpaiment").load("Npaiment/affichageNpaiment.php");
                                                                         $('#Npaiment').modal('hide');

                                                                     }
                                                                 });
                                                             }
                                                         </script>