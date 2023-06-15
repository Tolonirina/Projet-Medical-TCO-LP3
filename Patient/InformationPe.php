<center>
  <table style="width: 70%">
    <tr>
      <td style="width: 30%;">
        <div id="custom-search" class="top-search-bar">
          <input id="Recherche" style="margin-bottom: 4%;" class="form-control" type="text" placeholder="Recherche Par CIN">
        </div>

      </td>

      <td style="width: 34%;">
        <div id="custom-search" class="top-search-bar">
          <input id="Recherchenom" style="margin-bottom: 4%;" class="form-control" type="text" placeholder="Recherche Par Nom">
        </div>

      </td>

      <td> <a href="#" class="btn btn-primary col-lg-3" data-toggle="modal" title="Ajouter de patient" onclick="funtionGetAddModel()">

          <i class="fas fa-plus"></i>
        </a> </td>
    </tr>
  </table>
  <hr>


</center>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Information Personnelle de Patient </h5>
        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>
      </div>
      <div class="modal-body">

      </div>
    </div>
  </div>
</div>


<div id="AffichP">
  <?php include "affichage.php"; ?>

</div>





<script>
  $('#Recherche').keypress(function(e) {
    var key = e.which;
    if (key == 13) // the enter key code
    {

      CIN = $("#Recherche").val();
      $("#AffichP").load("Patient/affichage.php?CIN=" + CIN);
    }
  });

  $('#Recherchenom').keypress(function(e) {
    var key = e.which;
    if (key == 13) // the enter key code
    {

      Nom = $("#Recherchenom").val();
      $("#AffichP").load("Patient/affichage.php?Nom=" + Nom);
    }
  });




  function funtionGetAddModel() {
    $.ajax({
      type: "POST",
      url: "Patient/Addpat.php",

      success: function(result) {
        $('.modal-body').html(result);
        $('#exampleModal').modal('show');

      }
    });
  }
</script>