<?php 
include "../connexion.php";
$dateN=date("Y/m/d");
if($_POST['type']=='Insert')
{
 $queryPan="INSERT INTO paramanalyse 


(
NomPar,
Type,
Observation,
dateCrea
)



 VALUES (
'".str_replace("'","`",$_POST['TitrePAn'])."',
'".str_replace("'","`",$_POST['TypeAnalyseRad'])."',
'".str_replace("'","`",$_POST['observation'])."',
'".$dateN."'

)";
}

else if($_POST['type']=='Delete')
{
	 $queryPan="delete  from  paramanalyse  where id_PAR=".$_POST['id_PAR']."";
}


else if($_POST['type']=='update')
{
	$queryPan="update paramanalyse set 

NomPar='".str_replace("'","`",$_POST['TitrePAn'])."',
Type='".str_replace("'","`",$_POST['TypeAnalyseRad'])."',
Observation='".str_replace("'","`",$_POST['observation'])."'

where id_PAR=".$_POST['id_PAR']."	";



}



echo $queryPan;
mysqli_query($con,$queryPan);
