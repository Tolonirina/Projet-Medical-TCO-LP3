<?php 
include "../connexion.php";
$dateN=date("Y/m/d");
$data="";
if(isset($_POST['data']))
{
	$data=$_POST['data'];
}





if($_POST['type']=='Insert')
{
 $queryan="INSERT INTO analyse 


(
Id_Pas,
Observation,
FaieLe
)

 VALUES (
'".str_replace("'","`",$_POST['Id_pat'])."',
'".str_replace("'","`",$_POST['Observation'])."',
'".$dateN."'

)";
mysqli_query($con,$queryan);

$querSelect="select max(Id_ana) as max from analyse where Id_Pas =".$_POST['Id_pat']."";
$resulSel=mysqli_query($con,$querSelect);
$rowMax = $resulSel->fetch_assoc();

for($i=0;$i<count($data);$i++)
{
$queryInser="insert into analyseparamtre (
Id_ana,
Id_Para
)
VALUES
(
".$rowMax['max'].",
".$data[$i]."
)
";

mysqli_query($con,$queryInser);



}


}

if($_POST['type']=='update')
		{
			$queryDe="delete from analyseparamtre   where Id_ana =".$_POST['Id_ana']."";
			mysqli_query($con,$queryDe);

echo $queryDe;
		for($i=0;$i<count($data);$i++)
{
$queryInser="insert into analyseparamtre (
Id_ana,
Id_Para
)
VALUES
(
".$_POST['Id_ana'].",
".$data[$i]."
)
";

mysqli_query($con,$queryInser);
echo $queryInser;
}

$queryUp="update analyse set 
Observation ='".str_replace("'","`",$_POST['Observation'])."'
where Id_ana =".$_POST['Id_ana']."

";
	mysqli_query($con,$queryUp);	

	echo $queryUp;	

}




if($_POST['type']=='Delete')
{
	$queryDe="delete from analyse   where Id_ana =".$_POST['Id_ana']."";
mysqli_query($con,$queryDe);

$queryDe="delete from analyseparamtre   where Id_ana =".$_POST['Id_ana']."";
mysqli_query($con,$queryDe);
}
