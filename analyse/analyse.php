<?php session_start();
$_SESSION['Id_pat'] = "";
?>
<center>
    <table style="width: 70%">
        <tr>
            <td style="width: 30%;">
                <div id="custom-search" class="top-search-bar">
                    <input id="ParaNaRadion" style="margin-bottom: 4%;" class="form-control" type="text" placeholder="Recherche  ..">
                </div>

            </td>
            <td style="width: 30%;">
                <select class="form-control" id="TypeAnalyseRadR" onchange="functionGetRech();">
                    <option value=""> le type </option>
                    <option value="Analyse">Analyse</option>
                    <option value="Radiologique">Radiologique</option>

                </select>

            </td>


            <td> <a href="#" title="Ajouter un médicament" class="btn btn-primary col-lg-3" data-toggle="modal" onclick="funtionAddParAnalyse()">
                    <i class="fas fa-plus"></i>

                </a> </td>
        </tr>
    </table>
    <hr>

    <style type="text/css">
        .modal-ku {
            width: 750px;
            margin: auto;
        }
    </style>
</center>

<div class="modal fade" id="Analysepop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Gestion des analyses et radiologique de patient </h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="Analysepop1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Gestion des analyses et radiologique de patient</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>


<div id="Affichanalyse">
    <?php include "affichageanalyse.php"; ?>

</div>





<script>
    function functionGetRech(type) {


        TypeAnalyseRadR = $("#TypeAnalyseRadR").val();
        $("#AffichPAR").load("panalyseRad/affichagePA.php?TypeAnalyseRadR=" + TypeAnalyseRadR);

    }


    $('#ParaNaRadion').keypress(function(e) {
        var key = e.which;
        if (key == 13) // the enter key code
        {

            ParaNaRadion = $("#ParaNaRadion").val();
            $("#AffichPAR").load("panalyseRad/affichagePA.php?ParaNaRadion=" + ParaNaRadion);
        }
    });

    function funtionAddParAnalyse() {
        $.ajax({
            type: "POST",
            url: "panalyseRad/AddPAnalyse.php",

            success: function(result) {
                $('.modal-body').html(result);
                $('#ParaANaRadion').modal('show');

            }
        });
    }
</script>