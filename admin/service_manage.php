<?php
	/*####################################################
	WOCPFS - Wame On Code Pfsense Radius Auth
	Copyright (C) 2018 Mr.Dipendra Deshar
	E-Mail: jedeshar@gmail.com Homepage: http://ddeshar.com.np
  #####################################################*/

include("include/class.testlogin.php");
?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-cog"></i> Service Management</h1>
        <p>Service Management</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="index2.php"><i class="fa fa-home fa-lg"></i></a></li>
        <li class="breadcrumb-item"><a href="index2.php?option=service_manage"> Service Management</a></li>
    </ul>
</div>


<div class="row">
  <div class="col-md-3">
    <form action="reboot.php" method="post">
      <button type="submit" class="widget-small warning" value="reboot"><i class="icon fa fa-spinner fa-3x"></i>
        <div class="info">
          <h1>Reboot</h1>
        </div>
      </button>
    </form>
  </div>

  <div class="col-md-3">
    <form action="shutdown.php" method="post">
      <button type="submit" name="submit" class="widget-small danger" value="shutdown"><i class="icon fa fa-plug fa-3x"></i>
        <div class="info">
          <h1>shutdown</h1>
        </div>
      </button>
    </form>
  </div>
  
  <div class="col-md-3">
    <form action="squidreload.php" method="post">
      <button type="submit" class="widget-small info" value="reload"><i class="icon fa fa-refresh fa-3x"></i>
        <div class="info">
          <h1>Reload</h1>
        </div>
      </button>
    </form>
  </div>

  <div class="col-md-3">
    <form action="squidrestart.php" method="post">
      <button type="submit" class="widget-small primary" value="restart"><i class="icon fa fa-terminal fa-3x"></i>
        <div class="info">
          <h1>Restart</h1>
        </div>
      </button>
    </form>
  </div>
</div>