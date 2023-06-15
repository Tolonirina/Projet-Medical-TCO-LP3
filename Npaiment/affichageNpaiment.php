                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                      <div class="card">
                        <h5 class="card-header">Nouveau Paiment
                        </h5>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table table-striped table-bordered first">
                              <thead>
                                <tr>

                                  <th>CIN</th>
                                  <th>Nom</th>
                                  <th>Préom</th>
                                  <th>Titre de Paiment</th>
                                  <th>Date opération</th>
                                  <th>Montant</th>
                                  <th>Observation</th>


                                  <th style="text-align: center;">Action</th>
                                </tr>
                              </thead>
                              <tbody>



                                <?php

                                include "../connexion.php";
                                $querynNP = " SELECT CIN , patient.Id_pat,patient.Nom_Pat,patient.Prenom_Pat , npaiment.Id_Np,DATE_FORMAT(Date_crea, '%d/%m/%Y') as dateNpai,npaiment.NMonatant,npaiment.Titre,npaiment.Observation
FROM patient left join npaiment on npaiment.Id_Pats=patient.Id_pat  where 1=1";
                                if (isset($_GET['CinNPa']) and $_GET['CinNPa'] != "") {
                                  $querynNP .= " and CIN like'%" . $_GET['CinNPa'] . "%'";
                                }

                                if (isset($_GET['date1']) and $_GET['date1'] != "" &&  isset($_GET['date2']) and $_GET['date2'] != "") {
                                  $date1 = strtr($_GET['date1'], '/', '-');
                                  $date1 = date('Y/m/d', strtotime($date1));

                                  $date2 = strtr($_GET['date2'], '/', '-');
                                  $date2 = date('Y/m/d', strtotime($date2));


                                  $querynNP .= " and  Date_crea between '" . $date1 . "' and '" . $date2 . "'";
                                }


                                $querynNP .= " order by Id_pat desc limit 0,50";

                                $resultnP = mysqli_query($con, $querynNP);
                                while ($rownp = $resultnP->fetch_assoc()) {
                                ?>
                                  <tr>

                                    <td><?php echo str_replace("`", "'", $rownp['CIN']); ?></td>
                                    <td><?php echo str_replace("`", "'", $rownp['Nom_Pat']); ?></td>
                                    <td><?php echo str_replace("`", "'", $rownp['Prenom_Pat']); ?></td>

                                    <td title="Ajouter un nouveau paiment" style="cursor: pointer;" class="AddNPaiment" valueCIn="<?php echo str_replace("`", "'", $rownp['CIN']); ?>" valueId_pat="<?php echo str_replace("`", "'", $rownp['Id_pat']); ?>" valueNom="<?php echo str_replace("`", "'", $rownp['Nom_Pat']); ?>" valuePrenom="<?php echo str_replace("`", "'", $rownp['Prenom_Pat']); ?>">

                                      <?php echo str_replace("`", "'", $rownp['Titre']); ?></td>


                                    <td><?php echo str_replace("`", "'", $rownp['dateNpai']); ?></td>
                                    <td><?php echo str_replace("`", "'", $rownp['NMonatant']) . "Dhs"; ?></td>
                                    <td><?php echo str_replace("`", "'", $rownp['Observation']); ?></td>


                                    <td>
                                      <?php if ($rownp['Id_Np']) { ?>
                                        <center>
                                          <a href="#" onclick="funtionGetUpdateNPaime(<?php echo $rownp['Id_Np']; ?>)">
                                            <i title="Modifier" class="far fa-edit fa-lg" style="color: green;"></i>
                                          </a>
                                          <a href="#" onclick="functionRemoveNPaime(<?php echo $rownp['Id_Np']; ?>)">
                                            <i title="Supprimer" class="fa fa-trash fa-lg" style="color: red;" aria-hidden="true"></i>
                                          </a>

                                          <a href="#" onclick="ImprimerVosFacutre(<?php echo $rownp['Id_Np']; ?>);"> <i class="fas fa-print fa-lg " style="color: blue;" title="Imprimer votre facture"></i> </a>
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
                      $(".AddNPaiment").on("click", AddNouveauPaiment);

                      function AddNouveauPaiment(event) {
                        Cin = $(this).attr("valueCIn");

                        Nom = $(this).attr("valueNom");
                        Prenom = $(this).attr("valuePrenom");
                        Id_Pat = $(this).attr("valueId_pat");


                        $.ajax({
                          type: "POST",
                          url: "Npaiment/AddNpaiment.php",
                          data: {
                            Id_Pat: Id_Pat,
                            Cin: Cin,
                            Prenom: Prenom,
                            Nom: Nom
                          },
                          success: function(result) {
                            $('.modal-body').html(result);
                            $('#Npaiment').modal('show');

                          }
                        });


                      }








                      function funtionGetUpdateNPaime(Id_Np) {

                        $.ajax({
                          type: "POST",
                          url: "Npaiment/UpdateNPaiment.php",
                          data: {
                            Id_Np: Id_Np
                          },
                          success: function(result) {
                            $('.modal-body').html(result);
                            $('#Npaiment').modal('show');

                          }
                        });
                      }



                      function functionRemoveNPaime(Id_Np) {

                        $.ajax({
                          type: "POST",
                          url: "Npaiment/SuppressionNP.php",
                          data: {
                            Id_Np: Id_Np
                          },
                          success: function(result) {
                            $('.modal-body').html(result);
                            $('#Npaiment').modal('show');

                          }
                        });
                      }



                      function ImprimerVosFacutre(Id_Np) {


                        newwindow = window.open("Npaiment/Imprimer.php?Id_Np=" + Id_Np, "_blank", "toolbar=yes,scrollbars=yes, resizable=yes, top=500, left=500, width=800, height=700");
                        newwindow.moveTo(350, 150);

                      }
                    </script>