                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                      <div class="card">
                        <h5 class="card-header">Gestion des droits d'accée </h5>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table table-striped table-bordered first">
                              <thead>
                                <tr>
                                  <th>Utilusateur</th>
                                  <th>Fonction </th>
                                  <th>Spécialité</th>
                                  <th>Mot de passe</th>


                                  <th style="text-align: center;">Action</th>
                                </tr>
                              </thead>
                              <tbody>



                                <?php

                                include "../connexion.php";
                                $queryUs = " SELECT `Id_user`,`UserName`,`Password`,`Specialite`,`FonctionL` FROM `users` where 1=1 ";
                                if (isset($_GET['username']) and $_GET['username'] != "") {
                                  $queryUs .= " and UserName like'%" . $_GET['username'] . "%'";
                                }

                                $queryUs .= " order by Id_user desc";

                                $resultus = mysqli_query($con, $queryUs);
                                while ($rowP = $resultus->fetch_assoc()) {
                                ?>
                                  <tr>
                                    <td><?php echo str_replace("`", "'", $rowP['UserName']); ?></td>

                                    <td><?php echo str_replace("`", "'", $rowP['Specialite']); ?></td>
                                    <td><?php echo str_replace("`", "'", $rowP['FonctionL']); ?></td>
                                    <td> *********** </td>


                                    <td>
                                      <center>
                                        <a href="#" onclick="funtionGetUpdateUser(<?php echo $rowP['Id_user']; ?>)">
                                          <i title="Modifier" class="far fa-edit fa-lg" style="color: green;"></i>
                                        </a>
                                        <a href="#" onclick="functionRemoveUser(<?php echo $rowP['Id_user']; ?>)">
                                          <i title="Supprimer" class="fa fa-trash fa-lg" style="color: red;" aria-hidden="true"></i>
                                        </a>
                                      </center>
                                    </td>

                                  </tr>
                                <?php

                                }

                                ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>

                    <script>
                      function funtionGetUpdateUser(Id_user) {


                        $.ajax({
                          type: "POST",
                          url: "Access/updateUser.php",
                          data: {
                            Id_user: Id_user
                          },
                          success: function(result) {
                            $('.modal-body').html(result);
                            $('#DrAccees').modal('show');

                          }
                        });
                      }


                      function functionRemoveUser(Id_user) {

                        $.ajax({
                          type: "POST",
                          url: "Access/SuppUser.php",
                          data: {
                            Id_user: Id_user
                          },
                          success: function(result) {
                            $('.modal-body').html(result);
                            $('#DrAccees').modal('show');

                          }
                        });
                      }
                    </script>