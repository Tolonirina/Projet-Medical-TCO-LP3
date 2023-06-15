                                                         <label for="operation" class="col-9 col-lg-9 col-form-label text-center">

                                                             <b style="color: red;">voulez vous vraiment effectuer cette action ?<b>

                                                         </label>

                                                         <div class="modal-footer">
                                                             <a href="#" class="btn btn-secondary" data-dismiss="modal">Anuller</a>
                                                             <a href="#" onclick="FunctionDeleteOrd(<?php echo $_POST['Id_ord']; ?>);" class="btn btn-danger">Supprimer</a>
                                                         </div>



                                                         <script type="text/javascript">
                                                             function FunctionDeleteOrd(Id_ord) {
                                                                 type = "Delete";
                                                                 $.ajax({
                                                                     type: "POST",
                                                                     url: "ordonnance/gestOrdonnances.php",
                                                                     data: {
                                                                         type: type,
                                                                         Id_ord: Id_ord
                                                                     },
                                                                     success: function(result) {

                                                                         $('#ordonnancesP').modal('hide');
                                                                         $("#AffichOrd").load("ordonnance/afficheOrdonnace.php");

                                                                     }
                                                                 });
                                                             }
                                                         </script>