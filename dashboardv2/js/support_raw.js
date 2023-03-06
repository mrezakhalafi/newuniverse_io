$(document).ready(function () {

    $('.carousel').carousel('pause');
    // var rows = document.getElementsByClassName('monthly-bill');
    // var row_array = toArray(rows);
    // chunks(row_array, 3);
    // $("#chatbot").prop("disabled", true);
    $("#chatbot").click(function (event) {
        event.preventDefault();
    });

    var tickets = document.getElementsByClassName('monthly-bill');
    if (tickets.length != 0) {
        $('#no-tickets').css('display', 'none');
    }
});

var titleChar = false;
var invalidChar = /[\"'`´’‘;=-]/;

var $rows = $('.monthly-bill');
$('#search-ticket').keyup(function () {

    var val = '^(?=.*\\b' + $.trim($(this).val()).split(/\s+/).join('\\b)(?=.*\\b') + ').*$',
        reg = RegExp(val, 'i'),
        text;

    $rows.show().filter(function () {
        text = $(this).text().replace(/\s+/g, ' ');
        return !reg.test(text);
    }).hide();
});

$('#search-ticket').keyup(function () {

    var val = '^(?=.*\\b' + $.trim($(this).val()).split(/\s+/).join('\\b)(?=.*\\b') + ').*$',
        reg = RegExp(val, 'i'),
        text;

    $rows.show().filter(function () {
        text = $(this).text().replace(/\s+/g, ' ');
        return !reg.test(text);
    }).hide();
});

function validateForm() {
    //get all form elements
    var summary = document.getElementsByName('summary');
    var radios = document.getElementsByName('method');
}

function checkFunction(event) {
    if (event.checked) {
        service_length = document.querySelectorAll('input[type="checkbox"]:checked').length;
        // console.log(service_length);
        if (service_length == 0) {
            if (localStorage.lang == 0) {
                alert("You must check at least one checkbox.");
            }
            else {
                alert("Anda harus memilih setidaknya satu pilihan.");
            }
            // $("#selectall").prop("checked", true);
            return false;
        }
    } else {
        service_length = document.querySelectorAll('input[type="checkbox"]:checked').length;
        check_problemID = event.id;
        if (service_length == 0) {
            if (localStorage.lang == 0) {
                alert("You must check at least one checkbox.");
            }
            else {
                alert("Anda harus memilih setidaknya satu pilihan.");
            }
            $("#"+check_problemID).prop("checked", true);
            service_length = 1;
            // $("#selectall").prop("checked", true);
            return false;
        }
    }
}

function checkValid() {
    let isTitleValid = $('#ticketTitle').val().trim() != "" && !invalidChar.test($('#ticketTitle').val());
    let isDetailValid = $('#ticketDetail').val().trim() != "" && !invalidChar.test($('#ticketDetail').val());
    let problemAreaChecked = document.querySelectorAll('input[type="checkbox"]:checked').length > 0;

    if (isTitleValid && isDetailValid && problemAreaChecked) {
        $('#submit-ticket').prop('disabled', false);
        $('#forbiddenChar').hide();
    } else {
        $('#submit-ticket').prop('disabled', true);
        $('#forbiddenChar').show();
    }
}


$('#ticketTitle').on("change keyup paste input", function () {
    checkValid();
})

var detailChar = false;

$('#ticketDetail').on("change keyup paste input", function () {
    checkValid();
})

// $("input[type=checkbox]").change(function () {
//     checkValid();
// })



// script paling bawah
$('a.nav-link[href="billpayment.php"]').removeClass('active');
$('a.nav-link[href="index.php"]').removeClass('active');
$('a.nav-link[href="usage.php"]').removeClass('active');
$('a.nav-link[href="support.php"]').addClass('active');
$('a.nav-link[href="mailbox.php"]').removeClass('active');