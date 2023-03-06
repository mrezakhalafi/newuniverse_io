$(document).ready(function(){
    $('#titleText').bind('DOMSubtreeModified', function(event) {
		if (localStorage.lang == 1) {
			document.getElementsByName("name")[0].placeholder = "Nama";
			document.getElementsByName("message")[0].placeholder = "Pesan";
			document.getElementsByName("email")[0].placeholder = "Alamat Email";
		} else if (localStorage.lang == 0) {
			document.getElementsByName("name")[0].placeholder = "Name";
			document.getElementsByName("message")[0].placeholder = "Message";
			document.getElementsByName("email")[0].placeholder = "Email";
		}
	});

    $('#email').keyup(checkEmail);
    $('#message').focus(checkEmail);
});

function sendJSON() {
    var a = $('#name').val().trim();
    var b = $('#email').val().trim();
    var c = $('#message').val().trim();
    var whiteSpaceStart = /^\s+/;
    var whiteSpaceEnd = /\s+$/;
    var emptyString = /\S+/i;

    if (!emptyString.test(a) || !emptyString.test(b) || !emptyString.test(c)) {
        alert("Please fill all the required fields");
        return false;
    } else if (whiteSpaceStart.test(a) || whiteSpaceEnd.test(a) || whiteSpaceStart.test(b) || whiteSpaceEnd.test(b) || whiteSpaceStart.test(c) || whiteSpaceEnd.test(c)) {
        alert("Please check your input for unnecessary spaces!");
        return false;
    } else {

        $('#myModal').modal('show');

        let name = document.querySelector('#name');
        let email = document.querySelector('#email');
        let message = document.querySelector('#message');

        // Creating a XHR object 
        let xhr = new XMLHttpRequest();
        let url = "../response_email";

        // open a connection 
        xhr.open("POST", url, true);

        // Set the request header i.e. which type of content you are sending 
        xhr.setRequestHeader("Content-Type", "application/json");

        // Create a state change callback 
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {

                // Print received data from server 
                // result.innerHTML = this.responseText;
                console.log(this.responseText);

            }
        };

        // Converting JSON data to string 
        var data = JSON.stringify({
            "name": name.value,
            "email": email.value,
            "message": message.value
        });

        // Sending data with the request 
        xhr.send(data);
        $('input[name=name').val('');
        $('input[name=email').val('');
        $('textarea[name=message').val('');
    }
}

function checkEmail() {

    var val = $('#email').val();

    var regExEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;

    if (regExEmail.test(val)) {

        $('#alertEmail').css('display', 'none');
        $('#submit').prop('disabled', false);

    } else {

        $('#alertEmail').css('display', 'block');
        $('#submit').prop('disabled', true);

    }

}

/** error/success msg */
// <?php if (!empty($errMsg)) : ?>
// 	<script type="text/javascript">
// 		$(document).ready(function() {
// 			$("#myModal2").modal("show");
// 		});
// 	</script>
// <?php endif; ?>

// <?php if (!empty($succMsg)) : ?>
// 	<script type="text/javascript">
// 		$(document).ready(function() {
// 			$("#myModal").modal("show");
// 		});
// 	</script>
// <?php endif; ?>