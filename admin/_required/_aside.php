<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
        <div>
        <p class="app-sidebar__user-name">We!come</p>
        <p class="app-sidebar__user-designation"><?= $_SESSION['name'] ?> </p>
        </div>
    </div>
    
<?php 
    display_children(0, 0);
?>

</aside>