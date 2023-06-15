                                                         <label for="operation" class="col-9 col-lg-9 col-form-label text-center">

                                                             <b style="color: red;">voulez vous vraiment effectuer cette action ?<b>

                                                         </label>

                                                         <div class="modal-footer">
                                                             <a href="#" class="btn btn-secondary" data-dismiss="modal">Anuller</a>
                                                             <a href="#" onclick="FunctionDeletepaime(<?php echo $_POST['Id_Pai']; ?>);" class="btn btn-danger">Supprimer</a>
                                                         </div>



                                                         <script type="text/javascript">
                                                             function FunctionDeletepaime(Id_Pai) {
                                                                 type = "Delete";
                                                                 $.ajax({
                                                                     type: "POST",
                                                                     url: "DetailPaiment/gestPaiment.php",
                                                                     data: {
                                                                         type: type,
                                                                         Id_Pai: Id_Pai
                                                                     },
                                                                     success: function(result) {
                                                                         $("#AffichDetailP").load("DetailPaiment/affichePaime.php");
                                                                         $('#paimentPop').modal('hide');


                                                                     }
                                                                 });
                                                             }
                                                         </script>