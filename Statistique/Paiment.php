
<center>
<table  style="width: 84%;" > 
<tr> 



 <td style="width: 1%;"> </td>
<td style="width: 10%"> 

<select id="sexViste3" class="form-control"> 
<option value="">Paiment</option>
<option value="<">Avance < total</option>
<option value="=">Avance = total </option>
</select>

</td>

 <td style="width: 1%;"> </td>
<td style="width: 12%;">
	<input type="text" class="form-control col-10 col-lg-10 dateRe2" placeholder="date 1" id="datePai1"> </td>

 <td style="width: 1%;">à </td>
  <td style="width: 12%;">
 <input type="text" placeholder="date 2" class="form-control dateRe2  col-9 col-lg-9" id="dataPai2">
 </td>
<td style="width: 10%;"><button class="btn btn-primay" onclick="functionGetPimentT();">Recherche</button> </td>

 </tr> 
</table>
</center>



<script type="text/javascript">
	
	$(".dateRe2").datepicker();

function functionGetPimentT()
	{
		TypeConslViste=$("#TypeConslViste").val();
sexViste=$("#sexViste3").val();
dateSV1=$("#dateViRe1").val();
dateSV2=$("#dateViRe2").val();

$("#NombreDvistePaApo").load("Statistique/StatAppointement.php?TypeConslViste="+TypeConslViste+"&sexViste="+sexViste+"&dateSV1="+dateSV1+"&dateSV2="+dateSV2); 
	}

</script>