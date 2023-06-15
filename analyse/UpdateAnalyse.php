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
            $querySelTitre = "select distinct paramanalyse.Type ,NomPar,id_PAR from analyseparamtre INNER join paramanalyse on paramanalyse.id_PAR=analyseparamtre.Id_Para
inner join analyse on analyseparamtre.Id_ana=analyse.Id_ana where 1=1
 and  analyseparamtre.Id_ana =" . $_POST['Id_ana'] . "
          ";
            $resultSelTitre = mysqli_query($con, $querySelTitre);

            while ($rowSeT = $resultSelTitre->fetch_assoc()) { ?>
                <input type="checkbox" checked="checked" value="<?php echo $rowSeT['id_PAR']; ?>" name="analyse" class="CheckNalyse1"> <?php echo str_replace("`", "'", $rowSeT['NomPar']); ?><br />

            <?php }



            $querynal = " SELECT distinct `id_PAR`,`NomPar`,`Type`,`Observation` FROM `paramanalyse`  where 1=1
and id_PAR not in (" . $_POST['id_PAR'] . ") ";
            $querynal .= " order by id_PAR desc limit 0,50";
            $resultanaly = mysqli_query($con, $querynal);

            while ($rowPAna = $resultanaly->fetch_assoc()) {  ?>
                <input type="checkbox" value="<?php echo $rowPAna['id_PAR']; ?>" name="analyse" class="CheckNalyse1"> <?php echo str_replace("`", "'", $rowPAna['NomPar']); ?><br />




            <?php } ?>





        </div>
    </div>













    <div class="form-group row">
        <label for="Medicament1" class="col-2 col-lg-2 col-form-label text-left">Observation</label>
        <div class="col-4 col-lg-4">
            <textarea id="observationAnalyse" class="form-control"><?php echo str_replace("`", "", $_POST['Observation']); ?></textarea>
        </div>
    </div>





</form>


<div class="modal-footer">
    <a href="#" class="btn btn-secondary" data-dismiss="modal">Anuller</a>
    <a href="#" onclick="functionUpdaanalyse(<?php echo $_POST['Id_ana']; ?>);" class="btn btn-primary">Enregistrer</a>
</div>





<script type="text/javascript">
    function functionUpdaanalyse(Id_ana) {
        var jsonString = [];
        type = "update";
        CheckNalyse1 = document.getElementsByClassName('CheckNalyse1');
        Observation = $("#observationAnalyse").val();



        for (var i = 0; i < CheckNalyse1.length / 2; i++) {
            if (CheckNalyse1[i].checked) {

                jsonString.push(CheckNalyse1[i].value);

            }
        }





        $.ajax({
            type: "POST",
            url: "analyse/GetAnalyse.php",
            data: {
                data: jsonString,
                Observation: Observation,
                type: type,
                Id_ana: Id_ana
            },
            cache: false,

            success: function() {
                $('#Analysepop').modal('hide');
                $("#Affichanalyse").load("analyse/affichageanalyse.php");

            }
        });



    }
</script>