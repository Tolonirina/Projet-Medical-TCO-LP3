    
      test ="Sun Feb 10 2019 08:20:00 GMT+0100 (heure normale d’Europe centrale)";
       test3 ="Sun Feb 10 2019 08:30:00 GMT+0100 (heure normale d’Europe centrale)";
		var result = [];

			//for(var i=0;i < data.ROWCOUNT; i++){
				var eventObj = new Object();
            console.log(eventObj);
			//	if (data.DATA.ID){
					//CF9 returns the JSON slightly differently than older versions of CF
					eventObj.id = "1";			
					eventObj.start = new Date(test);			
					eventObj.end = new Date(test3);
					eventObj.title = "test";			
					eventObj.body = "hellow its me ";
				/*	eventObj.readOnly = data.DATA.READONLY[i];*/
			//	}else{
				/*	eventObj.id = data.DATA.id[i];			
					eventObj.start = new Date(data.DATA.starttime[i]);			
					eventObj.end = new Date(data.DATA.endtime[i]);
					eventObj.title = data.DATA.title[i];			
					eventObj.body = data.DATA.body[i];
					eventObj.readOnly = data.DATA.readonly[i];
				}	*/		
				result.push(eventObj);
			//}*/
     		callback(result);