<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
        <div>
        <p class="app-sidebar__user-name">We!come</p>
        <p class="app-sidebar__user-designation"><?= $_SESSION['name'] ?> </p>
        </div>
    </div>

    <ul class="app-menu">
        <li><a class="app-menu__item <?php if(!isset($_REQUEST['option'])) {echo "active";}?>" href="index2.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        
        <li class="treeview <?php if($_REQUEST['option'] == register2 || $_REQUEST['option'] == add_user || $_REQUEST['option'] == register_excel || $_REQUEST['option'] == manage_user || $_REQUEST['option'] == manage_group || $_REQUEST['option'] == print_user){echo "is-expanded";}?>"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">User Management</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item <?php if($_REQUEST['option'] == register2){echo "active";}?>" href="index2.php?option=register2"><i class="icon fa fa-user"></i>Add Single User</a></li>
                <li><a class="treeview-item <?php if($_REQUEST['option'] == add_user){echo "active";}?>" href="index2.php?option=add_user"><i class="icon fa fa-users"></i>Generate Multi Users</a></li>
                <li><a class="treeview-item <?php if($_REQUEST['option'] == register_excel){echo "active";}?>" href="index2.php?option=register_excel"><i class="icon fa fa-file-excel-o"></i>Generate Users Excel[.xls]</a></li>
                <li><a class="treeview-item <?php if($_REQUEST['option'] == manage_user){echo "active";}?>" href="index2.php?option=manage_user"><i class="icon fa fa-user-times"></i>User Manager</a></li>
                <li><a class="treeview-item <?php if($_REQUEST['option'] == manage_group){echo "active";}?>" href="index2.php?option=manage_group"><i class="icon fa fa-users"></i>Group Manager</a></li>
                <li><a class="treeview-item <?php if($_REQUEST['option'] == print_user){echo "active";}?>" href="index2.php?option=print_user"><i class="icon fa fa-address-card"></i>พิมพ์บัตรอินเตอร์เน็ต</a></li>
            </ul>
        </li>
        
        <li class="treeview <?php if($_REQUEST['option'] == user_online || $_REQUEST['option'] == user_history || $_REQUEST['option'] == user_statistic || $_REQUEST['option'] == check_accp){echo "is-expanded";}?>"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">System Report</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item <?php if($_REQUEST['option'] == user_online){echo "active";}?>" href="index2.php?option=user_online"><i class="icon fa fa-list"></i>User Online</a></li>
                <li><a class="treeview-item <?php if($_REQUEST['option'] == user_history){echo "active";}?>" href="index2.php?option=user_history"><i class="icon fa fa-history"></i>User History</a></li>
                <li><a class="treeview-item <?php if($_REQUEST['option'] == user_statistic){echo "active";}?>" href="index2.php?option=user_statistic"><i class="icon fa fa-line-chart"></i>User Statistic</a></li>
                <li><a class="treeview-item <?php if($_REQUEST['option'] == check_accp){echo "active";}?>" href="index2.php?option=check_accp"><i class="icon fa fa-signal"></i>Access Point Status</a></li>
                <li><a class="treeview-item" href="https://<?=$_SERVER['SERVER_ADDR'];?>:7445" target="_blank"><i class="icon fa fa-pie-chart"></i>Lightsquid report</a></li>
            </ul>
        </li>
        
        <li class="treeview <?php if($_REQUEST['option'] == form || $_REQUEST['option'] == backupindex || $_REQUEST['option'] == system ){echo "is-expanded";}?>"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-server"></i><span class="app-menu__label">Server Management</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item <?php if($_REQUEST['option'] == form){echo "active";}?>" href="index2.php?option=form"><i class="icon fa fa-ban"></i>Block Web Squid</a> </li>
                <li><a class="treeview-item <?php if($_REQUEST['option'] == backupindex){echo "active";}?>" href="index2.php?option=backupindex"><i class="icon fa fa-window-restore"></i>Backup</a></li>
                <li><a class="treeview-item <?php if($_REQUEST['option'] == system){echo "active";}?>" href="index2.php?option=system"><i class="icon fa fa-server"></i>Control System</a></li> 
                <li><a class="treeview-item" href="http://<?=$_SERVER['SERVER_ADDR'];?>/phpMyAdmin" target="_blank"><i class="icon fa fa-database"></i>phpMyAdmin </a></li>

            </ul>
        </li>

        <li class="treeview <?php if($_REQUEST['option'] == manage_interface || $_REQUEST['option'] == manage_config || $_REQUEST['option'] == manuals){echo "is-expanded";}?>"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cog"></i><span class="app-menu__label">Setting</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item <?php if($_REQUEST['option'] == manage_interface){echo "active";}?>" href="index2.php?option=manage_interface"><i class="icon fa fa-sign-in"></i>Interface Manager</a></li>
                <li><a class="treeview-item <?php if($_REQUEST['option'] == manage_config){echo "active";}?>" href="index2.php?option=manage_config"><i class="icon fa fa-pencil"></i>Global Configuration</a></li>
                <li><a class="treeview-item <?php if($_REQUEST['option'] == manuals){echo "active";}?>" href="index2.php?option=manuals"><i class="icon fa fa-book"></i>Manuals</a></li>

            </ul>
        </li>
    </ul>
</aside>

