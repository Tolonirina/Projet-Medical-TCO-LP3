<?php 
include "../connexion.php";
$heure=date("H:m");
$dateN=date("Y/m/d");
if($_POST['type']=='Insert')
{
 $queryP="INSERT INTO ordonnance 


(
Id_pats,
ListMedicament,
Observation,
Usage1,
date_Odr,

heureOr
)



 VALUES (
'".str_replace("'","`",$_POST['Id_Pat'])."',
'".str_replace("'","`",$_POST['listeMedicament'])."',
'".str_replace("'","`",$_POST['Observation'])."',
'".str_replace("'","`",nl2br($_POST['UsageMe']))."',
'".$dateN."',
'".$heure."'
)";
}

else if($_POST['type']=='Delete')
{
	 $queryP="delete  from  ordonnance  where Id_ord=".$_POST['Id_ord']."";
}


else if($_POST['type']=='update')
{
	$queryP="update ordonnance set 

ListMedicament='".str_replace("'","`",$_POST['listeMedicament'])."',
Observation='".str_replace("'","`",$_POST['Observation'])."',
Usage1='".str_replace("'","`",nl2br($_POST['UsageMe']))."'
where Id_ord=".$_POST['Id_ord']."	";



}



echo $queryP;
mysqli_query($con,$queryP);
