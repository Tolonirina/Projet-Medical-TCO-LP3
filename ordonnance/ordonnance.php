<center>
    <table style="width: 90%;">
        <tr>
            <td style="width: 16%;">
                <div id="custom-search" class="top-search-bar">
                    <input id="RechercheCinOrd" style="margin-bottom: 8%;" class="form-control" type="text" placeholder="Recherche par  CIN">
                </div>
            </td>

            <td style="width: 16%;">
                <div id="custom-search" class="top-search-bar">
                    <input id="RechercheOrdoM" style="margin-bottom: 8%;" class="form-control" type="text" placeholder="Par  Médicament">
                </div>
            </td>

            <td style="width: 1%;"> </td>
            <td style="width: 12%;">
                <input type="text" class="form-control col-10 col-lg-10" placeholder="D traitement 1" id="dateOrd1">
            </td>

            <td style="width: 1%;">à </td>
            <td style="width: 12%;">
                <input type="text" placeholder="D traitement 2" class="form-control col-9 col-lg-9" id="dateOrd2">
            </td>
            <td style="width: 10%;"><button class="btn btn-primay" onclick="functionRechercheMOrd();">Recherche</button> </td>

        </tr>
    </table>
</center>





<div class="modal fade" id="ordonnancesP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Gestion des ordonnances</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>



<!-- §§§§§§§§§§§§§§§§§§ inmression des ordonnaces !-->
<div class="modal fade" id="ordonnancesImp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Imrission des ordonnances
                    <a href="#" onclick="functionPrint();" style="margin-left: 30px;" title="Imprimer">
                        <i class="fas fa-print fa-lg " style="color: blue;"></i></a>
                </h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>

<div id="AffichOrd">
    <?php include "afficheOrdonnace.php"; ?>

</div>




<script>
    $("#dateOrd1").datepicker();
    $("#dateOrd2").datepicker();


    function functionRechercheMOrd() {
        dateOrd1 = $("#dateOrd1").val();
        dateOrd2 = $("#dateOrd2").val();
        TypeConsl = $("#TypeConsl1").val();

        $("#AffichOrd").load("ordonnance/afficheOrdonnace.php?dateOrd1=" + dateOrd1 + "&dateOrd2=" + dateOrd2 + "&TypeConsl=" + TypeConsl);
    }


    $('#RechercheCinOrd').keypress(function(e) {

        var key = e.which;
        if (key == 13) // the enter key code
        {


            Cin_Ord = $("#RechercheCinOrd").val();
            $("#AffichOrd").load("ordonnance/afficheOrdonnace.php?Cin_Ord=" + Cin_Ord);

        }
    });

    $('#RechercheOrdoM').keypress(function(e) {

        var key = e.which;
        if (key == 13) // the enter key code
        {


            MediOrd = $("#RechercheOrdoM").val();
            $("#AffichOrd").load("ordonnance/afficheOrdonnace.php?MediOrd=" + MediOrd);

        }
    });
</script>