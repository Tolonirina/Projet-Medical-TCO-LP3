                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                      <div class="card">
                        <h5 class="card-header">Gestion des ordonnaces </h5>

                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table table-striped table-bordered first">
                              <thead>
                                <tr>
                                  <th>CIN</th>
                                  <th>Nom </th>
                                  <th>Prenom</th>

                                  <th>Traitement </th>
                                  <th>Usage </th>
                                  <th> Observation</th>
                                  <th>Date traitement</th>
                                  <th style="text-align: center;">Action</th>
                                </tr>
                              </thead>
                              <tbody>

                                <?php

                                include "../connexion.php";
                                $queryOr = "  select DISTINCT Usage1, CIN,patient.Nom_Pat,patient.Prenom_Pat,ordonnance.Observation, `Id_ord`,patient.Id_pat,ListMedicament,DATE_FORMAT(date_Odr, '%d/%m/%Y') as date_Odr from consultation
left join patient on patient.Id_pat=consultation.Id_Pat
left join ordonnance on ordonnance.Id_pats=patient.Id_pat
 where 1=1 and patient.Id_pat is not null
  ";

                                if (isset($_GET['Cin_Ord']) and $_GET['Cin_Ord'] != "") {
                                  $queryOr .= " and CIN like '%" . $_GET['Cin_Ord'] . "%'";
                                }

                                if (isset($_GET['MediOrd']) and $_GET['MediOrd'] != "") {
                                  $queryOr .= " and  ListMedicament like  '%" . $_GET['MediOrd'] . "%'";
                                }

                                if ((isset($_GET['dateOrd1']) and $_GET['dateOrd1'] != "") && (isset($_GET['dateOrd2']) and $_GET['dateOrd2'] != "")) {

                                  $date1 = strtr($_GET['dateOrd1'], '/', '-');
                                  $date1 = date('Y/m/d', strtotime($date1));

                                  $date2 = strtr($_GET['dateOrd2'], '/', '-');
                                  $date2 = date('Y/m/d', strtotime($date2));

                                  $queryOr .= " and  date_Odr between   '" . $date1 . "' and '" . $date1 . "'";
                                }




                                $queryOr .= " order by Id_ord desc limit 0,50";

                                $resultOr = mysqli_query($con, $queryOr);
                                while ($rowOr = $resultOr->fetch_assoc()) {
                                ?>

                                  <tr>
                                    <td><?php echo str_replace("`", "'", $rowOr['CIN']); ?></td>
                                    <td><?php echo str_replace("`", "'", $rowOr['Nom_Pat']); ?></td>
                                    <td><?php echo str_replace("`", "'", $rowOr['Prenom_Pat']); ?></td>

                                    <td title="Ajouter un nouveau traitement" style="cursor: pointer;" class="nouveauTraitement" valtrai="<?php echo $rowOr['Id_pat']; ?>" dataNom="<?php echo $rowOr['Nom_Pat']; ?>" dataPrenom="<?php echo $rowOr['Prenom_Pat']; ?>" dataCin="<?php echo $rowOr['CIN']; ?>">


                                      <?php
                                      $ListMedicament = str_replace(",", "<br>", $rowOr['ListMedicament']);
                                      echo "<b style='color:black;'>" . str_replace("`", "'", $ListMedicament) . "</b>";
                                      ?>
                                    </td>
                                    <td><?php echo str_replace("`", "'", $rowOr['Usage1']); ?> </td>
                                    <td><?php echo str_replace("`", "'", $rowOr['Observation']); ?></td>
                                    <td><?php echo str_replace("`", "'", $rowOr['date_Odr']); ?></td>
                                    <td>
                                      <?php if (trim($rowOr['Id_ord'])) { ?>
                                        <center>
                                          <a href="#" onclick="funtionGetUpdateord(<?php echo $rowOr['Id_ord']; ?>)">
                                            <i title="Modifier" class="far fa-edit fa-lg" style="color: green;"></i></a>
                                          <a href="#" onclick="functionRemoveord(<?php echo $rowOr['Id_ord']; ?>)">
                                            <i title="Supprimer" class="fa fa-trash fa-lg" style="color: red;" aria-hidden="true"></i></a>
                                          <a href="#" onclick="functionGetOrdeImp(<?php echo $rowOr['Id_ord']; ?>)" title="Imprimer"> <i class="fas fa-print fa-lg " style="color: blue;"></i> </a>



                                        </center>
                                      <?php } ?>
                                    </td>
                                  </tr>

                                <?php }
                                ?>



                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>



                    <script>
                      function functionGetOrdeImp(Id_ord) {


                        newwindow = window.open("ordonnance/ImprissionOr.php?Id_ord=" + Id_ord, "_blank", "toolbar=yes,scrollbars=yes, resizable=yes, top=500, left=500, width=800, height=700");
                        newwindow.moveTo(350, 150);

                      }




                      function functionRemoveord(Id_ord) {

                        $.ajax({
                          type: "POST",
                          url: "ordonnance/SuppressionOr.php",
                          data: {
                            Id_ord: Id_ord
                          },
                          success: function(result) {
                            $('.modal-body').html(result);
                            $('#ordonnancesP').modal('show');

                          }
                        });
                      }





                      $(".nouveauTraitement").on("click", funtionGetIordonnaces)

                      function funtionGetIordonnaces(e) {
                        Id_Pat = $(this).attr("valtrai");
                        NomP = $(this).attr("dataNom");
                        PrenomP = $(this).attr("dataPrenom");
                        CinP = $(this).attr("dataCin");

                        $.ajax({
                          type: "POST",
                          url: "ordonnance/AddOrdonnance.php",
                          data: {
                            Id_Pat: Id_Pat,
                            NomP: NomP,
                            PrenomP: PrenomP,
                            CinP: CinP
                          },
                          success: function(result) {
                            $('.modal-body').html(result);
                            $('#ordonnancesP').modal('show');

                          }
                        });
                      }



                      /**************************** Function update ***************************************/
                      function funtionGetUpdateord(Id_ord) {



                        $.ajax({
                          type: "POST",
                          url: "ordonnance/updateOrd.php",
                          data: {
                            Id_ord: Id_ord
                          },
                          success: function(result) {
                            $('.modal-body').html(result);
                            $('#ordonnancesP').modal('show');

                          }
                        });
                      }
                    </script>