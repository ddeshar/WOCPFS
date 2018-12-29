<?
if($filebackup!=""){
    chmod('backup/'.$filebackup,0777);
    @unlink('backup/'.$filebackup) or die("Database backup finished");
}
?>

<div class="app-title">
    <div>
        <h1><i class="fa fa-window-restore"></i> สำรองข้อมูล</h1>
        <p>Backup</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="index2.php"><i class="fa fa-home fa-lg"></i></a></li>
        <li class="breadcrumb-item"><a href="index2.php?option=backupindex">สำรองข้อมูล</a></li>
    </ul>
</div>

<div class="row">
    <div class="col-md-3">
        <a href="index2.php?option=restore">
            <div class="widget-small warning"><i class="icon fa fa-database fa-3x"></i>
            <div class="info">
                <h4>Restore</h4>
            </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="index2.php?option=backupdb">
            <div class="widget-small info"><i class="icon fa fa-database fa-3x"></i>
            <div class="info">
                <h4>Backup</h4>
            </div>
            </div>
        </a>
    </div>
</div>
