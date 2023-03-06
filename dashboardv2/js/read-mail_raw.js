$(document).ready(function () {
    $('a.nav-link[href="billpayment.php"]').removeClass('active');
    $('a.nav-link[href="index.php"]').removeClass('active');
    $('a.nav-link[href="usage.php"]').removeClass('active');
    $('a.nav-link[href="support.php"]').removeClass('active');
    $('a.nav-link[href="mailbox.php"]').addClass('active');
});