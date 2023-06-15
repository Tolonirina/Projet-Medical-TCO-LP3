<script>
	<?php include "../connexion.php"; ?>
$(document).ready(function() {

   var $eventcalendarcfc = "EventCalendar.cfc";
   var $calendar = $('#calendar');
   var id = 10;



	function formatCFDate(curDate){
      
		var curDate = new Date(curDate);
		var curYear = curDate.getFullYear();
		var curMonth = curDate.getMonth();
		curMonth++;
		var curDay = curDate.getDate();
		var curHour = curDate.getHours();
		var curMin = curDate.getMinutes();

	
		return curYear + "-" + curMonth + "-" + curDay + " " + curHour + ":" + curMin;
	}

//Read http://www.redredred.com.au/projects/jquery-week-calendar/ to understand these settings
   $calendar.weekCalendar({
      timeslotsPerHour : 6, // pour diviser les cellulle 
      allowCalEventOverlap : true,
      overlapEventsSeparate: true,
      firstDayOfWeek : 1,
      businessHours :{start: 8, end: 21, limitDisplay: true },
      daysToShow : 6,
      height : function($calendar) {
         return $(window).height() - $("h1").outerHeight() - 1;
      },
      eventRender : function(calEvent, $event) {
         if (calEvent.end.getTime() < new Date().getTime()) {
            $event.css("backgroundColor", "#aaa");



            $event.find(".wc-time").css({
               "backgroundColor" : "#999",
               "border" : "1px solid #888"
            });
         }
      },
      draggable : function(calEvent, $event) {
         return calEvent.readOnly != true;
      },
      resizable : function(calEvent, $event) {
         return calEvent.readOnly != true;
      },
      eventNew : function(calEvent, $event) {



         var $dialogContent = $("#event_edit_container");
         resetForm($dialogContent);
         var startField = $dialogContent.find("select[name='start']").val(calEvent.start);
         var endField = $dialogContent.find("select[name='end']").val(calEvent.end);
         var titleField = $dialogContent.find("input[name='title']");
         var bodyField = $dialogContent.find("textarea[name='body']");

         var CINField = $dialogContent.find("input[name='CINR']");
         var NOMField = $dialogContent.find("input[name='NOMR']");
         var PrenomField = $dialogContent.find("input[name='PRENOMR']");


         $dialogContent.dialog({
            modal: true,
            title: "Gestion de rendez-vous",
            close: function() {
               $dialogContent.dialog("destroy");
               $dialogContent.hide();
               $('#calendar').weekCalendar("removeUnsavedEvents");
            },




            buttons: {
               save : function() {

               	//save button clicked on a new event
                  calEvent.id = $("#id_Red").val();

                  calEvent.start = new Date(formatCFDate(startField.val()));
                  calEvent.end = new Date(formatCFDate(endField.val()));
                  calEvent.title = $("#titleR").val();
                  calEvent.body = $("#ObservationRendez").val();	


                  $calendar.weekCalendar("removeUnsavedEvents");
                  $calendar.weekCalendar("updateEvent", calEvent);
                  $dialogContent.dialog("close");
              // });
            Id_Pat=$("#Id_paSRen").val();
            title=$("#titleR").val();
            observation=$("#ObservationRendez").val();
StartDate=$("#StartDate").text();
StartIme=$("#StartIme option:selected").text();
EndTime=$("#EndTime option:selected").text();



            type="Insert";
      $.ajax({
        type: "POST",
        url: "GestionRendezVous.php",
        data: {StartTime:calEvent.start,EndTime1:calEvent.end,Id_Pat:Id_Pat,title:title,observation:observation,type:type,
         StartDate:StartDate,StartIme:StartIme,EndTime:EndTime},
        success: function(result) {
     

        }
    });


               },
               cancel : function() {
                  $dialogContent.dialog("close");
               }
            }
         }).show();

         $dialogContent.find(".date_holder").text($calendar.weekCalendar("formatDate", calEvent.start));
         setupStartAndEndTimeFields(startField, endField, calEvent, $calendar.weekCalendar("getTimeslotTimes", calEvent.start));


      },
      eventDrop : function(calEvent, $event) {
      	//Event was moved and drop into another time slot
         	$.getJSON($eventcalendarcfc+"?method=modifyEvent&returnFormat=json", {id: calEvent.id, title: calEvent.title,body: calEvent.body,starttime: formatCFDate(calEvent.start),endtime: formatCFDate(calEvent.end)},  function(data) {});
      },
      eventResize : function(calEvent, $event) {
      	//Event was resized	
        
      },
      eventClick : function(calEvent, $event) {


         if (calEvent.readOnly) {
            return;
         }




         var $dialogContent = $("#event_edit_container");

         resetForm($dialogContent);
         var startField = $dialogContent.find("select[name='start']").val();
         var endField = $dialogContent.find("select[name='end']").val(calEvent.end);
         var titleField = $dialogContent.find("input[name='title']").val(calEvent.title);
         var bodyField = $dialogContent.find("textarea[name='body']");
         bodyField.val(calEvent.body);

         var CINField = $dialogContent.find("input[name='CINR']").val(calEvent.CIN);
         var NOMField = $dialogContent.find("input[name='NOMR']").val(calEvent.NOM);
         var PrenomField = $dialogContent.find("input[name='PRENOMR']").val(calEvent.Prenom);
         





         $dialogContent.dialog({
            modal: true,
            title: "Modifier - " + calEvent.title,
            close: function() {
               $dialogContent.dialog("destroy");
               $dialogContent.hide();
               $('#calendar').weekCalendar("removeUnsavedEvents");
            },
            buttons: {
               save : function() {
		//saved button click on existing event
            
// pour contenue 
	
                  		calEvent.start = new Date(startField.val());
                  		calEvent.end = new Date(endField.val());

                  		calEvent.title = titleField.val();
                  		calEvent.body = bodyField.val();

      type="Update";
      $.ajax({
        type: "POST",
        url: "GestionRendezVous.php",
        data: {title:titleField.val(),observation:bodyField.val(),type:type,
         Id_Rend:calEvent.id},
        success: function(result) {
     

        }
    });



	                $calendar.weekCalendar("updateEvent", calEvent);
          	       	 $dialogContent.dialog("close");
               		

               },
               "delete" : function() {
               	//delete button clicked

if (confirm("voulez vous vraiment effectuer cette action ?"))
{
     type="Delete";
      $.ajax({
        type: "POST",
        url: "GestionRendezVous.php",
        data: {type:type,
         Id_Rend:calEvent.id},
        success: function(result) {
     
        	  $calendar.weekCalendar("removeEvent", calEvent.id);
          	   $dialogContent.dialog("close");
        }
    });

}
	                
               		
               
               },
               cancel : function() {
                  $dialogContent.dialog("close");
               }
            }
         }).show();

         var startField = $dialogContent.find("select[name='start']").val(calEvent.start);
         var endField = $dialogContent.find("select[name='end']").val(calEvent.end);
         $dialogContent.find(".date_holder").text($calendar.weekCalendar("formatDate", calEvent.start));
    setupStartAndEndTimeFields(startField, endField, calEvent, $calendar.weekCalendar("getTimeslotTimes", calEvent.start));
         $(window).resize().resize(); //fixes a bug in modal overlay size ??

      },
      eventMouseover : function(calEvent, $event) {
      },
      eventMouseout : function(calEvent, $event) {
      },
      noEvents : function() {

      },
//call data from CFC

      data: function(start, end, callback,CIN,NOM,Prenom) {
          
  <?php 

$querS="SELECT CIN,patient.Nom_Pat,patient.Prenom_Pat ,Id_Rend,patient.Id_Pat,TitreRe,ObservationRend,StartTime,EndTime  FROM rendezvous
inner join patient on  rendezvous.Id_Pat=patient.Id_Pat order by Id_Rend asc
";
$resuli=mysqli_query($con,$querS);
$resuli1=mysqli_query($con,$querS);
$rowCOi1=$resuli1->fetch_assoc();

if($rowCOi1['Id_Rend']){
while($rowCOi=$resuli->fetch_assoc())


{
  

  ?>
    
       var eventObj = new Object();
           
		var result = [];

			//for(var i=0;i < data.ROWCOUNT; i++){
				;
			//	if (data.DATA.ID){
					//CF9 returns the JSON slightly differently than older versions of CF
					eventObj.id = '<?php echo $rowCOi['Id_Rend'];?>';			
					eventObj.start = new Date('<?php echo $rowCOi['StartTime'];?>');			
					eventObj.end = new Date('<?php echo $rowCOi['EndTime'];?>');
					eventObj.title = '<?php echo $rowCOi['TitreRe'];?>';			
					eventObj.body = "<?php echo $rowCOi['ObservationRend'];?>";
			
					eventObj.CIN="<?php echo $rowCOi['CIN'];?>";	
					 eventObj.NOM="<?php echo $rowCOi['Nom_Pat'];?>";
        			 eventObj.Prenom="<?php echo $rowCOi['Prenom_Pat'];?>";
        			
					
		

result.push(eventObj); 
callback(result);           
         <?php  } ?>
				
		
     		
 <?php } ?>
      }
   });

   function resetForm($dialogContent) {
      $dialogContent.find("input").val("");
      $dialogContent.find("textarea").val("");
   }


   /*
    * Sets up the start and end time fields in the calendar event
    * form for editing based on the calendar event being edited
    */
   function setupStartAndEndTimeFields($startTimeField, $endTimeField, calEvent, timeslotTimes) {


      for (var i = 0; i < timeslotTimes.length; i++) {
         var startTime = timeslotTimes[i].start;
         var endTime = timeslotTimes[i].end;
         var startSelected = "";
         if (startTime.getTime() === calEvent.start.getTime()) {
            startSelected = "selected=\"selected\"";
         }
         var endSelected = "";
         if (endTime.getTime() === calEvent.end.getTime()) {
            endSelected = "selected=\"selected\"";
         }
           Starthours=timeslotTimes[i].start.getHours()+":"+timeslotTimes[i].start.getMinutes();
           Endhours=timeslotTimes[i].end.getHours()+":"+timeslotTimes[i].end.getMinutes();

         $startTimeField.append("<option value=\"" + startTime + "\" " + startSelected + ">" + Starthours + "</option>");
         $endTimeField.append("<option value=\"" + endTime + "\" " + endSelected + ">" + Endhours + "</option>");

      }
      $endTimeOptions = $endTimeField.find("option");
      $startTimeField.trigger("change");
   }

   var $endTimeField = $("select[name='end']");
   var $endTimeOptions = $endTimeField.find("option");

   //reduces the end time options to be only after the start time options.
   $("select[name='start']").change(function() {
      var startTime = $(this).find(":selected").val();
      var currentEndTime = $endTimeField.find("option:selected").val();
      $endTimeField.html(
            $endTimeOptions.filter(function() {
               return startTime < $(this).val();
            })
            );

      var endTimeSelected = false;
      $endTimeField.find("option").each(function() {
         if ($(this).val() === currentEndTime) {
            $(this).attr("selected", "selected");
            endTimeSelected = true;
            return false;
         }
      });

      if (!endTimeSelected) {
         //automatically select an end date 2 slots away.
         $endTimeField.find("option:eq(1)").attr("selected", "selected");
      }

   });

});

