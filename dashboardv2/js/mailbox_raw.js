// $(document).ready(function() {
$(".msgs").click(function () {
    window.location = $(this).data("href");
});
$('a.nav-link[href="billpayment.php"]').removeClass('active');
$('a.nav-link[href="index.php"]').removeClass('active');
$('a.nav-link[href="usage.php"]').removeClass('active');
$('a.nav-link[href="support.php"]').removeClass('active');
$('a.nav-link[href="mailbox.php"]').addClass('active');


// });

var $rows = $('.msgs');
$('#search-msg').keyup(function () {

    var val = '^(?=.*\\b' + $.trim($(this).val()).split(/\s+/).join('\\b)(?=.*\\b') + ').*$',
        reg = RegExp(val, 'i'),
        text;

    $rows.show().filter(function () {
        text = $(this).text().replace(/\s+/g, ' ');
        return !reg.test(text);
    }).hide();
});