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
        <link rel="stylesheet" type="text/css" href="_assets/font-awesome-4.7.0/css/font-awesome.min.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Kanit:300,400,400i,700" rel="stylesheet">
        <style>
            h1, h2, h3, h4, h5, h6, label, button, .nav-link, .swal-title, .swal-text, span, a {
                font-family: 'Kanit' !important;
            }

            .footer {
                position: fixed;
                left: 0;
                bottom: 0;
                width: 100%;
                background-color: #222d32;
                color: white;
                text-align: center;
                padding-top: 15px;
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
                <div class="app-title">
                    <div>
                        <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
                        <p>Wame On Code Radius</p>
                    </div>
                    <ul class="app-breadcrumb breadcrumb">
                        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                        <li class="breadcrumb-item"><a href="index2.php">Dashboard</a></li>
                    </ul>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="widget-small primary"><i class="icon fa fa-users fa-3x"></i>
                            <div class="info">
                            <h4>Users</h4>
                            <p><b><?php
                                    $sqlUser = "SELECT * FROM account ";
                                    echo mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], $sqlUser));
                                ?></b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget-small info"><i class="icon fa fa-list fa-3x"></i>
                            <div class="info">
                            <h4>USERS ONLINE</h4>
                            <p><b>
                                <?php
                                    $sqlOnline = "SELECT * from radacct,account where radacct.acctstarttime >= '".date("Y-m-d")." 00:00:00' and radacct.acctstarttime <= '".date("Y-m-d")." 23:59:59' and radacct.username = account.username and radacct.acctstoptime IS NOT NULL order by radacct.acctstarttime ";
                                    echo mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], $sqlOnline));
                                ?>
                            </b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget-small warning"><i class="icon fa fa-signal fa-3x"></i>
                            <div class="info">
                            <h4>TOTAL AP</h4>
                            <p><b><?php
                                    $sqlAp = "SELECT * FROM ap ";
                                    echo mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], $sqlAp));
                                ?></b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget-small danger"><i class="icon fa fa-bell-o fa-3x"></i>
                            <div class="info">
                            <h4>CRITICAL ALARMS</h4>
                            <p><b>15</b></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="tile">
                            <h3 class="tile-title">User Online</h3>
                            <?php 
                                $sqlOnlineList = "SELECT * FROM radacct,account WHERE radacct.acctstoptime IS NULL AND radacct.username = account.username ORDER BY radacct.acctstarttime LIMIT 7";
                                $resultOnlineList = mysqli_query($GLOBALS["___mysqli_ston"], $sqlOnlineList);
                                if (mysqli_num_rows($resultOnlineList) > 0) {
                            ?>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Name</th>
                                        <th>Starttime</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $countOnlineList = 0;
                                        while($dataOnlineList = mysqli_fetch_object($resultOnlineList)) { 
                                        $countOnlineList++;
                                    ?>
                                    <tr>
                                        <td><?= $countOnlineList  ?></td>
                                        <td><?= $dataOnlineList->username ?> </td>
                                        <td><?= $dataOnlineList->firstname ?> <?= $dataOnlineList->lastname ?> </td>
                                        <td><?= $dataOnlineList->acctstarttime ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <?php }else{ ?>
                                <div class="bs-component">
                                    <div class="alert alert-danger">
                                        <strong>Sorry!</strong> No data Available right now.
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="tile">
                            <h3 class="tile-title">User History</h3>
                            <?php 
                                $sqlUserHis = "SELECT * from radacct,account where radacct.acctstarttime >= '".date("Y-m-d")." 00:00:00' and radacct.acctstarttime <= '".date("Y-m-d")." 23:59:59' and radacct.username = account.username and radacct.acctstoptime IS NOT NULL order by radacct.acctstarttime LIMIT 7";
                                $resultUserHis = mysqli_query($GLOBALS["___mysqli_ston"], $sqlUserHis);
                                if (mysqli_num_rows($resultUserHis) > 0) {
                            ?>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>username</th>
                                        <th>Name</th>
                                        <th>Time</th>
                                        <th>Upload	Download</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $countOnlineList = 0;
                                    while($dataUserHis = mysqli_fetch_object($resultUserHis)) { 
                                    $countOnlineList++;
                                ?>
                                    <tr>
                                        <td><?= $countOnlineList  ?></td>
                                        <td><?= $dataUserHis->username ?></td>
                                        <td><?= $dataUserHis->firstname ?> <?= $dataUserHis->lastname ?></td>
                                        <td>
                                            <?php
                                            $hours = floor($dataUserHis->acctsessiontime/60.0/60.0);
                                            $mins = floor(($dataUserHis->acctsessiontime - $hours * 60.0 * 60.0)/60.0);
                                            $secs = $dataUserHis->acctsessiontime - ($hours * 60.0 * 60.0) - ($mins * 60.0);
                                            printf("%d:%02d:%02d", $hours, $mins, $secs);
                                            ?>
                                        </td>      
                                        <td><?= Round(((int)$dataUserHis->acctinputoctets/1000000),2) ?> MB.| <?= Round(((int)$dataUserHis->acctoutputoctets/1000000),2) ?> MB.</td>
                                    </tr>
                                    <?php } ?> 
                                </tbody>
                            </table>
                            <?php }else{ ?>
                                <div class="bs-component">
                                    <div class="alert alert-danger">
                                        <strong>Sorry!</strong> No data Available right now.
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            <?php } else { ?>
                <div class="row">
                    <div class="col-md-12">
                        <?php include($_REQUEST['option'] . ".php"); } ?>
                    </div>
                </div>
        </main>
        <?php 
            include("_required/_footer.php");
            if($_REQUEST['option'] == manage_group || $_REQUEST['option'] == user_online || $_REQUEST['option'] == check_accp || $_REQUEST['option'] == manage_user || $_REQUEST['option'] == print_user || $_REQUEST['option'] == manage_vip ){
        ?>

            <!-- Data table plugin-->
            <script type="text/javascript" src="_assets/js/plugins/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="_assets/js/plugins/dataTables.bootstrap.min.js"></script>
            <script type="text/javascript">$('#sampleTable').DataTable();</script>
        <?php } 
            if($_REQUEST['option'] == users_vip){
        ?>

        <script>
            $('#MACADDRESS').keyup(function (e) {
                var r = /([a-f0-9]{2})/i;
                var str = e.target.value.replace(/[^a-f0-9:]/ig, "");
                    if (e.keyCode != 8 && r.test(str.slice(-2))) {
                        str = str.concat(':')
                    }
                    e.target.value = str.slice(0, 17);
            });
        </script>
            <?php }?>
    </body>
</html>