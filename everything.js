var id;
var map;
var input_address_lat_long ="";
var inputAddress;
var latlong;
var markers = [];
var myLatlng;
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var infowindow = new google.maps.InfoWindow();
var home_address; //Marker object for Home Marker
google.maps.event.addDomListener(window, 'load', initialize);
function init() {
    $("#logins").draggable();
    $("#advanced").draggable();
    $("#addresources").draggable();
    $("#editPop").draggable();
    var doneTypingInterval = 500; 
    var typingTimer2;
    $('#myAddress').keyup(function(){
        clearTimeout(typingTimer2);
        typingTimer2 = setTimeout(plotAddress, doneTypingInterval);
    });
    $('#myAddress').keydown(function(){
        clearTimeout(typingTimer2);
    });
    var typingTimer;
    $('#keyword').keyup(function(){
        clearTimeout(typingTimer);
        typingTimer = setTimeout(findResources, doneTypingInterval);
    });
    $('#keyword').keydown(function(){
        clearTimeout(typingTimer);
    });
    if(getCookie("username")!=null){
        document.getElementById("administrative_options").style.display="block";
        document.getElementById("not_administrative_options").style.display="none";
    }
    //Get page if there is a get parameter in the URL
    if(getParameterByName('resourceID') != ""){ 
        $.ajax({
            type: "POST",
            url:"pageGet.php",
            data:{
                ID: getParameterByName('resourceID')
            },
            complete: function(response){
                if(response['responseText']!="<p id='counter' style='display:none'>1</p>"){
                    document.getElementById("contents").innerHTML = response['responseText'];
                    addaddress();
                }
            }
        });
    }
}

function initialize() {
    directionsDisplay = new google.maps.DirectionsRenderer();
   /* if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            lat = position.coords.latitude;
            long = position.coords.longitude;*/
            var mapOptions = {
                center: new google.maps.LatLng(37.77711,-121.913781),
                zoom: 10
            };
            map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
      /*  });
    }*/
    directionsDisplay.setMap(map);
    directionsDisplay.setPanel(document.getElementById('directions-panel'));
}

function findResources() {
    if (document.getElementById("keyword").value != "") {
        document.getElementById("contents").innerHTML = "";
        document.getElementById("loader").style.display = "block";
        if(input_address_lat_long!=""){
            console.log(input_address_lat_long);
            var parsedLat = input_address_lat_long.lat;
            var parsedLng = input_address_lat_long.lng;
        }else{
            var parsedLat = "";
            var parsedLng = "";
        }
        $.ajax({
            type: "POST",
            url: "find.php",
            data: {
                Keyword: document.getElementById("keyword").value,
                Lat: parsedLat,
                Lng: parsedLng,
                myAddress: inputAddress
            },
            complete: function (response) {
                document.getElementById("printOption").style.display="block";
                document.getElementById("loader").style.display="none";
                document.getElementById("contents").innerHTML = response['responseText'];
                addaddress();
            }
        });
    }
}

function addaddress() {
    var counter = document.getElementById("counter").innerHTML;
    clearMap();
    for (var i = 1; i <= counter; i++) {
        address = document.getElementById("Location" + i).textContent;
        resourceTitle = document.getElementById("resourceTitle"+i).textContent;
        latlong = document.getElementById("latlong" + i).textContent;
        latlong = latlong.split(",");
        var lat = latlong[0].substring(1);
        var long = latlong[1].substring(0, latlong[1].length - 1);
        myLatlng = new google.maps.LatLng(parseFloat(lat), parseFloat(long));
        addMarker(myLatlng, address, resourceTitle);
    }
}

function addMarker(location, address, resTitle) {
    var marker = new google.maps.Marker({
        position: location,
        map: map,
        title: address
    });
    var contentString = '<div class="infoContents"><h1 class="resTitle">' + resTitle + '</h1><p>' + address + '</p></div>';
    
    google.maps.event.addListener(marker, 'click', function () {
        infowindow.setContent(contentString);
        infowindow.open(map, marker);
    });
    markers.push(marker);
}

function add_home_address(location, address, icon) {
    if(markers['base']!= null){markers['base'].setMap(null);} //If there is already a home icon, get rid of it

    home_address = new google.maps.Marker({
        id: 'base',
        position: location,
        map: map,
        title: address,
        icon: icon
    });

    markers['base'] = home_address;
    var infowindow = new google.maps.InfoWindow();
    google.maps.event.addListener(home_address, 'click', function () {
        infowindow.setContent(address);
        infowindow.open(map, marker);
    });
}

function clearMap() {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
    }
}

function showDirections(counter){
    if(document.getElementById("myAddress").value ===""){
        alert("To use Direction Service, make sure your address is not empty");
    }
    else{
    $('#goBackAlt').fadeToggle();
    $('#directions-panel').fadeToggle();
    document.getElementsByClassName("paragraphs")[0].style.display="none";
    counter +=1;
    var latlong = document.getElementById("latlong" + counter ).textContent;
    latlong = latlong.split(",");
    var lat = latlong[0].substring(1);
    var long = latlong[1].substring(0, latlong[1].length - 1);
    myLatlng = new google.maps.LatLng(parseFloat(lat), parseFloat(long));
    var end = document.getElementById("postedAddress").textContent;
    var request = {
        origin: end,
        destination: myLatlng,
        travelMode: google.maps.TravelMode.DRIVING
    };
    directionsService.route(request, function(response, status){
        if(status==google.maps.DirectionsStatus.OK){
            directionsDisplay.setDirections(response);
        }
        else{
        }
    });
}
}
function plotAddress(){
    inputAddress = document.getElementById("myAddress").value;  
    var geocoder = new google.maps.Geocoder();
    if(geocoder){
        geocoder.geocode({'address':inputAddress}, function(results,status){
            if(status==google.maps.GeocoderStatus.OK){
                if(status!=google.maps.GeocoderStatus.ZERO_RESULTS){
                    input_address_lat_long = results[0].geometry.location;
                    add_home_address(input_address_lat_long, inputAddress, 'rsz_home.png');
                }
            }
        });
    }
    if(document.getElementById("keyword").value != ""){
        findResources();
    }
}

function advancedSearch() {
    $.ajax({
        type: "POST",
        url: "Search.php",
        data: {
            sname: document.getElementById("sname").value,
            stype: document.getElementById("stype").value,
            sLocation: document.getElementById("sLocation").value,
            sstart: document.getElementById("sstart").value,
            send: document.getElementById("send").value
        },
        complete: function (response) {
            document.getElementById("contents").innerHTML = response['responseText'];
            mapToggle();
        }
    });
}

function mapToggle() {
    document.getElementsByClassName("SignUp")[0].style.display = "none";
    document.getElementsByClassName("SignUp")[1].style.display = "none";
    document.getElementById("login").style.display = "block";
    document.getElementById("none").style.display = "block";
    if (document.getElementById("logins").style.display == "none") {
        if (document.getElementById("advanced").style.display == "none") {
            if(document.getElementById("editPop").style.display == "none"){
                $('#addresources').fadeToggle();
            }else{
                $('#editPop').fadeToggle();
            }
        } else {
            $('#advanced').fadeToggle();
        }
    } else {
        $('#logins').fadeToggle();
    }
    $('#screenCover').fadeToggle();
}

function resetDisplay(){
    document.getElementById("editresources").style.display = "none";
    document.getElementById("deleteresources").style.display = "none";
    document.getElementById("addresources").style.display="none";
    document.getElementById("advanced").style.display="none";
    document.getElementById("logins").style.display="none";
}
function resetToLoad(){
    document.getElementById("contents").innerHTML="";
    document.getElementById("myAddress").value="";
    document.getElementById("keyword").value = "";
}

function changePage(tempPage){
    page = tempPage;
    document.getElementById("loader").style.display = "block";
    $("div").scrollTop(0);
    $('#contents').fadeToggle();
    $.ajax({
        type: "POST",
        url: "find.php",
        data:{
            Keyword: document.getElementById("postedKeyword").innerHTML,
            myAddress: document.getElementById("postedAddress").innerHTML,
            Lat: document.getElementById("postedLat").innerHTML,
            Lng: document.getElementById("postedLng").innerHTML,
            page: tempPage
        },
        complete: function(response){
            document.getElementById("loader").style.display="none";
            document.getElementById("contents").innerHTML = response['responseText'];
            $('#contents').fadeToggle();
            addaddress();
        }
    });
}

function saveEdit(){
    var ename = document.getElementById("eName"), eType = document.getElementById("eType"), eURL = document.getElementById("eURL"), eLocation = document.getElementById("eLocation"),
    eHours = document.getElementById("eHours"), eDetails = document.getElementById("eDetails"), eNumber = document.getElementById("eNumber"), eName = document.getElementById("eName");
    $.ajax({
        type:"POST",
        url: "saveEdit.php",
        data:{
            id: id,
            name: ename.value,
            type: eType.value,
            url: eURL.value,
            location: eLocation.value,
            hours: eHours.value,
            details: eDetails.value,
            number: eNumber.value,
        },
        complete: function(response){
            $('#editPop').fadeToggle();
            $('#editresources').fadeToggle();
            $('#screenCover').fadeToggle();
            alert(response['responseText']);
        }
    });
}
function editResource(id){
    this.id = id;
    $.ajax({
        type:"POST",
        url:"edit.php",
        data:{
            id: id
        },
        complete: function(response){
            $("#editPop").fadeToggle();
            $("#screenCover").fadeToggle();
            var arr=JSON.parse(response['responseText']);
            var ename = document.getElementById("eName"), eType = document.getElementById("eType"), eURL = document.getElementById("eURL"), eLocation = document.getElementById("eLocation"),
            eHours = document.getElementById("eHours"), eDetails = document.getElementById("eDetails"), eNumber = document.getElementById("eNumber"), eName = document.getElementById("eName");
            ename.style.height = 0;
            eType.style.height = 0;
            eURL.style.height = 0;
            eLocation.style.height = 0;
            eHours.style.height = 0;
            eDetails.style.height = 0;
            eNumber.style.height = 0;
            ename.innerHTML = arr[0];
            eType.innerHTML = arr[1];
            eURL.innerHTML = arr[2];
            eLocation.innerHTML = arr[3];
            eHours.innerHTML = arr[4];
            eDetails.innerHTML = arr[5];
            eNumber.innerHTML = arr[6];
            ename.style.height = (15 + eName.scrollHeight+"px");
            eType.style.height = (15 + eName.scrollHeight + "px");
            eURL.style.height = (15+ eURL.scrollHeight + "px");
            eLocation.style.height = (15 + eLocation.scrollHeight + "px");
            eHours.style.height = (15 + eHours.scrollHeight + "px");
            eDetails.style.height = (15 + eDetails.scrollHeight + "px");
            eNumber.style.height = (15 + eNumber.scrollHeight + "px");
            
        }
    });
}

function findEditResources(){
    document.getElementById("loader").style.display = "block";
    document.getElementById("editContents").innerHTML = "";
    $.ajax({
        type:"POST",
        url:"find.php",
        data:{
            Keyword: document.getElementById("editWord").value,
            Edit: "true"
        },
        complete: function(response){
            document.getElementById("loader").style.display="none";
            document.getElementById("editContents").innerHTML = response['responseText'];
        }
    });
}

function findDeleteResources() {
    document.getElementById("loader").style.display = "block";
    document.getElementById("deleteContents").innerHTML ="";
    $.ajax({
        type: "POST",
        url: "find.php",
        data: {
            Keyword: document.getElementById("deleteWord").value,
            Delete: "true"
        },
        complete: function (response) {
            document.getElementById("loader").style.display="none";
            document.getElementById("deleteContents").innerHTML = response['responseText'];

        }
    });
}

function signUpOptions(){
    document.getElementsByClassName("SignUp")[0].style.display = "inline";
    document.getElementsByClassName("SignUp")[1].style.display = "inline";
    document.getElementById("login").style.display = "none";
    document.getElementById("none").style.display = "none";
}

function gotoprint(){
    if(typeof page !== "undefined"){
        window.location.href="print.php?keyword="+document.getElementById("postedKeyword").innerHTML+"&address="+document.getElementById("postedAddress").innerHTML+"&lat="+document.getElementById("postedLat").innerHTML+"&lng="+document.getElementById("postedLng").innerHTML+"&page="+page;
    }else{
        window.location.href="print.php?keyword="+document.getElementById("postedKeyword").innerHTML+"&address="+document.getElementById("postedAddress").innerHTML+"&lat="+document.getElementById("postedLat").innerHTML+"&lng="+document.getElementById("postedLng").innerHTML;

    }
}

//FUNCTIONS THAT WERE PASTED IN
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
function getCookie(name) {
    var dc = document.cookie;
    var prefix = name + "=";
    var begin = dc.indexOf("; " + prefix);
    if (begin == -1) {
        begin = dc.indexOf(prefix);
        if (begin != 0) return null;
    }
    else
    {
        begin += 2;
        var end = document.cookie.indexOf(";", begin);
        if (end == -1) {
        end = dc.length;
        }
    }
    return unescape(dc.substring(begin + prefix.length, end));
} 
//END
//FUNCTIONS NOT CURRENTLY BEING USED
//CLAIM RESOURCE
function claimResource(id){
    var email = prompt("Please Enter your email");
    $.ajax({
        type: "POST",
        url: "claim.php",
        data:{
            email: email,
            id: id
        },
        complete: function(response){
            alert(response['responseText']);
        }
    });
}
//Not currently being used