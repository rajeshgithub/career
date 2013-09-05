<?php
include("config.php");
global $objConn;
?>
<HTML>
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<TITLE>
Juxt::Survey Admin
</TITLE>
<LINK rel="stylesheet" type="text/css" href="css/htmcss.css"></LINK>
<META HTTP-EQUIV="Refresh" CONTENT="300">
</HEAD>
<?php
$term = 0;
echo "<TABLE border=\"0\" cellpadding=\"4\" cellspacing=\"1\" width=\"600px\" align=\"center\" style=\"font-family:verdana;font-size:12px;background-color:#A2A2A2\">";
echo "<TR><TD colspan=\"2\" class=\"tdhead\">Survey clicks/counts : </TD></TR>";
echo "<TR><TD class=\"tdhead\" align=\"center\" width=\"351px\">Arrive</TD><TD class=\"tdhead\" align=\"center\">Count</TD></TR>";
$SQL = "SELECT COUNT(*) AS counts FROM `jc_friend_surveydata` WHERE (page1 IS NULL OR page1='1')";
$RS = mysql_query($SQL);
$ROW = mysql_fetch_assoc($RS);
echo "<TR>";
echo "<TD class=\"tdfilled\">Page-1</TD>";
echo "<TD class=\"tdfilled\">".$ROW["counts"]."</TD>";
echo "</TR>";
mysql_free_result($RS);
echo "<TR><TD class=\"tdhead\" align=\"center\">Page completed</TD><TD class=\"tdhead\" align=\"center\">Count</TD></TR>";
for($p=1;$p<=1;$p++)
{
/*	if($p==1)
	{
		$SQLt = "SELECT COUNT(*) AS counts FROM `jc_friend_surveydata` WHERE term='Y'";
		$RSt = mysql_query($SQLt);
		$ROWt = mysql_fetch_assoc($RSt);
		$term = $ROWt["counts"];
		echo "<TR>";
		echo "<TD class=\"tdfilled redtext\">Terminates (Page-1)</TD>";
		echo "<TD class=\"tdfilled redtext\">".$term."</TD>";
		echo "</TR>";
		mysql_free_result($RSt);
	}
*/	$SQL = "SELECT COUNT(*) AS counts FROM `jc_friend_surveydata` WHERE page$p='1'";
	$RS = mysql_query($SQL);
	$ROW = mysql_fetch_assoc($RS);
	
	$cnt = $ROW["counts"];
	if($p==1)
	{
		$cnt = $cnt - $term;
	}
	
	echo "<TR>";
	echo "<TD class=\"tdfilled\">Page-$p</TD>";
	echo "<TD class=\"tdfilled\">".$cnt."</TD>";
	echo "</TR>";
	mysql_free_result($RS);
}
echo "</TABLE>";

$SQL_RFR = "SELECT distinct(rfr) FROM `jc_friend_surveydata` WHERE page1='1'";
$RS_RFR = mysql_query($SQL_RFR);
echo "<TABLE border=\"0\" cellpadding=\"4\" cellspacing=\"1\" width=\"600px\" align=\"center\" style=\"font-family:verdana;font-size:12px;background-color:#a2a2a2;border-top:10px solid #fff\">";
echo "<TR><TD class=\"tdhead\" align=\"center\" width=\"250px\">RFR</TD><TD class=\"tdhead\" align=\"center\" width=\"115px\">Completed</TD></TR>";
while($ROW_RFR = mysql_fetch_assoc($RS_RFR))
{
	$rfr = $ROW_RFR["rfr"];
	echo "<TR>";
	echo "<TD class=\"tdfilled\">".$rfr."</TD>";
	for($i=1;$i<=1;$i++)
	{
		$SQL = "SELECT count(*) AS cnt FROM `jc_friend_surveydata` WHERE page$i='1' AND rfr='".$rfr."'";
		$RS = mysql_query($SQL);
		$ROW = mysql_fetch_assoc($RS);
		$count = $ROW["cnt"];
		echo "<TD class=\"tdfilled\">".$count."</TD>";
		mysql_free_result($RS);
	}
	echo "</TR>";
}
mysql_free_result($RS_RFR);
echo "</TABLE>";

/*
$timeArray = array("first"=>"20","2"=>array("20","15"),"3"=>array("15","10"),"4"=>array("10","5"),"last"=>"5");
echo "<TABLE border=\"0\" cellpadding=\"4\" cellspacing=\"1\" width=\"600px\" align=\"center\" style=\"font-family:verdana;font-size:12px;background-color:#a2a2a2;border-top:10px solid #fff\">";
echo "<TR><TD class=\"tdhead\" align=\"center\" width=\"195px\">Completion time in minutes</TD><TD class=\"tdhead\" align=\"center\" width=\"115px\">Count</TD></TR>";
foreach ($timeArray as $key=>$tm)
{
echo "<TR>";
if($key=="first")
{
$p1 = intval($tm) * 60;
$timeQuery = " time_to_sec(timespan)>$p1";
echo "<TD class=\"tdfilled\">&gt;".$tm."</TD>";
}
else if($key=="last")
{
$p1 = intval($tm) * 60;
$timeQuery = " time_to_sec(timespan)<$p1";
echo "<TD class=\"tdfilled\">&lt;".$tm."</TD>";
}
else
{
$p1 = intval($tm[0]) * 60;
$p2 = intval($tm[1]) * 60;
$timeQuery = " (time_to_sec(timespan)>=$p2 AND time_to_sec(timespan)<$p1)";
echo "<TD class=\"tdfilled\">&gt;=".$tm[1]." AND &lt;".$tm[0]."</TD>";
}
$SQL = "SELECT count(*) AS cnt FROM `jc_higheduccour_surveydata` WHERE $timeQuery AND page2='1'";
$RS = mysql_query($SQL);
$ROW = mysql_fetch_assoc($RS);
$count = $ROW["cnt"];
echo "<TD class=\"tdfilled\">".$count."</TD>";
mysql_free_result($RS);
echo "</TR>";
}
echo "</TABLE>";
*/
mysql_close($objConn);
?>
</BODY>
</HTML>