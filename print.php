<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="web_author" content="Jason Bao" />
<meta property="og:type" content="printPage" />
<meta name=viewport content='width=530'>
<title>Print Page</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
function init(){
	var getArray = getSearchParameters();
	$.ajax({
		type:"POST",
		url:"find.php",
		data:{
			Keyword: getArray.keyword,
			Lat: getArray.lat,
			Lng: getArray.lng,
			myAddress: getArray.address,
			page: getArray.page
		},
		complete: function(response){
      console.log(response);
			document.getElementById("content").innerHTML = response['responseText'];
			$(".dropdown-menu").remove();
			$("#pageMarkers").remove();
		}
	});
}
function getSearchParameters() {
      var prmstr = window.location.search.substr(1);
      return prmstr != null && prmstr != "" ? transformToAssocArray(prmstr) : {};
}

function transformToAssocArray( prmstr ) {
    var params = {};
    var prmarr = prmstr.split("&");
    for ( var i = 0; i < prmarr.length; i++) {
        var tmparr = prmarr[i].split("=");
        params[tmparr[0]] = tmparr[1];
    }
    return params;
}
</script>
</head>
<body onload="init()">
  <p id="content">
  </p>
</div>
</div>
