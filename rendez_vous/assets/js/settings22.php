<script>
$(document).ready(function() {

   var $eventcalendarcfc = "/eventcalendar/com/fusionlink/eventcalendar/EventCalendar.cfc";
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
      timeslotsPerHour : 2,
      allowCalEventOverlap : true,
      overlapEventsSeparate: true,
      firstDayOfWeek : 1,
      businessHours :{start: 8, end: 22, limitDisplay: true },
      daysToShow : 7,
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


         $dialogContent.dialog({
            modal: true,
            title: "New Calendar Event",
            close: function() {
               $dialogContent.dialog("destroy");
               $dialogContent.hide();
               $('#calendar').weekCalendar("removeUnsavedEvents");
            },
            buttons: {
               save : function() {
               	//save button clicked on a new event
               	$.getJSON($eventcalendarcfc+"?method=addEvent&returnFormat=json", {title: titleField.val(),body: bodyField.val(),starttime: formatCFDate(startField.val()),endtime: formatCFDate(endField.val())},  function(data) {

                  calEvent.id = data.ID;
                  calEvent.start = new Date(data.STARTTIME);
                  calEvent.end = new Date(data.ENDTIME);
                  calEvent.title = data.TITLE;
                  calEvent.body = data.BODY;	

                  $calendar.weekCalendar("removeUnsavedEvents");
                  $calendar.weekCalendar("updateEvent", calEvent);
                  $dialogContent.dialog("close");
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
         	$.getJSON($eventcalendarcfc+"?method=modifyEvent&returnFormat=json", {id: calEvent.id, title: calEvent.title,body: calEvent.body,starttime: formatCFDate(calEvent.start),endtime: formatCFDate(calEvent.end)},  function(data) {});
      },
      eventClick : function(calEvent, $event) {

         if (calEvent.readOnly) {
            return;
         }

         var $dialogContent = $("#event_edit_container");
         resetForm($dialogContent);
         var startField = $dialogContent.find("select[name='start']").val(calEvent.start);
         var endField = $dialogContent.find("select[name='end']").val(calEvent.end);
         var titleField = $dialogContent.find("input[name='title']").val(calEvent.title);
         var bodyField = $dialogContent.find("textarea[name='body']");
         bodyField.val(calEvent.body);

         $dialogContent.dialog({
            modal: true,
            title: "Edit - " + calEvent.title,
            close: function() {
               $dialogContent.dialog("destroy");
               $dialogContent.hide();
               $('#calendar').weekCalendar("removeUnsavedEvents");
            },
            buttons: {
               save : function() {
		//saved button click on existing event
               	$.getJSON($eventcalendarcfc+"?method=modifyEvent&returnFormat=json", {id: calEvent.id, title: titleField.val(),body: bodyField.val(),starttime: formatCFDate(startField.val()),endtime: formatCFDate(endField.val())},  function(data) {

                  		calEvent.start = new Date(startField.val());
                  		calEvent.end = new Date(endField.val());
                  		calEvent.title = titleField.val();
                  		calEvent.body = bodyField.val();

	                  $calendar.weekCalendar("updateEvent", calEvent);
          	        $dialogContent.dialog("close");
               	});

               },
               "delete" : function() {
               	//delete button clicked
               	$.getJSON($eventcalendarcfc+"?method=removeEvent&returnFormat=json", {id: calEvent.id},  function(data) {

	                  $calendar.weekCalendar("removeEvent", data.ID);
          	        $dialogContent.dialog("close");
               		
               	});
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
      data: function(start, end, callback) {
  	$.getJSON($eventcalendarcfc+"?method=getEvents&returnFormat=json&queryFormat=column", {start: formatCFDate(start),end: formatCFDate(end)},  function(data) {
		var result = [];
			for(var i=0;i < data.ROWCOUNT; i++){
				var eventObj = new Object();
				if (data.DATA.ID){
					//CF9 returns the JSON slightly differently than older versions of CF
					eventObj.id = data.DATA.ID[i];			
					eventObj.start = new Date(data.DATA.STARTTIME[i]);			
					eventObj.end = new Date(data.DATA.ENDTIME[i]);
					eventObj.title = data.DATA.TITLE[i];			
					eventObj.body = data.DATA.BODY[i];
					eventObj.readOnly = data.DATA.READONLY[i];
				}else{
					eventObj.id = data.DATA.id[i];			
					eventObj.start = new Date(data.DATA.starttime[i]);			
					eventObj.end = new Date(data.DATA.endtime[i]);
					eventObj.title = data.DATA.title[i];			
					eventObj.body = data.DATA.body[i];
					eventObj.readOnly = data.DATA.readonly[i];
				}			
				result.push(eventObj);
			}
     		callback(result);
   	});
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
         $startTimeField.append("<option value=\"" + startTime + "\" " + startSelected + ">" + timeslotTimes[i].startFormatted + "</option>");
         $endTimeField.append("<option value=\"" + endTime + "\" " + endSelected + ">" + timeslotTimes[i].endFormatted + "</option>");

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