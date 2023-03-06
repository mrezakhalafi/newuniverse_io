$(document).ready(function () {
    $("#emailTF").attr('autocomplete', 'off');
    $("#passwordTF").attr('autocomplete', 'off');
});

// $("#emailTF").on('input', function () {
//     checkEmail();
// });

if (localStorage.lang == 1) {
    document.getElementById("emailTF").placeholder = "Alamat Email";
}


function hasWhiteSpace(s) {
    return /\s/g.test(s);
}

$('#loginBTN').click(function (e) {
    e.preventDefault();
    // let dirtyEmail = $('#emailTF').val();
    // let dirtyPass = $('#passwordTF').val();
    let testEmail = hasWhiteSpace($('#emailTF').val());
    let testPass = hasWhiteSpace($('#passwordTF').val());
    if (testEmail === true || testPass === true) {
        // console.log('email', testEmail);
        // console.log('pass', testPass);
        $("#myModal").modal("show");
    } else {
        // console.log("'" + testEmail + "'");
        // console.log("'" + testPass + "'");
        var email = DOMPurify.sanitize($('#emailTF').val());
        var pass = DOMPurify.sanitize($('#passwordTF').val());
        // alert(email+pass);
        goLogin(email, pass);
    }
});

$('#emailTF').keyup(function (e) {
    // e.preventDefault();
    console.log(e.which);
    checkEmail();
    if (e.which === 13) {
        let testEmail = hasWhiteSpace($('#emailTF').val());
        let testPass = hasWhiteSpace($('#passwordTF').val());
        if (testEmail === true || testPass === true) {
            // console.log('email', testEmail);
            // console.log('pass', testPass);
            $("#myModal").modal("show");
        } else {
            // console.log("'" + testEmail + "'");
            // console.log("'" + testPass + "'");
            var email = DOMPurify.sanitize($('#emailTF').val());
            var pass = DOMPurify.sanitize($('#passwordTF').val());
            // alert(email+pass);
            goLogin(email, pass);
        }
    }
})

$('#passwordTF').keyup(function (e) {
    // e.preventDefault();
    console.log(e.which);
    if (e.which === 13) {
        let testEmail = hasWhiteSpace($('#emailTF').val());
        let testPass = hasWhiteSpace($('#passwordTF').val());
        if (testEmail === true || testPass === true) {
            console.log('email', testEmail);
            console.log('pass', testPass);
            $("#myModal").modal("show");
        } else {
            // console.log("'" + testEmail + "'");
            // console.log("'" + testPass + "'");
            var email = DOMPurify.sanitize($('#emailTF').val());
            var pass = DOMPurify.sanitize($('#passwordTF').val());
            // alert(email+pass);
            goLogin(email, pass);
        }
    }
})

function checkEmail() {

    var val = $('#emailTF').val();

    var regExEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;

    if (val != "") {

        $("#emptyEmail").addClass("d-none");
        if (regExEmail.test(val)) {

            $('#alertEmail').addClass("d-none");

        } else {

            $('#alertEmail').removeClass('d-none')

            $('body').on('keydown', function (e) {
                if (e.keyCode == 9) e.preventDefault();
            });

        }
    } else {
        $("#emptyEmail").removeClass('d-none')
        $('#alertEmail').addClass("d-none");
    }

}

function checkPassword() {
    var val = $('#passwordTF').val();

    if (val != "") {
        $("#emptyPass").removeClass("d-none");

    } else {
        $("#emptyPass").addClass("d-none");
    }
}

function goLogin(email, password) {
    $.ajax({
                dataType: 'json',
                url: 'checkEmail.php?email=' + email + '&password=' + password + '&cc=' + localStorage.country_code,
                type: 'GET',
                success: function (data) {
                        // alert(data.response);
                        console.log(data);
                        if (data.response == "You already logged in with another account!") {
                            alert(data.response);
                            window.location.href = "dashboardv2/";
                        } else if (data.response == "ok") {
                            window.location.href = ('dashboardv2/');
                        } else if (data.response == "Please Validate Your Email!") {
                            window.location.href = ('verifyemail.php');
                        } else if (data.response == "Please Finish Your Payment!") {
                            window.location.href = ('paycheckout.php');
                        } else if (data.response == "Trial!") {
                            window.location.href = ('trialcheckout.php');
                        } else if (data.response == "expired") {
                            alert('Your account has expired. Please subscribe if you would like to continue.');
                            window.location.href = 'dashboardv2/index';
                        } else if (data.response == "Your Password is Incorrect!") {

                            if (email == '' || password == '') {

                                if (localStorage.lang == 0) {
                                    alert('Please fill all the required fields.');
                                } else {
                                    alert('Harap isi semua bidang yang diperlukan.');
                                }

                                let email = $('#emailTF').val();
                                let pass = $('#passwordTF').val();

                                if (localStorage.lang == 0) {
                                    $('#emptyEmail').text('Please fill this field.');
                                    $('#emptyPass').text('Please fill this field.');
                                } else {
                                    $('#emptyEmail').text('Harap isi bidang ini.');
                                    $('#emptyPass').text('Harap isi bidang ini.');
                                }

                                if (!email) {
                                    $('#emptyEmail').removeClass("d-none");
                                } else {
                                    $('#emptyEmail').addClass("d-none");
                                }

                                if (!pass) {
                                    $('#emptyPass').removeClass("d-none");
                                } else {
                                    $('#emptyPass').addClass("d-none");
                                }

                                $('body').on('keydown', function (e) {
                                    if (e.keyCode == 9) e.preventDefault();
                                });

                            } else {

                                $.ajax({
                                    dataType: 'json',
                                    url: 'checkEmail.php?email=' + email + '&password=' + password + '&cc=' + localStorage.country_code,
                                    type: 'GET',
                                    success: function (data) {
                                        // alert(data.response);
                                        console.log(data);
                                        if (data.response == "You already logged in with another account!") {
                                            alert(data.response);
                                            window.location.href = "dashboardv2/";
                                        } else if (data.response == "ok") {
                                            window.location.href = ('dashboardv2/');
                                        } else if (data.response == "Please Validate Your Email!") {
                                            window.location.href = ('verifyemail.php');
                                        } else if (data.response == "Please Finish Your Payment!") {
                                            window.location.href = ('paycheckout.php');
                                        } else if (data.response == "Trial!") {
                                            window.location.href = ('trialcheckout.php');
                                        } else if (data.response == "expired") {
                                            alert('Your account has expired. Please subscribe if you would like to continue.');
                                            window.location.href = 'dashboardv2/index';
                                        } else if (data.response == "Account does not exist!") {
                                            if (localStorage.lang == 0) {
                                                alert('Account does not exist!');
                                            } else {
                                                alert('Akun tersebut tidak ditemukan!');
                                            }
                                        } else if (data.response == "Your Password is Incorrect!") {
                                            $('#emptyEmail').css('display', 'none');

                                            // $("#myModal").modal("show");

                                            if (localStorage.lang == 0) {
                                                alert('Your Password is Incorrect!');
                                            } else {
                                                alert('Password anda salah!');
                                            }

                                            $('body').on('keydown', function (e) {
                                                if (e.keyCode == 9) e.preventDefault();
                                            });
                                        }
                                    },
                                    error: function (xhr, status, error) {
                                        console.log(error);
                                        $("#myModal").modal("show");
                                    }
                                });
                            }
                        }
                    }
                });
            }

                        /** success/error msg */
                        // $(document).ready(function() {
                        //     $("#myModal").modal("show");
                        // });