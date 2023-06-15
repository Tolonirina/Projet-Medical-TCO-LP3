<?php session_start();
if($_SESSION['id_user']) { ?>
<div class="dashboard-main-wrapper">
<?php $link="http://localhost/Cabinet?dmnd=" ;?>
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="#">Dr <?php echo $_SESSION['Username'];?> 
                : <?php echo $_SESSION['Specialite'];?> </a>
               
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                    	   <li class="nav-item">
                            <div id="custom-search" class="top-search-bar">
                               
                            </div>
                      		  </li>
                 

                        

                           
                        <li class="nav-item dropdown notification">
                            <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-bell"></i> <span class="indicator"></span></a>
         
                        </li>
                     
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="<?php echo $link; ?>" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../assets/images/avatar-1.jpg" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name">User name </h5>
                                   
                                </div>
                             
                                <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Setting</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-power-off mr-2"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                               <b style="color: white"> Nom Cabinet 
                               	 <a title="Username-less login" class="modalC"  href="AjouterPatient.php" >
                          
	                          	</a>
                               </b>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link active"  href="<?php echo $link;?>" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fa fa-fw fa-user-circle"></i>Dossiers médicaux des patients </a>
                                <div id="submenu-1" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                  
                                        <li class="nav-item">
                                            <a class="nav-link"  href="<?php echo $link;?>getPatient">Patient</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo $link;?>getHistoPat">Historique </a>
                                        </li>                                 

                                                              
                                      
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  data-toggle="collapse"  
                                href="<?php echo $link;?>"
                                aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fa fa-fw fa-rocket"></i> Consultations &
                             Contrôle </a>
                            
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" href="<?php echo $link; ?>"  data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-fw fa-chart-pie"></i>Statistiques </a>
                                <div id="submenu-3" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                         

                                    </ul>
                                </div>
                            </li>
                        
                            <li class="nav-divider">
                               <!-- Features-->
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo $link;?>"  data-toggle="collapse" aria-expanded="false" data-target="#submenu-6" aria-controls="submenu-6"><i class="fas fa-fw fa-file"></i> Ordonnances</a>
                              
                            </li>
                         
                         
                            <li class="nav-item">
                                <a class="nav-link" href="#"  ><i class="fas fa-fw fa-map-marker-alt" ></i> Rendez vous</a>
                            
                            </li>
                            <li class="nav-item" >
                                <a class="nav-link" href="#" href="<?php echo $link; ?>"  data-toggle="collapse" aria-expanded="false" data-target="#submenu-10" aria-controls="submenu-10"><i class="fas fa-f fa-folder" id="Convocation"></i> droits d’accès </a>
                         
                            </li>

                             <li class="nav-item">
                             <a class="nav-link" href="<?php echo $link;?>">
                                <i class="fas fa-f fa-folder" id="Convocation"></i> Médicaments</a>
                             </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-10" aria-controls="submenu-10"><i class="fas fa-f fa-folder" id="Convocation"></i>Sauvegarde 
                                 vos données</a>
                         
                            </li>                            
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
       
        <div id='calendar' style="width: 100%;"></div>
    <div id="event_edit_container" >
        <form>
         
            <ul>
            	<li> CIN :  <input style="width: 40" type="text"  name="CINR" id="CinRe" placeholder="CIN" ></li>
            	<li> Nom :  <input type="text" id="NomInfo" name="NOMR" placeholder="Nom" disabled="disabled"></li>
            	<li> Prénom :  <input type="text" name="PRENOMR" id="PrenomInfo"  placeholder="Prénom" disabled="disabled"></li>
                <li><span>Date: </span><span id="StartDate" class="date_holder"></span></li>
                <li><label for="start">de : </label><select style="width: 30%;" name="start" id="StartIme" disabled="disabled"></select>

                <label for="end">à : </label><select style="width: 30%;"  disabled="disabled" id="EndTime" name="end"></select>
                <li><label for="title">Titre : </label><input type="text" id="titleR" name="title" maxlength="60"/></li>
                <li><label for="body">Observation : </label><textarea id="ObservationRendez" class="form-control" name="body"></textarea></li>
            </ul>
            <input type="hidden" id="Id_paSRen" >
            <input type="hidden" id="id_Red" >
        </form>
    </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <div class="footer" style="position: fixed;bottom: 0;text-align: center; opacity: 0.5">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        </div>
            
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>


    <script type="text/javascript">
    	


	$('#CinRe').keypress(function (e) {
 var key = e.which;
 if(key == 13)  // the enter key code
  {


		CinRe=$("#CinRe").val();
	
		$.ajax({
        type: "POST",
        url: "AfficheInforPer.php",
        data: {CinRe:CinRe},
        success: function(result) { 
        	var data = $.parseJSON(result);	
        	$("#Id_paSRen").val(data['Id_Pat']);
        	$("#NomInfo").val(data['Nom_Pat']);
        	$("#PrenomInfo").val(data['Prenom_Pat']);
num=1;
 dataId= +data['Id_Rend'] + +num;
        	 $("#id_Red").val(dataId);


        }

        	  });
        
    }

}); 

	

	

    </script>

   <?php }
   

else {
    header('Location: /Cabinet/Authentification.php'); 
}

     ?>
