<?
$id = $_GET['ID'];
include('db_connect.php');
include('checkCredentials.php');
$user = $_COOKIE['username'];
$sql = "SELECT * FROM Resources2 WHERE ID = $id";
$result = mysql_query($sql);

while($row = mysql_fetch_array($result)){
    if($row['User']===$user){
        mysql_query("DELETE FROM Resources2 WHERE ID =$id");
        file_put_contents("deletedResources.txt", "DELETE FROM Resources2 WHERE ID =$id");
        echo "Success!";
    }
    else{
    echo "Did not work";
    }
}

?>
<html>
<head>
<title>Delete Resources</title>
</head>
<body>
<a href="index.php">Go Back </a>

</body>

</html>