
window.onload = Idle();
//google.charts.load('current', {'packages':['corechart']});
function Idle() {
    Get_Mail();
    //   Get_Machine_Data();
}

// tab-bar
function openarea(evt, cityName) // tab display or not
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
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
function openarea_sub(evt, cityName) // tab display or not
{
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent_sub");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the link that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

function Reset_password() {
    var msg = '';
    var status = true;
    if ($("input[name$='new_pw']").val() == '') {
        msg += "請輸入新密碼\n";
        status = false;
    }
    if ($("input[name$='make_sure_pw']").val() == '') {
        msg += "請確認新密碼";
        status = false;
    }
    if ($("input[name$='new_pw']").val() != $("input[name$='make_sure_pw']").val()) {
        msg += "新密碼不相同，請重新輸入";
        status = false;
        $("input[name$='new_pw']").val("");
        $("input[name$='make_sure_pw']").val("");
    }


    if (status == true) {
        $.ajax({
            url: '../?/Account_C/Reset_Password',
            type: 'POST',
            data: $('#reset_PW').serialize(),
            error: function (xhr) {
                alert('Ajax request 發生錯誤');
            },
            success: function (data) {
                alert(data);
                window.location.href = '../?/Logout';
            }
        });
    }
    if (msg != '') {
        alert(msg);
    }
}

//取得Mail
function Get_Mail() {
    $.ajax({
        url: '../?/Account_C/Get_Mail_by_Username',
        type: 'POST',
        data: $('#mail').serialize(),
        error: function (xhr) {
            alert('Ajax request 發生錯誤');
        },
        success: function (data) {
            data = JSON.parse(data);
            $("input[name$='now_email']").val(data['mail']);
        }
    });
}
//修改
function Update_mail() {
    $.ajax({
        url: '../?/Account_C/Update_Mail_by_Username',
        type: 'POST',
        data: $('#mail').serialize(),
        error: function (xhr) {
            alert('Ajax request 發生錯誤');
        },
        success: function (data) {
            data = JSON.parse(data);

            // console.log(data);
            // $("#NOW").val();
            // $("input[name$='email']").val("");

            alert(data['msg']);
            window.location.reload();

        }
    });
}

/* 
AJAX ↓

$.ajax({
    url: '../?/Person_C/Get_All_Dept',
    type: 'POST',
    data: $('#searchForm').serialize(),
    error: function (xhr) {
        alert('Ajax request 發生錯誤');
    },
    success: function (data) {
        $('#dept').html(data);
    }
});

*/