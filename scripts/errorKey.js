$(document).ready(
    function () {
        var isCtrl = false;
        var selectedText = "";
        $(document).keyup(function (e) {
            if (e.which == 17) isCtrl = false;
        }).keydown(function (e) {
            if (e.which == 17) isCtrl = true;
            if (e.which == 13 && isCtrl == true) {
                if (window.getSelection) {
                    selectedText = window.getSelection();
                }
                else if (document.getSelection) {
                    selectedText = document.getSelection();
                }
                else if (document.selection) {
                    selectedText = document.selection.createRange().text;
                }
                if (selectedText) {
                    var cmmts = prompt(("Отправить сообщение об ошибке в тексте?\nПоясните в чём заключается ошибка:", "");
                    if (cmmts != null) {
                        $.ajax({
                            type: "POST",
                            url: "/ctrlenter/errorPost.php",
                            data: {text: [selectedText], pageurl: [window.location.href], comm: [cmmts]}
                        });
                    }
                }
            }
        });
    });