<?php



?>

<html>
<head>
<title>Delete Resources</title>
<style>
a{
text-decoration: none;
color: #e74c3c;
}
a:hover{
color: #2c3e50;


}
#goback{
position: absolute;
left: 0;
font-size: 20px;
padding-left:3%;
}

</style>
</head>
<body>
<h1><a id= "title" href="javascript:$('#deleteresources').fadeToggle();"><span id="goback"> Go Back </span></a> <a id= "title" href="index.php"> On My Feet</a></h1>
<div class="paragraphs">
Deleting Resources is permanent and can not be undone <br><br>
To delete resource, Search for the resource and then click on it to delete <br><br>
Search: <input type = "text" id= "deleteWord" />
<br>
<br>
<div id="deleteContents">


</div>
</div>
</body>


<script>
var typingTimer;                
		var doneTypingInterval = 300; 
		$('#deleteWord').keyup(function(){
	    		clearTimeout(typingTimer);
	    		typingTimer = setTimeout(findDeleteResources, doneTypingInterval);
		});
		$('#deleteWord').keydown(function(){
		    clearTimeout(typingTimer);
		});
</script>
</html>