                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                      <div class="card">
                        <h5 class="card-header">Gestion des analyses & radioligique
                        </h5>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table table-striped table-bordered first">
                              <thead>
                                <tr>
                                  <th>Titre</th>
                                  <th>Type </th>
                                  <th>Observation </th>


                                  <th style="text-align: center;">Action</th>
                                </tr>
                              </thead>
                              <tbody>



                                <?php

                                include "../connexion.php";
                                $queryPAnal = " SELECT `id_PAR`,`NomPar`,`Type`,`Observation` FROM `paramanalyse`  where 1=1 ";
                                if (isset($_GET['ParaNaRadion'])) {
                                  $queryPAnal .= " and NomPar like'%" . $_GET['ParaNaRadion'] . "%'";
                                }

                                if (isset($_GET['TypeAnalyseRadR'])) {
                                  $queryPAnal .= " and Type like '%" . $_GET['TypeAnalyseRadR'] . "%'";
                                }



                                $queryPAnal .= " order by id_PAR desc limit 0,50";

                                $resultPAna = mysqli_query($con, $queryPAnal);
                                while ($rowPAna = $resultPAna->fetch_assoc()) {
                                ?>
                                  <tr>
                                    <td><?php echo str_replace("`", "'", $rowPAna['NomPar']); ?></td>
                                    <td><?php echo str_replace("`", "'", $rowPAna['Type']); ?></td>
                                    <td><?php echo str_replace("`", "'", $rowPAna['Observation']); ?></td>


                                    <td>
                                      <center>
                                        <a href="#" onclick="funtionGetUpdatePanalyse(<?php echo $rowPAna['id_PAR']; ?>)">
                                          <i title="Modifier" class="far fa-edit fa-lg" style="color: green;"></i>
                                        </a>
                                        <a href="#" onclick="functionRemovePanalyse(<?php echo $rowPAna['id_PAR']; ?>)">
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
                      function funtionGetUpdatePanalyse(id_PAR) {

                        $.ajax({
                          type: "POST",
                          url: "panalyseRad/UpdatePanalye.php",
                          data: {
                            id_PAR: id_PAR
                          },
                          success: function(result) {
                            $('.modal-body').html(result);
                            $('#ParaANaRadion').modal('show');

                          }
                        });
                      }



                      function functionRemovePanalyse(id_PAR) {

                        $.ajax({
                          type: "POST",
                          url: "panalyseRad/SuppressionPa.php",
                          data: {
                            id_PAR: id_PAR
                          },
                          success: function(result) {
                            $('.modal-body').html(result);
                            $('#ParaANaRadion').modal('show');

                          }
                        });
                      }
                    </script>