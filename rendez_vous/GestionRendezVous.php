<?php 

include "../connexion.php";

$date=date("Y/m/d");

$heure=gmdate('Y-m-d H:i \G\M\T');


if(trim($_POST['type'])=="Insert")
{

$date1 = strtr($_POST['StartDate'], '/', '-');
$dateRend=	date('Y/m/d',strtotime($date1));

 $queryC="INSERT INTO rendezvous 

(
Id_Pat,
DateRend,
StartH,
EndH,
TitreRe,
ObservationRend,
StartTime,
EndTime,
DateIns
)


 VALUES (
'".str_replace("'","`",$_POST['Id_Pat'])."',
'".$dateRend."',
'".str_replace("'","`",$_POST['StartIme'])."',
'".str_replace("'","`",$_POST['EndTime'])."',
'".str_replace(",",".",$_POST['title'])."',
'".str_replace("'","`",$_POST['observation'])."',
'".str_replace("'","`",$_POST['StartTime'])."',
'".str_replace("'","`",$_POST['EndTime1'])."',
'".$date."'

)";
}




else if($_POST['type']=='Delete')
{
	 $queryC="delete  from  rendezvous  where Id_Rend=".$_POST['Id_Rend']."";
}


else if($_POST['type']=='Update')
{

	$queryC="update rendezvous set 


TitreRe='".str_replace("'","`",$_POST['title'])."',
ObservationRend='".str_replace(",",".",$_POST['observation'])."'


where Id_Rend=".$_POST['Id_Rend']."	";



}



echo $queryC;
mysqli_query($con,$queryC);






?>