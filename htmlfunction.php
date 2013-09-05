<?php
/*
$xml_file - Name of the xml file to bind with dropdown
$variable - Name/id of the dropdown
$clsname - Specify the class name default is dropdown
$default_text - Specify the default text appear in Dropdown default is 'Select one'
$func - Name of the function to be fired when option is selected in the dropdown
$paramArr - Optiona parameter list if supplied passed to the function
$disabled - Make Dropdown Disabled
*/
function AddDropDown($xml_file,$variable,$clsname='dropdown',$default_text = 'Select one',$func='',$paramArr='',$disabled='')
{
	$objDOM = new DOMDocument();
	$fn = "xml/$xml_file";
	if($objDOM->load($fn))
	{
		$event = "";
		$c_func = "";
		$node = $objDOM->getElementsByTagName("Row");
		if($func!='')
		{
			if($paramArr=='')
			{
				$c_func = $func."();";
			}
			else
			{
				$c_func = $func."(";
				for($i=0;$i<count($paramArr);$i++)
				{
					$c_func .= $paramArr[$i].",";
				}
				$c_func = substr($c_func,0,strlen($c_func)-1);
				$c_func .= ");";
			}
			$event = "onchange=\"$c_func\" ";
		}
		echo "<SELECT name=\"$variable\" id=\"$variable\" $disabled class=\"$clsname\" $event>";
		echo "<OPTION value=\"0\">".$default_text."</OPTION>";
		foreach( $node as $value )
		{
			$values = $value->getElementsByTagName("Value")->item(0)->nodeValue;
			$title = html_entity_decode($value->getElementsByTagName("Title")->item(0)->nodeValue);
			echo "<OPTION value=\"$values\">".$title."</OPTION>";
		}
		echo "</SELECT>";
	}
}

function AddDropDownRand($none_cant,$xml_file,$variable,$clsname='dropdown',$default_text = 'Select one',$func='',$paramArr='',$disabled='')
{
	$objDOM = new DOMDocument();
	$fn = "xml/$xml_file";
	if($objDOM->load($fn))
	{
		$event = "";
		$c_func = "";
		$node = $objDOM->getElementsByTagName("Row");
		$optioncount = $node->length;
		$substract  = ($none_cant+1);
		$randomArr = range(0,$optioncount-$substract);
		shuffle($randomArr);
		if($func!='')
		{
			if($paramArr=='')
			{
				$c_func = $func."();";
			}
			else
			{
				$c_func = $func."(";
				for($i=0;$i<count($paramArr);$i++)
				{
					$c_func .= $paramArr[$i].",";
				}
				$c_func = substr($c_func,0,strlen($c_func)-1);
				$c_func .= ");";
			}
			$event = "onchange=\"$c_func\" ";
		}
		echo "<SELECT name=\"$variable\" id=\"$variable\" $disabled class=\"$clsname\" $event>";
		echo "<OPTION value=\"0\">".$default_text."</OPTION>";

		for($v=0;$v<($optioncount-$none_cant);$v++)
		{
			$v1 = $randomArr[$v];
			$values = $node->item($v1)->getElementsByTagName("Value")->item(0)->nodeValue;
			$title = html_entity_decode($node->item($v1)->getElementsByTagName("Title")->item(0)->nodeValue);
			echo "<OPTION value=\"$values\">".$title."</OPTION>";
		}
		if($none_cant!=0)
		{
			//$v--;
			for(;$v<$optioncount;$v++)
			{
				$values = $node->item($v)->getElementsByTagName("Value")->item(0)->nodeValue;
				$title = html_entity_decode($node->item($v)->getElementsByTagName("Title")->item(0)->nodeValue);
				echo "<OPTION value=\"$values\">".$title."</OPTION>";
			}
		}
		echo "</SELECT>";
	}
}

//Generates empty dropdown list without xml binding
function AddDynDropDown($variable,$func='',$paramArr='',$clsname="dropdown",$disabled='',$default_text = 'Select one')
{
	$event = "";
	$c_func = "";
	if($func!='')
	{
		if($paramArr=='')
		{
			$c_func = $func."();";
		}
		else
		{
			$c_func = $func."(";
			for($i=0;$i<count($paramArr);$i++)
			{
				$c_func .= $paramArr[$i].",";
			}
			$c_func = substr($c_func,0,strlen($c_func)-1);
			$c_func .= ");";
		}
		$event = "onchange=\"$c_func\" ";
	}
	echo "<SELECT name=\"$variable\" id=\"$variable\" $disabled class=\"$clsname\" $event>";
	echo "<OPTION value=\"0\">".$default_text."</OPTION>";
	echo "</SELECT>";
}

/*
PARAMETERS DETAILS -
$xml_file - Name of the xml file to bind with checkbox
$cls - Name of the class
$rows - Number of rows for checkbox
$cols - Number of colsfor checkbox
$width - width in px ie 800px,900px or in % i.e. 100%,80%
$variableArr - Array of variable for the checkbox name and id
$func - Name of the function used fired when checkbox is clicked
$linkDropdown - true or false if true automatically pass 3 parameters to function
1. id of the checkbox
2. value of the checkbox
3. title of the checkbox
$paramArr - Array of parameters passed to function if required
$cellspacing - 1 or 0 if 1 display a grid in table of the checkbox
*/

function AddCheckBox($xml_file,$isImage,$cls="Ans",$bgcolor,$shuffle='0',$orinent,$rows=1,$columns=1,$width,$func='',$linkDropdown,$paramArr='',$cellspacing='1')
{
	$objDOM = new DOMDocument();
	$fn = "xml/$xml_file";
	if($objDOM->load($fn))
	{
		$event = "";
		$c_func = "";
		$v=0;

		$node = $objDOM->getElementsByTagName("Row");
		$optioncount = $node->length;

		$randomArr = range(0,$optioncount-1);
		if($shuffle=='4')
		{
			shuffle($randomArr);
		}

		if($func!='' && $linkDropdown==false)
		{
			if($paramArr=='')
			{
				$c_func = $func."();";
			}
			else
			{
				$c_func = $func."(";
				for($i=0;$i<count($paramArr);$i++)
				{
					$c_func .= $paramArr[$i].",";
				}
				$c_func = substr($c_func,0,strlen($c_func)-1);
				$c_func .= ");";
			}
			$event = "onclick=\"$c_func\" ";
		}
		if($orinent=="0")
		{
			$colwidth = ($width/$columns)."%";
			echo "<TABLE border=\"0\" width=\"".$width."\" cellspacing=\"".$cellspacing."\" cellpadding=\"0\" class=\"backwhite\">";
			for($r=1;$r<=$rows;$r++)
			{
				echo "<TR>";
				for($c=1;$c<=$columns;$c++)
				{
					if($v < $optioncount)
					{
						$v1 = $randomArr[$v];
						$chkname = $node->item($v1)->getAttribute("varName");
						$values = $node->item($v1)->getElementsByTagName("Value")->item(0)->nodeValue;
						$title = html_entity_decode($node->item($v1)->getElementsByTagName("Title")->item(0)->nodeValue);
						echo "<TD class=\"".$cls."\" width=\"$colwidth\">";
						if($linkDropdown==true)
						{
							$event = "onclick=\"$func($chkname,$values,'$title');\" ";
						}
						if($isImage=='Y')
						{
							$img_url = "images/".$title;
							echo "<INPUT type=\"checkbox\" name=\"$chkname\" id=\"$chkname\"  value=\"$values\"  $event /><label for=\"$chkname\"><IMG src='".$img_url."' title='".$title."'></label>";
						}
						else
						{
							echo "<INPUT type=\"checkbox\" name=\"$chkname\" id=\"$chkname\"  value=\"$values\"  $event /><label for=\"$chkname\">".$title."</label>";
						}
						echo "</TD>";
						$v++;
					}
					else
					{
						echo "<TD class=\"".$cls."\" width=\"$colwidth\">&nbsp;</TD>";
					}
				}
				echo "</TR>";
			}
		}
		else
		{
			echo "<TABLE border=\"0\" width=\"".$width."\" cellspacing=\"0\" cellpadding=\"0\">";
			echo "<TR>";
			for($c=1;$c<=$columns;$c++)
			{
				$colwidth = ($width/$columns)."%";
				echo "<TD valign=\"top\" width=\"$colwidth\">";
				echo  "<TABLE border=\"0\" width=\"100%\" cellspacing=\"".$cellspacing."\" cellpadding=\"0\" class=\"backwhite\">";
				for($r=1;$r<=$rows;$r++)
				{
					if($v < $optioncount)
					{
						$v1 = $randomArr[$v];
						$chkname = $node->item($v1)->getAttribute("varName");
						$values = $node->item($v1)->getElementsByTagName("Value")->item(0)->nodeValue;
						$title = html_entity_decode($node->item($v1)->getElementsByTagName("Title")->item(0)->nodeValue);
						if($linkDropdown==true)
						{
							$event = "onclick=\"$func($chkname,$values,'$title');\" ";
						}
						echo "<TR><TD class=\"".$cls."\">";
						if($isImage=='Y')
						{
							$img_url = "images/".$title;
							echo "<INPUT type=\"checkbox\" name=\"$chkname\" id=\"$chkname\"  value=\"$values\"  $event /><label for=\"$chkname\"><IMG src='".$img_url."' title='".$title."'></label>";
						}
						else
						{
							echo "<INPUT type=\"checkbox\" name=\"$chkname\" id=\"$chkname\"  value=\"$values\"  $event /><label for=\"$chkname\">".$title."</label>";
						}
						echo "</TD></TR>";
						$v++;
					}
					else
					{
						echo "<TR><TD class=\"".$cls."\">&nbsp;</TD></TR>";
					}
				}
				echo "</TABLE></TD>";
			}
			echo "</TR>";
		}
		echo "</TABLE>";
	}
}

function AddCheckBoxRand($xml_file,$fixposvalue,$isImage,$cls="Ans",$orinent,$rows=1,$columns=1,$width,$func='',$linkDropdown,$paramArr='',$cellspacing='1')
{
	$objDOM = new DOMDocument();
	$fn = "xml/$xml_file";
	if($objDOM->load($fn))
	{
		$event = "";
		$c_func = "";
		$v=0;
		$node = $objDOM->getElementsByTagName("Row");
		$optioncount = $node->length;
		$substract = $fixposvalue + 1;
		$randomArr = range(0,$optioncount-$substract);
		shuffle($randomArr);
		if($func!='' && $linkDropdown==false)
		{
			if($paramArr=='')
			{
				$c_func = $func."();";
			}
			else
			{
				$c_func = $func."(";
				for($i=0;$i<count($paramArr);$i++)
				{
					$c_func .= $paramArr[$i].",";
				}
				$c_func = substr($c_func,0,strlen($c_func)-1);
				$c_func .= ");";
			}
			$event = "onclick=\"$c_func\" ";
		}
		if($orinent=="0")
		{
			$colwidth = ($width/$columns)."%";
			echo "<TABLE border=\"0\" width=\"".$width."\" cellspacing=\"".$cellspacing."\" cellpadding=\"0\" class=\"backwhite\">";
			for($r=1;$r<=$rows;$r++)
			{
				echo "<TR>";
				for($c=1;$c<=$columns;$c++)
				{
					if($v < ($optioncount-$fixposvalue))
					{
						$v1 = $randomArr[$v];
						$chkname = $node->item($v1)->getAttribute("varName");
						$values = $node->item($v1)->getElementsByTagName("Value")->item(0)->nodeValue;
						$title = html_entity_decode($node->item($v1)->getElementsByTagName("Title")->item(0)->nodeValue);
						echo "<TD class=\"".$cls."\" width=\"$colwidth\">";
						if($linkDropdown==true)
						{
							$event = "onclick=\"$func($chkname,$values,'$title');\" ";
						}
						if($isImage=='Y')
						{
							$img_url = "images/thumbnail/".$title;
							echo "<INPUT type=\"checkbox\" name=\"$chkname\" id=\"$chkname\"  value=\"$values\"  $event /><IMG src='".$img_url."' title='".$title."'>";
						}
						else
						{
							echo "<INPUT type=\"checkbox\" name=\"$chkname\" id=\"$chkname\"  value=\"$values\"  $event /><label for=\"$chkname\">".$title."</label>";
						}
						echo "</TD>";
					}
					else if($v < $optioncount)
					{
						$chkname = $node->item($v)->getAttribute("varName");
						$values = $node->item($v)->getElementsByTagName("Value")->item(0)->nodeValue;
						$title = html_entity_decode($node->item($v)->getElementsByTagName("Title")->item(0)->nodeValue);

						echo "<TD class=\"".$cls."\" width=\"$colwidth\">";
						if($linkDropdown==true)
						{
							$event = "onclick=\"$func($chkname,$values,'$title');\" ";
						}
						if($isImage=='Y')
						{
							$img_url = "images/thumbnail/".$title;
							echo "<INPUT type=\"checkbox\" name=\"$chkname\" id=\"$chkname\"  value=\"$values\"  $event /><IMG src='".$img_url."' title='".$title."'>";
						}
						else
						{
							echo "<INPUT type=\"checkbox\" name=\"$chkname\" id=\"$chkname\"  value=\"$values\"  $event /><label for=\"$chkname\">".$title."</label>";
						}
						echo "</TD>";
					}
					else
					{

						echo "<TD class=\"".$cls."\" width=\"$colwidth\">&nbsp;</TD>";
					}
					$v++;
				}
				echo "</TR>";
			}
		}
		else
		{
			$colwidth = ($width/$columns)."%";
			echo "<TABLE border=\"0\" width=\"".$width."\" cellspacing=\"0\" cellpadding=\"0\">";
			echo "<TR>";
			for($c=1;$c<=$columns;$c++)
			{
				echo "<TD valign=\"top\" width=\"$colwidth\">";
				echo  "<TABLE border=\"0\" width=\"100%\" cellspacing=\"".$cellspacing."\" cellpadding=\"0\" class=\"backwhite\">";
				for($r=1;$r<=$rows;$r++)
				{
					if($v < ($optioncount-$fixposvalue))
					{
						$v1 = $randomArr[$v];
						$chkname = $node->item($v1)->getAttribute("varName");
						$values = $node->item($v1)->getElementsByTagName("Value")->item(0)->nodeValue;
						$title = html_entity_decode($node->item($v1)->getElementsByTagName("Title")->item(0)->nodeValue);
						if($linkDropdown==true)
						{
							$event = "onclick=\"$func($chkname,$values,'$title');\" ";
						}
						echo "<TR><TD class=\"".$cls."\">";
						if($isImage=='Y')
						{
							$img_url = "images/thumbnail/".$title;
							echo "<INPUT type=\"checkbox\" name=\"$chkname\" id=\"$chkname\"  value=\"$values\"  $event /><IMG src='".$img_url."' title='".$title."'>";
						}
						else
						{
							echo "<INPUT type=\"checkbox\" name=\"$chkname\" id=\"$chkname\"  value=\"$values\"  $event /><label for=\"$chkname\">".$title."</label>";
						}
						echo "</TD></TR>";
					}
					else if($v < $optioncount)
					{
						$chkname = $node->item($v)->getAttribute("varName");
						$values = $node->item($v)->getElementsByTagName("Value")->item(0)->nodeValue;
						$title = html_entity_decode($node->item($v)->getElementsByTagName("Title")->item(0)->nodeValue);

						echo "<TR><TD class=\"".$cls."\">";
						if($linkDropdown==true)
						{
							$event = "onclick=\"$func($chkname,$values,'$title');\" ";
						}
						if($isImage=='Y')
						{
							$img_url = "images/thumbnail/".$title;
							echo "<INPUT type=\"checkbox\" name=\"$chkname\" id=\"$chkname\"  value=\"$values\"  $event /><IMG src='".$img_url."' title='".$title."'>";
						}
						else
						{
							echo "<INPUT type=\"checkbox\" name=\"$chkname\" id=\"$chkname\"  value=\"$values\"  $event /><label for=\"$chkname\">".$title."</label>";
						}
						echo "</TD></TR>";
					}
					else
					{

						echo "<TR><TD class=\"".$cls."\">&nbsp;</TD></TR>";
					}
					$v++;
				}
				echo "</TABLE></TD>";
			}
			echo "</TR>";
		}
		echo "</TABLE>";
	}
}

function AddCheckBoxFix($xml_file,$isImage,$cls="Ans",$bgcolor,$shuffle='0',$orinent,$rows=1,$columns=1,$width,$func='',$linkDropdown,$paramArr='',$cellspacing='1',$fixvar)
{
	$objDOM = new DOMDocument();
	$fn = "xml/$xml_file";
	if($objDOM->load($fn))
	{
		$event = "";
		$c_func = "";
		$v=0;

		$node = $objDOM->getElementsByTagName("Row");
		$optioncount = $node->length;

		$randomArr = range(0,$optioncount-1);
		if($shuffle=='4')
		{
			shuffle($randomArr);
		}

		if($func!='' && $linkDropdown==false)
		{
			if($paramArr=='')
			{
				$c_func = $func."();";
			}
			else
			{
				$c_func = $func."(";
				for($i=0;$i<count($paramArr);$i++)
				{
					$c_func .= $paramArr[$i].",";
				}
				$c_func = substr($c_func,0,strlen($c_func)-1);
				$c_func .= ");";
			}
			$event = "onclick=\"$c_func\" ";
		}
		if($orinent=="0")
		{
			$colwidth = ($width/$columns)."%";
			echo "<TABLE border=\"0\" width=\"".$width."\" cellspacing=\"".$cellspacing."\" cellpadding=\"0\" class=\"backwhite\">";
			for($r=1;$r<=$rows;$r++)
			{
				echo "<TR>";
				for($c=1;$c<=$columns;$c++)
				{
					if($v < $optioncount)
					{
						$v1 = $randomArr[$v];
						//$chkname = $node->item($v1)->getAttribute("varName");
						$values = $node->item($v1)->getElementsByTagName("Value")->item(0)->nodeValue;
						$title = html_entity_decode($node->item($v1)->getElementsByTagName("Title")->item(0)->nodeValue);
						echo "<TD class=\"".$cls."\"  width=\"".$colwidth."\">";
						if($linkDropdown==true)
						{
							$event = "onclick=\"$func($chkname,$values,'$title');\" ";
						}
						if($isImage=='Y')
						{
							$img_url = "images/".$title;
							echo "<INPUT type=\"checkbox\" name=\"$fixvar\" id=\"$fixvar\"  value=\"$values\"  $event /><IMG src='".$img_url."' title='".$title."'>";
						}
						else
						{
							echo "<INPUT type=\"checkbox\" name=\"$fixvar\" id=\"$fixvar\"  value=\"$values\"  $event />".$title;
						}
						echo "</TD>";
						$v++;
					}
					else
					{
						echo "<TD class=\"".$cls."\" width=\"".$colwidth."\">&nbsp;</TD>";
					}
				}
				echo "</TR>";
			}
		}
		else
		{
			echo "<TABLE border=\"0\" width=\"".$width."\" cellspacing=\"0\" cellpadding=\"0\">";
			echo "<TR>";
			for($c=1;$c<=$columns;$c++)
			{
				echo "<TD valign=\"top\">";
				echo  "<TABLE border=\"0\" width=\"100%\" cellspacing=\"".$cellspacing."\" cellpadding=\"0\" class=\"backwhite\">";
				for($r=1;$r<=$rows;$r++)
				{
					if($v < $optioncount)
					{
						$v1 = $randomArr[$v];
						//$chkname = $node->item($v1)->getAttribute("varName");
						$values = $node->item($v1)->getElementsByTagName("Value")->item(0)->nodeValue;
						$title = html_entity_decode($node->item($v1)->getElementsByTagName("Title")->item(0)->nodeValue);
						if($linkDropdown==true)
						{
							$event = "onclick=\"$func($chkname,$values,'$title');\" ";
						}
						echo "<TR><TD bgcolor=\"".$bgcolor."\" class=\"".$cls."\">";
						if($isImage=='Y')
						{
							$img_url = "images/".$title;
							echo "<INPUT type=\"checkbox\" name=\"$fixvar\" id=\"$fixvar\"  value=\"$values\"  $event /><IMG src='".$img_url."' title='".$title."'>";
						}
						else
						{
							echo "<INPUT type=\"checkbox\" name=\"$fixvar\" id=\"$fixvar\"  value=\"$values\"  $event />".$title;
						}
						echo "</TD></TR>";
						$v++;
					}
					else
					{
						echo "<TR><TD bgcolor=\"".$bgcolor."\" class=\"".$cls."\">&nbsp;</TD></TR>";
					}
				}
				echo "</TABLE></TD>";
			}
			echo "</TR>";
		}
		echo "</TABLE>";
	}
}

function AddRadioButton($xml_file,$isImage,$cls="Ans",$bgcolor,$shuffle='0',$orinent,$rows=1,$columns=1,$width,$func='',$paramArr='',$cellspacing='1')
{
	$objDOM = new DOMDocument();
	$fn = "xml/$xml_file";
	if($objDOM->load($fn))
	{
		$event = "";
		$c_func = "";
		$v=0;

		$node = $objDOM->getElementsByTagName("Row");
		$optioncount = $node->length;

		$randomArr = range(0,$optioncount-1);
		if($shuffle=='4')
		{
			shuffle($randomArr);
		}

		if($func!='' && $linkDropdown==false)
		{
			if($paramArr=='')
			{
				$c_func = $func."();";
			}
			else
			{
				$c_func = $func."(";
				for($i=0;$i<count($paramArr);$i++)
				{
					$c_func .= $paramArr[$i].",";
				}
				$c_func = substr($c_func,0,strlen($c_func)-1);
				$c_func .= ");";
			}
			$event = "onclick=\"$c_func\" ";
		}
		if($orinent=="0")
		{
			echo "<TABLE border=\"0\" width=\"".$width."\" cellspacing=\"".$cellspacing."\" cellpadding=\"0\" class=\"backwhite\">";
			for($r=1;$r<=$rows;$r++)
			{
				echo "<TR>";
				for($c=1;$c<=$columns;$c++)
				{
					if($v < $optioncount)
					{
						$v1 = $randomArr[$v];
						$radname = $node->item($v1)->getAttribute("varName");
						$values = $node->item($v1)->getElementsByTagName("Value")->item(0)->nodeValue;
						$title = html_entity_decode($node->item($v1)->getElementsByTagName("Title")->item(0)->nodeValue);
						echo "<TD class=\"".$cls."\" bgcolor=\"".$bgcolor."\">";
						/*
						if($isImage=='Y')
						{
						$img_url = "images/thumbnail/".$title;
						echo "<INPUT type=\"radio\" name=\"$radname\" id=\"$radname\"  value=\"$values\"  $event /><label for=\"$radname\"><IMG src='".$img_url."' title='".$title."'></label>";
						}
						*/
						if($isImage=='Y')
						{
							$img_url = "images/thumbnail/".$title;
							echo "<label for=\"$radname.$values\"><INPUT type=\"radio\" name=\"$radname\" id=\"$radname.$values\"  value=\"$values\" $event /><IMG src='".$img_url."' title='".$title."'></label>";
						}
						else
						{
							echo "<INPUT type=\"radio\" name=\"$radname\" id=\"$radname\"  value=\"$values\"  $event /><label for=\"$radname\">".$title."</label>";
						}
						echo "</TD>";
						$v++;
					}
					else
					{
						echo "<TD class=\"".$cls."\" bgcolor=\"".$bgcolor."\">&nbsp;</TD>";
					}
				}
				echo "</TR>";
			}
		}
		else
		{
			echo "<TABLE border=\"0\" width=\"".$width."\" cellspacing=\"0\" cellpadding=\"0\">";
			echo "<TR>";
			for($c=1;$c<=$columns;$c++)
			{
				echo "<TD valign=\"top\">";
				echo  "<TABLE border=\"0\" width=\"100%\" cellspacing=\"".$cellspacing."\" cellpadding=\"0\" class=\"backwhite\">";
				for($r=1;$r<=$rows;$r++)
				{
					if($v < $optioncount)
					{
						$v1 = $randomArr[$v];
						$radname = $node->item($v1)->getAttribute("varName");
						$values = $node->item($v1)->getElementsByTagName("Value")->item(0)->nodeValue;
						$title = html_entity_decode($node->item($v1)->getElementsByTagName("Title")->item(0)->nodeValue);
						echo "<TR><TD bgcolor=\"".$bgcolor."\" class=\"".$cls."\">";
						if($isImage=='Y')
						{
							$img_url = "images/thumbnail/".$title;
							echo "<INPUT type=\"radio\" name=\"$radname\" id=\"$radname\"  value=\"$values\"  $event /><label for=\"$radname\"><IMG src='".$img_url."' title='".$title."'></label>";
						}
						else
						{
							echo "<INPUT type=\"radio\" name=\"".$radname."\" id=\"".$radname."\"  value=\"".$values."\"><label for=\"$radname\">".$title."</label>";
						}
						echo "</TD></TR>";
						$v++;
					}
					else
					{
						echo "<TR><TD bgcolor=\"".$bgcolor."\" class=\"".$cls."\">&nbsp;</TD></TR>";
					}
				}
				echo "</TABLE></TD>";
			}
			echo "</TR>";
		}
		echo "</TABLE>";
	}
}
/*Generates and returns the variable names
$name - The name of the variable
$count  - Total number of variable names to be generate
$delim - Delemeter character between varable name and serial number
*/
function generateVar($name,$count,$delim="_")
{
	$varArray = array();
	for($i=1;$i<=$count;$i++)
	{
		$var = $name.$delim.$i;
		$varArray[]=$var;
	}
	return $varArray;
}

//Returns the browser name and browser version
function getBrowserDetails()
{
	$browArr = array();
	$bname = "";
	$bver = "";
	$browser_flag = false;

	$browsers = array("firefox", "msie", "opera", "chrome", "safari","mozilla", "seamonkey",    "konqueror", "netscape","gecko", "navigator", "mosaic", "lynx", "amaya","omniweb", "avant", "camino", "flock", "aol","chrome");

	$ip = $_SERVER["REMOTE_ADDR"];
	$Agent = strtolower($_SERVER['HTTP_USER_AGENT']);
	$sessionid	=	session_id();
	foreach($browsers as $browser)
	{
		if(preg_match("#($browser)[/ ]?([0-9.]*)#", $Agent, $match))
		{
			$bname = $match[1];
			$bver = $match[2];
			$browser_flag = true;
			break;
		}
	}
	if($browser_flag==false || $bname=='' || $bname==' ')
	{
		$bname = "unkown";
		$bver = "0";
	}
	$browArr[] = $bname;
	$browArr[] = $bver;
	return $browArr;
}

//Return the client ip address
function getClientIP()
{
	if(isset($_SERVER["HTTP_NS_REMOTE_ADDR"]))
	{
		$ip =  $_SERVER["HTTP_NS_REMOTE_ADDR"];
	}
	else
	{
		$ip =  $_SERVER['REMOTE_ADDR'] ;
	}
	return $ip;
}

function unique_id($length) {
	$cstr = "";
	$arr = array("1","2","3","4","5","6","7","8","9","0","q","w","e","r","t",
	"y","u","i","o","p","a","s","d","f","g","h","j","k","l",
	"z","x","c","v","b","n","m","Q","W","E","R","T","Y","U",
	"I","O","P","A","S","D","F","G","H","J","K","L","Z","X",
	"C","V","B","N","M");
	srand((float) microtime() * 1000000);
	for($i = $length; $i > 0; $i--) {
		$cstr .= $arr[rand(0, sizeof($arr)-1)];
	}
	return $cstr;
}

function shuffle_assoc(&$array) {
	$keys = array_keys($array);

	shuffle($keys);

	foreach($keys as $key) {
		$new[$key] = $array[$key];
	}

	$array = $new;

	return true;
}

//days difference between two dates
function daysDifference($endDate, $beginDate)
{
   //explode the date by "-" and storing to array
   $date_parts1=explode("-", $beginDate);
   $date_parts2=explode("-", $endDate);
   //gregoriantojd() Converts a Gregorian date to Julian Day Count
   $start_date=gregoriantojd($date_parts1[1], $date_parts1[2], $date_parts1[0]);
   $end_date=gregoriantojd($date_parts2[1], $date_parts2[2], $date_parts2[0]);
   return $end_date - $start_date;
}
/*
$v = 0;
$objDOM = new DOMDocument();
$fn = "xml/jc_indion_ChkQ5_5.xml";
if($objDOM->load($fn))
{
$node = $objDOM->getElementsByTagName("Row");
$optioncount = $node->length;
echo "<TABLE border=\"0\" width=\"100%\" cellspacing=\"1\" cellpadding=\"0\" class=\"backwhite\">";
for($r=1;$r<=3;$r++)
{
echo "<TR>";
for($c=1;$c<=3;$c++)
{
if($v < $optioncount)
{
$chkname = $node->item($v)->getAttribute("varName");
$values = $node->item($v)->getElementsByTagName("Value")->item(0)->nodeValue;
$title = html_entity_decode($node->item($v)->getElementsByTagName("Title")->item(0)->nodeValue);
echo "<TD class=\"Ans1\">";
echo "<INPUT type=\"checkbox\" name=\"$chkname\" id=\"$chkname\" value=\"$values\" onclick=\"\" /><label for=\"$chkname\">".$title."</label></TD>";
$v++;
}
else
{
echo "<TD class=\"Ans1\">&nbsp;</TD>";
}
}
echo "</TR>";
}
echo "</TABLE>";
}
*/
?>