function noBack()
{
	window.history.forward();
}

String.prototype.trim = function()
{
	var x = this;
	x = x.replace(/^\s*(.*)/, "$1");
	x = x.replace(/(.*?)\s*$/, "$1");
	return x;
}

//Email Validation
function isEmailAddr(email, errMsg)
{
	var result = false;
	email = get_id(email);
	var theStr = new String(email.value);
	var index = theStr.indexOf("@");
	if (index > 0)
	{
		var pindex = theStr.indexOf(".",index);
		if ((pindex > index+1) && (theStr.length > pindex+1))
		{
			result = true;
		}
	}
	if(result == false)
	{
		alert(errMsg);
		email.focus();
	}
	return result;
}

//Validate checkbox
function validateCheckbox(chkvarnames,reqCount,optioncount,errMsg)
{
	var temp = false;
	varArray = chkvarnames.split(",");
	checkedcount = 0;
	for(i=0; i<optioncount;i++)
	{
		chkname = varArray[i];
		chkVar1= get_id(chkname).checked;
		if(chkVar1== true)
		{
			checkedcount++;
		}
	}
	if(checkedcount < reqCount )
	{
		alert(errMsg);
		get_id(varArray[0]).focus();
		return false;
	}
	else
	{
		return true;
	}
};

//Check Blank Space
function checkSpace(id,msg)
{
	var alpha;
	var flag = true;
	str = trim(get_id(id).value);
	for (i = 0; i < str.length; i++)
	{
		alpha = str.charAt(i);
		if(alpha==" " || alpha=="")
		{
			alert(msg);
			get_id(id).focus();
			flag = false;
			break;
		}
	}
	return flag;
}

//Validate Numeric Value
function isNumeric(st, errMsg)
{
	var Char;
	if(!(st))
	{
		st = get_id(st);
	}
	sText = st.value;
	var IsNumeric = true;
	var blnk = "0123456789.-";
	var blnkcnt = 0;
	for (i = 0; i < sText.length; i++)
	{
		Char = sText.charAt(i);
		if (blnk.indexOf(Char) == -1)
		{
			IsNumeric = false;
		}
	}
	if(IsNumeric == false)
	{
		if(errMsg != '')
		{
			alert(errMsg);
			st.focus();
		}
	}
	return IsNumeric;
}

//Value is numeric
function isAnyNumeric(st, mode, errMsg)
{
	// Function to check if user input has any Numeric value.
	// For example, user enters 1232s324 OR sw23232 OR 2342343sdhs, it would return TRUE.
	// But if user enters "asgshsgd", it would return FALSE
	var Char;
	var chkMode = mode;
	st =  get_id(st);
	sText = st.value;
	var IsNumeric = false;
	var blnk = "0123456789.-";
	var blnkcnt = 0;
	for (i = 0; i < sText.length; i++)
	{
		Char = sText.charAt(i);
		if (blnk.indexOf(Char) > -1)
		{
			IsNumeric = true;
		}
	}
	if(IsNumeric == chkMode)
	{
		if(errMsg != '')
		{
			alert(errMsg);
			st.focus();
		}
		return false;
	}
	else
	{
		return true;
	}
}

//Remove all option from the drop down list
function removeAllOptions(selectbox)
{
	var i;
	for(i=selectbox.options.length-1;i>=0;i--)
	{
		//selectbox.options.remove(i);
		selectbox.remove(i);
	}
}

//Add Option Dropdown
function addOption(selectbox, value, text )
{
	var optn = document.createElement("OPTION");
	optn.text = text;
	optn.value = value;
	sel = document.getElementById(selectbox);
	sel.options.add(optn);
}

//Remove Option Dropdown
function removeOption(sel,value)
{
	var i;
	selectbox = document.getElementById(sel);
	for(i=selectbox.options.length-1;i>=0;i--)
	{
		if(selectbox.options[i].value==value)
		{
			selectbox.remove(i);
		}
	}
}

//Validate text box is filled or not
function isFilledText(textbox, spStr, errMsg)
{
	var strVal;
	textbox = get_id(textbox);
	strVal = textbox.value;
	strVal = trim(strVal);
	if((strVal=='') || (strVal==spStr))
	{
		if(errMsg != '')
		{
			alert(errMsg);
			textbox.focus();
		}
		return false;
	}
	else
	{
		return true;
	}
}

//Is filled email
function isFilledEmail(textbox, spStr, errMsg)
{
	var strVal;
	textbox =  get_id(textbox);
	strVal = textbox.value;
	strVal = trim(strVal);
	if((strVal=='') || (strVal==spStr))
	{
		if(errMsg != '')
		{
			alert(errMsg);
			textbox.focus();
		}
		return false;
	}
	else
	{
		v=isEmailAddr(textbox, errMsg);
		return v;
	}
}

//Is filled numeric
function isFilledNumeric(textbox, spStr, errMsg)
{
	var strVal;
	textbox =  get_id(textbox);
	strVal = textbox.value;
	strVal = trim(strVal);
	if((strVal=='') || (strVal==spStr))
	{
		if(errMsg != '')
		{
			alert(errMsg);
			textbox.focus();
		}
		return false;
	}
	else
	{
		v=isNumeric(textbox,errMsg);
		return v;
	}
}

//Is drop down selected
function isFilledSelect(selectbox, spStr, errMsg, cmpOpt)
{
	// Possible values for cmpOpt are
	// 0 when values are supposed to be compared but in numbers, variable spStr is mentioned in number
	// 1 when text needs to be compared, variable spStr is mentioned in text
	// 2 when values are supposed to be compared but in text, variable spStr is mentioned in text
	var strVal;
	if(cmpOpt == 0)
	{
		selectbox = get_id(selectbox);
		strVal = selectbox.selectedIndex;
		if(strVal==spStr)
		{
			alert(errMsg);
			selectbox.focus();
			return false;
		}
		else
		{
			return true;
		}
	}
	else if(cmpOpt == 1)
	{
		strVal = selectbox.options[selectbox.selectedIndex].text;
		spStr = trim(spStr);
		if(strVal==spStr)
		{
			alert(errMsg);
			selectbox.focus();
			return false;
		}
		else
		{
			return true;
		}
	}
	else if(cmpOpt == 2)
	{
		strVal = selectbox.options[selectbox.selectedIndex].value;
		spStr = trim(spStr);
		if(strVal==spStr)
		{
			alert(errMsg);
			selectbox.focus();
			return false;
		}
		else
		{
			return true;
		}
	}
}

//If checkbox checked
function isCBoxChecked(checkBox, numChecked, errMsg, countCBox)
{
	var numCBox, chkTemp, chkCount;
	if(countCBox == 1)
	{
		if(checkBox.checked == false)
		{
			if(errMsg != "")
			{
				alert(errMsg);
				checkBox.focus();
			}
			return false;
		}
		else
		{
			return true;
		}
	}
	else
	{
		chkTemp = false;
		chkCount = 0;
		numCBox = checkBox.length;
		for(i=0;i<numCBox;i++)
		{
			if(checkBox[i].checked == true)
			{
				chkCount++;
				if(chkCount==numChecked)
				{
					chkTemp = true;
				}
			}
		}
		if(chkTemp==false)
		{
			if(errMsg != "")
			{
				alert(errMsg);
			}
		}
		return chkTemp;
	}
}

//Compare two strings
function compareString(strObject1, strObject2, objType)
{
	var str1, str2;
	var isEqual = false;
	if(objType == "Text")
	{
		str1 = strObject1.value;
		str1 = trim(str1);
		str2 = strObject2.value;
		str2 = trim(str2);
		if(str1 == str2)
		{
			isEqual = true;
		}
	}
	else if(objType == "Select")
	{
		str1 = strObject1.options[strObject1.selectedIndex].text;
		str1 = trim(str1);
		str2 = strObject2.options[strObject2.selectedIndex].text;
		str2 = trim(str2);
		if(str1 == str2)
		{
			isEqual = true;
		}
	}
	return isEqual;
}

//Generate string for different form values
function createStrSubmit(frmName)
{
	var strSubmit = "";
	var currElement, lstElement;
	lstElement = "";
	for(i=0; i<frmName.elements.length; i++)
	{
		currElement = frmName.elements[i];
		switch(currElement.type)
		{
			case 'text':
			case 'select-one':
			case 'hidden':
			case 'password':
			case 'textarea':
			strSubmit += currElement.name + '=' + escape(currElement.value) + '&'
			break;
			case 'checkbox':
			if(currElement.checked == true)
			{
				if(lstElement != currElement.name)
				{
					strSubmit += currElement.name + '=' + escape(trim(currElement.value)) + '&'
				}
				else
				{
					if(strSubmit.substring(strSubmit.length - 1, strSubmit.length) == '&')
					strSubmit = strSubmit.substring(0, strSubmit.length - 1)
					strSubmit += ',' + escape(currElement.value)
				}
				lstElement = currElement.name
			}
			break;
		}
		if(strSubmit.substring(strSubmit.length - 1, strSubmit.length) != '&')
		{
			strSubmit += '&';
		}
	}
	if(strSubmit.substring(strSubmit.length - 1, strSubmit.length) == '&')
	{
		strSubmit = strSubmit.substring(0,strSubmit.length-1);
	}
	return strSubmit;
}

//Check for all form fields
function checkFormAllFields(frmName)
{
	var strSubmit = true;
	var currElmVal;
	var currI = -1;
	for(i=0; i<frmName.elements.length; i++)
	{
		currElement = frmName.elements[i];
		switch(currElement.type)
		{
			case 'text':
			case 'select-one':
			case 'password':
			case 'textarea':
			case 'checkbox':
			currElmVal = currElement.value;
			currElmVal = trim(currElmVal);
			if(escape(currElmVal) == "")
			{
				if(strSubmit == true)
				{
					currI = i;
				}
				strSubmit = false;
			}
			break;
		}
	}
	if(strSubmit == false)
	{
		alert('No field can be left blank.');
		currElement = frmName.elements[currI];
		currElement.focus();
	}
	return strSubmit;
}

//Check for special characters
function chkspChar(str)
{
	var alpha;
	var flag= true;
	for (i = 0; i < str.length; i++)
	{
		alpha = str.charAt(i);
		if(!((alpha>="A" && alpha<="Z") || (alpha>="a" && alpha<="z") || (alpha>="0" && alpha<="9")))
		{
			flag=false;
			break;
		}
	}
	return flag;
}

//Allow only numeric data
function _allowNumeric(e)
{
	var keyp;
	keyp = getKeyCode(e);

	if(keyp >= 48 && keyp <= 57)
	{
		return true;
	}
	else if(keyp == null)
	{
		return true;
	}
	else
	{
		if(keyp == 8 || keyp == 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
};

//Only Alpha allowed
function isAlpha(st,errMsg)
{
	str = st.value;
	flag=true;
	for (i = 0; i < str.length; i++)
	{
		alpha = str.charAt(i);
		if(!((alpha>="A" && alpha<="Z") || (alpha>="a" && alpha<="z") || (alpha=='_')))
		{
			if(errMsg!='')
			{
				alert(errMsg);
				st.focus();
			}
			flag=false;
			break;
		}
	}
	return flag;
};

//Is filled and alpha
function isFilledAlpha(textbox, spStr, errMsg)
{
	var strVal;
	textbox = get_id(textbox);
	strVal = textbox.value;
	strVal = trim(strVal);
	if((strVal=='') || (strVal==spStr))
	{
		if(errMsg != '')
		{
			alert(errMsg);
			textbox.select();
		}
		return false;
	}
	else
	{
		v=isAlpha(textbox,errMsg);
		return v;
	}
};

//Only Alpha Numeric allowed
function isAlphaNumeric(st,errMsg)
{
	str = st.value;
	flag=true;
	for (i = 0; i < str.length; i++)
	{
		alpha = str.charAt(i);
		if(!((alpha>="A" && alpha<="Z") || (alpha>="a" && alpha<="z") || (alpha>="0" && alpha<="9")))
		{
			if(errMsg!='')
			{
				alert(errMsg);
				st.select();
			}
			flag=false;
			break;
		}
	}
	return flag;
};

//Is filled and alphanum
function isFilledAlphaNum(textbox, spStr, errMsg)
{
	var strVal;
	strVal = textbox.value;
	strVal = trim(strVal);
	if((strVal=='') || (strVal==spStr))
	{
		if(errMsg != '')
		{
			alert(errMsg);
			textbox.select();
		}
		return false;
	}
	else
	{
		v=isAlphaNumeric(textbox,errMsg);
		return v;
	}
};

//Is 1 option selected from option list
function isRadioSelected(radio,errMsg)
{
	robj = document.forms[0].elements[radio];
	if(robj.length > 0)
	{
		flag = false;
		for(var i=0;i<robj.length;i++)
		{
			if(robj[i].checked == true)
			{
				flag = true;
				break;
			}
		}
		if(flag==false)
		{
			if(errMsg!='')
			{
				alert(errMsg);
			}
			robj[0].focus();
		}
	}
	return flag;
};

//Short cut for document.getElementById function
function get_id(element)
{
	if(document.getElementById(element))
	{
		return document.getElementById(element);
	}
	else
	{
		return false;
	}
};

//Return form elements value
function $F(element)
{
	if(get_id(element).value)
	{
		return get_id(element).value;
	}
	else
	{
		return false;
	}
};

function trim(s)
{
	var l=0; var r=s.length -1;
	while(l < s.length && s[l] == ' ')
	{	l++; }
	while(r > l && s[r] == ' ')
	{	r-=1;	}
	return s.substring(l, r+1);
};

function getKeyCode(e)
{
	if (window.event)
	{
		return window.event.keyCode;
	}
	else if (e)
	{
		return e.which;
	}
	else
	{
		return null;
	}
};

//Allow true alpha space backspace and del
function _allowAlpha(e)
{
	var keyp;
	keyp = getKeyCode(e);
	if((keyp>=65 && keyp<=90) || (keyp>=97 && keyp<=122) || keyp==32 || keyp==8 || keyp==0)
	{
		return true;
	}
	else if(keyp == null)
	{
		return true;
	}
	else
	{
		return false;
	}
};

//Allow alpha and numeric
function _allowAlphaNumeric(e)
{
	var keyp;
	keyp = getKeyCode(e);
	if((keyp>=65 && keyp<=90) || (keyp>=97 && keyp<=122)  || keyp==8 || keyp==0 ||(keyp>=48 && keyp<=57) || (keyp==95))
	{
		return true;
	}
	else if(keyp == null)
	{
		return true;
	}
	else
	{
		return false;
	}
};

//numeric with dot and numbers
function _allowNumeric2(e)
{
	var keyp;
	keyp = getKeyCode(e);
	if(keyp >= 46 && keyp <= 57)
	{
		return true;
	}
	else if(keyp == null)
	{
		return true;
	}
	else
	{
		if(keyp == 8 || keyp == 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
};

//check if more than 1 decimal point in number
function checkDecimal(str)
{
	var alpha;
	var dot = 0;
	var slash = 0;
	for (i = 0; i < str.length; i++)
	{
		alpha = str.charAt(i);
		if(alpha==".")
		{
			dot++;
		}
		if(alpha=="/")
		{
			slash++;
		}
	}
	if(dot>1 || slash>0)
	{
		alert("The value you have enetered contains incorrect data.");
	}
}

function _allowAlphaNumericSpace(e)
{
	var keyp;
	keyp = getKeyCode(e);
	if((keyp>=65 && keyp<=90) || (keyp>=97 && keyp<=122)  || keyp==8 || keyp==0 ||(keyp>=48 && keyp<=57) || (keyp==95) || (keyp==32))
	{
		return true;
	}
	else if(keyp == null)
	{
		return true;
	}
	else
	{
		return false;
	}
};

//Returns true if all checkboxes are checked
function returnAllChecked(chkname)
{
	var countchk = chkname.length;
	var check = true;
	for(i=0;i<countchk;i++)
	{
		if(chkname[i].checked == false)
		{
			var check = false;
			break;
		}
	}
	return check;
};

//Return true only if any 1 of checkbox is checked (Array form)
function returnAnyChecked(chkname)
{
	var countchk = chkname.length;
	var check = false;
	for(i=0;i<countchk;i++)
	{
		if(get_id(chkname[i]).checked == true)
		{
			check = true;
			break;
		}
	}
	return check;
};

//Return true only if any 1 checkbox is checked (Var str, and count)
function anyCheckedStr(chkname,countchk)
{
	var check = false;
	for(i=1;i<=countchk;i++)
	{
		chk = chkname + "_" + i;
		if(get_id(chk).checked == true)
		{
			check = true;
			break;
		}
	}
	return check;
};

//Checks for duplicate values selected in 2 dropdowns
function _checkDuplicateAct(d1,d2,d3,dropcount)
{
	v1 = document.getElementById(d1);
	v2  = document.getElementById(d2);
	if(dropcount==3)
	{
		v3 = document.getElementById(d3);
	}
	if(!(v1.value==97 || v1.value==98 || v1.value==0))
	{
		if(dropcount==3 && (v1.value==v2.value || v1.value==v3.value))
		{
			alert("you have already selected this option");
			v1.selectedIndex = 0;
		}
		else if(dropcount==2 && (v1.value==v2.value))
		{
			alert("you have already selected this option");
			v1.selectedIndex = 0;
		}
	}
}

/*
get_id("c10_1").onchange = function(){ duplicate5(this,this.value,"c10_2","c10_3","c10_4","c10_5"); }
get_id("c10_2").onchange = function(){ duplicate5(this,this.value,"c10_1","c10_3","c10_4","c10_5"); }
get_id("c10_3").onchange = function(){ duplicate5(this,this.value,"c10_2","c10_1","c10_4","c10_5"); }
get_id("c10_4").onchange = function(){ duplicate5(this,this.value,"c10_2","c10_3","c10_1","c10_5"); }
get_id("c10_5").onchange = function(){ duplicate5(this,this.value,"c10_2","c10_3","c10_4","c10_1"); }
*/
function duplicate5(cur_drop,value,d1,d2,d3,d4)
{
	v1 = get_id(d1).value;
	v2 = get_id(d2).value;
	v3 = get_id(d3).value;
	v4 = get_id(d4).value;
	if(value!=0)
	{
		if(v1==value || v2==value || v3==value || v4==value)
		{
			alert("You have already selected this option");
			cur_drop.selectedIndex = 0;
		}
	}
}

function duplicate4(cur_drop,value,d1,d2,d3)
{
	v1 = get_id(d1).value;
	v2 = get_id(d2).value;
	v3 = get_id(d3).value;
	if(value!=0)
	{
		if(v1==value || v2==value || v3==value)
		{
			alert("You have already selected this option");
			cur_drop.selectedIndex = 0;
		}
	}
}
//Uncheck all the checkbox (Var str, and count)
function uncheckAll(id,count)
{
	for(i=1;i<=count;i++)
	{
		chkid = id+"_"+i;
		get_id(chkid).checked = false;
	}
}

function checkFilled(txt_id,msg)
{
	if(get_id(txt_id).value=='' || get_id(txt_id).value==' ')
	{
		get_id(txt_id).style.color = '#a0a0a0';
		get_id(txt_id).value = msg;
	}
}

function removeDefault(txt_id,msg)
{
	txtstr = get_id(txt_id).value;
	//if(get_id(txt_id).value==msg || get_id(txt_id).value=='')
	if(txtstr.search(msg)!=-1 || get_id(txt_id).value=='')
	{
		get_id(txt_id).style.color = '#000000';
		get_id(txt_id).value = '';
	}
}

//Return the number of option checked in the checkbox list (Var str, and count)
function countChecked(id,count)
{
	chkcount = 0;
	for(i=1;i<=count;i++)
	{
		chkid = id+"_"+i;
		if(get_id(chkid).checked)
		{
			chkcount++;
		}
	}
	return chkcount;
}

//
function checknoneArr(chkidArr,value)
{
	chkcollect = document.getElementsByName(chkidArr);
	len =chkcollect.length;
	noneid = chkcollect[chkcollect.length-1];
	if(value!=98)
	{
		cid =  chkcollect[value-1];
		if(cid.checked)
		{
			if(noneid.checked)
			{
				alert("You can\'t select any other option dd with \'None\' option");
				cid.checked = false;
			}
		}
	}
	else
	{
		for(i=0;i<(len-1);i++)
		{
			chkid = chkcollect[i];
			if(chkid.checked)
			{
				alert("You can\'t select \'None\' option with any other option");
				noneid.checked = false;
				break;
			}
		}
	}
}

//Restricts for checkbox selected with none option or vice versa
function checknone(id,value,countchk,qid)
{
	prevar = id.substr(0,1);
	noneid = prevar + qid + "_" + countchk;
	if(value!=98 && value!=99)
	{
		if(get_id(id).checked)
		{
			if(get_id(noneid).checked)
			{
				alert("You can\'t select any other option with \'None\' option");
				get_id(id).checked = false;
			}
		}
	}
	else
	{
		for(i=1;i<countchk;i++)
		{
			chkid = prevar + qid + "_" + i;
			if(get_id(chkid).checked)
			{
				alert("You can\'t select \'None\' option with any other option");
				get_id(noneid).checked = false;
				break;
			}
		}
	}
}

//Generate Ajax Object
function getAjaxObj()
{
	var AjaxObj = null;
	try
	{
		// Firefox, Opera 8.0+, Safari
		AjaxObj = new XMLHttpRequest();
	}
	catch (e)
	{
		// Internet Explorer
		try
		{
			AjaxObj = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			AjaxObj = new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	return AjaxObj;
};

//Toggle CWE function for home page
function toggleCWE(value)
{
	var chkvar = false;
	if(value==2)
	{
		chkvar = true ;
	}
	if(chkvar == true)
	{
		if(get_id('div_cwe_relation').style.display == 'none')
		{
			get_id('div_cwe_relation').style.display = 'block';
		}
	}
	else
	{
		get_id('div_cwe_relation').style.display = 'none';
		get_id('D8A_d').selectedIndex = 0;
		get_id('d9').selectedIndex = 0;
		get_id('d10').selectedIndex = 0;
	}
}


//Ajax call to check existing email id in survey data
ObjAjax = getAjaxObj();
function checkmailId(mid)
{
	mid = trim(mid);
	myRandom = parseInt(Math.random()*99999999);
	ObjAjax.open("GET","chekmailid.php?rand=" + myRandom + "&mid=" + mid);
	ObjAjax.onreadystatechange = function _httpchekmailId()
	{
		if(ObjAjax.readyState == 4)
		{
			strResponse = ObjAjax.responseText;
			if(strResponse.indexOf("yes") > -1)
			{
				get_id("div_mail_exist").style.display = 'block';
				get_id("div_continue").style.display = 'none';
				get_id("Emailid").select();
			}
			else
			{
				get_id("div_mail_exist").style.display = 'none';
				get_id("div_continue").style.display = 'block';
			}
			ObjAjax = null;
			ObjAjax = getAjaxObj();
		}
	}
	ObjAjax.send(null);
	return false;
}

//Show hide other option div for dropdown value selected
function showHideOther_Drp(value,divid,txtoth)
{
	if(value==97)
	{
		get_id(divid).style.display = "block";
		get_id(txtoth).focus();
	}
	else
	{
		get_id(divid).style.display = "none";
		get_id(txtoth).value = '';
	}
}

//Show hide other option div for checkbox checked
function showHideOther_Chk(id,ind,divid)
{
	chkid = id + "_"+ind;
	chkoth = id + "_oth";
	if(get_id(chkid).checked)
	{
		get_id(divid).style.display = "block";
		get_id(chkoth).focus();
	}
	else
	{
		get_id(divid).style.display = "none";
		get_id(chkoth).value = '';
	}
}

/*--------------dynamic table rows--------------*/
var checked_arr = new Array();
//var txt10;
var index = 0;
var checked_value = new Array();
function  AddRoww(chkid, chk_val, chk_title)
{
	if(get_id(chkid).checked==true)
	{
		checked_arr[index] = chk_title;
		checked_value[index] = chkid+"_"+chk_val;
		index++;
	}
	else
	{
		for(i=0;i<checked_arr.length;i++)
		{
			if(checked_arr[i]==chk_title)
			{
				checked_arr.splice(i,1);
				checked_value.splice(i,1);
				index--;
				break;
			}
		}
	}
	if(checked_arr.length==0)
	{
		get_id("div_dyn_table").style.display='none';
	}
	else
	{
		get_id("div_dyn_table").style.display='block';
	}
	_clearTable(); //CLEAR EVERY ROW
	_renderTable(chk_val,chkid); //RENDER TABLE AND INSERT ROW FROM SELECTED CHECKBOX
}

function _clearTable()
{
	var dynamic_table = document.getElementById("dynamic_table");
	if(dynamic_table.rows.length > 0)
	{
		while(dynamic_table.rows.length > 0)
		{
			dynamic_table.deleteRow(dynamic_table.rows.length-1);
		}
	}
}

function _renderTable(chk_val,chkid)
{
	//txt10=document.getElementById("dynamic_table");
	var optArray = new Array("Social Networking Site (Posted by a friend/friend\'s friend)","By some Blogger in her/his blog","Forums/Discussion Boards","In some consumer Review Websites","Saw in a Video uploaded by someone","Received some RSS feed","Saw a link tagged by a friend","I don\'t remember seeing anything in above places");
	var dynamic_table = document.getElementById("dynamic_table");
	var rowCounter = 0;
	var isFound;
	var currVal;
	for(i=0; i< checked_arr.length; i++)
	{
		var  drpid = checked_value[i];
		strHTML = "&nbsp;<SELECT name='" + drpid + "' id='" + drpid + "' class='dropdown'>";
		strHTML += "<OPTION value='0'>Select One</OPTION>";
		for(k=0;k<optArray.length; k++)
		{
			//alert(k + " = " + optArray[k]);
			strHTML += "<OPTION value='" + (k + 1) + "'>" + optArray[k] + "</OPTION>";
		}
		strHTML += "</SELECT>";

		dynamic_table.insertRow(rowCounter);
		dynamic_table.rows[rowCounter].insertCell(0);
		dynamic_table.rows[rowCounter].cells[0].innerHTML = "&nbsp;"+checked_arr[i] ;
		dynamic_table.rows[rowCounter].cells[0].width ="130px" ;
		dynamic_table.rows[rowCounter].cells[0].className = 'Que2';
		dynamic_table.rows[rowCounter].insertCell(1);
		dynamic_table.rows[rowCounter].cells[1].innerHTML = strHTML;
		dynamic_table.rows[rowCounter].cells[1].width = "400px";
		dynamic_table.rows[rowCounter].cells[1].className = 'Ans2';
		rowCounter++;
	}
}

function getradioCheckedValue(radioObj) {
	if(!radioObj)
	return "";
	var radioLength = radioObj.length;
	if(radioLength == undefined)
	if(radioObj.checked)
	return radioObj.value;
	else
	return "";
	for(var i = 0; i < radioLength; i++) {
		if(radioObj[i].checked) {
			return radioObj[i].value;
		}
	}
	return "";
}

function enableDisableChk(id,count,flag)
{
	for(i=1;i<=count;i++)
	{
		chkid = id + "_" + i;
		if(flag==1)
		{
			get_id(chkid).disabled = false;
		}
		else
		{
			get_id(chkid).checked = false;
			get_id(chkid).disabled = true;
		}
	}
}

function addMost(mdrop,chk,value,title)
{
	if(chk.checked)
	{
		addOption(mdrop,value,title);
	}
	else
	{
		removeOption(mdrop,value);
	}
}

function uncheckAll_arr(arv)
{
	arv = arv + "[]";
	chkcollect = document.getElementsByName(arv);
	len = chkcollect.length;
	for(i=0;i<len;i++)
	{
		chkcollect[i].checked = false;
	}
}

/*
chkbrand = document.getElementsByName("b1[]");
len =chkbrand.length;
flag = false;
if(get_id("a4_oth").value=='' || get_id("a4_oth")==' ')
{
for(i=0;i<len;i++)
{
chkid = chkbrand[i];
if(chkid.checked)
{
flag = true;
break;
}
}
if(flag==false)
{
if(get_id("a4_oth").value=='' || get_id("a4_oth")==' ')
{
alert("Please select which all other online ads do you remember");
get_id("a4_oth").focus();
chkVar = false;
}
}
}
*/
/*

function getDynamicTable(qtext,cvar,varcount,tablediv)
{
var optArray = new Array("Amazon","Ebay.in","Fashionandyou.com","Flipkart.com","FutureBazaar.com","Homeshop18.com","Indiaplaza.in","Shopping.IndiaTimes.com","Infibeam.com","Letsbuy.com","Myntra.com","Shopping.Rediff.com","Tradeus.in","Yebhi.com");

var products = new Array("Shoes","Clothing/Apparel","Accessories/Lifestyle products","Lingerie/Innerwear","Mobiles","Cameras","Home and Kitchen","Audio & Video","Jewellery","Watches","Bags","Fragrances");

strHTML = "";

anycheck = anyCheckedStr(cvar,varcount);

if(anycheck==true)
{
strHTML = "<TABLE border='0' width='900px' cellspacing='1' cellpadding='0' class='backwhite' style='border-top:2px solid #fff'>";
strHTML += "<TR>";
strHTML += "<TD class='Que2' colspan='2'>";
strHTML += qtext;
strHTML += "</TD>";
strHTML += "</TR>";
for(i=1;i<=varcount;i++)
{
chkid = cvar + "_" + i;
if(get_id(chkid).checked)
{
drpid = chkid + "_" + i;

strDrop = "<SELECT name='" + drpid + "' id='" + drpid + "' class='dropdown2'>";
strDrop += "<OPTION value='0'>Select one</OPTION>";
for(k=0;k<optArray.length; k++)
{
strDrop += "<OPTION value='" + (k + 1) + "'>" + optArray[k] + "</OPTION>";
}
strDrop += "</SELECT>";

strHTML += "<TR>";

strHTML += "<TD class='Ans2' width='230'>";
strHTML += products[i-1];
strHTML += "</TD>";

strHTML += "<TD class='Ans2' width='665'>";
strHTML += strDrop;
strHTML += "</TD>";

strHTML += "</TR>";
}
}
strHTML += "</TABLE>";
get_id(tablediv).innerHTML = strHTML;
}
else
{
get_id(tablediv).innerHTML = "";
}
}
*/

/*
if(chkVar==true)
{
if(get_id("").checked)
{
chkVar = isFilledText("_oth",'','Please specify the other option.');
}
}
if(chkVar==true)
{
if(get_id("").value==97)
{
chkVar = isFilledText("_oth",'','Please specify the other option.');
}
}

if(chkVar==true)
{
chkcollect = document.getElementsByName("varname[]");
len = chkcollect.length;
flag = false;
for(i=0;i<len;i++)
{
cid =  chkcollect[i];
if(cid.checked)
{
chkVar = true;
flag = true;
break;
}
}
if(flag==false)
{
alert("Please select.");
chkVar = false;
chkcollect[0].focus();
}
}
function terminate()
{
d2 = get_id("d2").value;
a1 = get_id("a1").value;
a10 = get_id("a10").value;

d8 = get_id("d8").value;
d3 = get_id("d3").value;
d4 = get_id("d4").value;
d9 = get_id("d9").value;
d10 = get_id("d10").value;

ddlCity = get_id("ddlCity").value;
if(a1!=98 || (d2<18 || d2>35) || (a10>=1 && a10<=3) || ddlCity==97)
{
objdataAjax = getAjaxObj();
uid = get_id("uid").value;
SessionId = get_id("SessionId").value;
strValues = "&uid=" + uid + "&d8=" + d8 + "&d3=" + d3 + "&d4=" + d4 + "&d9=" + d9 + "&d10=" + d10 + "&a1=" + a1 + "&d2=" + d2 + "&a10=" + a10 + "&ddlCity=" + ddlCity + "&SessionId=" + SessionId + "&ajax=y";
objdataAjax.open("POST","ServerPage1.php", true);
objdataAjax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
objdataAjax.onreadystatechange = function ()
{
if(objdataAjax.readyState == 4)
{
var strResponse = objdataAjax.responseText;
//alert(strResponse);
window.location = strResponse;
}
}
objdataAjax.send(strValues);
return false;
}
}
*/