<?php
  include("include/config.inc.php");
  if(!isset($_SESSION['logined'])) {
    ?><meta http-equiv="refresh" content="0;url=index.php"><?
  }

  $init=$_POST[init];
  $Submit=$_POST[Submit];
  /*
    แก้ไข   /usr/local/etc/sudoers  เพิ่ม
    www ALL=NOPASSWD: /bin/echo, /usr/bin/radclient
    www ALL=NOPASSWD: /usr/local/etc/rc.d/squid
    www ALL=NOPASSWD: /usr/local/sbin/squid
    www ALL=NOPASSWD: /sbin/init
    www ALL=NOPASSWD: /sbin/reboot
  */

  if($init==3 and $Submit=="Submit") { 
    echo '<pre>';
    $last_line = system('/usr/local/bin/sudo  /sbin/reboot', $retval);
    echo '
    </pre>
    <hr />Last line of the output: ' . $last_line . '
    <hr />Return value: ' . $retval;
    print "<h1><br> Run   Restart  Now</h1><br> $retval";
  }

  if($init==0  and $Submit=="Submit" ){
    echo '<pre>';
    $last_line = system('/usr/local/bin/sudo /sbin/init 0', $retval);
    echo '
    </pre>
    <hr />Last line of the output: ' . $last_line . '
    <hr />Return value: ' . $retval;
    print "<h1><br> Run Shutdown Now</h1> <br> $retval";
    ########################################
  }

  if($init==2  and $Submit=="Submit") {
    ##########################################
    echo '<pre>';
    $last_line = system('/usr/local/bin/sudo  /usr/local/sbin/squid -k reconfig ', $retval);
    echo '
    </pre>
    <hr />Last line of the output: ' . $last_line . '
    <hr />Return value: ' . $retval;
    ########################################
    print "<h1><br> Run Proxy Restart </h1><br> $retval";
    exit();
  }
?>  
<div class="app-title">
    <div>
        <h1><i class="fa fa-server"></i> รีบูท/ปิด  Server</h1>
        <p>Control System</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="index2.php"><i class="fa fa-home fa-lg"></i></a></li>
        <li class="breadcrumb-item"><a href="index2.php?option=system"> รีบูท/ปิด  Server</a></li>
    </ul>
</div>

<?php print $init; ?>

<div class="row">
  <div class="col-md-5">
    <div class="tile">
      <!-- <h3 class="tile-title">Control System</h3> -->
        <form name="form1" method="post" action="index2.php?option=system">
          <div class="tile-body">
            
            <div class="animated-radio-button">
              <label>
                <input type="radio" name="init" value="3"><span class="label-text">Reboot รีบูตระบบ</span>
              </label>
            </div>

            <div class="animated-radio-button">
              <label>
                <input type="radio" name="init" value="0"><span class="label-text">Shutdown ปิดเครื่อง</span>
              </label>
            </div>

            <div class="animated-radio-button">
              <label>
                <input type="radio" name="init" value="2"><span class="label-text">Restart Squid Proxy squid -k reconfig</span>
              </label>
            </div>
          </div>
          <div class="tile-footer">
            <input type="submit" name="Submit" value="Submit" class="btn btn-primary">
          </div>
        </form>
    </div>
  </div>
</div>
