<?php
session_start();
?>


<form id="form" data-parsley-validate="" novalidate="">
    <input type="hidden" id="idUser" value="<?php echo $_SESSION['id_user']; ?>">
    <div class="form-group row">
        <label for="Utilisateur" class="col-4 col-lg-4 col-form-label text-left">Utilisateur </label>
        <div class="col-8 col-lg-8">
            <input type="text" id="Utilisateur" value="<?php echo $_SESSION['Username']; ?> " class="form-control">
        </div>

    </div>

    <div class="form-group row">
        <label for="Password" class="col-4 col-lg-4 col-form-label text-left">Nouveu Mot de passe </label>
        <div class="col-8 col-lg-8">
            <input type="Password" id="Password" class="form-control" value="">
        </div>

    </div>


</form>


<div class="modal-footer">
    <a href="#" class="btn btn-secondary" data-dismiss="modal">Anuller</a>
    <a href="#" onclick="ChangePassr();" class="btn btn-primary">Enregistrer</a>
</div>

<script type="text/javascript">
    function ChangePassr() {
        type = "UpdateM";


        Password = $("#Password").val();
        id_user = $("#idUser").val();

        $.ajax({
            type: "POST",
            url: "Access/getaccess.php",
            data: {
                Password: Password,
                type: type,
                id_user: id_user
            },
            success: function(result) {

                $('.modal-body').html(result);



            }
        });




    }
</script>