<?php 
include "../connexion.php";



$heure=gmdate('Y-m-d H:i \G\M\T');
$date1 = strtr($_POST['dateCons'], '/', '-');
$dateC=	date('Y/m/d',strtotime($date1));

if(trim($_POST['type'])=="Insert")
{



 $queryC="INSERT INTO consultation 


(
Id_Pat,
Date_Cons,
Type_Cons,
poids,
Prix,
Observation,
Heure
)



 VALUES (
'".str_replace("'","`",$_POST['Id_Pat'])."',
'".$dateC."',
'".str_replace("'","`",$_POST['operation'])."',
'".str_replace("'","`",$_POST['Poids'])."',
'".str_replace(",",".",$_POST['Prix'])."',
'".str_replace("'","`",$_POST['ObservationCons'])."',
'".$heure."'


)";
}




else if($_POST['type']=='Delete')
{
	 $queryC="delete  from  consultation  where Id_con=".$_POST['Id_con']."";
}


else if($_POST['type']=='update')
{

	$queryC="update consultation set 

Date_Cons='".$dateC."',
poids='".str_replace("'","`",$_POST['Poids'])."',
Prix='".str_replace(",",".",$_POST['Prix'])."',
Observation='".str_replace("'","`",$_POST['ObservationCons'])."',
Type_Cons='".str_replace("'","`",$_POST['operation'])."'

where Id_con=".$_POST['Id_con']."	";



}




mysqli_query($con,$queryC);
