                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                      <div class="card">


                        <h5 class="card-header">Gestion des Consultations et des Contrôle</h5>

                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table table-striped table-bordered first">
                              <thead>
                                <tr>
                                  <th>CIN</th>
                                  <th>Nom </th>
                                  <th>Prenom</th>
                                  <th>opération</th>

                                  <th>Date opération </th>
                                  <th> Poinds </th>
                                  <th> Prix </th>
                                  <th> Observation </th>

                                  <th style="text-align: center;">Action</th>
                                </tr>
                              </thead>
                              <tbody>



                                <?php



                                include "../connexion.php";
                                $queryC = " SELECT CIN,patient.Nom_Pat,patient.Prenom_Pat, consultation.Id_con,patient.Id_Pat,poids,Prix,Observation,DATE_FORMAT(Date_Cons, '%d/%m/%Y') as Date_Cons,`Type_Cons` FROM `patient` 
left join consultation on consultation.Id_pat=patient.Id_Pat where 1=1
  ";
                                if (isset($_GET['Cin_Con']) and $_GET['Cin_Con'] != "") {
                                  $queryC .= " and  CIN like'%" . $_GET['Cin_Con'] . "%'";
                                }

                                if (isset($_GET['dateCons1']) && $_GET['dateCons1'] != "" and isset($_GET['dateCons2']) && $_GET['dateCons2'] != "") {
                                  $date1 = strtr($_GET['dateCons1'], '/', '-');
                                  $date1 = date('Y/m/d', strtotime($date1));

                                  $date2 = strtr($_GET['dateCons2'], '/', '-');
                                  $date2 = date('Y/m/d', strtotime($date2));

                                  $queryC .= " and  Date_Cons between '" . $date1 . "' and '" . $date2 . "'";
                                }

                                if (isset($_GET['TypeConsl']) and trim($_GET['TypeConsl']) != "") {
                                  $queryC .= " and   Type_Cons ='" . $_GET['TypeConsl'] . "'";
                                }


                                $queryC .= " order by Id_con, Id_Pat  desc limit 0,50";

                                $result = mysqli_query($con, $queryC);
                                while ($rowC = $result->fetch_assoc()) {
                                ?>
                                  <tr>
                                    <td><?php echo str_replace("`", "'", $rowC['CIN']); ?></td>
                                    <td><?php echo str_replace("`", "'", $rowC['Nom_Pat']); ?></td>
                                    <td><?php echo str_replace("`", "'", $rowC['Prenom_Pat']); ?></td>
                                    <td style="cursor: pointer;" title="click pour ajouter une consultation ou un Contrôle" class="AddConsultation" valuesPat="<?php echo $rowC['Id_Pat'] ?>" valuesCon="<?php echo $rowC['Id_con'] ?>" ValCIn="<?php echo $rowC['CIN'] ?>">

                                      <?php if (trim($rowC['Type_Cons']) == "0") {
                                        echo "Nouvelle consultation";
                                      } else if (trim($rowC['Type_Cons']) == "1") {
                                        echo "Contrôle";
                                      }; ?></td>
                                    <td style="cursor: pointer;" title="click pour ajouter une consultation ou un Contrôle" class="AddConsultation" valuesPat="<?php echo $rowC['Id_Pat'] ?>" valuesCon="<?php echo $rowC['Id_con'] ?>" ValCIn="<?php echo $rowC['CIN'] ?>">

                                      <?php echo str_replace("`", "'", $rowC['Date_Cons']); ?></td>
                                    <td><?php echo str_replace("`", "'", $rowC['poids']); ?> </td>
                                    <td><?php echo str_replace("`", "'", $rowC['Prix']) . " Dhs"; ?> </td>
                                    <td><?php echo str_replace("`", "'", $rowC['Observation']); ?> </td>

                                    <td>
                                      <center>
                                        <?php if (trim($rowC['Id_con'])) { ?>
                                          <a href="#" onclick="funtionGetUpdateCons(<?php echo $rowC['Id_con'] ?>,<?php echo $rowC['Id_Pat']; ?>)">
                                            <i title="Modifier" class="far fa-edit fa-lg" style="color: green;"></i>
                                          </a>

                                          <a href="#" onclick="functionRemoveCo(<?php echo $rowC['Id_con']; ?>)">
                                            <i title="Supprimer" class="fa fa-trash fa-lg" style="color: red;" aria-hidden="true"></i>
                                          </a>
                                      </center>
                                    <?php } ?>
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
                      $(".AddConsultation").on("click", functionAddConsultations)

                      function functionAddConsultations(e) {
                        Cin_p = $(this).attr("ValCIn");

                        Id_Pat = $(this).attr("valuesPat");
                        Id_con = $(this).attr("valuesCon");
                        $.ajax({
                          type: "POST",
                          url: "consultation/InsertConsultation.php",
                          data: {
                            Id_con: Id_con,
                            Id_Pat: Id_Pat,
                            Cin_p: Cin_p
                          },
                          success: function(result) {
                            $('.modal-body').html(result);
                            $('#ConsultationPop').modal('show');

                          }
                        });

                      }


                      function funtionGetUpdateCons(Id_con, Id_Pat) {

                        $.ajax({
                          type: "POST",
                          url: "consultation/updateConsultation.php",
                          data: {
                            Id_con: Id_con,
                            Id_Pat: Id_Pat
                          },
                          success: function(result) {
                            $('.modal-body').html(result);
                            $('#ConsultationPop').modal('show');

                          }
                        });

                      }



                      function functionRemoveCo(Id_con) {
                        $.ajax({
                          type: "POST",
                          url: "consultation/Suppression.php",
                          data: {
                            Id_con: Id_con
                          },
                          success: function(result) {
                            $('.modal-body').html(result);
                            $('#ConsultationPop').modal('show');

                          }
                        });
                      }
                    </script>