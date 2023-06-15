<center>
  <table style="width: 70%">
    <tr>
      <td style="width: 30%;">
        <div id="custom-search" class="top-search-bar">
          <input id="RechercheUser" style="margin-bottom: 4%;" class="form-control" type="text" placeholder="Utilisateur">
        </div>

      </td>



      <td> <a href="#" class="btn btn-primary col-lg-3" data-toggle="modal" title="Ajouter de patient" onclick="funtionGetAddDroist()">

          <i class="fas fa-plus"></i>
        </a> </td>
    </tr>
  </table>
  <hr>


</center>

<div class="modal fade" id="DrAccees" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Gestion des droits d'accées </h5>
        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>
      </div>
      <div class="modal-body">

      </div>
    </div>
  </div>
</div>


<div id="AffiAccess">
  <?php include "affiaccess.php"; ?>

</div>





<script>
  $('#RechercheUser').keypress(function(e) {
    var key = e.which;
    if (key == 13)
    {

      username = $("#RechercheUser").val();
      $("#AffiAccess").load("Access/affiaccess.php?username=" + username);
    }
  });




  function funtionGetAddDroist() {
    $.ajax({
      type: "POST",
      url: "Access/Adduser.php",

      success: function(result) {
        $('.modal-body').html(result);
        $('#DrAccees').modal('show');

      }
    });
  }
</script>