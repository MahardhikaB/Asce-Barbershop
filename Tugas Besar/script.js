$(".main").fadeOut(8);
window.setTimeout(function() {
    $(".main").fadeIn();
}, 1000);

var screenHeight = document.querySelector('.hal1').clientHeight;

$(".title").fadeOut(1000);
$(".about h3").fadeOut(1000);
$(".layanan").fadeOut(1000);
$(".box-kiri").css('transform', 'translateX(400%)');
$(".box-kanan").css('transform', 'translateX(-400%)');
$(".paket").fadeOut(1000);
$(".box-ganjil").css('transform', 'translateX(400%)');
$(".box-genap").css('transform', 'translateX(-400%)');
$(".arrow").fadeOut(1000);

window.addEventListener("scroll", function() {
    var nav = document.getElementsByClassName("navbar");
    if (window.pageYOffset > 100) {
        nav[0].style.width = "89%";
        nav[0].style.top = "0";
    } else {
        nav[0].style.width = "80%";
        nav[0].style.top = "30px";
    }

    if (window.pageYOffset > screenHeight - 250 && window.pageYOffset < (screenHeight - 250) * 2) {
        $(".title").fadeIn(1000);
        $(".about h3").slideDown(500);
        $(".layanan").fadeIn(1000);
        $(".box-kiri").css('transform', 'translateX(0)');
        $(".box-kanan").css('transform', 'translateX(0)');
    } else {
        $(".title").fadeOut(100);
        $(".about h3").slideUp(100);
        $(".layanan").fadeOut(100);
        $(".box-kiri").css('transform', 'translateX(-400%)');
        $(".box-kanan").css('transform', 'translateX(400%)');
    }

    if (window.pageYOffset > (screenHeight - 100) * 2 && window.pageYOffset < screenHeight * 3) {
        $(".paket").fadeIn(1000);
        $(".box-ganjil").css('transform', 'translateX(0)');
        $(".box-genap").css('transform', 'translateX(0)');
    } else {
        $(".paket").fadeOut(500);
        $(".box-ganjil").css('transform', 'translateX(-400%)');
        $(".box-genap").css('transform', 'translateX(400%)');
    }

    if (window.pageYOffset > screenHeight - 250) {
        $(".arrow").fadeIn(1000);
    } else {
        $(".arrow").fadeOut(500);
    }
}); 


$('*').css('scroll-behavior', 'smooth');