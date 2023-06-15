<?php
$cinp = "";
$nomp = "";
$prenom = "";
$ListMedicament = "";
$Observation = "";
$Usage1 = "";
include "../connexion.php";
$queryOrU = "select DISTINCT Usage1, CIN,patient.Nom_Pat,patient.Prenom_Pat, ordonnance.Observation,`Id_ord`,patient.Id_pat,ListMedicament from consultation
left join patient on patient.Id_pat=consultation.Id_Pat
left join ordonnance on ordonnance.Id_pats=patient.Id_pat
 where 1=1 
 and Id_ord =" . trim($_POST['Id_ord']) . " 
 ";
$resultOrd = mysqli_query($con, $queryOrU);
$rowOrd = $resultOrd->fetch_assoc();
$cinp = $rowOrd['CIN'];
$nomp = $rowOrd['Nom_Pat'];
$prenom = $rowOrd['Prenom_Pat'];
$ListMedicament = $rowOrd['ListMedicament'];
$Observation = str_replace("`", "'", $rowOrd['Observation']);
$Usage1 = str_replace("`", "'", $rowOrd['Usage1']);
?>


<input type="hidden" id="getId_ord" value="<?php echo $_POST['Id_ord'] ?>">

<form id="form" data-parsley-validate="" novalidate="">
    <div class="form-group row">
        <label for="CIN" class="col-3 col-lg-3 col-form-label text-left">CIN</label>
        <div class="col-8 col-lg-8">
            <input disabled="disabled" id="CIN" value="<?php echo  $cinp; ?>" type="text" required="" data-parsley-type="CIN" placeholder="Médicament" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="nomp" class="col-3 col-lg-3 col-form-label text-left">Nom</label>
        <div class="col-8 col-lg-8">
            <input disabled="disabled" id="nomp" value="<?php echo  $nomp; ?>" type="text" required="" data-parsley-type="nomp" placeholder="Médicament" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="Medicament1" class="col-3 col-lg-3 col-form-label text-left">Prénom</label>
        <div class="col-8 col-lg-8">
            <input disabled="disabled" id="prenom" value="<?php echo  $prenom; ?>" type="text" required="" data-parsley-type="prenom" placeholder="prenom" class="form-control">
        </div>
    </div>





    <div class="form-group row">
        <label for="Medicament1" class="col-2 col-lg-2 col-form-label text-left">Médicaments</label>
        <div class="select-wrapper col-8 col-lg-8">
            <span class="autocomplete-select "></span>
        </div>

    </div>

    <div class="form-group row">
        <label for="Medicament1" class="col-3 col-lg-3 col-form-label text-left">Usage </label>
        <div class="col-8 col-lg-8">
            <textarea class="form-control" id="UsageMe1" placeholder="Exmp Doliprane 1000 : 2f/j (5j)"><?php echo str_replace("<br />", "", $Usage1); ?></textarea>
        </div>
    </div>


    <div class="form-group row">
        <label for="Medicament1" class="col-3 col-lg-3 col-form-label text-left">Observation</label>
        <div class="col-8 col-lg-8">
            <textarea class="form-control" id="ObservationU"><?php echo  $Observation;  ?></textarea>
        </div>
    </div>



</form>


<div class="modal-footer">
    <a href="#" class="btn btn-secondary" data-dismiss="modal">Anuller</a>
    <a href="#" onclick="functionUpOrdo();" class="btn btn-primary">Enregistrer</a>
</div>

<?php
// pour remplire la combobox //
include "../connexion.php";
$queryOrM = " SELECT `Id_Med`,`Nom_Med` FROM `medicament`  ";
$resultOrM = mysqli_query($con, $queryOrM);
?>





<input type="hidden" value="<?php echo $ListMedicament; ?>" id="listeMedicament">
<script>
    function functionUpOrdo() {
        Id_ord = $("#getId_ord").val();
        listeMedicament = $("#listeMedicament").val();
        Observation = $("#ObservationU").val();
        UsageMe = $("#UsageMe1").val();
        type = "update";
        $.ajax({
            type: "POST",
            url: "ordonnance/gestOrdonnances.php",
            data: {
                type: type,
                Id_ord: Id_ord,
                listeMedicament: listeMedicament,
                Observation: Observation,
                UsageMe: UsageMe
            },
            success: function(result) {
                $('#ordonnancesP').modal('hide');
                $("#AffichOrd").load("ordonnance/afficheOrdonnace.php");

            }
        });
    }










    /********************************************** Script Add ******************************************************/
    /** rempir combobox with data */


    var autocomplete = new SelectPure(".autocomplete-select", {
            options: [
                <?php
                while ($rowOrM = $resultOrM->fetch_assoc()) {
                    echo  '{
            label: "' . str_replace("`", "'", $rowOrM["Nom_Med"]) . '",
            value: "' . str_replace("`", "'", $rowOrM["Nom_Med"]) . '",
          },';
                }
                ?>


                {
                    label: $("#listeMedicament").val(),
                    value: $("#listeMedicament").val(),
                },


            ],
            value: [$("#listeMedicament").val()],
            multiple: true,
            autocomplete: true,
            icon: "fa fa-times",
            onChange: value => {
                document.getElementById("listeMedicament").value = value;

            },

        }

    );
</script>