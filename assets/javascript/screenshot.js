function screenshot(print_area, pic_name){

    html2canvas(document.getElementById(print_area)).then(function(canvas) {
        document.body.appendChild(canvas);
        var a = document.createElement('a');
        a.href = canvas.toDataURL("image/jpeg").replace("image/jpeg", "image/octet-stream");
        a.download = pic_name + '.jpg';
        a.click();
    });
}