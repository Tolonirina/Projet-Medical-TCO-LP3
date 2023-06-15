<center>
    <table style="width: 90%">
        <tr>
            <td style="width: 16%;">
                <div id="custom-search" class="top-search-bar">
                    <input id="CinNPaiment" style="margin-bottom: 4%;" class="form-control" type="text" placeholder="Cin">
                </div>

            </td>
            <td style="width: 1%;"> </td>
            <td style="width: 12%;">
                <input type="text" class="form-control col-10 col-lg-10 dateP" placeholder="date 1" id="dateNPai1">
            </td>

            <td style="width: 1%;">à </td>
            <td style="width: 12%;">
                <input type="text" placeholder="date 2" class="form-control col-9 col-lg-9 dateP" id="dateNPai2">
            </td>
            <td style="width: 10%;"><button class="btn btn-primay" onclick="functionRecherchNPaimei();">Recherche</button> </td>
        </tr>
    </table>
    <hr>


</center>

<div class="modal fade" id="Npaiment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nouveau Paiment </h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>


<div id="AffichNpaiment">
    <?php include "affichageNpaiment.php"; ?>

</div>





<script>
    $(".dateP").datepicker();


    function functionRecherchNPaimei() {
        CinNPa = $("#CinNPaiment").val();
        date1 = $("#dateNPai1").val();

        date2 = $("#dateNPai2").val();
        $("#AffichNpaiment").load("Npaiment/affichageNpaiment.php?CinNPa=" + CinNPa + "&date1=" + date1 + "&date2=" + date2);
    }


    $('#CinNPaiment').keypress(function(e) {
        var key = e.which;
        if (key == 13) // the enter key code
        {

            CinNPa = $("#CinNPaiment").val();
            $("#AffichNpaiment").load("Npaiment/affichageNpaiment.php?CinNPa=" + CinNPa);
        }
    });
</script>