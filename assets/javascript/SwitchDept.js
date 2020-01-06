var baseUrl = document.getElementById('baseurl').value;

function switch_dept(dept, dept_id) {
    $.ajax({
        url: "../index.php/User/swich_dept/",
        data: {
            "dept": dept,
            "dept_id": dept_id
        }
        ,
        type: "POST",
        dataType: 'text',

        success: function (message) {
            $('#dept').val(dept);
            $('#dept_id').val(dept_id);
            alert("切換身分為：" + dept);
            window.location.reload();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert("切換身分失敗");
        }
    });
}
