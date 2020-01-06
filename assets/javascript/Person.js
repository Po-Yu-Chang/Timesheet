
window.onload = Idle();
//google.charts.load('current', {'packages':['corechart']});
function Idle() {
    Get_dept();
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

//取得部門
function Get_dept() {

    $.ajax({
        url: '../?/Person_C/Get_All_Dept',
        type: 'POST',
        error: function (xhr) {
            alert('Ajax request 發生錯誤');
        },
        success: function (data) {
            $('#dept1').html(data);
            $('#dept2').html(data);
        }
    });
}

// 依照部門找人員
function Get_Member_by_Dept() {
    $.ajax({
        url: '../?/Person_C/Get_Member_by_Dept',
        type: 'POST',
        data: {
            "dept": $('#dept1').val()
        },
        error: function (xhr) {
            alert('Ajax request 發生錯誤');
        },
        success: function (data) {
            $("input[name$='m_id']").val("");
            $("input[name$='username']").val("");
            $("input[name$='password']").val("");
            $('#member').html(data);


        }
    });
}

// 依照人員取得職編
function Get_Member_ID() {
    $.ajax({
        url: '../?/Person_C/Get_Username_by_Member',
        type: 'POST',
        data: {
            "member": $('#member').val()
        },
        error: function (xhr) {
            alert('Ajax request 發生錯誤');
        },
        success: function (data) {
            data = JSON.parse(data);
            $("input[name$='m_id']").val(data['m_id']);
            $("input[name$='username']").val(data['username']);
            $("input[name$='password']").val(data['password']);
        }
    });
}

// 依照人員列表
function Get_Member_List() {
    $.ajax({
        url: '../?/Person_C/Get_Member_List',
        type: 'POST',
        data: {
            "dept": $('#dept2').val()
        },
        error: function (xhr) {
            alert('Ajax request 發生錯誤');
        },
        success: function (data) {
            $('#member_list').html(data);
        }
    });
}

//設定帳號
function Set_Username() {
    if ($("input[name$='username']").val() == '' && $("input[name$='password']").val() == '') {
        alert("請輸入帳號、密碼");
    } else {
        $.ajax({
            url: '../?/Person_C/Set_Username',
            type: 'POST',
            data: $('#Set_Username').serialize(),
            error: function (xhr) {
                alert('Ajax request 發生錯誤');
            },
            success: function (data) {
                alert('設定帳號成功~');
            }
        });
    }
}

function Set_Mail(username, name, mail) {

    $('#name').html(name);
    $('#email').val(mail);
    $('#username').val(username);

}

function Update_mail() {
    $.ajax({
        url: '../?/Person_C/Update_Mail',
        type: 'POST',
        data: $('#Set_Email').serialize(),
        error: function (xhr) {
            alert(xhr + 'Ajax request 發生錯誤');
        },
        success: function (data) {
            data = JSON.parse(data);

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