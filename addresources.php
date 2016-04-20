<!DOCTYPE html>
<html>
<head>
<title>Add Resource</title>

</head>
<body>
<div id=all>

	Resource Name: <textarea style="width:200px; resize:none;" onkeyup="adjust(this)" name="name" id="name" type="text" ></textarea><br><br>
	Resource Type: <textarea style="width:200px; resize:none;" onkeyup="adjust(this)" id="type" type="text"></textarea><br><br>
	URL (Optional): <input type = "text" name = "url" id = "url" value = "http://"/> <br><br>
	Street Number: <input type="number" id = "streetnum"  name="streetnum"><br> Street Name: <input type="text" id="streetnam"  name="streetnam"><br> City: <input type="text" id="city" name="city" > State: <input type="text" id="state" name= "state" > <br><br>
	<!--Resource Start Date: <input type="date" name="start" value="2012-01-02" id="start"/> <br>
	Resource End Date: <input type="date" value="2012-02-02"name="end" id="end">-->
	Hours: <input type = "text" name = "hours" id = "hours" /><br>
	Phone Number: <input type="text" name = "number" id= "number" /> <br>
	<input type="text" name="addressobject" id="addressobject" style="display:none" >
	<input type="text" name="aString" id="aString" style="display:none"/>
	<!--<input type= "checkbox" name="annual" id= "annual" value="annual">Annual<br><br>-->
	<div id="new">
	
	</div>
	Details: <textarea style="width:200px; resize:none;" onkeyup="adjust(this)" id = "details" name="details"  type="text" ></textarea>
	<button type="button" onClick="addResource()">Submit</button>
	<!--<button type="button" onclick="addNew()">Add more date fields</button>
	<button type="button" onclick="deleteAtt()">Delete a date field</button>-->

</div>
</body>
<script>

var counter = 0;

	function adjust(x){
	x.style.height = 0;
	x.style.height = (15 + x.scrollHeight+"px");
	
	
	}
	function addResource(){
		var address= document.getElementById("streetnum").value + " " + document.getElementById("streetnam").value+ ", " + document.getElementById("city").value+", " + document.getElementById("state").value;
		var JSONobject;
		var geocoder = new google.maps.Geocoder();
		if(geocoder){
			geocoder.geocode({'address':address}, function(results,status){
				if(status==google.maps.GeocoderStatus.OK){
		    			if(status!=google.maps.GeocoderStatus.ZERO_RESULTS){
		    				document.getElementById("addressobject").value = results[0].geometry.location;
		    				submitForm();
		    			}else{
		    				alert("No results found");
		    			}
		    		}else{
		    			alert("Geocode was not successful for the following reason: " +status);
		    		}
		    	});
		}
	}
	function submitForm(){
		var string = ",";
		if(counter!=0){
			for(var i =1; i<=counter; i++){
				if(i!=1){
					string = string +"start"+i+":"+ document.getElementById("start" + i).value +","+ "end"+i+":" + document.getElementById("end"+i).value;
				}else{
				string = document.getElementById("start"+i).value + "," + "end"+i+":" + document.getElementById("end"+i).value;
				}
				if(counter!= i){
				string = string+ ","
				}
			}
		}
		else{
			document.getElementById("aString").value="false"
		}
		//, start:document.getElementById("start").value, end: document.getElementById("end").value, start1: document.getElementById("aString").value, annual: document.getElementById("annual").checked IMPLEMENT LATER
		$.ajax({
			type: "POST",
			async :false,
			url: "createEvent.php",
			data: {submit:"Create Event", hours: document.getElementById("hours").value, name: document.getElementById("name").value, type: document.getElementById("type").value, streetnum: document.getElementById("streetnum").value, streetnam: document.getElementById("streetnam").value, city: document.getElementById("city").value, state: document.getElementById("state").value, Latitude: document.getElementById("addressobject").value.substr(1, document.getElementById("addressobject").value.search(",")-1) , Longitude: document.getElementById("addressobject").value.substring((document.getElementById("addressobject").value.search(",") +2), (document.getElementById("addressobject").value.length-1)), details: document.getElementById("details").value, number: document.getElementById("number").value, URL: document.getElementById("url").value},
			complete: function(response){
				//console.log(document.getElementById("addressobject").value);
				//console.log(response['responseText']);
				window.location.assign("");
			}
		});
			
	}
	function addNew(){
		counter+=1;
		var newStartDate= document.getElementById("start").cloneNode(true);
		var newEndDate = document.getElementById("end").cloneNode(true);
		var newCheck = document.getElementById("annual").cloneNode(true);
		newStartDate.id = ("start" + counter);
		newEndDate.id= ("end" + counter);
		newCheck.id = ("annual" + counter);
		newdiv = document.createElement('div');
		newdiv.id=("new"+counter);
		thing="new"+counter;
		document.getElementById("new").appendChild(newdiv);
		newStartDate.setAttribute('name', 'start'+counter);
		newEndDate.setAttribute('name', 'end'+counter);
		newCheck.setAttribute('name', 'annual' + counter);
		document.getElementById(thing).appendChild(document.createTextNode("Start Date:"));
		document.getElementById(thing).appendChild(newStartDate);
		newcontent=document.createElement('div');
		document.getElementById(thing).appendChild(newcontent);
		document.getElementById(thing).appendChild(document.createTextNode("End Date:"));
            	document.getElementById(thing).appendChild(newEndDate);
            	document.getElementById(thing).appendChild(newCheck);
            	document.getElementById(thing).appendChild(document.createTextNode("Annual"));
		newcontent = document.createElement('div');
		newcontent.innerHTML="<br>";
		document.getElementById(thing).appendChild(newcontent);
	}
	function deleteAtt(){
	if(counter!=0){
		var Start = document.getElementById('start'+counter);
		Start.parentNode.remove();
		counter -=1;
	}
	}
</script>
</html>