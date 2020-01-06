function Load()
{
	var id=document.getElementById("id").value;
	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("Display").innerHTML= xmlhttp.responseText;				
				}
        };
        xmlhttp.open("post", "../index.php/Repair_C/Load/"+ id, true);
        xmlhttp.send();// JavaScript Documen
}
function count_page()
{
	var id=document.getElementById("id").value;
	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("Reject_qty").value= xmlhttp.responseText;				
				}
        };
        xmlhttp.open("post", "../index.php/Repair_C/count_page/"+ id, true);
        xmlhttp.send();// JavaScript Documen
}
function Edit(index,item_class)
{
	if(item_class=='請假')
	{
		 window.location.assign("../index.php/Repair_C/Day_off/"+index);
	}
}
 function logout()//登出
{
	
    var txt;
    var r = confirm("是否要登出");
    if (r == true) {
		 window.location.assign("../index.php/Logout");
	   
    } else {
        
    }
 }