<?php
	/*####################################################
	WOCPFS - Wame On Code Pfsense Radius Auth
	Copyright (C) 2018 Mr.Dipendra Deshar
	E-Mail: jedeshar@gmail.com Homepage: http://ddeshar.com.np
    #####################################################*/

    include("include/class.testlogin.php");
?>
<style>
blockquote {padding: 10px 20px;margin: 20px;font-size: 18px;border-left: 5px solid #28a745;}
</style>
<div class="app-title">
    <div>
        <h1><i class="fa fa-book"></i> Manuals</h1>
        <p>Manual documents of WocAuth</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="index2.php"><i class="fa fa-home fa-lg"></i></a></li>
        <li class="breadcrumb-item"><a href="index2.php?option=manuals">Manuals</a></li>
    </ul>
</div>

<div class="tile mb-4">
    <div class="row" style="margin-bottom: 2rem;">
        <div class="col-lg-12">
            <!-- <h3>Tabs</h3> -->
            <div class="bs-component">
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#home">NAS / Clients</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Interfaces">Interfaces</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#EAP">EAP</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#SQL">SQL</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Authentication">Authentication Servers</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Captive">Captive Portal</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Cron">Cron</a></li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active show" id="home">
                        <blockquote><h4>Service -> FreeRADIUS</h4></blockquote>
                        <p><img src="images/manual/NASClients.png" alt="" width="100%"></p>
                    </div>
                    <div class="tab-pane fade" id="Interfaces">
                        <blockquote><h4>Service -> FreeRADIUS</h4>
                            <li>Interface -> 1812 = Authen</li>
                            <li>Interface -> 1813 = Account</li>
                            <li>Interface -> 1816 = Status</li>
                        </blockquote>
                        <p><img src="images/manual/Interfaces.png" alt="" width="100%"></p>
                    </div>
                    <div class="tab-pane fade" id="EAP">
                        <blockquote><h4>Service -> FreeRADIUS</h4>
                            <li>EAP -> LTS -> Radius-Cert</li>
                        </blockquote>
                        <p><img src="images/manual/EAP.png" alt="" width="100%"></p>
                    </div>
                    <div class="tab-pane fade" id="SQL">
                        <blockquote><h4>Service -> FreeRADIUS</h4>
                            <li>SQL -> enable</li>
                            <li>mysql = root -> psw</li>
                            <li>radclient = no</li>
                            <li>radclient = no</li>
                        </blockquote>
                        <p><img src="images/manual/SQL.png" alt="" width="100%"></p>
                    </div>
                    <div class="tab-pane fade" id="Authentication">
                        <blockquote><h4>System -> User Manager</h4></blockquote>
                        <p><img src="images/manual/AuthenticationServers.png" alt="" width="100%"></p>
                    </div>
                    <div class="tab-pane fade" id="Captive">
                        <blockquote><h4>Service -> Captive Portal</h4>
                            <li>Captive portal -> Add</li>
                            <li>ใส่ชื่อ เช่น pstlab</li>
                            <li>enable pstlab</li>
                            <li>enable popup</li>
                            <li>enable user custom login page</li>
                            <li>Authen method & Server ที่ได้สร้างไว้ก่อนหน้านี้</li>
                            <li>radius accounting</li>
                        </blockquote>

                        <p><img src="images/manual/CaptivePortal.png" alt="" width="100%"></p>
                    </div>
                    <div class="tab-pane fade" id="Cron">
                        <blockquote><h4>Service -> Cron</h4></blockquote>
                        <p><img src="images/manual/Cron.png" alt="" width="100%"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>