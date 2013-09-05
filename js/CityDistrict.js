var objMenuAjax, finalPath,drplist,ctrlID;

function ajaxObject()
{
	if(window.XMLHttpRequest)
	{
		obj = new XMLHttpRequest;
	}
	else if (window.ActiveXObject)
	{
		obj = new ActiveXObject("Microsoft.XMLHTTP");
	}
	return obj;
}

objMenuAjax = ajaxObject();
function bindState(xmlname,ctrlID,type)
{
	objMenuAjax = ajaxObject();
	_BindList(xmlname,ctrlID,type)
}
function _BindList(xmlname,ctrlID,type)
{
	var File = xmlname + ".xml";
	var myRandom = parseInt(Math.random()*99999999);
	if(type==1)
	{
		removeAllOption("ddlCity");
		addOption("ddlCity",0,"Select your city/town/village?");
	}
	if(xmlname=='0')
	{
		removeAllOption(ctrlID);
		addOption(ctrlID, 0, "You currently reside?");
	}
	else
	{
		objMenuAjax.open("GET","CityList.php?rand=" + myRandom + "&xmlname=" + File + "&type=" + type,true);
		objMenuAjax.onreadystatechange = function _httpMatrixValue()
		{
			if(objMenuAjax.readyState == 1)
			{
				addOption(ctrlID,0,"please wait");
				document.getElementById(ctrlID).disabled = true;
			}
			else if(objMenuAjax.readyState == 4)
			{
				var drplist = objMenuAjax.responseText;
				PopulateDropdown(ctrlID,drplist);
				document.getElementById(ctrlID).disabled = false;
				objMenuAjax = null;
				objMenuAjax = ajaxObject();
			}
		}
		objMenuAjax.send(null);
	}
};

function PopulateDropdown(ctrl,allddlValues)
{
	var currddlList, allValues;
	removeAllOption(ctrl);
	if(ctrl=="ddlState")
	{
		label = "Select your state?";
	}
	else if(ctrl=="ddlDistrict")
	{
		label = "Select your district?";
	}
	else if(ctrl=="ddlCity")
	{
		label = "Select your city/town/village?";
	}
	//addOption(ctrl, 0, "You currently reside?");
	addOption(ctrl, 0, label);
	currddlList = allddlValues.split(",");
	for(i=0; i<currddlList.length-1; i++)
	{
		allValues = currddlList[i].split("_");
		addOption(ctrl, allValues[0], allValues[1]);
	}
	return;
};

function addOption(ctrl, value, text)
{
	var ddl=document.getElementById(ctrl);
	var optn = document.createElement("OPTION");
	optn.value = value;
	optn.text = text;
	ddl.options.add(optn);
	return;
};

function removeAllOption(ctrl)
{
	var i;
	var ddl=document.getElementById(ctrl);
	if(ddl.options.length>0)
	{
		for(i=ddl.options.length-1;i>=0;i--)
		{
			ddl.remove(i);
		}
	}
};
