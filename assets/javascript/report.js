// JavaScript Document
function hidden_display()
{
	
    var x = document.getElementById('option');
    if (x.style.display === 'none') {
        x.style.display = 'block';
    } else {
        x.style.display = 'none';
    
}
}
function changeDisable(value)
{
	var DATA_OK=document.getElementById('DATA_OK');
	var DATA_NG=document.getElementById('DATA_NG')
	var IMG_OK=document.getElementById('IMG_OK');
	var IMG_NG=document.getElementById('IMG_NG');
	var DATA_ALL=document.getElementById('DATA_ALL');
	var IMG_ALL=document.getElementById('IMG_ALL');
    var IMG_NO=document.getElementById('IMG_NO');
switch(value)
{
	case 'DATA_OK':
	{
	  IMG_OK.checked=true;
	  DATA_OK.checked=true;
	  DATA_NG.checked=false;
	  IMG_NG.checked=false;
	  DATA_ALL.checked=false;
	  IMG_ALL.checked=false;
	}
	break;
	
	case 'DATA_NG':
	{
		IMG_NG.checked=true;
		DATA_NG.checked=true;
	   
	   DATA_OK.checked=false;
	   IMG_OK.checked=false;
	   DATA_ALL.checked=false;
	   IMG_ALL.checked=false;
	}
	break;
	
	case 'DATA_ALL':
	{
	   DATA_OK.checked=false;
	   IMG_OK.checked=false;
	   DATA_NG.checked=false;
	   IMG_NG.checked=false;
	   IMG_ALL.checked=true;
	   DATA_ALL.checked=true;
	}
	break;
	
	default:
	   DATA_OK.checked=false;
	   IMG_OK.checked=false;
	   DATA_NG.checked=false;
	   IMG_NG.checked=false;
	   IMG_ALL.checked=true;
	   DATA_ALL.checked=true;
}
}
function Initialize()/*  search database from server*/
{
	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("Database").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "../index.php/Report/showdatabase", true);
        xmlhttp.send();
/* -------------------------------------------------------------------------------------------------------*/		
	var xmlhttp2 = new XMLHttpRequest();
        xmlhttp2.onreadystatechange = function() {
            if (xmlhttp2.readyState == 4 && xmlhttp2.status == 200) {
                document.getElementById("again_error").innerHTML = xmlhttp2.responseText;
            }
        };
        xmlhttp2.open("GET", '../index.php/Report/Initial_again_error', true);
        xmlhttp2.send();		
/* -------------------------------------------------------------------------------------------------------*/
     var xmlhttp3 = new XMLHttpRequest();
        xmlhttp3.onreadystatechange = function() {
            if (xmlhttp3.readyState == 4 && xmlhttp3.status == 200) {
                document.getElementById("OK").innerHTML = xmlhttp3.responseText;
            }
        };
        xmlhttp3.open("GET", '../index.php/Report/Initial_OK', true);
        xmlhttp3.send();
/* -------------------------------------------------------------------------------------------------------*/	
}
function Search_lot_number()/*  search lot_number by database and start_date end end_data*/
{
	var start=document.getElementById("start_date");
	var end=document.getElementById("end_date");
	var database=document.getElementById("Database_Option");
	if((start.value.length==0) || (end.value.length==0))
	{
   alert("開始日期與結束日期不能為空");
	}
	else
	{
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("Lot_Number_Option").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", '../index.php/Report/Search_lot_number' + '/' +database.value + '/' + start.value + '/' + end.value, true);
        xmlhttp.send();
	}	
}
function action()
{
	var lot_number=document.getElementById("Lot_number_Option");
	var database=document.getElementById("Database_Option");
	if(lot_number.value.length==0)
	{
		alert("批號不能為空");
	}
	else
	{
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("again_error").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", '../index.php/Report/Search_again_error' + '/' +database.value+ '/' +lot_number.value, true);
        xmlhttp.send();	
/*again error............................................................................................  */

        var xmlhttp2 = new XMLHttpRequest();
        xmlhttp2.onreadystatechange = function() {
            if (xmlhttp2.readyState == 4 && xmlhttp2.status == 200) {
                document.getElementById("OK").innerHTML = xmlhttp2.responseText;
            }
        };
        xmlhttp2.open("GET", '../index.php/Report/Search_ok' + '/' +database.value+ '/' +lot_number.value, true);
        xmlhttp2.send();	
/*OK..............................................................................................................  */
        var xmlhttp3 = new XMLHttpRequest();
        xmlhttp3.onreadystatechange = function() {
            if (xmlhttp3.readyState == 4 && xmlhttp3.status == 200) {
                document.getElementById("maintbody").innerHTML = xmlhttp3.responseText;
				  
	
            }
        };
        xmlhttp3.open("GET", '../index.php/Report/Search_All' + '/' +database.value+ '/' +lot_number.value, true);
        xmlhttp3.send();
		


	}

	
}

	function openwindow(test_number)
{
	var lot_number=document.getElementById("Lot_number_Option");
	var database=document.getElementById("Database_Option");
	if(lot_number.value.length!=0)
	{
	window.open('/?/report/find_detail/' +database.value+ '/' +lot_number.value + '/'+test_number, 'lot_number',
    'left=20,top=20,width=1500px,height=700px,toolbar=no,menubar=no,scrollbars=yes,resizable=no,location=no,directories=no,status=no'); return false;
	}
	else
	{
		alert('No Lot_Number');
	}
	
}
function export_excel()
{
	
	var lot_number=document.getElementById("Lot_number_Option");
	var database=document.getElementById("Database_Option");
	if(lot_number.value.length!=0)
	{
		window.location =' ../index.php/Report/Export' + '/' +database.value+ '/' +lot_number.value
	}
	
}

