<script>
    function gl(linkname,dest){
        document.write('<a class="dropdown-item"  href="'+dest+'">'+linkname+'</a>')
    }
    function showhide(state){
        var cacheobj=document.getElementById("innermenu").style
        if (state==0)
            cacheobj.visibility="hidden"
        else if(state==2) 
            cacheobj.visibility="visible"
        else
            cacheobj.visibility=cacheobj.visibility=="hidden"? "visible" : "hidden"
    }

    //Specify your links here- gl(Item text, Item URL)
    <?php while($groups = mysqli_fetch_object($result)) { ?>
        gl("Group <?= $groups->gdesc ?>","index2.php?option=manage_user&group=<?= $groups->gname ?>")
    <?php } ?>

    //Extend this list as needed            
    document.onclick=function(){showhide(0)}

</script>