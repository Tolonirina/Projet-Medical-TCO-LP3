<!DOCTYPE html>
<head>
<style type="text/css">

@media print {

th{
	height: 50px;
}
#Traiment{
		margin-top: 0cm;
	margin-left: 1.2cm;
	margin-right: 1.2cm;
}
.tableZ{
	height: 30px;
}

#ImrissionEta{
	margin-top: 2.5cm;
	margin-left: 1.2cm;
	margin-right: 1.2cm;
} 

#dateF{
	text-align: center;
	margin-top :1cm;
}

}


th{
	height: 50px;
}
.tableZ{
	height: 30px;
}

#ImrissionEta{
	margin-top: 2.5cm;
	margin-left: 1.2cm;
	margin-right: 1.2cm;
} 

#dateF{
	text-align: center;
	margin-top :1cm;
}
</style>
</head>
<?php 

include "../connexion.php";
$queryAnalyse="select distinct 
patient.Id_pat,patient.CIN,patient.Nom_Pat,patient.Prenom_Pat,analyse.Observation,analyse.FaieLe,analyse.Id_ana,DATE_FORMAT(DateNaissance, '%d/%m/%Y') as dateN
from patient
left join analyse on analyse.Id_Pas=patient.Id_pat
left join analyseparamtre on analyseparamtre.Id_ana=analyse.Id_ana
left join paramanalyse on paramanalyse.id_PAR=analyseparamtre.Id_Para
where analyse.Id_ana=".$_GET['Id_ana']."
";

$resultAna=mysqli_query($con,$queryAnalyse);
$rowPai = $resultAna->fetch_assoc();
?>

	<meta charset="utf-8">

<body>
	<div id="ImrissionEta"  class="sheet padding-10mm A5" >
<b><u> Patient : </u> </b><br/>
<table style="margin-left: 10%; font-family: Times New Roman, Times, serif">

  <tr><td><b>Nom </b></td>
  	<td>&nbsp;&nbsp;&nbsp;</td>
  	<td>: <?php echo str_replace("`", "'", $rowPai['Nom_Pat']) ;?></td>
  </tr>
 <tr> <td><b>Prénom </b></td>
 	<td>&nbsp;&nbsp;&nbsp;</td>
 	<td>: <?php echo str_replace("`", "'", $rowPai['Prenom_Pat']) ;?></td>
 </tr>
  <tr><td><b>Date de naissance </b></td>
  	<td>&nbsp;&nbsp;&nbsp;</td>
  	<td>: <?php echo str_replace("`", "'", $rowPai['dateN']) ;?></td>
  </tr>
</table>

<hr/>
<br/>

<br>
<div id="Traiment">
            <?php 
          $querySelTitre="select distinct paramanalyse.Type ,NomPar,id_PAR from analyseparamtre INNER join paramanalyse on paramanalyse.id_PAR=analyseparamtre.Id_Para
inner join analyse on analyseparamtre.Id_ana=analyse.Id_ana where 1=1
 and  analyseparamtre.Id_ana =".$_GET['Id_ana']."
          ";
          $resultSelTitre=mysqli_query($con,$querySelTitre);
          
          while($rowSeT = $resultSelTitre->fetch_assoc())
          {
          echo " - ".str_replace("`", "'", $rowSeT['NomPar'])."<br/>" ;

             }?>
</div>
</div>
</body>
<script type="text/javascript">
	print();
	close();
</script>
</html>