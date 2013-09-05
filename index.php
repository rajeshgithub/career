<?php
require("config.php");
require("htmlfunction.php");

$sessionid = session_id();
$b_det = getBrowserDetails();
$bname = $b_det[0];
$bver = $b_det[1];
$ip = getClientIP();
/*
$SQL = "SELECT SessionId FROM `jc_career_data` WHERE SessionId='".$sessionid."' LIMIT 0,1";
$rs = mysql_query($SQL);
if(mysql_num_rows($rs)==0)
{
	$SQL = "INSERT INTO `jc_career_data`(start_time,session_id,ip) VALUES(now(),'".$sessionid."','".$ip."')";
	if(!mysql_query($SQL))
	{

		die("There is some database error ".mysql_error());

	}
}
mysql_close($objConn);
*/
?>

<HTML>
	<HEAD>
	<META name="robots" content="noindex,nofollow,noarchive">
	<META http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<TITLE>Juxt - Career</TITLE>
		<LINK rel="stylesheet" type="text/css" href="css/htmcss.css"></LINK>
		<SCRIPT src="js/gen_validation.js" type="text/javascript"></SCRIPT>
		<SCRIPT src="js/CityDistrict.js" type="text/javascript"></SCRIPT>
		<SCRIPT src="js/validatePage.js" type="text/javascript"></SCRIPT>
	</HEAD>
<!--
<BODY onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="">
onsubmit="return validate_home();"
-->
<BODY onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="">
<CENTER>

<FORM name="form1" id="form1" class="formsetting" method="POST" action="ServerPage1.php" onsubmit="return validate();">
<DIV style="display:none;">
	<INPUT type="hidden" name="SessionId" id="SessionId" value="<?php echo $sessionid ?>" />
</DIV>

<TABLE width="900px" cellpadding="0" cellspacing="0" border="0">
<TR>
<TD>
<span class="normText">
<b><1st Level Assessment Form></b>
<br/>
Hi,
<br/>
Thanks for considering us. 
<br/>
We follow a simple process, everyone interested to work with us or we are evaluating to hire need to first fill this 1st level assessment form. Then we conduct a telephonic round, after those two we decide to meet across table and evaluate before making a final offer.
<br/>
We will be glad if you can fill the following form for us, we know, if you are serious about joining us you will find the time to fill it.
<br/>
(Note: This is not a self paced system, please either fill the answers now, or prepare and fill it later, but in one go.)
<br/>
<br/>
Once again thanks,
Mrutyunjay
<hr>
</span>
</TD>
</TR>
</TABLE>

<TABLE width="900px" cellpadding="0" cellspacing="0" border="0">
<TR><TD class="Sec2">About you</TD></TR>
</TABLE>

<TABLE width="900px" border="0" cellpadding="0" cellspacing="1" class="backwhite">
	<TR>
		<TD width="113" class="Que2">Name</TD>
		<TD width="292" class="Ans2">
			<INPUT type="text" name="uname" id="uname" class="textbox" size="30" />
		</TD>
		<TD width="53" class="Que2">Email-Id</TD>
		<TD width="157" class="Ans2">
		<INPUT type="textbox" name="emailid" id="emailid" class="textbox" size="45"/>
		</TD>
	</TR>
</TABLE>

<TABLE width="900px" border="0" cellpadding="0" cellspacing="1" class="backwhite">
	<TR>
		<TD class="Que2" colspan="2">
		Your social presence (if you don't specify then we will assume you don't have one and the consequence thereof. Its ok, don't create one now.):
		</TD>
	</TR>
	<TR>
		<TD width="113" class="Que2">Your Linkedin public profile link</TD>
		<TD width="292" class="Ans2">
			<INPUT type="text" name="linkedin" id="linkedin" class="textbox" size="30" />
		</TD>
	</TR>	
	<TR>
		<TD width="113" class="Que2">Your Twitter handle</TD>
		<TD width="292" class="Ans2">
			<INPUT type="text" name="twitter" id="twitter" class="textbox" size="30" />
		</TD>
	</TR>	
	<TR>
		<TD width="113" class="Que2">Your Quora handle</TD>
		<TD width="292" class="Ans2">
			<INPUT type="text" name="quora" id="quora" class="textbox" size="30" />
		</TD>
	</TR>	
	<TR>
		<TD width="113" class="Que2">Number of facebook friends you have</TD>
		<TD width="292" class="Ans2">
			<INPUT type="text" name="fb_friends" id="fb_friends" class="textbox" size="30" />
		</TD>
	</TR>		
</TABLE>

<TABLE width="900px" border="0" cellpadding="0" cellspacing="1"  class="backwhite">
	<TR>
		<TD class="Que2" width="461">Are you open to relocate to Delhi?</TD>
		<TD class="Ans2" width="436">
		<?php
		AddDropDown("location.xml","location");
		?>
		</TD>
	</TR>
</TABLE>

<DIV id="div_other_loc" style="display:none;">
<TABLE width="900px" border="0" cellpadding="0" cellspacing="1"  class="backwhite">
	<TR>
		<TD class="Que2">Please specify detailed reason for choosing this city?</TD>
	</TR>
	<TR>
		<TD class="Ans2">
		<textarea rows="2" cols="108" name="loc_reason" id="loc_reason"></textarea>
		</TD>
	</TR>
</TABLE>
</DIV>


<TABLE width="900px" cellpadding="0" cellspacing="1" border="0" class="backwhite">
	<TR>
		<TD class="Que2" width="900px">What all internet activities do you currently undertake from your mobile?</TD>
	</TR>
	<TR>
		<TD class="Ans2" width="900px">
		<?php
		AddCheckBox("job_role.xml",'N',"Ans2","#FFB37F","1","0","2","3",'100%','',false,'','1');
		?>
		</TD>
	</TR>
</TABLE>

<DIV id="div_research" style="display:none;">
<TABLE width="900px" cellpadding="0" cellspacing="1" border="0" class="backwhite">
	<TR>
		<TD class="Que2" width="900px">Your interest areas in Market Research Service?</TD>
	</TR>
	<TR>
		<TD class="Ans2" width="900px">
		<?php
		AddCheckBox("market_research.xml",'N',"Ans2","#FFB37F","1","0","4","2",'100%','',false,'','1');
		?>
		</TD>
	</TR>
</TABLE>
</DIV>

<TABLE width="900px" cellpadding="0" cellspacing="0" border="0">
<TR><TD class="Sec2">Help us know you better</TD></TR>
</TABLE>

<TABLE width="900px" border="0" cellpadding="0" cellspacing="1"  class="backwhite">
	<TR>
		<TD class="Que2" width="450">How did you come to know about <b>Juxt</b>?</TD>
		<TD class="Ans2">
		<textarea rows="1" cols="51" name="know_juxt" id="know_juxt"></textarea>
		</TD>
	</TR>
	<TR>
		<TD class="Que2" width="450">Why did you decide to apply to <b>Juxt</b>?<br/><span class="bluetext">&nbsp;(Eg. Is it part of a regular job search you are doing or you have reason for applying to Juxt? What reason?) (we love long answers)</span></TD>
		<TD class="Ans2">
		<textarea rows="1" cols="51" name="why_apply" id="why_apply"></textarea>
		</TD>
	</TR>
	<TR>
		<TD class="Que2" width="450">What is it that you know about <b>Juxt</b>?<br/><span class="bluetext">&nbsp;(Eg. Nature of our business? What is that we do a regular basis? In your perception, how big is the team?) (we love long answers)</span></TD>
		<TD class="Ans2">
		<textarea rows="1" cols="51" name="bis_nature" id="bis_nature"></textarea>
		</TD>
	</TR>
	<TR>
		<TD class="Que2" width="450">Why are you interested in market research?<br/><span class="bluetext">&nbsp;(We love long answers, we also have a dictionary of answers built through this question)</span></TD>
		<TD class="Ans2">
		<textarea rows="1" cols="51" name="interest" id="interest"></textarea>
		</TD>
	</TR>
	<TR>
		<TD class="Que2" width="450">What all work are you good at?<br/><span class="bluetext">&nbsp;(You can create list including everything on earth you think you are good at, including digging a right size whole to plant a banana tree) (List as many as you can, must fill an A4 size page)</span></TD>
		<TD class="Ans2">
		<textarea rows="1" cols="51" name="work_skill" id="work_skill"></textarea>
		</TD>
	</TR>
	<TR>
		<TD class="Que2" width="450">How do you think you can add value at <b>Juxt</b>?<br/><span class="bluetext">&nbsp;(We love long but straight, well thought through answers)</span></TD>
		<TD class="Ans2">
		<textarea rows="1" cols="51" name="add_value" id="add_value"></textarea>
		</TD>
	</TR>
	<TR>
		<TD class="Que2" width="450">Why <b>Juxt</b> should hire you?<br/><span class="bluetext">&nbsp;(We love long answers but you better be candid)</span></TD>
		<TD class="Ans2">
		<textarea rows="1" cols="51" name="why_hire" id="why_hire"></textarea>
		</TD>
	</TR>
	<TR>
		<TD class="Que2" width="450">Your expected salary per month (in hand after tax)?<br/><span class="bluetext">&nbsp;(we want a short answer, after tax in hand per month number in INR)</span></TD>
		<TD class="Ans2">
		<INPUT type="text" name="exp_salary" id="exp_salary" class="textbox" size="30" />
		</TD>
	</TR>
</TABLE>

<TABLE width="900px" border="0" cellpadding="0" cellspacing="1"  class="backwhite">
	<TR>
		<TD class="Que2" width="550">If you are selected, after the interview process, how quickly will you be able to join?</TD>
		<TD class="Ans2" width="350">
		<?php
		AddDropDown("join_time.xml","join_time");
		?>
		</TD>
	</TR>
</TABLE>

<TABLE width="900px" cellpadding="0" cellspacing="1" border="0" class="backwhite">
	<TR>
		<TD class="Que2" width="900px">Your interest areas in Market Research Service?</TD>
	</TR>
	<TR>
		<TD class="Ans2" width="900px">
		<?php
		AddCheckBox("explain_you.xml",'N',"Ans2","#FFB37F","1","0","9","3",'100%','',false,'','1');
		?>
		</TD>
	</TR>
</TABLE>

<DIV id="div_continue" style="display:block">
<TABLE width="900px" cellpadding="4" cellspacing="1" border="0">
	<TR class="backwhite">
		<TH><INPUT type="image" src="images/button/submit.gif"/></TH>
	</TR>
</TABLE>
</DIV>

<DIV id="lastItem"></DIV>
</FORM>
</CENTER>
</BODY>

<SCRIPT type="text/javascript">
get_id("location").onchange = function ()
{
	if(this.value!=1)
	{
		get_id("div_other_loc").style.display = 'block';
	}
	else
	{
		get_id("div_other_loc").style.display = 'none';
	}
}

get_id("job_1").onchange = function ()
{
	if(this.checked==true)
	{
		get_id("div_research").style.display = 'block';
	}
	else
	{
		get_id("div_research").style.display = 'none';
	}
}
</SCRIPT>
</HTML>