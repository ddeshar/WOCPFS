
				
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="Burapha Linux Laboratory" />
	<meta name="keywords" content="authentication system" />
	<meta name="description" content="Burapha Linux Authentication Project" />	
    <link href="css/main.css" type=text/css rel=stylesheet>
	<title>-:- Authent!cation -:-</title>
</head>
<body>
<div id="content">

<table width="95%" border="0" align="center" cellpadding="0" cellspacing="10"  class="header">
  <tr>
    <td width="6%" align="center"><img src="images/BlackNeonAgua_060.png" alt="" width="59" height="60" /></td>
    <td width="94%"><a href="index2.php?option=user_statistic">Statistic</a><br />
<span class="normal">สถิติการใช้งานระบบ</span></td>
    <td width="94%">&nbsp;</td>
  </tr>
</table>
 


<script type="text/javascript">

function onrollout()
{
  tmp = findSWF("ofc");
  x = tmp.rollout();
}

function onrollout2()
{
  tmp = findSWF("ofc");
  x = tmp.rollout();
}

function findSWF(movieName) {
  if (navigator.appName.indexOf("Microsoft")!= -1) {
    return window[movieName];
  } else {
    return document[movieName];
  }
}

</script>

<script type="text/javascript" src="openchart/js/swfobject.js"></script>
<div align="center">
<div id="my_chart" style="padding: 0px; margin:10px 20px 10px 5px ; width: 98%; height: 250px; " onmouseout="__onrollout();"></div>
 	
<script type="text/javascript">
var so = new SWFObject("openchart/actionscript/open-flash-chart.swf", "ofc", "98%", "250", "9", "#FFFFFF");
so.addVariable("data", "chart_data.php");

/*so.addVariable("variables","true");
so.addVariable("title","Test,{font-size: 20;}");
so.addVariable("y_legendx","Open Flash Chart,12,0x736AFF");
so.addVariable("y_label_size","15");
so.addVariable("y_ticks","5,10,4");
so.addVariable("bar","50,0x9933CC,หน้าหลัก ,10");
so.addVariable("values","9,6,7,9,5,7,6,9,9");
so.addVariable("x_labels","มกราคม,กุมภาพันธ์,มีนาคม,เมษายน,พฤษภาคม,มิถุนายน,กรกฎาคม,สิงหาคม,กันยายน,ตุลาคม,พฤศจิกายน,ธันวาคม");
so.addVariable("x_axis_steps","2");
so.addVariable("y_max","20");
*/

so.addParam("allowScriptAccess", "always" );//"sameDomain");
so.addParam("onmouseout", "onrollout2();" );
so.write("my_chart");
</script>

</div>
</div>



</body>
</html>
