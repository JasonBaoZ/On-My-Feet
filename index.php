<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Home - On My Feet</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta name="web_author" content="Jason Bao">
    <meta name="description" content="A user-friendly website for homeless outreach workers to link low-income and homeless individuals to the necessary and relevant resources">
    <meta property="og:title" content="On My Feet">
    <meta property="og:description" content="A user-friendly website for homeless outreach workers to link low-income and homeless individuals to the necessary and relevant resources">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/all.css" />
    <link type="text/css" rel="stylesheet" href="css/dropdown.css" />
    <script type="text/javascript" src="js/dropdown.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    </script>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-53190533-1', 'auto');
      ga('require', 'displayfeatures');
      ga('send', 'pageview');
    </script>
    <script src="/everything.js"></script>
  </head>
  <body onload="init()">
  <div id="contentDynamic">
    <h1>
      <a id= "goBackAlt" href="javascript:$('#goBackAlt').fadeToggle(); javascript:$('#directions-panel').fadeToggle(); javascript:$('#mainContents').fadeToggle();" style="display:none">
        <span id="goback"> Go Back </span>
      </a>
      <a id= "title" href="index.php">On My Feet</a>
    </h1>
    <div id="directions-panel" style="display:none;"></div>
    <div class="paragraphs" id="mainContents">
      <div id="options">
        <div id="administrative_options" style="display:none">
          <a class="add" href="logout.php">Log out</a><br>
          <a class="add" href="javascript:$('#addresources').fadeToggle();$('#screenCover').fadeToggle();">Add Resources</a><br>
          <a class="add" href="javascript:$('#deleteresources').fadeToggle();">Delete Resources</a><br>
          <a class="add" href="javascript:$('#editresources').fadeToggle();">Edit Resources </a><br>
          <a class="add" href="orgTutorial.php"> Organization Tutorial </a>
        </div>
        <div id="not_administrative_options">
          <a class="add" href="javascript:$('#logins').fadeToggle();$('#screenCover').fadeToggle();">Log In </a><br>
          <a class="add" href="tutorial.docx"> Tutorial </a>
        </div> 
      </div>   
    <br><br>
    <p>Enter your address (optional):</p><input type="text" id="myAddress" name="myAddress" onblur="plotAddress();"/> <br>
    <p>Find resources near you by keyword:</p><input type="text" id="keyword"/><br>
    <p>Filter By:</p><input type="checkbox" name="within" id="within" checked disabled="disabled"/>Closest to you
    <br><br>   
    <p>List of relevant resources: <a href="javascript:void(0)" id="printOption" onclick="gotoprint()" style="display:none"><span style="float:right">Print Results</span></a></p><br><br>
    <div id="editresources" style="display:none; overflow-y:scroll;">
      <?php include('editResource.php'); ?>
    </div>
    <div id="editPop" class = "popup ui-draggable"style = "display:none; overflow-y:scroll;">
      <?php include('popEdit.php'); ?>
    </div>
    <div id="deleteresources" style="display:none; overflow-y: scroll;">
      <?php include('deleteresources.php'); ?>
    </div>
    <div id="screenCover" onclick="mapToggle()" ></div>
    <div id="addresources" class="ui-draggable popup" style="display:none">
      <?php include('addresources.php'); ?>
    </div>
    <div id="advanced" class="ui-draggable popup" style="display:none" name="advanced">
      Search for a:<br>
      Resource Name: <textarea id="sname" type="text"></textarea><br>
      Resource Type: <textarea id="stype" type="text"  ></textarea><br>
      Resource Location: <textarea id="sLocation" type="text"></textarea><br>
      Resource Start Date: <textarea id="sstart" type="text"></textarea><br>
      Resource End Date: <textarea id="send" type="text"></textarea>
      <input name="search" type="submit" value="Search for Event" onClick="advancedSearch()" />
    </div> 
    <div id="logins" name="logins" style="display:none" class="ui-draggable popup">
      <form id="login" name="login" method="post" action="login.php">
        Username: <input name="username" id="username" type="text" /><br>
        Password: <input name="password" id = "password" type = "password" >
        <input type="submit" name="submit" id="submit" value="Submit">
      </form>
      <p id="wrong" style="color:red">
        <?php 
          if(isset($_SESSION['wrong'])){
            if($_SESSION['wrong']==="false"){
              echo "Wrong Username or Password";
            }
            unset($_SESSION['wrong']);
          }
        ?>
      </p>
      <p id= "none">
        Do not have an account? Sign up <a href="signup.php" onClick="signUpOptions();return false;"> here </a>
      </p>
      <a href="signup.php"><button class = "SignUp btn btn-default btn-lg" style="display:none">Sign up as Organization</button></a>
      <button class = "SignUp btn btn-default btn-lg" style="display:none">Sign up as Volunteer</button>
    </div>
    <p> <img src="ajax-loader.gif" id="loader" style="display: none;margin-left: auto;margin-right: auto;position: relative;top: 20px;"></p>
    <div id="contents">
    </div>
  </div>
</div>
<div id="map-canvas"></div>
</body>
</html>