<?php


include "../connexion.php";
$queryOrIm = "  select DISTINCT Usage1, CIN,patient.Nom_Pat,patient.Prenom_Pat,ordonnance.Observation, `Id_ord`,patient.Id_pat,ListMedicament,DATE_FORMAT(DateNaissance, '%d/%m/%Y') as dateN from consultation
left join patient on patient.Id_pat=consultation.Id_Pat
left join ordonnance on ordonnance.Id_pats=patient.Id_pat
 where Id_ord=" . $_GET['Id_ord'] . "
  ";
$resultOrIm = mysqli_query($con, $queryOrIm);
$rowOrIm = $resultOrIm->fetch_assoc();
$Traitement = str_replace(",", "<br/>", $rowOrIm['ListMedicament']);

?>




<meta charset="utf-8">


<style type="text/css">
  @page {
    size: A5
  }

  @media print {

    #tabInfo {
      margin-left: 2cm;
    }

    th {
      height: 50px;
    }

    .tableZ {
      height: 30px;
    }

    .Infos {
      font-weight: bold;

    }

    #ImrissionEta {
      margin-top: 2.5cm;
      margin-left: 1.2cm;
      margin-right: 1.2cm;
    }

    #dateF {
      text-align: center;
      margin-left: 5cm;
    }

  }


  th {
    height: 50px;
  }

  .tableZ {
    height: 30px;
  }

  #ImrissionEta {
    margin-top: 2.5cm;
    margin-left: 1.2cm;
    margin-right: 1.2cm;
  }

  .Infos {
    font-weight: bold;

  }

  #dateF {
    text-align: center;
    margin-left: 5cm;
  }
</style>

<div id="ImrissionEta" class="sheet padding-10mm A5">

  <b><u>Patient :</u> </b>
  <table style="margin-left: 2cm;" id="tabInfo">
    <tr>

    </tr>
    <tr>
      <td class="Infos">Nom </td>
      <td>&nbsp;&nbsp;&nbsp;</td>
      <td>:<?php echo str_replace("`", "'", $rowOrIm['Nom_Pat']); ?></td>
    </tr>
    <tr>
      <td class="Infos">Prénom </td>
      <td>&nbsp;&nbsp;&nbsp;</td>
      <td>:<?php echo str_replace("`", "'", $rowOrIm['Prenom_Pat']); ?></td>
    </tr>
    <tr>
      <td class="Infos">Date Naissance </td>&nbsp;&nbsp;&nbsp;<td></td>
      <td>: <?php echo str_replace("`", "'", $rowOrIm['dateN']); ?></td>
    </tr>
  </table>

  <hr />

  <b><u>Traitement :</u></b>

  <table border="1" cellspacing="0" style="width: 100%;text-align: center;">
    <tr>
      <th> Médicament </th>


      <th> Usage </th>
    </tr>
    <tr>
      <td class="tableZ"><?php echo str_replace("`", "'", $Traitement); ?> </td>


      <td class="tableZ"><?php echo str_replace("`", "'", $rowOrIm['Usage1']); ?> </td>
    </tr>

  </table>
  <br>
  <center>
    <b id="dateF"> Fais le : <?php echo date("d-M-Y"); ?> </b>
  </center>
</div>



<script type="text/javascript">
  print();
  close();
</script>