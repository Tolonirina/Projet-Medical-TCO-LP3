<?php 
include "../connexion.php";




if(trim($_POST['type'])=="Insert")
{



 $queryACC="INSERT INTO users 


(
UserName,
Password,
Specialite,
FonctionL,
dateCreation
)



 VALUES (
'".str_replace("'","`",$_POST['Utilisateur'])."',
'".str_replace("'","`",$_POST['Password'])."',
'".str_replace(",",".",$_POST['Specialite'])."',
'".str_replace("'","`",$_POST['FonctionM'])."',
'getdate()'



)";
}




else if($_POST['type']=='Delete')
{
	 $queryACC="delete  from  users  where Id_user=".$_POST['Id_user']."";
}


else if($_POST['type']=='update')
{

	$queryACC="update users set 

UserName='".str_replace("'","`",$_POST['Utilisateur'])."',
Specialite='".str_replace("'","`",$_POST['Specialite'])."',
FonctionL='".str_replace(",",".",$_POST['FonctionM'])."'
where Id_user=".$_POST['Id_user']."	";



}

else if($_POST['type']=='UpdateM')
{

	$queryACC="update users set 

Password='".str_replace("'","`",$_POST['Password'])."'

where Id_user=".$_POST['id_user']."	";
echo '
<center>
<div id="passds"  style="color: green;font-size: 1em;font-weight: bold;">Votre mot de passe à bien modifier</div>      
</center>';
}



mysqli_query($con,$queryACC);
