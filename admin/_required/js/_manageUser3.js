<script>
    function gl<?= $users->username?>(linkname,dest){
        document.write('<a class="dropdown-item" href="'+dest+'">'+linkname+'</a>')
    }

    function showhide<?= $users->username?>(state){
        var cacheobj=document.getElementById("innermenu<?= $users->username?>").style
        if (state==0)
            cacheobj.visibility="hidden"
        else if(state==2)
            cacheobj.visibility="visible"
        else
            cacheobj.visibility=cacheobj.visibility=="hidden"? "visible" : "hidden"
    }

    //Specify your links here- gl(Item text, Item URL)
    <?php while($groups = mysqli_fetch_object($result2)) { ?>
    gl<?= $users->username?>("ย้ายไปกลุ่ม  <?= $groups->gdesc ?>","index2.php?option=manage_user&action=move&user=<?= $users->username?>&group=<?= $groups->gname ?>")
    <?php } ?>

    //Extend this list as needed

    document.onclick=function(){showhide<?= $user->username?>(0)}
</script>