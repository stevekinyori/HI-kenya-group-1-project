<html>
<head>
<title>DHIS MFL facility updater</title>
<style type=text/css>

body{
    background-color: #1D5288;
    color: white;
    font-size: 15px;
  width:400px;
	padding:10px;

	margin:0px;
	
}

#disp{
    background-color: #1D5288;
    color: white;
    font-size: 15px;
    margin: 500;
    width: 400px;
    margin-top: 30%;
}
#loginField {
    margin: 130px auto 0;
    position: relative;
    text-align: center;
    width: 350px;
}
#bannerArea {
    border: medium none;
    margin-bottom: 35px;
}
#loginField {
    text-align: center;
}
#flagArea {
    border: 1px solid #D5D5D5;
    border-radius: 2px 2px 2px 2px;
    left: 120px;
    margin-bottom: -2%;
    max-width: 160px;
    position: relative;
    top: 22px;
}
#mflarea{
   border: 1px solid #D5D5D5;
    border-radius: 2px 2px 2px 2px;
    left: 120px;
    margin-bottom: -2%;
    max-width: 160px;
    position: relative;
    top: -90px;
    margin-left: 190px;
}

</style>
</head>
<body>
<div id="disp">
<H1 align=center> DHIS MFL facility list updater</h1>

<div id="flagarea">
<img src="kenya.png"></img>
</div>
<div id="bannerArea"><a href="http://www.dhis2.org"><img src="logo_front.png" style="border:none"></a></div>
 <div id="mflarea"><a href="http://www.ehealth.or.ke/facilities"><img src="title.gif" style="border:none"></a></div>           
            <form id="loginForm" action="connection.php" method="post">
                <table>
                    <tbody><tr>
                        <td><label for="j_username">Username</label></td>
                        <td><input id="j_username" name="j_username" style="width:240px; height:20px;" type="text"></td>
                    </tr>
                    <tr>
                        <td><label for="j_password">Password</label></td>
                        <td><input id="j_password" name="j_password" style="width:240px; height:20px;" autocomplete="off" type="password"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input id="submit" class="button" value="Login" style="width:120px" type="submit">
                            <input id="reset" class="button" value="Clear" style="width:120px" type="reset">
                        </td>
                    </tr>
                </tbody></table>
            </form>
	
</div>

</body>
</html>	

            
                                
