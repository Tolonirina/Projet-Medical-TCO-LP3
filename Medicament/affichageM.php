                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                      <div class="card">
                        <h5 class="card-header">Information sur les médicament
                        </h5>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table table-striped table-bordered first">
                              <thead>
                                <tr>
                                  <th>Médicament</th>
                                  <th>Observation</th>


                                  <th style="text-align: center;">Action</th>
                                </tr>
                              </thead>
                              <tbody>



                                <?php

                                include "../connexion.php";
                                $queryP = " SELECT `Id_Med`,`Nom_Med`,`Commentaire` FROM `medicament`  ";
                                if (isset($_GET['medicament'])) {
                                  $queryP .= " where Nom_Med like'%" . $_GET['medicament'] . "%'";
                                }

                                $queryP .= " order by Id_Med desc limit 0,50";

                                $result = mysqli_query($con, $queryP);
                                while ($rowP = $result->fetch_assoc()) {
                                ?>
                                  <tr>
                                    <td><?php echo str_replace("`", "'", $rowP['Nom_Med']); ?></td>
                                    <td><?php echo str_replace("`", "'", $rowP['Commentaire']); ?></td>


                                    <td>
                                      <center>
                                        <a href="#" onclick="funtionGetUpdateM(<?php echo $rowP['Id_Med']; ?>)">
                                          <i title="Modifier" class="far fa-edit fa-lg" style="color: green;"></i>
                                        </a>
                                        <a href="#" onclick="functionRemoveM(<?php echo $rowP['Id_Med']; ?>)">
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
                      function funtionGetUpdateM(Id_Med) {

                        $.ajax({
                          type: "POST",
                          url: "Medicament/UpdateMed.php",
                          data: {
                            Id_Med: Id_Med
                          },
                          success: function(result) {
                            $('.modal-body').html(result);
                            $('#Medicament').modal('show');

                          }
                        });
                      }



                      function functionRemoveM(Id_Med) {

                        $.ajax({
                          type: "POST",
                          url: "Medicament/SuppressionM.php",
                          data: {
                            Id_Med: Id_Med
                          },
                          success: function(result) {
                            $('.modal-body').html(result);
                            $('#Medicament').modal('show');

                          }
                        });
                      }
                    </script>