<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="/laypage-v1.3/laypage/laypage.js"></script>
<link type="text/css" href="/laypage-v1.3/laypage/skin/laypage.css" />
<script type="text/javascript" src="/JSCal2-1.7/src/js/jscal2.js"></script>
<script type="text/javascript" src="/JSCal2-1.7/src/js/lang/en.js"></script>
<link type="text/css" rel="stylesheet" href="/JSCal2-1.7/src/css/jscal2.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>回朔追尋</title>
</head>

<body>
<input type="hidden" name="sql" value="<? //echo $string ?>"  />
<form name="back_form" method="post" action="<? echo base_url() ?>index.php/back/find/">
<div align="center">
<table border="2">
<tr>
<td><input type="text" id="start" name="start" size="10" readonly required="required"><input type="button" value="開始日期" id="BTN" name="BTN" required="required"></td>
<td><input type="text" id="end" name="end" size="10" readonly><input type="button" value="結束日期" id="BTN2" name="BTN2"></td>
<td></td>
</tr>
<tr>
<td><h>流程卡號:</h><input type="text" name="flowcard_no" /></td>
<td><h>序號:</h><input type="text" name="seqno" /><br /></td>
<td><h>工單:</h><input type="text" name="workorder" /></td>
</tr>
<tr>
<td><input  style="width:120px;height:40px;font-size:20px;" id="button_size" type="submit" value="送出"></td>
<td><input style="width:120px;height:40px;font-size:20px;" id="button_size" type="reset" value="重填"></td>
<td></td>
</tr>
</table>
</div>
<div><h1 id="page1"></h1></div>
<script type="text/javascript">//日曆
    new Calendar({
        inputField: "start",
        dateFormat: "%Y%m%d",
        trigger: "BTN",
        bottomBar: true,
        weekNumbers: true,
        showTime: 24,
        onSelect: function() {this.hide();}
    });
</script>
<script type="text/javascript">//日曆
    new Calendar({
        inputField: "end",
        dateFormat: "%Y%m%d",
        trigger: "BTN2",
        bottomBar: true,
        weekNumbers: true,
        showTime: 24,
        onSelect: function() {this.hide();}
    });
</script>
<script>
laypage({  
    cont: 'page1', //容器。值支持id名、原生dom对象，jquery对象。  
    pages: <? echo $laypage ?>, //总页数  
    curr:<? echo $page ?>,
    jump: function(e,first){ //触发分页后的回调  
        //触发分页后的回调  
        var curr = e.curr; 
        if(!first){ //一定要加此判断，否则初始时会无限刷新
           location.href = "<? echo base_url() ?>index.php/back/jump/"+e.curr;
        } 
    }  
});  
</script>


<? //echo $count ; ?>
<? echo $html_table ; ?>


</form>
</body>
</html>