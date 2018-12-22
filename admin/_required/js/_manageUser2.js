<script type="text/javascript">
    function autoChecked(frmObj,chkObj){
        for(i=0; i<frmObj.length; i++){
            if(chkObj.checked)
                frmObj[i].checked=true;
            else
                frmObj[i].checked=false;
        }
    }

    function isChecked(frmObj){
        var _return = false;
            for(i=0; i<frmObj.length; i++){
                if(frmObj[i].checked)
                _return = true;
            }
            return _return;
    }

    function confirm2Move(frmObj){
        if(!isChecked(frmObj)){
            alert("กรุณาเลือกรายการที่จะดำเนินการ ..!");
            return false;
        }else if(frmObj.group.options[frmObj.group.selectedIndex].value == ""){
            alert("กรุณาเลือกวิธีการดำเนินการ ..!");
            return false;
        }else{
            return confirm("ยืนยันการลบ / การย้ายกลุ่มที่ถูกเลือก ?");
        }
    }
</script>