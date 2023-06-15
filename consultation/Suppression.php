                                                         <label for="operation" class="col-9 col-lg-9 col-form-label text-center">

                                                             <b style="color: red;">voulez vous vraiment effectuer cette action ?<b>

                                                         </label>

                                                         <div class="modal-footer">
                                                             <a href="#" class="btn btn-secondary" data-dismiss="modal">Anuller</a>
                                                             <a href="#" onclick="FunctionDeleteCons(<?php echo $_POST['Id_con']; ?>);" class="btn btn-danger">Supprimer</a>
                                                         </div>



                                                         <script type="text/javascript">
                                                             function FunctionDeleteCons(Id_con) {
                                                                 type = "Delete";
                                                                 $.ajax({
                                                                     type: "POST",
                                                                     url: "consultation/gestConsu.php",
                                                                     data: {
                                                                         type: type,
                                                                         Id_con: Id_con
                                                                     },
                                                                     success: function(result) {
                                                                         $("#AffichC").load("consultation/afficheConsu.php");
                                                                         $('#ConsultationPop').modal('hide');


                                                                     }
                                                                 });
                                                             }
                                                         </script>