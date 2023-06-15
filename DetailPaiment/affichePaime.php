                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                      <div class="card">


                        <h5 class="card-header"> Gestion des détails de Paiment
                        </h5>

                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table table-striped table-bordered first">
                              <thead>
                                <tr>
                                  <th>CIN</th>
                                  <th>Nom </th>
                                  <th>Prenom</th>
                                  <th>titre de paiment</th>
                                  <th>Date Paiment </th>
                                  <th> Total </th>
                                  <th> Avance </th>
                                  <th> Observation </th>

                                  <th style="text-align: center;">Action</th>
                                </tr>
                              </thead>
                              <tbody>



                                <?php



                                include "../connexion.php";
                                $querypai = "select patient.CIN,patient.Nom_Pat,patient.Prenom_Pat,patient.Id_pat,npaiment.Id_Np,npaiment.Titre,paiment.MAvance,DATE_FORMAT(paiment.Date_Pai, '%d/%m/%Y') as Date_Pai,paiment.Id_Pai,
npaiment.NMonatant,paiment.Obervation
from npaiment
inner join patient on  patient.Id_pat=npaiment.Id_Pats
left join  paiment on paiment.id_NP=npaiment.Id_Np where 1=1
  ";
                                if (isset($_GET['Cin_Con']) and $_GET['Cin_Con'] != "") {
                                  $querypai .= " and  CIN like'%" . $_GET['Cin_Con'] . "%'";
                                }

                                if (isset($_GET['typeP']) and $_GET['typeP'] != "") {
                                  $querypai .= " and  Titre like'%" . $_GET['typeP'] . "%'";
                                }


                                if (isset($_GET['date1']) and $_GET['date1'] != "" &&  isset($_GET['date2']) and $_GET['date2'] != "") {
                                  $date1 = strtr($_GET['date1'], '/', '-');
                                  $date1 = date('Y/m/d', strtotime($date1));

                                  $date2 = strtr($_GET['date2'], '/', '-');
                                  $date2 = date('Y/m/d', strtotime($date2));

                                  $querypai .= " and  Date_Pai between '" . $date1 . "' and '" . $date2 . "'";
                                }

                                $querypai .= " order by  Id_Np  asc limit 0,50 ";
                                $resultPai = mysqli_query($con, $querypai);



                                while ($rowPai = $resultPai->fetch_assoc()) {

                                ?>
                                  <tr>
                                    <td><?php echo str_replace("`", "'", $rowPai['CIN']); ?></td>
                                    <td><?php echo str_replace("`", "'", $rowPai['Nom_Pat']); ?></td>
                                    <td><?php echo str_replace("`", "'", $rowPai['Prenom_Pat']); ?></td>

                                    <td style="cursor: pointer;" title="click pour ajouter des avances de paiment" class="AddPaiment" valuesidNp="<?php echo $rowPai['Id_Np']; ?>" Valtitre="<?php echo $rowPai['Titre'] ?>" ValtMonta="<?php echo $rowPai['NMonatant'] ?>" ValCIN="<?php echo $rowPai['CIN'] ?>">

                                      <?php echo $rowPai['Titre'];  ?></td>

                                    <td>

                                      <?php echo str_replace("`", "'", $rowPai['Date_Pai']); ?></td>

                                    <td><?php echo $rowPai['NMonatant'] . " Dhs"; ?> </td>
                                    <td><?php echo str_replace("`", "'", $rowPai['MAvance']) . "Dhs"; ?> </td>

                                    <td><?php echo str_replace("`", "'", $rowPai['Obervation']); ?> </td>
                                    <td>
                                      <center>
                                        <?php if (trim($rowPai['Id_Pai'])) { ?>
                                          <a href="#" onclick="funtionGetUpdatePai(<?php echo $rowPai['Id_Pai'] ?>)">
                                            <i title="Modifier" class="far fa-edit fa-lg" style="color: green;"></i>
                                          </a>

                                          <a href="#" onclick="functionRemovePai(<?php echo $rowPai['Id_Pai']; ?>)">
                                            <i title="Supprimer" class="fa fa-trash fa-lg" style="color: red;" aria-hidden="true"></i>
                                          </a>

                                          <a href="#" onclick="ImprimerVosFacutre1(<?php echo $rowPai['Id_Np']; ?>);"> <i class="fas fa-print fa-lg " style="color: blue;" title="Imprimer votre facture"></i> </a>

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
                      $(".AddPaiment").on("click", functionAddPaiment)

                      function functionAddPaiment(e) {
                        CIN = $(this).attr("ValCIN");
                        id_NP = $(this).attr("valuesidNp");
                        Titre = $(this).attr("Valtitre");
                        Montant = $(this).attr("ValtMonta");
                        $.ajax({
                          type: "POST",
                          url: "DetailPaiment/AddPaiment.php",
                          data: {
                            id_NP: id_NP,
                            Titre: Titre,
                            Montant: Montant,
                            CIN: CIN
                          },
                          success: function(result) {
                            $('.modal-body').html(result);
                            $('#paimentPop').modal('show');

                          }
                        });

                      }


                      function funtionGetUpdatePai(Id_Pai) {

                        $.ajax({
                          type: "POST",
                          url: "DetailPaiment/updatePaiment.php",
                          data: {
                            Id_Pai: Id_Pai
                          },
                          success: function(result) {
                            $('.modal-body').html(result);
                            $('#paimentPop').modal('show');

                          }
                        });

                      }



                      function functionRemovePai(Id_Pai) {
                        $.ajax({
                          type: "POST",
                          url: "DetailPaiment/Suppression.php",
                          data: {
                            Id_Pai: Id_Pai
                          },
                          success: function(result) {
                            $('.modal-body').html(result);
                            $('#paimentPop').modal('show');

                          }
                        });
                      }






                      function ImprimerVosFacutre1(Id_Np) {



                        newwindow = window.open("Npaiment/Imprimer.php?Id_Np=" + Id_Np, "_blank", "toolbar=yes,scrollbars=yes, resizable=yes, top=500, left=500, width=800, height=700");
                        newwindow.moveTo(350, 150);

                      }
                    </script>