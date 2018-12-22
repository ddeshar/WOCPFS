<div class="app-title">
    <div>
        <h1><i class="fa fa-line-chart"></i> สถิติการใช้งานระบบ</h1>
        <p>Statistic</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="index2.php"><i class="fa fa-home fa-lg"></i></a></li>
        <li class="breadcrumb-item"><a href="index2.php?option=user_statistic">สถิติการใช้งานระบบ</a></li>
    </ul>
</div>

<div id="content">

    <script type="text/javascript">
      function onrollout(){
        tmp = findSWF("ofc");
        x = tmp.rollout();
      }

      function onrollout2(){
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
