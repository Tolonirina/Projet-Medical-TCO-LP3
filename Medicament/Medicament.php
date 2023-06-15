<center>
    <table style="width: 50%">
        <tr>
            <td style="width: 40%;">
                <div id="custom-search" class="top-search-bar">
                    <input id="MedicamentR" style="margin-bottom: 4%;" class="form-control" type="text" placeholder="Recherche Médicament ..">
                </div>

            </td>
            <td> <a href="#" title="Ajouter un médicament" class="btn btn-primary col-lg-3" data-toggle="modal" onclick="funtionGetAddMedicament()">
                    <i class="fas fa-plus"></i>

                </a> </td>
        </tr>
    </table>
    <hr>


</center>

<div class="modal fade" id="Medicament" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Information sur les médicament </h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>


<div id="AffichM">
    <?php include "affichageM.php"; ?>

</div>





<script>
    $('#MedicamentR').keypress(function(e) {
        var key = e.which;
        if (key == 13) // the enter key code
        {

            medicament = $("#MedicamentR").val();
            $("#AffichM").load("Medicament/affichageM.php?medicament=" + medicament);
        }
    });

    function funtionGetAddMedicament() {
        $.ajax({
            type: "POST",
            url: "Medicament/AffichePopMe.php",

            success: function(result) {
                $('.modal-body').html(result);
                $('#Medicament').modal('show');

            }
        });
    }
</script>