                                                         <label for="operation" class="col-9 col-lg-9 col-form-label text-center">

                                                             <b style="color: red;">voulez vous vraiment effectuer cette action ?<b>

                                                         </label>

                                                         <div class="modal-footer">
                                                             <a href="#" class="btn btn-secondary" data-dismiss="modal">Anuller</a>
                                                             <a href="#" onclick="FunctionDeleteUser(<?php echo $_POST['Id_user']; ?>);" class="btn btn-danger">Supprimer</a>
                                                         </div>



                                                         <script type="text/javascript">
                                                             function FunctionDeleteUser(Id_user) {
                                                                 type = "Delete";
                                                                 $.ajax({
                                                                     type: "POST",
                                                                     url: "Access/getaccess.php",
                                                                     data: {
                                                                         type: type,
                                                                         Id_user: Id_user
                                                                     },
                                                                     success: function(result) {

                                                                         $('#DrAccees').modal('hide');
                                                                         $("#AffiAccess").load("Access/affiaccess.php");

                                                                     }
                                                                 });
                                                             }
                                                         </script>