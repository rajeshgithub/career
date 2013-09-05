function validate()
{
	var chkVar = true;

	rfr = get_id("RFR").value;

	if(chkVar==true)
	{
		chkVar = isFilledSelect("ddlState","0",'Please select state.',0);
	}
	if(chkVar==true)
	{
		chkVar = isFilledSelect("d2","0",'Please select your age.',0);
	}
	if(chkVar==true)
	{
		chkVar = isFilledSelect("d1","0",'Please select gender.',0);
	}

	if(chkVar==true)
	{
		chkVar = isFilledSelect("d3","0",'Please select your highest level of education.',0);
	}

	if(chkVar==true)
	{
		chkVar = isFilledSelect("a6","0",'Please select the type of mobile handset you have.',0);
	}
	if(chkVar==true)
	{
		chkVar = isFilledSelect("a7","0",'Please select the mobile handset brand you have.',0);
	}

	if(chkVar==true)
	{
		chkVar = validateCheckbox('a4_1,a4_2,a4_3,a4_4',1,4,'Please select on which all devices do you regularly access the internet.');
	}
	if(chkVar==true)
	{
		chkVar = isFilledSelect("a4_m","0",'Please select on which of the device you access the internet most.',0);
	}

	if(chkVar==true)
	{
		chkcollect = document.getElementsByName("a5[]");
		len =chkcollect.length;
		flag = false;
		for(i=0;i<len;i++)
		{
			chkid = chkcollect[i];
			if(chkid.checked)
			{
				flag = true;
				break;
			}
		}
		if(flag==false)
		{
			alert("Please select what all internet activities do you currently undertake.");
			chkcollect[0].focus();
			chkVar = false;
		}
	}
	if(chkVar==true)
	{
		chkVar = isFilledText('a1','','Please specify your first friend name.');
	}
	if(chkVar==true)
	{
		for(i=1;i<=3;i++)
		{
			tvar = "a1_" + i;
			msg = "Please specify word/phrase for first friend.";
			chkVar = isFilledText(tvar,'',msg);
			if(chkVar==false)
			{
				break;
			}
		}
	}

	if(chkVar==true)
	{
		chkVar = isFilledText('a2','','Please specify your second friend name.');
	}
	if(chkVar==true)
	{
		for(i=1;i<=3;i++)
		{
			tvar = "a2_" + i;
			msg = "Please specify word/phrase for second friend.";
			chkVar = isFilledText(tvar,'',msg);
			if(chkVar==false)
			{
				break;
			}
		}
	}

	if(chkVar==true)
	{
		chkVar = isFilledText('a3','','Please specify your third friend name.');
	}

	if(chkVar==true)
	{
		for(i=1;i<=3;i++)
		{
			tvar = "a3_" + i;
			msg = "Please specify word/phrase for third friend.";
			chkVar = isFilledText(tvar,'',msg);
			if(chkVar==false)
			{
				break;
			}
		}
	}
	if(chkVar==true)
	{
		if(rfr!='Ym' && rfr!="Com")
		{
			chkVar = isFilledText("Emailid",'','Please type your Email id.');
			if(chkVar==true)
			{
				chkVar  =  checkSpace("Emailid","You can\'t include blank space(s) to Email id.");
			}
			if(chkVar==true)
			{
				chkVar  =  isEmailAddr("Emailid",'Please type correct Email id.');
			}
		}
	}
	return chkVar;
}