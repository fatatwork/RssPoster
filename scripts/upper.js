$(document).ready(function () {
    $('#Footer_cont').append("<a class='upper' title='�����'>&nbsp;</a>");
    $(".upper").css("display", "none");
    $(window).scroll(function () {
        if ($(this).scrollTop() >= (parseInt($(document).height()) - parseInt($(window).height()) - 100)) {
            $(".upper").stop().animate({"bottom": "20px" }, 100);
            $(".upper").css("display", "block");
        } else {
            $(".upper").stop().animate({"bottom": "-50px" }, 100);
            $(".upper").css("display", "none");
        }
    });
    $(".upper").click(function () {
        jQuery('html, body').animate({scrollTop: 0}, 'fast');
        return false;
    });


});
