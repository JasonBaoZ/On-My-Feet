<html>
<head>
	<title> Tutorial </title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<style>
	html{
		background-color: #f2f2f2;
	}
	img{
		border-style:dotted;
		display:block;
		margin-left:auto;
		margin-right:auto;

	}
	body{
		display:block;
		min-height:100%;
		width: 980px;
		margin: 0 auto;
		padding: 0 70px;
		position: relative;
		z-index: 1;
		background: #fff;
		border-top: none;
		border-bottom: none;
		overflow-x: auto;
		overflow-y: auto;
		-webkit-box-shadow: 0 0 4px rgba(0,0,0,.3);
		box-shadow: 0 1px 3px rgba(0,0,0,.3);
		-ms-box-shadow: 0 1px 3px rgba(0,0,0,.3);
		border: 1px solid #dedede \9;
	}
	#main{
		width:100%;
		position:relative;
	}
	#main.content{
		margin: 0 auto;
		width: 980px;
		margin-top: 50px;
	}
	h1.title {
		width: 1040px;
		height: 100px;
		line-height: 100px;
		text-align: center;
		margin: 0;
		background-color: #c0c0c0;
		color: black;
		-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
		filter: alpha(opacity=50);
		-moz-opacity: 0.5;
		-khtml-opacity: 0.5;
		opacity: 0.5;
		position:relative;
		right:30px;
	}
	p{
		font-size: 18px;
	}
	#title {
		text-decoration: none;
		color: black;
	}
	</style>
	<script>
	$(function() {
  $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
});
	</script>
</head>
<body>
<h1 class="title"> <a id="title" href= "index.php"> On My Feet </a> </h1>
<div id="main" class = "content"> 
<p>Frequently Asked Questions: </p>
<ul>
<li><a href="#question1"> How do I find a Resource? </a></li>
<li><a href="#question2"> Where is the submit button? </a></li>
<li><a href= "#question3"> How exactly should I enter the address? </a></li>
<li><a href= "#question4"> How do I know which marker on the map is which resource? </a></li>
</ul>
<h1 id="question1"> How do I find a Resource? </h1>
<p> &nbsp &nbsp &nbsp &nbsp Finding a resource is extremely simple. Simply enter in whatever it is that you are looking for in the "Find resources near you by keyword" box. If you inputted an address, the site will find the resources that are closest to you that match the keyword. The keyword can be anything from the resource phone number to the resource address to the resource name.
<img src="/TutorialScreens/Question1.png" alt = "">
</div>



</body>
</html>