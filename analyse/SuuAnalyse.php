                                                         <label for="operation" class="col-9 col-lg-9 col-form-label text-center">

                                                             <b style="color: red;">voulez vous vraiment effectuer cette action ?<b>

                                                         </label>

                                                         <div class="modal-footer">
                                                             <a href="#" class="btn btn-secondary" data-dismiss="modal">Anuller</a>
                                                             <a href="#" onclick="FunctionDeleteAnaly(<?php echo $_POST['Id_ana']; ?>);" class="btn btn-danger">Supprimer</a>
                                                         </div>



                                                         <script type="text/javascript">
                                                             function FunctionDeleteAnaly(Id_ana) {
                                                                 type = "Delete";
                                                                 $.ajax({
                                                                     type: "POST",
                                                                     url: "analyse/GetAnalyse.php",
                                                                     data: {
                                                                         type: type,
                                                                         Id_ana: Id_ana
                                                                     },
                                                                     success: function(result) {

                                                                         $('#Analysepop1').modal('hide');
                                                                         $("#Affichanalyse").load("analyse/affichageanalyse.php");

                                                                     }
                                                                 });
                                                             }
                                                         </script>