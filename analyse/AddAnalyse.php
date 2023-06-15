<?php
$cinp = "";
$nomp = "";
$prenom = "";
if (isset($_POST['Id_pat'])) {
    $_SESSION['Id_pat'] = $_POST['Id_pat'];
}

if (isset($_POST['CIN'])) {
    $cinp = $_POST['CIN'];
}
if (isset($_POST['Nom'])) {
    $nomp = $_POST['Nom'];
}
if (isset($_POST['Prenom'])) {
    $prenom = $_POST['Prenom'];
}

include "../connexion.php";
$querynal = " SELECT distinct `id_PAR`,`NomPar`,`Type`,`Observation` FROM `paramanalyse`  where 1=1 ";

$querynal .= " order by id_PAR desc limit 0,50";

$resultanaly = mysqli_query($con, $querynal);



?>


<input type="hidden" id="Id_patAN" value="<?php echo $_SESSION['Id_pat']; ?>">

<form id="form" data-parsley-validate="" novalidate="">
    <div class="form-group row">
        <label for="CIN" class="col-2 col-lg-2  col-form-label text-left">CIN</label>
        <div class="col-4 col-lg-4">
            <input disabled="disabled" value="<?php echo  $cinp; ?>" type="text" required="" data-parsley-type="CIN" placeholder="Médicament" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="nomp" class="col-2 col-lg-2   col-form-label text-left">Nom</label>
        <div class="col-4 col-lg-4">
            <input disabled="disabled" value="<?php echo  $nomp; ?>" type="text" required="" data-parsley-type="nomp" placeholder="Médicament" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="Medicament1" class="col-2 col-lg-2  col-form-label text-left">Prénom</label>
        <div class="col-4 col-lg-4">
            <input disabled="disabled" value="<?php echo  $prenom; ?>" type="text" required="" data-parsley-type="prenom" placeholder="prenom" class="form-control">
        </div>
    </div>



    <div class="form-group row" style="top: 2%; right:2%;width: 50%;height: 72%; position: absolute;border: 2px solid gray;border-radius: 5px;">
        <label for="Analyse" class="col-2 col-lg-2 col-form-label text-left">Analyse :</label>
        <div class="col-8 col-lg-8">

            <?php
            while ($rowPAna = $resultanaly->fetch_assoc()) {  ?>
                <input type="checkbox" value="<?php echo $rowPAna['id_PAR']; ?>" name="analyse" class="CheckNalyseIns"> <?php echo str_replace("`", "'", $rowPAna['NomPar']); ?><br />




            <?php } ?>





        </div>
    </div>













    <div class="form-group row">
        <label for="Medicament1" class="col-2 col-lg-2 col-form-label text-left">Observation</label>
        <div class="col-4 col-lg-4">
            <textarea id="observationAnalyse" class="form-control"></textarea>
        </div>
    </div>





</form>


<div class="modal-footer">
    <a href="#" class="btn btn-secondary" data-dismiss="modal">Anuller</a>
    <a href="#" onclick="functionAddanalyse();" class="btn btn-primary">Enregistrer</a>
</div>





<script type="text/javascript">
    function functionAddanalyse() {

        type = "Insert";
        Id_pat = $("#Id_patAN").val();
        checkNalyse = document.getElementsByClassName('CheckNalyseIns');

        Observation = $("#observationAnalyse").val();

        var jsonString = [];
        for (var i = 0; i < checkNalyse.length / 2; i++) {
            if (checkNalyse[i].checked) {
                jsonString.push(checkNalyse[i].value);

            }
        }





        $.ajax({
            type: "POST",
            url: "analyse/GetAnalyse.php",
            data: {
                data: jsonString,
                Observation: Observation,
                type: type,
                Id_pat: Id_pat
            },
            cache: false,

            success: function() {
                $('#Analysepop').modal('hide');
                $("#Affichanalyse").load("analyse/affichageanalyse.php");

            }
        });



    }
</script>