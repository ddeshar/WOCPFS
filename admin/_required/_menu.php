<?php
    function display_children($parent, $child) {

        if($child == 0){$ul = "app-menu";}else{$ul = "treeview-menu";}
        if($child == 0){$li = "treeview";}else{$li = "";}
        if($child == 0){$a = "class='app-menu__item' data-toggle='treeview'";}else{$a = "";}
        if($child == 0){$aa = "app-menu__item";}else{$aa = "treeview-item";}
        
        $menuQuery = "SELECT a.id, a.label, a.link, a.type, a.icon, a.parent,a.status, Deriv1.Count FROM `menu` a  LEFT OUTER JOIN (SELECT parent, COUNT(*) AS Count FROM `menu` GROUP BY parent) Deriv1 ON a.id = Deriv1.parent WHERE a.parent=" . $parent;
        $menuResult = mysqli_query($GLOBALS["___mysqli_ston"], $menuQuery);
        echo "<ul class='$ul'>";
        while ($row = mysqli_fetch_object($menuResult)) {
            if($row->status == 0){
                if($row->type == 1){
                    $link ="index2.php?option=$row->link";
                }else if($row->type == 2){
                    $link = $row->link;
                }else if($row->type == 3){
                    $link = "https://$_SERVER[SERVER_ADDR]$row->link";
                }
                
                if($_REQUEST['option'] == $row->link){$active = "active";}
                
                if ($row->Count > 0) {
                    if($row->parent){$expand = "is-expanded";}else{$expand ="No";}
                    echo "<li class='$li $expand'>
                        <a $a href='#'>
                            <i class=\"app-menu__icon fa fa-$row->icon\"></i>
                            <span class=\"app-menu__label\">" . $row->label  . "</span>
                            <i class=\"treeview-indicator fa fa-angle-right\"></i></a>";
                        display_children($row->id, 1);
                    echo "</li>";
                } elseif ($row->Count == 0) {
    
                    
                    echo "<li class='$li'><a class='$aa $active' href='$link'><i class='app-menu__icon fa fa-$row->icon'></i><span class='app-menu__label'>" . $row->label . "</span></a></li>";
                } else;
            }
        }
        echo "</ul>";
    }
?>