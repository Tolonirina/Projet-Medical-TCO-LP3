<?php
$cinp = "";
$nomp = "";
$prenom = "";
if (isset($_POST['CinP'])) {
    $cinp = $_POST['CinP'];
}
if (isset($_POST['NomP'])) {
    $nomp = $_POST['NomP'];
}
if (isset($_POST['PrenomP'])) {
    $prenom = $_POST['PrenomP'];
}

?>


<input type="hidden" id="getId_Pat" value="<?php echo $_POST['Id_Pat'] ?>">

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
            <textarea class="form-control" id="UsageMe" placeholder="Exmp Doliprane 1000 : 2f/j (5j)
           Doliprane 500 : 2f/j (4j)"></textarea>
        </div>
    </div>





    <div class="form-group row">
        <label for="Medicament1" class="col-3 col-lg-3 col-form-label text-left">Observation</label>
        <div class="col-8 col-lg-8">
            <textarea class="form-control" id="Observation"></textarea>
        </div>
    </div>












</form>


<div class="modal-footer">
    <a href="#" class="btn btn-secondary" data-dismiss="modal">Anuller</a>
    <a href="#" onclick="functionAddOrdo();" class="btn btn-primary">Enregistrer</a>
</div>

<?php
include "../connexion.php";
$queryOrM = " SELECT `Id_Med`,`Nom_Med` FROM `medicament`  ";
$resultOrM = mysqli_query($con, $queryOrM);
?>





<input type="hidden" id="listeMedicament">
<script>
    function functionAddOrdo() {
        Id_Pat = $("#getId_Pat").val();
        Observation = $("#Observation").val();
        listeMedicament = $("#listeMedicament").val();
        UsageMe = $("#UsageMe").val();
        type = "Insert";
        $.ajax({
            type: "POST",
            url: "ordonnance/gestOrdonnances.php",
            data: {
                type: type,
                Id_Pat: Id_Pat,
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
                    label: "X",
                    value: "X",
                },


            ],
            value: ["X"],
            multiple: true,
            autocomplete: true,
            icon: "fa fa-times",
            onChange: value => {
                document.getElementById("listeMedicament").value = value;

            },

        }

    );
</script>