<?php

$CIN = "";
$NOM = "";
$Prenom = "";
$DateNai = "";
$Tel = "";
$Email = "";
$Sexe = "";
$adreese = "";
if (isset($_POST['idPas'])) {
    include "../connexion.php";
    $queryP1 = " SELECT `Id_pat`,`CIN`,`Nom_Pat`,`Prenom_Pat`, DATE_FORMAT(DateNaissance, '%d/%m/%Y') as dateN,`Telephone`,`Email`,`Adresse`,`DateCreation`,`Sexe` FROM `patient` 
where Id_pat=" . $_POST['idPas'] . "";
    $result1 = mysqli_query($con, $queryP1);
    $rowP1 = $result1->fetch_assoc();
    $CIN = $rowP1['CIN'];
    $NOM = $rowP1['Nom_Pat'];
    $Prenom = $rowP1['Prenom_Pat'];
    $DateNai = $rowP1['dateN'];
    $Tel = $rowP1['Telephone'];
    $Email = $rowP1['Email'];
    $adreese = $rowP1['Adresse'];
    $Sexe = $rowP1['Sexe'];
}
?>
<input type="hidden" id="idPas" value="<?php echo $_POST['idPas']; ?>">



<!-- Button trigger modal -->

<!-- Modal -->

<form id="form" data-parsley-validate="" novalidate="">
    <div class="form-group row">
        <label for="CINP" class="col-3 col-lg-3 col-form-label text-left">CIN</label>
        <div class="col-8 col-lg-8">
            <input id="CINP" value="<?php echo $CIN; ?>" type="text" required="" data-parsley-type="CIN" placeholder="CIN" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="NomP" class="col-3 col-lg-3 col-form-label text-left">Nom</label>
        <div class="col-8 col-lg-8">
            <input id="NomP" type="text" value="<?php echo $NOM; ?>" required="" placeholder="Nom" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="PrenomPa" class="col-3 col-lg-3 col-form-label text-left">Prénom</label>
        <div class="col-8 col-lg-8">
            <input id="PrenomPa" value="<?php echo $Prenom; ?>" type="text" required="" data-parsley-type="url" placeholder="Prénom" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="DateNaissanceP" class="col-3 col-lg-3 col-form-label text-left">Date Naissance</label>
        <div class="col-8 col-lg-8">
            <input value="<?php echo $DateNai; ?>" id="DateNaissanceP" type="text" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="SexeP" class="col-3 col-lg-3 col-form-label text-left">Sexe </label>
        <div class="col-8 col-lg-8">
            <select id="SexeP" class="form-control">
                <option><?php echo $Sexe; ?></option>
                <option>M</option>
                <option>F</option>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="telephoneP" class="col-3 col-lg-3 col-form-label text-left">Téléphone</label>
        <div class="col-8 col-lg-8">
            <input value="<?php echo $Tel; ?>" id="telephoneP" type="text" required="" data-parsley-type="telephoneP" placeholder="Téléphone" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="Adreese" class="col-3 col-lg-3 col-form-label text-left">Adreese </label>
        <div class="col-8 col-lg-8">
            <input value="<?php echo $adreese; ?>" id="AdreeseP" type="text" required="" data-parsley-type="AdreeseP" placeholder="Adreese" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="Email" class="col-3 col-lg-3 col-form-label text-left">Email</label>
        <div class="col-8 col-lg-8">
            <input value="<?php echo $Email; ?>" id="EmailP" type="text" required="" data-parsley-type="EmailP" placeholder="Email" class="form-control">
        </div>
    </div>




</form>
</div>
<div class="modal-footer">
    <a href="#" class="btn btn-secondary" data-dismiss="modal">Anuller</a>
    <a href="#" onclick="functionInsertIntoPa();" class="btn btn-primary">Enregistrer</a>
</div>









<script type="text/javascript">
    $(function() {
        $("#DateNaissanceP").datepicker();

    });

    function functionInsertIntoPa() {

        type = "update";
        idPas = $("#idPas").val();
        CIN = $("#CINP").val();
        NomP = $("#NomP").val();
        PrenomPa = $("#PrenomPa").val();

        DateNaissance = $("#DateNaissanceP").val();
        telephone = $("#telephoneP").val();
        Adreese = $("#AdreeseP").val();
        Email = $("#EmailP").val();
        SexeP = $("#SexeP").val();

        $.ajax({
            type: "POST",
            url: "Patient/MesajourPa.php",
            data: {
                type: type,
                CIN: CIN,
                NomP: NomP,
                PrenomPa: PrenomPa,
                DateNaissance: DateNaissance,
                telephone: telephone,
                Adreese: Adreese,
                Email: Email,
                SexeP: SexeP,
                idPas: idPas
            },
            success: function(result) {
                $('#exampleModal').modal('hide');
                $("#AffichP").load("Patient/affichage.php");

            }
        });


    }
</script>