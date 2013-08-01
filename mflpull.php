<?php
/**
 * Created by IntelliJ IDEA.
 * User: steve_w
 * Date: 7/25/13
 * Time: 2:55 PM
 * To change this template use File | Settings | File Templates.
 */
$MFL = array();
$page = 0;
function get_url_contents($url){
    $crl = curl_init();
    $timeout = 0;
    curl_setopt ($crl, CURLOPT_URL,$url);
    curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
    $ret = curl_exec($crl);
  set_time_limit(0);
    curl_close($crl);
    return $ret;
}

function getXML($page){
    $url = "testapi.ehealth.or.ke/api/facilities?page=".$page;
    $mfl = get_url_contents($url);
    //$_SESSION['offlineMFL'] = $mfl;
    global $xmlMfl;
    $xmlMfl = simplexml_load_string($mfl);
    return $xmlMfl;
}

function processXML($xmlMfl){
    global $page;
    $page = $xmlMfl->Pager[0]-> PageCount;
    for($i=0;$i<$xmlMfl->Pager[0]-> PageSize;$i++)
    {
        //echo $xmlMfl->Facility[$i]-> Code.':::::'.$xmlMfl->Facility[$i]-> Name.'</br>';
        global $MFL;
        //print gettype($xmlMfl->Facility[$i]-> Code);
        if($xmlMfl->Facility[$i] == NULL)
        {
            break;
        }
        else{
        $Code = (string)$xmlMfl->Facility[$i]-> Code;
        $Facility = (string)$xmlMfl->Facility[$i]-> Name;
        array_push($MFL,array("Code"=>$Code,"Facility"=>$Facility));
        }
    }
}
function updateMFL(){
    global $MFL,$page;
    processXML(getXML(0));
    for($i=2;$i<=$page;$i++)
    {
        processXML(getXML($i));
    }
    $fp = fopen('array.json', 'w');
    fwrite($fp, json_encode($MFL));
    fclose($fp);
   echo ("success");
}
function getMFL(){
   echo(file_get_contents('array.json'));
//echo($retrieveMFL);
}
if(isset($_POST['action'])) {
    if($_POST['action'] == 'getmfl') {
        getMFL();
    } elseif($_POST['action'] == 'update') {
        updateMFL();
    }
}

?>
