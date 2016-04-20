<html>
<head>
	<title>Edit Resource</title>
	<style>
	.editInput{
		resize:none;
		width:350px;
	}

	</style>
</head>
<body>
<form id = "editForm">
<table>
<tr><td>Name: </td><td><textarea class = "editInput" type = "text" id = "eName"/></textarea></td></tr>
<tr><td>URL: </td><td><textarea class = "editInput" type="text" id= "eURL"/></textarea></td></tr>
<tr><td>Type: </td><td><textarea class = "editInput" type = "text" id = "eType"/></textarea></td></tr>
<tr><td>Location: </td><td><textarea class = "editInput" type = "text" id = "eLocation"/></textarea></td></tr>
<tr><td>Hours: </td><td><textarea class = "editInput" type="text" id="eHours"/></textarea></td></tr>
<tr><td>Phone Number: </td><td><textarea class = "editInput" type = "text" id = "eNumber"/></textarea></td></tr>
<tr><td>Details: </td><td><textarea class = "editInput" type="text" id="eDetails"/></textarea></td></tr>
</table>
<button type="button" onClick = "saveEdit();"> Save </button> 
</form>

</body>

</html>