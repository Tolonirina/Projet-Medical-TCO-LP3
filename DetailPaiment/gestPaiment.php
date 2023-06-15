<?php 
include "../connexion.php";



$heure=date('H:i');
$datePai = date("Y/m/d");


if(trim($_POST['type'])=="Insert")
{



 $queryPai="INSERT INTO paiment 


(
id_NP,
Date_Pai,
Heur_P,
MAvance,
Obervation

)



 VALUES (
'".str_replace("'","`",$_POST['id_NP'])."',
'".$datePai."',
'".$heure."',
 '".str_replace("'","`",$_POST['AvancePai'])."',
'".str_replace(",",".",$_POST['ObservationPai'])."'




)";
}




else if($_POST['type']=='Delete')
{
	 $queryPai="delete  from  paiment  where Id_Pai=".$_POST['Id_Pai']."";
}


else if($_POST['type']=='update')
{

	$queryPai="update paiment set 


MAvance='".str_replace("'","`",$_POST['AvancePai'])."',
Obervation='".str_replace(",",".",$_POST['ObservationPai'])."'
where Id_Pai=".$_POST['Id_Pai']."	";

}




mysqli_query($con,$queryPai);
