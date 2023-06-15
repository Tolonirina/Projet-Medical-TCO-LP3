
<center>
<table  style="width: 84%;" > 
<tr> 


<td style="width: 15%;">
  <select class="form-control" id="TypeConslViste">
	<option value="">Type de visite </option>
	<option value="0">Nouvelle consultation</option>
	<option value="1">Contrôle  </option>
</select> </td>
 <td style="width: 1%;"> </td>
<td style="width: 10%"> 

<select id="sexViste" class="form-control"> 
<option value="">Sexe</option>
<option value="M">Masculin</option>
<option value="F">Féminin</option>
</select>

</td>

 <td style="width: 1%;"> </td>
<td style="width: 12%;">
	<input type="text" class="form-control col-10 col-lg-10 dateSV1" placeholder="date 1" id="dateSV1"> </td>

 <td style="width: 1%;">à </td>
  <td style="width: 12%;">
 <input type="text" placeholder="date 2" class="form-control dateSV1  col-9 col-lg-9" id="dateSV2">
 </td>
<td style="width: 10%;"><button class="btn btn-primay" onclick="functionGetNombreDvisite();">Recherche</button> </td>

 </tr> 
</table>
</center>




<div id="NombreDvistePa">
<?php include "AfficheNombreDViste.php";?>
</div>  

<script type="text/javascript">
	
	$(".dateSV1").datepicker();

function functionGetNombreDvisite()	
	{
TypeConslViste=$("#TypeConslViste").val();
sexViste=$("#sexViste").val();
dateSV1=$("#dateSV1").val();
dateSV2=$("#dateSV2").val();

$("#NombreDvistePa").load("Statistique/AfficheNombreDViste.php?TypeConslViste="+TypeConslViste+"&sexViste="+sexViste+"&dateSV1="+dateSV1+"&dateSV2="+dateSV2); 


	}

</script>