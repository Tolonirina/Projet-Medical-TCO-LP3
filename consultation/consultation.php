<center>
    <table style="width: 90%;">
        <tr>
            <td style="width: 16%;">
                <div id="custom-search" class="top-search-bar">
                    <input id="RechercheControl" style="margin-bottom: 8%;" class="form-control" type="text" placeholder="Recherche par  CIN">
                </div>
            </td>

            <td style="width: 18%;"><select class="form-control" id="TypeConsl1">
                    <option value=""> Choisez le type d'opération </option>
                    <option value="0">Nouvelle consultation</option>
                    <option value="1">Contrôle </option>
                </select> </td>
            <td style="width: 1%;"> </td>
            <td style="width: 12%;">
                <input type="text" class="form-control col-10 col-lg-10" placeholder="date 1" id="dateCons1">
            </td>

            <td style="width: 1%;">à </td>
            <td style="width: 12%;">
                <input type="text" placeholder="date 2" class="form-control col-9 col-lg-9" id="dateCons2">
            </td>
            <td style="width: 10%;"><button class="btn btn-primay" onclick="functionRechercheMul();">Recherche</button> </td>

        </tr>
    </table>
</center>





<div class="modal fade" id="ConsultationPop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Gestion des consultations et des contrôles</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>


<div id="AffichC">
    <?php include "afficheConsu.php"; ?>

</div>




<script>
    $("#dateCons1").datepicker();
    $("#dateCons2").datepicker();


    function functionRechercheMul() {
        dateCons1 = $("#dateCons1").val();
        dateCons2 = $("#dateCons2").val();
        TypeConsl = $("#TypeConsl1").val();

        $("#AffichC").load("consultation/afficheConsu.php?dateCons1=" + dateCons1 + "&dateCons2=" + dateCons2 + "&TypeConsl=" + TypeConsl);
    }


    $('#RechercheControl').keypress(function(e) {
        var key = e.which;
        if (key == 13) // the enter key code
        {

            Cin_Con = $("#RechercheControl").val();
            $("#AffichC").load("consultation/afficheConsu.php?Cin_Con=" + Cin_Con);

        }
    });
</script>