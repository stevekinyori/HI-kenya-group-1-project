<html>
<head>
<title>This is the dhis connector</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"> </script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<style type="text/css">


body {
    background-color: #1D5288;
    color: white;
    font-size: 15px;
    margin: 0;
    padding: 10px;
}
#facilities {
    height: 500px;
    overflow-y: scroll;
    width: 400px;
}
#mfl {
    margin-left: 800px;
    margin-top: -627px;
    position: relative;
}
#mflfacilities {
    height: 500px;
    margin-left: 800px;
    overflow-y: scroll;
    width: 400px;
}
#compare {
    margin-left: 400px;
    margin-top: 477px;
}
#nocode {
    margin-left: -12px;
    margin-top: -14px;
    max-height: 500px;
    max-width: 300px;
    overflow-y: scroll;
}
#nocodeholder {
    margin-left: 439px;
    margin-top: -542px;
}
#wrongname {
    float: right;
    margin-top: -40px;
    max-height: 500px;
    overflow-y: scroll;
}
#misng {
    float: left;
    margin-top: 18px;
    max-height: 500px;
    overflow-y: scroll;
}
#view {
    margin-top: -80px;
    margin-left: 450px;
}

</style>
</head>
<body>

<?php

$url = "http://test.hiskenya.org/api/organisationUnits.json?paging=false";

$username =$_POST['j_username'];
$password = $_POST['j_password'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,0); 
curl_setopt($ch, CURLOPT_TIMEOUT, 0);
set_time_limit(0);  
$output=curl_exec($ch);
$error=curl_error($ch) . "<br />";
$data=(json_encode($output,true));
?>

<script type="text/javascript">
    var my_var = <?php echo($data); ?>;
  var FACILITY_NAME=[];
	var FACILITY_CODE=[];
	var FACILITY_LEVEL=[];
	var FACILITY_ID=[];
	var mfl_code=[];
	var mfl_name=[];
	var missingfac=[];
	var missingname=[];

json=jQuery.parseJSON(my_var);
	$(document).ready(function() {
	 
            $(json.organisationUnits).each(function(i, data){	
                var id = data.id;
				FACILITY_NAME.push(data.name);
				if(data.code===undefined){
				FACILITY_CODE.push(0);
				
				}
				else{
				FACILITY_CODE.push(data.code);
				}
				FACILITY_LEVEL.push(data.level);
				FACILITY_ID.push(data.id);
              
        });
					
         }); 
		 function getfacilities(){
		  var length=FACILITY_NAME.length;
		  for( var i=0;i<length; i++){
	
		$("#facilities").append(FACILITY_CODE[i]+"  : "+FACILITY_NAME[i]+"<br/>");
		  
		  }
		 }
		 
function cls(){
		 $(document).ready (function(){
		 $('#facilities').html(" ");
		 });
		 }
		 
		 function clmfl(){
		 $(document).ready (function(){
		 $('#mflfacilities').html(" ");
		});
		}
		 function getmfl(){
		 $("document").ready(function(){
								 data = {
								"action": "getmfl"
								};
								data = $(this).serialize() + "&" + $.param(data);
								$.ajax({
								type: "post",
								dataType: "",
								url: "mflPull.php", //Relative or absolute path to php file
								data: data, 
					success: function (data){ 
					json=data;
					var data = JSON.parse(data);
					 $(data).each(function(i, dat){	
					mfl_code.push (dat.Code);
					mfl_name.push(dat.Facility);
				 $("#mflfacilities").append(dat.Code+"  : "+dat.Facility+"<br/>");
							
										
						});		
					}
					
					});
					});
					}
		function check(){
		 $("document").ready(function(){
							data = {
								"action": "getmfl"
								};
								data = $(this).serialize() + "&" + $.param(data);
								$.ajax({
								type: "post",
								dataType: "",
								url: "mflPull.php", //Relative or absolute path to php file
								data: data, 
					success: function (data){ 
					json=data;
					var count=0
					var data = JSON.parse(data);
					$(data).each(function(i, dat){
								var length=FACILITY_CODE.length;
									for (var i=0;i<length;i++){
											if( FACILITY_CODE[i]==dat.Code){
												if(FACILITY_NAME[i]==dat.Facility)
												{
												count++;
												}
												else{
												$("#wrongname").append(dat.Code+" "+dat.Facility).append(" "+"======>"+" ").append(FACILITY_CODE[i]+" " +FACILITY_NAME[i]+ "</br>");
												}
											}
											else {
												count++
											}
									}
									var index = FACILITY_CODE.indexOf(dat.Code);
									if (index >=0){
										count++;
									}
									else{
									$("#misng").append(dat.Code+"  "+dat.Facility +"</br>");
									missingfac.push(dat.Facility);
									missingname.push(dat.Code);
									}
							});
								
					
					}
});

					for (var i=0;i<FACILITY_CODE.length;i++){
							if (FACILITY_CODE[i]==0){
									$("#nocode").append(FACILITY_CODE[i]+"  : "+FACILITY_NAME[i]+"<br/>");
							}
							
					}
});

}
function update(){
$("document").ready(function(){
								 data = {
								"action": "update"
								};
								data = $(this).serialize() + "&" + $.param(data);
								$.ajax({
								type: "post",
								dataType: "",
								url: "mflPull.php", //Relative or absolute path to php file
								data: data, 
					success: function (data){ 
							alert("Mfl list updated");
						}
					});
				});	 
			}
</script>
<div id="dhisfacilities">
<h1 align="left"><img src="logo_front.png">	facility list</img></h1>
		<p>	To view all facilities in DHIS click on the view facilities button</p>
	<button id="viewall" onclick="getfacilities();"> View facilities</button>
	<button id="clear" onclick="cls();"> Clear list</button>
	
</div>
<div id="facilities">
</div>

<div id="mfl">
<h1 align="left"><img src="title.gif">	facility list</img></h1>
	<button id="viewmfl" onclick="getmfl();"> View facilities</button>
	<button id="clr" onclick="clmfl();"> Clear list</button>
	<button id="update" onclick="update();">Update List</button>	
</div>
<div id="mflfacilities">
</div>
<div id="nocodeholder">
<h2>DHIS facilities with no code</h2>
<div id="nocode">

</div>	
</div>
<div id="compare">
<label for="missing">View missing facilities</label>
<button id="missing" onclick=" check();">View</button>
<button id="update">Update to DHIS</button>
</div>
<h2 align="left"> Missing facilities</h2>
<div id="misng">


</div>
<div id="view">
<h2 align="center">Facilities with wrong name</h2>
<h2 align="left">Mfl Name & Code =====> DHIS Name & Code</h2>
<div id="wrongname">
</div>
</div>
</body>
</html>
