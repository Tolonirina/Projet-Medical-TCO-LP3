<!DOCTYPE html>
<html>
<head>
	<title></title>
	

	<meta charset="utf-8">

<style type="text/css">

@media print {

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
$querypai="select patient.CIN,patient.Nom_Pat,TIME_FORMAT(Heur_P, '%H:%i')as Heur_P,patient.Prenom_Pat,patient.Id_pat,npaiment.Id_Np,npaiment.Titre,paiment.MAvance,DATE_FORMAT(Date_crea, '%d/%m/%Y') as dateNpai,paiment.Id_Pai,
npaiment.NMonatant,paiment.Obervation,DATE_FORMAT(DateNaissance, '%d/%m/%Y') as dateN,
DATE_FORMAT(paiment.Date_Pai, '%d/%m/%Y') as Date_Pai,paiment.Id_Pai,
(select count(paiment.Id_Pai)  from npaiment 
 inner join patient on  patient.Id_pat=npaiment.Id_Pats
inner join  paiment on paiment.id_NP=npaiment.Id_Np ) as count 
from npaiment
inner join patient on  patient.Id_pat=npaiment.Id_Pats
inner join  paiment on paiment.id_NP=npaiment.Id_Np 
where npaiment.Id_Np =".$_GET['Id_Np']." order by paiment.Date_Pai ,paiment.Id_Pai
  ";

$resultPai=mysqli_query($con,$querypai);  
$rowPai = $resultPai->fetch_assoc();
  ?>
<body>


<div id="ImrissionEta"  class="sheet padding-10mm A5" >
<b><u> Patient : </u> </b><br/>
<table style="margin-left: 10%; font-family: Times New Roman, Times, serif">

  <tr><td><b>Nom </b></td>
  	<td>&nbsp;&nbsp;&nbsp;</td>
  	<td>: <?php echo str_replace("`", "'", $rowPai['Nom_Pat']) ;?></td><tr/>
 <tr> <td><b>Prénom </b></td>
 	<td>&nbsp;&nbsp;&nbsp;</td>
 	<td>: <?php echo str_replace("`", "'", $rowPai['Prenom_Pat']) ;?></td><tr/>
  <tr><td><b>Date de naissance </b></td>
  	<td>&nbsp;&nbsp;&nbsp;</td>
  	<td>: <?php echo str_replace("`", "'", $rowPai['dateN']) ;?></td><tr/>
</table>

<hr/>
<br/>
<b> Facture  :</b> <?php echo str_replace("`", "'", $rowPai['Titre']) ;?>  <b> de </b>:
<?php echo str_replace("`", "'", $rowPai['dateNpai']) ;?>  




<table border="1" cellspacing="0" style="width: 100%;text-align: center;">
	<tr>
<th >  Total  </th>
<th> Avance  </th>
<th> Date   </th>
<th> Heure  </th>
<th> le reste  </th>
	</tr>	

<?php 
$i=0;

$rest =0;

$resultPai2=mysqli_query($con,$querypai);  
while($rowPai2 = $resultPai2->fetch_assoc())
{
$rest+=$rowPai2['MAvance']; // pour calculer la somme d'avance ;
}

$resultPai1=mysqli_query($con,$querypai);  
while($rowPai1 = $resultPai1->fetch_assoc())
{
$i++;
?>
<tr>
	<?php if($i==1){?>
<td class="tableZ" rowspan="<?php echo $rowPai['count']; ?>">
	<?php echo str_replace("`", "'", $rowPai['NMonatant'])." Dhs" ;?>
</td>
<?php } ?>
<td class="tableZ"><?php echo str_replace("`", "'", $rowPai1['MAvance'])." Dhs" ;?>  </td>
<td class="tableZ"><?php echo str_replace("`", "'", $rowPai1['Date_Pai']) ;?>  </td>
<td class="tableZ"><?php echo str_replace("`", "'", $rowPai1['Heur_P']) ;?>  </td>


 
<?php if($i==1) {?>

<td class="tableZ" rowspan="<?php echo $rowPai['count']; ?>"> 
<?php echo $rowPai['NMonatant']-$rest." Dhs" ;?>
 </td>
<?php } ?>

 
	</tr>
<?php 



}
?>


</table>

<center>
	<br/><br/>
<b id="dateF" style="margin-left: 3cm;"> Fait le : <?php echo date("d-M-Y") ;?>  </b>
</center>

</div>



</body>

<script type="text/javascript">
	
	print();
	close();

</script>
</html>