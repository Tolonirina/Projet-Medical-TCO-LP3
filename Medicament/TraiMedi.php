<?php 
include "../connexion.php";
$dateN=date("Y/m/d");
if($_POST['type']=='Insert')
{
 $queryP="INSERT INTO medicament 


(
	Nom_Med,
Commentaire,
Date_Ce
)



 VALUES (
'".str_replace("'","`",$_POST['Medicament'])."',
'".str_replace("'","`",$_POST['Commentaire'])."',

'".$dateN."'

)";
}

else if($_POST['type']=='Delete')
{
	 $queryP="delete  from  medicament  where Id_Med=".$_POST['Id_Med']."";
}


else if($_POST['type']=='update')
{
	$queryP="update medicament set 

Nom_Med='".str_replace("'","`",$_POST['Medicament'])."',
Commentaire='".str_replace("'","`",$_POST['Commentaire'])."'

where Id_Med=".$_POST['id_Med']."	";



}




mysqli_query($con,$queryP);
