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

                                  <th>Date opération </th>
                                  <th style="width: 20%;">Heure</th>
                                  <th>opération</th>
                                </tr>
                              </thead>
                              <tbody>



                                <?php

                                include "../connexion.php";
                                $queryC = " SELECT CIN,patient.Nom_Pat,patient.Prenom_Pat, consultation.Id_con,patient.Id_Pat,DATE_FORMAT(Date_Cons, '%d/%m/%Y') as Date_Cons,`Type_Cons` ,Heure FROM `patient` 
left join consultation on consultation.Id_pat=patient.Id_Pat where 1=1
  ";
                                if (isset($_GET['Cin_Con']) and trim($_GET['Cin_Con']) != "") {
                                  $queryC .= " and  CIN like'%" . $_GET['Cin_Con'] . "%'";
                                }

                                if (isset($_GET['dateCons1']) and trim($_GET['dateCons1']) != "" && isset($_GET['dateCons2']) and trim($_GET['dateCons2']) != "") {
                                  $date1 = strtr($_GET['dateCons1'], '/', '-');
                                  $date1 = date('Y/m/d', strtotime($date1));

                                  $date2 = strtr($_GET['dateCons2'], '/', '-');
                                  $date2 = date('Y/m/d', strtotime($date2));

                                  $queryC .= " and  Date_Cons between '" . $date1 . "' and '" . $date2 . "'";
                                }

                                if (isset($_GET['TypeConsl']) and trim($_GET['TypeConsl']) != "") {
                                  $queryC .= " and   Type_Cons ='" . $_GET['TypeConsl'] . "'";
                                }

                                if (isset($_GET['sexHis']) and trim($_GET['sexHis']) != "") {
                                  $queryC .= " and   Sexe like'%" . $_GET['sexHis'] . "%'";
                                }


                                $queryC .= " order by Id_con,patient.Id_Pat desc limit 0,50";

                                $result = mysqli_query($con, $queryC);
                                while ($rowC = $result->fetch_assoc()) {
                                ?>
                                  <tr>
                                    <td><?php echo str_replace("`", "'", $rowC['CIN']); ?></td>
                                    <td><?php echo str_replace("`", "'", $rowC['Nom_Pat']); ?></td>
                                    <td><?php echo str_replace("`", "'", $rowC['Prenom_Pat']); ?></td>

                                    <td> <?php echo str_replace("`", "'", $rowC['Date_Cons']); ?></td>
                                    <td> <?php echo $rowC['Heure']; ?></td>
                                    <td> <?php if (trim($rowC['Type_Cons']) == "0") {
                                            echo "Nouveau consultation";
                                          } else if (trim($rowC['Type_Cons']) == "1") {
                                            echo "Contrôle";
                                          }; ?></td>









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