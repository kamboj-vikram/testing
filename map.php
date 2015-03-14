<?php 

	$address = $_GET['address'];	
    $address = str_replace(" ", "+", $address);
    $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false");
    $json = json_decode($json);
    $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
    $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};

?>


<script src="http://maps.googleapis.com/maps/api/js"></script>
<script>
function initialize() {

	var lat = "<?php echo $lat; ?>";
	var lng = "<?php echo $long; ?>";
  var mapProp = {
    center:new google.maps.LatLng(lat,lng),
    zoom:5,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>
<div id="googleMap" style="width:500px;height:380px;"></div>