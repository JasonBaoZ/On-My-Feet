<?php

?>
<html>
<head>
<title>Edit Resources </title>
</head>
<body>
<h1><a id= "title" href="javascript:$('#editresources').fadeToggle();"><span id="goback"> Go Back </span></a> <a id= "title" href="index.php"> On My Feet</a></h1>
<div class="paragraphs">
To edit a resource, search for the resource and then click on it to edit <br><br>
Remember that you can only edit resources that are created by you. To claim a resource, click on the ticker and click Claim Resource. A site administer will then help you claim the resource within 24 hours.<br><br>
Search: <input type = "text" id= "editWord" />
<script>
var typingTimer;                
var doneTypingInterval = 300; 
$('#editWord').keyup(function(){
	clearTimeout(typingTimer);
	typingTimer = setTimeout(findEditResources, doneTypingInterval);
});
$('#editWord').keydown(function(){
	clearTimeout(typingTimer);
});
</script>
<br>
<br>
<div id="editContents">

</div>
</div>
</body>

</html>