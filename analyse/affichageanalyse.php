                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                      <div class="card">
                        <h5 class="card-header">Analyse & patient
                        </h5>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table table-striped table-bordered first">
                              <thead>
                                <tr>
                                  <th>CIN </th>
                                  <th>Nom</th>
                                  <th>Prénom</th>
                                  <th>le titre</th>

                                  <th>Type </th>
                                  <th> Date </th>
                                  <th>Observation </th>


                                  <th style="text-align: center;">Action</th>
                                </tr>
                              </thead>
                              <tbody>



                                <?php

                                include "../connexion.php";
                                $queryanal = "select distinct 
patient.Id_pat,patient.CIN,patient.Nom_Pat,patient.Prenom_Pat,analyse.Observation,analyse.FaieLe,analyse.Id_ana
from patient
left join analyse on analyse.Id_Pas=patient.Id_pat
left join analyseparamtre on analyseparamtre.Id_ana=analyse.Id_ana
left join paramanalyse on paramanalyse.id_PAR=analyseparamtre.Id_Para";


                                if (isset($_GET['ParaNaRadion'])) {
                                  $queryanal .= " and NomPar like'%" . $_GET['ParaNaRadion'] . "%'";
                                }

                                if (isset($_GET['TypeAnalyseRadR'])) {
                                  $queryanal .= " and Type like '%" . $_GET['TypeAnalyseRadR'] . "%'";
                                }



                                $queryanal .= " order by Id_ana desc limit 0,50";

                                $resultAna = mysqli_query($con, $queryanal);
                                while ($rowAna = $resultAna->fetch_assoc()) {
                                  $id_PAR = "0";
                                ?>
                                  <tr>
                                    <td><?php echo str_replace("`", "'", $rowAna['CIN']); ?></td>
                                    <td><?php echo str_replace("`", "'", $rowAna['Nom_Pat']); ?></td>
                                    <td><?php echo str_replace("`", "'", $rowAna['Prenom_Pat']); ?></td>

                                    <td style="cursor: pointer;" class="AddAnalyse" title="Ajouter une analyse ou radiologique " valCIn="<?php echo str_replace("`", "'", $rowAna['CIN']); ?>" valNom="<?php echo str_replace("`", "'", $rowAna['Nom_Pat']); ?>" valPrenom="<?php echo str_replace("`", "'", $rowAna['Prenom_Pat']); ?>" ValIdP="<?php echo $rowAna['Id_pat']; ?>">

                                      <?php
                                      $querySelTitre = "select paramanalyse.NomPar,paramanalyse.id_PAR,paramanalyse.Type
          from analyseparamtre 
          INNER join paramanalyse on paramanalyse.id_PAR=analyseparamtre.Id_Para
           where analyseparamtre.Id_ana=" . $rowAna['Id_ana'] . "
          ";
                                      if ($rowAna['Id_ana']) {
                                        $resultSelTitre = mysqli_query($con, $querySelTitre);
                                        while ($rowSeT = $resultSelTitre->fetch_assoc()) {
                                          echo $rowSeT['NomPar'] . "<br/>";
                                          $id_PAR = $id_PAR . "," . $rowSeT['id_PAR'];
                                        } ?>




                                        <input type="hidden" id="id_PAR<?php echo $rowAna['Id_ana']; ?>" value="<?php echo $id_PAR; ?>">
                                      <?php } ?>


                                    </td>

                                    <td>

                                      <?php
                                      $querySelTitre = "select paramanalyse.Type
          from analyseparamtre 
          INNER join paramanalyse on paramanalyse.id_PAR=analyseparamtre.Id_Para
           where analyseparamtre.Id_ana=" . $rowAna['Id_ana'] . "
          ";
                                      $resultSelTitre = mysqli_query($con, $querySelTitre);
                                      if ($rowAna['Id_ana']) {
                                        while ($rowSeT = $resultSelTitre->fetch_assoc()) {
                                          echo $rowSeT['Type'] . "<br/>";
                                        }
                                      }
                                      ?>

                                    </td>


                                    <td><?php echo str_replace("`", "'", $rowAna['FaieLe']); ?> </td>

                                    <td><?php echo str_replace("`", "'", $rowAna['Observation']); ?> </td>

                                    <td>
                                      <?php if ($rowAna['Id_ana']) { ?>
                                        <center>

                                          <a href="#" onclick="funtionGetUpdateanalyse(<?php echo $rowAna['Id_ana']; ?>,
           '<?php echo $rowAna['CIN']; ?>',
           	'<?php echo $rowAna['Nom_Pat']; ?>',
           	'<?php echo $rowAna['Prenom_Pat']; ?>',
           	'<?php echo $rowAna['Observation']; ?>'
           )

           	">

                                            <i title="Modifier" class="far fa-edit fa-lg" style="color: green;"></i>
                                          </a>
                                          <a href="#" onclick="functionRemoveanalyse(<?php echo $rowAna['Id_ana']; ?>)">
                                            <i title="Supprimer" class="fa fa-trash fa-lg" style="color: red;" aria-hidden="true"></i>
                                          </a>

                                          <a href="#" onclick="functionGetOdro(<?php echo $rowAna['Id_ana']; ?>)" title="Imprimer"> <i class="fas fa-print fa-lg " style="color: blue;"></i> </a>
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







                    <script type="text/javascript">
                      function functionGetOdro(Id_ana) {
                        newwindow = window.open("analyse/ImprimerAnalyse.php?Id_ana=" + Id_ana, "_blank", "toolbar=yes,scrollbars=yes, resizable=yes, top=500, left=500, width=800, height=700");
                        newwindow.moveTo(350, 150);
                      }


                      $(".AddAnalyse").on("click", functionAddAnalys)

                      function functionAddAnalys(e) {


                        Id_pat = $(this).attr("ValIdP");
                        CIN = $(this).attr("valCIn");
                        Nom = $(this).attr("valNom");
                        Prenom = $(this).attr("valPrenom");

                        $.ajax({
                          type: "POST",
                          url: "Analyse/AddAnalyse.php",
                          data: {
                            Id_pat: Id_pat,
                            CIN: CIN,
                            Nom: Nom,
                            Prenom: Prenom
                          },
                          success: function(result) {
                            $('.modal-body').html(result);
                            $('#Analysepop').modal('show');

                          }
                        });



                      }



                      function funtionGetUpdateanalyse(Id_ana, CIN, Nom, Prenom, Observation) {

                        id_PAR = $("#id_PAR" + Id_ana).val();

                        $.ajax({
                          type: "POST",
                          url: "Analyse/UpdateAnalyse.php",
                          data: {
                            Id_ana: Id_ana,
                            CIN: CIN,
                            Nom: Nom,
                            Prenom: Prenom,
                            id_PAR: id_PAR,
                            Observation: Observation
                          },
                          success: function(result) {
                            $('.modal-body').html(result);
                            $('#Analysepop').modal('show');

                          }
                        });

                      }





                      function functionRemoveanalyse(Id_ana) {

                        $.ajax({
                          type: "POST",
                          url: "Analyse/SuuAnalyse.php",
                          data: {
                            Id_ana: Id_ana
                          },
                          success: function(result) {
                            $('.modal-body').html(result);
                            $('#Analysepop1').modal('show');

                          }
                        });
                      }
                    </script>