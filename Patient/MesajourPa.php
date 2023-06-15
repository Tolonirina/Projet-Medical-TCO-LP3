<?php 
include "../connexion.php";
$date1 = strtr($_POST['DateNaissance'], '/', '-');
$dateN=	date('Y/m/d',strtotime($date1));
if($_POST['type']=='Insert')
{
	
 $queryP="INSERT INTO patient 


(CIN,
Nom_Pat,
Prenom_Pat,
DateNaissance,
Telephone,
Adresse,
Email,

Sexe,
DateCreation)



 VALUES (
'".str_replace("'","`",$_POST['CIN'])."',
'".str_replace("'","`",$_POST['NomP'])."',
'".str_replace("'","`",$_POST['PrenomPa'])."',
'".$dateN."',
'".str_replace("'","`",$_POST['telephone'])."',
'".str_replace("'","`",$_POST['Adreese'])."',
'".str_replace("'","`",$_POST['Email'])."',
'".str_replace("'","`",$_POST['SexeP'])."',
'getdate()'

)";
}

else if($_POST['type']=='Delete')
{
	 $queryP="delete  from  patient  where Id_pat=".$_POST['idPas']."";
}


else if($_POST['type']=='update')
{
	
	$queryP="update patient set 

CIN='".str_replace("'","`",$_POST['CIN'])."',
Nom_Pat='".str_replace("'","`",$_POST['NomP'])."',
Prenom_Pat='".str_replace("'","`",$_POST['PrenomPa'])."',
DateNaissance='".$dateN."',
Telephone='".str_replace("'","`",$_POST['telephone'])."',
Adresse='".str_replace("'","`",$_POST['Adreese'])."',
Email='".str_replace("'","`",$_POST['Email'])."',
Sexe='".str_replace("'","`",$_POST['SexeP'])."'
where Id_pat=".$_POST['idPas']."	";



}


echo $dateN;
echo $queryP;


mysqli_query($con,$queryP);
