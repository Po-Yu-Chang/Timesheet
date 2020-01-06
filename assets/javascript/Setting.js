var baseUrl = document.getElementById('baseurl').value;
window.onload = Idle();
function Idle() {
    Get_Machine();
}


function openarea(evt, divName) // tab display or not
{
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the link that opened the tab
    document.getElementById(divName).style.display = "block";
    evt.currentTarget.className += " active";
}

function Get_Machine() {
    $.ajax({
        url: '../?/Setting_C/Get_Machine',
        type: 'POST',
        error: function (xhr) {
            alert(xhr + 'Ajax request 發生錯誤');
        },
        success: function (data) {
            $('#Machine_table tbody').html(data);
        }
    });
}

function Update_Sequence(name, value, table, index) {
    if (typeof (value) == 'undefined') {
        value = ''
    }
    $.ajax({
        url: '../?/Setting_C/Update_Sequence/' + name + '/' + value + '/' + table + '/' + index + '/',
        type: 'POST',
        error: function (xhr) {
            alert(xhr + 'Ajax request 發生錯誤');
        },
        success: function (data) {
            //$('#Machine_table tbody').html(data);
            alert(data);

        }
    });
}
