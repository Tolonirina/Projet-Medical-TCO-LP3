
<?php 
include "../connexion.php";
$queryCOI=" SELECT Id_Rend,CIN,patient.Nom_Pat,patient.Prenom_Pat,patient.Id_Pat FROM `patient` 
left join rendezvous on rendezvous.Id_Pat=patient.Id_Pat
where CIN ='".trim($_POST['CinRe'])."' ORDER by Id_Rend desc limit 0,1
  ";

$resultConi=mysqli_query($con,$queryCOI);
$rowCCon = $resultConi->fetch_assoc();

 echo json_encode($rowCCon);
  ?>