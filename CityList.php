<?php
	if(isset($_REQUEST["xmlname"]))
   {
	  $xmlname = $_REQUEST["xmlname"];
	  $type = intval($_REQUEST["type"]);
	  $strdata = "";
	  $doc = new DOMDocument();
	  $XMLDocPath = "http://www.getcounted.net/StateCityXML/".$xmlname;
	  //$XMLDocPath = "http://172.30.101.2/StateCityXML/".$xmlname;
	  //$XMLDocPath = "http://www.juxt360.com/statecity/".$xmlname;
	  $doc->load( $XMLDocPath);
	  $tagname = "state";
	  if($type==1)
	  {
		  $tagname = "district";
	  }
	  else if($type==2)
	  {
  		  $tagname = "city";
	  }	 
	  $rows = $doc->getElementsByTagName($tagname);
	  foreach( $rows as $data)
	  {	 
  		  $tnode = $data->getElementsByTagName( "title" );
		  $title = $tnode->item(0)->nodeValue;
  
		  $vnode = $data->getElementsByTagName( "value" );
		  $value = $vnode->item(0)->nodeValue;

		  $strdata .= $value . "_" . $title. ",";
	  }
	 echo $strdata;
   }
?>

