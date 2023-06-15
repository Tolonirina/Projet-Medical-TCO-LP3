                                                         <label for="operation" class="col-9 col-lg-9 col-form-label text-center">

                                                           <b style="color: red;">voulez vous vraiment effectuer cette action ?<b>

                                                         </label>

                                                         <div class="modal-footer">
                                                           <a href="#" class="btn btn-secondary" data-dismiss="modal">Anuller</a>
                                                           <a href="#" onclick="FunctionDeletePanalyse(<?php echo $_POST['id_PAR']; ?>);" class="btn btn-danger">Supprimer</a>
                                                         </div>



                                                         <script type="text/javascript">
                                                           function FunctionDeletePanalyse(id_PAR) {
                                                             type = "Delete";
                                                             $.ajax({
                                                               type: "POST",
                                                               url: "panalyseRad/getPanalyse.php",
                                                               data: {
                                                                 type: type,
                                                                 id_PAR: id_PAR
                                                               },
                                                               success: function(result) {

                                                                 $('#ParaANaRadion').modal('hide');
                                                                 $("#AffichPAR").load("panalyseRad/affichagePA.php");

                                                               }
                                                             });
                                                           }
                                                         </script>