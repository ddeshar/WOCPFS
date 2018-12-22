<?php
	include("include/class.mysqldb.php");
	include("include/config.inc.php");
	include("include/pagination.php");
	if(!isset($_SESSION['logined'])) {
		?><meta http-equiv="refresh" content="0;url=index.php"><?
	} 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="author" content="Dipendra Deshar" />
        <meta name="keywords" content="authentication system" />
        <meta name="description" content="PFSENSE Authentication Project" />	
        <title>-:- Authent!cation -:-</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Main CSS-->
        <link rel="stylesheet" type="text/css" href="_assets/css/main.css">
        <!-- Font-icon css-->
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Kanit:300,400,400i,700" rel="stylesheet">
        <style>
            h1, h2, h3, h4, h5, h6, label, button, .nav-link, .swal-title, .swal-text, span, a {
                font-family: 'Kanit' !important;
            }
        </style>

        <script>
            function stoperror(){
                return true
            }
            window.onerror=stoperror
        </script>
    </head>

    <body class="app sidebar-mini rtl">
        <?php 
            include("_required/_header.php");
            include("_required/_aside.php");
        ?>
        <main class="app-content">
            <?php if(!isset($_REQUEST['option'])) { ?>
                <div class="row">
                    <div class="col-md-3">
                        <a href="index2.php?option=manage_admin">
                            <div class="widget-small danger"><i class="icon fa fa-users fa-3x"></i>
                                <div class="info">
                                    <h4>เปลี่ยนรหัสผ่าน</h4>
                                    
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <div class="col-md-3">
                        <a href="index2.php?option=register2">
                            <div class="widget-small danger"><i class="icon fa fa-users fa-3x"></i>
                                <div class="info">
                                    <h4>เพิ่มผู้ใช้ทีละคน</h4>
                                    
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <div class="col-md-3">
                        <a href="index2.php?option=register_excel">
                            <div class="widget-small danger"><i class="icon fa fa-users fa-3x"></i>
                                <div class="info">
                                    <h4>เพิ่มผู้ใช้ Excel</h4>
                                    
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <div class="col-md-3">
                        <a href="index2.php?option=manage_group">
                            <div class="widget-small danger"><i class="icon fa fa-users fa-3x"></i>
                                <div class="info">
                                    <h4>จัดการกลุ่มผู้ใช้</h4>
                                    
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <div class="col-md-3">
                        <a href="index2.php?option=manage_config">
                            <div class="widget-small danger"><i class="icon fa fa-users fa-3x"></i>
                                <div class="info">
                                    <h4>แก้ไขค่าระบบ</h4>
                                    
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <div class="col-md-3">
                        <a href="index2.php?option=user_online">
                            <div class="widget-small danger"><i class="icon fa fa-users fa-3x"></i>
                                <div class="info">
                                    <h4>ผู้ที่กำลังใช้งานอยู่</h4>
                                    
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <div class="col-md-3">
                        <a href="index2.php?option=user_history">
                            <div class="widget-small danger"><i class="icon fa fa-users fa-3x"></i>
                                <div class="info">
                                    <h4>ประวัติการใช้งาน</h4>
                                    
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <div class="col-md-3">
                        <a href="index2.php?option=user_statistic">
                            <div class="widget-small danger"><i class="icon fa fa-users fa-3x"></i>
                                <div class="info">
                                    <h4>สถิติการใช้งาน</h4>
                                    
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <div class="col-md-3">
                        <a href="http://<?=$_SERVER['SERVER_ADDR'];?>/phpMyAdmin" target="_blank">
                            <div class="widget-small danger"><i class="icon fa fa-users fa-3x"></i>
                                <div class="info">
                                    <h4>จัดการ mysql</h4>
                                    
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <div class="col-md-3">
                        <a href="index2.php?option=manage_user">
                            <div class="widget-small danger"><i class="icon fa fa-users fa-3x"></i>
                                <div class="info">
                                    <h4>จัดการข้อมูลผู้ใช้</h4>
                                    
                                </div>
                            </div>
                        </a>
                    </div>

                        <!-- <a href="index2.php?option=add_user">
                        <span>เพิ่มผู้ใช้แบบกลุ่ม</span>
                        </a>
                        <a href="index2.php?option=users_vip">
                        <span>เพิ่ม User VIP</span>
                        </a>
                        <a href="index2.php?option=manage_vip">
                        <span>แสดง User VIP</span>
                        </a>
                        <a href="index2.php?option=manage_interface">
                        <span>ปรับแต่งหน้าล็อกอิน</span>
                        </a>
                        <a href="index2.php?option=form">
                        <span>บล๊อก เว็บ,โหลด</span>
                        </a>
                        <a href="index2.php?option=check_accp">
                        <span>สถานะ AP</span>
                        </a>
                        <a href="index2.php?option=basic_data">
                        <span>ข้อมูลพื้นฐาน</span>
                        </a>
                        <a href="index2.php?option=import_data">
                        <span>นำเข้าข้อมูล</span>
                        </a>
                        <a href="index2.php?option=power">
                        <span>รีบูท/ปิดระบบ</span>
                        </a>
                        <a href="index2.php?option=system">
                        <span>ควบคุม Server</span>
                        </a>
                        <a href="index2.php?option=backupindex" >
                        <span>BackupDB</span>
                        </a>
                        <a href="index2.php?option=manuals">
                        <span>คู่มือการใช้งาน</span>
                        </a>
                        <a href="https://<?=$_SERVER['SERVER_ADDR'];?>:7445" target="_blank">
                        <span>Lightsquid</span>
                        </a> -->
                    <div style="clear:both;"> </div>
                </div>
            <?php } else { ?>
                <!-- <div class="app-title">
                    <div>
                        <h1><i class="fa fa-dashboard"></i> Blank Page</h1>
                        <p>Start a beautiful journey here</p>
                    </div>
                    <ul class="app-breadcrumb breadcrumb">
                        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                        <li class="breadcrumb-item"><a href="#">Blank Page</a></li>
                    </ul>
                </div> -->
                <div class="row">
                    <div class="col-md-12">
                        <?php include($_REQUEST['option'] . ".php"); } ?>
                    </div>
                </div>
        </main>
        <?php 
            include("_required/_footer.php");
            if($_REQUEST['option'] == manage_group || $_REQUEST['option'] == user_online || $_REQUEST['option'] == check_accp || $_REQUEST['option'] == manage_user || $_REQUEST['option'] == print_user){
        ?>

            <!-- Data table plugin-->
            <script type="text/javascript" src="_assets/js/plugins/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="_assets/js/plugins/dataTables.bootstrap.min.js"></script>
            <script type="text/javascript">$('#sampleTable').DataTable();</script>
        <?php } ?>

    </body>
</html>