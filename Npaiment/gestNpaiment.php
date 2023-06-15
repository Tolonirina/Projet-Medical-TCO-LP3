<?php 
include "../connexion.php";
$dateN=date("Y/m/d");
if($_POST['type']=='Insert')
{
 $queryNP="INSERT INTO NPaiment 


(
Id_Pats,
NMonatant,
Titre,

Observation,
Date_crea
)




 VALUES (
'".str_replace("'","`",$_POST['Id_Pat'])."',
'".str_replace("'","`",$_POST['NMontantTo'])."',
'".str_replace("'","`",$_POST['NTitre'])."',
'".str_replace("'","`",$_POST['observation'])."',
'".$dateN."'

)";
}

else if($_POST['type']=='Delete')
{
	 $queryNP="delete  from  NPaiment  where Id_Np=".$_POST['Id_Np']."";
}


else if($_POST['type']=='update')
{
	$queryNP="update NPaiment set 

NMonatant='".str_replace("'","`",$_POST['NMontantTo'])."',
Titre='".str_replace("'","`",$_POST['NTitre'])."',
Observation='".str_replace("'","`",$_POST['observation'])."'
where Id_Np=".$_POST['Id_Np']."	";

}



echo $queryNP;
mysqli_query($con,$queryNP);
