<?php
require("config.php");

/*$redirect = REDIRECT_PATH."/thanks.php?SessionId=".$_REQUEST["SessionId"];
header("location:$redirect");
exit;*/

$sec_code = "";
$field = "";
$values = "";
$result = "SUCCESS";
$fldArray = array();
$term = "";


if(isset($_SESSION["rfr"]))
{
	$rfr = $_SESSION["rfr"];
}
else if(isset($_REQUEST["rfr"]))
{
	$rfr = $_REQUEST["rfr"];
}
$rfr = strtolower($rfr);

$sqlFieldList = "SELECT * FROM `jc_friend_surveydata` LIMIT 0,1";
$rsFieldList = mysql_query($sqlFieldList);
$fieldCount = mysql_num_fields($rsFieldList);
if($fieldCount > 0)
{
	for($i=0; $i<$fieldCount; $i++)
	{
		$fldArray[] = mysql_field_name($rsFieldList, $i);
	}
}
mysql_free_result($rsFieldList);

if($rfr=="ym" || $rfr=="com")
{
	$SQL = "SELECT * FROM `jc_career_data` WHERE uid='".$_REQUEST["uid"]."' ";
}
else
{
	$SQL = "SELECT * FROM `jc_career_data` WHERE Emailid='".$_REQUEST["Emailid"]."' ";
}
$RS = mysql_query($SQL);
$exist  = mysql_num_rows($RS);
if($exist > 0)
{
	mysql_close($objConn);
	if($rfr=='panel')
	{
		//$redirect = "http://www.juxtconsult.in/gctest/thankse.aspx?emailid=".$_REQUEST["Emailid"]."&SID=72&Survey=hed_survey&rfr=".$_SESSION["rfr"];
		$redirect = REDIRECT_PATH."/thanks.php?SessionId=".$_REQUEST["SessionId"];
	}
	else
	{
		$redirect = REDIRECT_PATH."/thanks.php?SessionId=".$_REQUEST["SessionId"];
	}
	header("location:$redirect");
	exit;
}
$SQL ="UPDATE `jc_career_data` SET submit_time_page1=now(),Page1='1',End_Dt_Tm=now(), ";
foreach($_POST as $key=>$value)
{
	if(!(array_search($key,$fldArray)===FALSE))
	{
		if(is_array($value))
		{
			$field .= "$key = '".htmlspecialchars(implode(",",$value))."',";
		}
		else
		{
			$value = htmlspecialchars(trim($value));
			$field .= "$key = '$value',";
		}
	}
}
$field .= "EmailId = '".$_REQUEST["Emailid"]."' ";
$field = substr($field,0,strlen($field)-1);

$SQL .=$field." WHERE SessionId= '".$_REQUEST["SessionId"]."' ";
if(!mysql_query($SQL))
{
	die("There is some database error");
	mysql_close($objConn);
}
else
{
	$SQL ="UPDATE `jc_career_data` SET timespan = TIMEDIFF(`End_Dt_Tm`,`Start_Dt_Tm`) WHERE SessionId= '".$_REQUEST["SessionId"]."'";
	mysql_query($SQL);

	/*
	if($rfr=="ym" || $rfr=="com")
	{
	if($term=='Y')
	{
	$redirect = REDIRECT_PATH."/thanks_t.php?SessionId=".$_REQUEST["SessionId"]."&uid=".$_REQUEST["uid"];
	}
	else
	{
	$redirect = REDIRECT_PATH."/SurveyPage2.php?uid=".$_REQUEST["uid"]."&SessionId=".$_REQUEST["SessionId"];
	}
	}
	*/
	$redirect = REDIRECT_PATH."/thanks.php?SessionId=".$_REQUEST["SessionId"];
	mysql_close($objConn);
	header("location:$redirect");
}
?>