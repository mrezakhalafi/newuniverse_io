function checkuser() {
    var company_id = <?= $_SESSION['id_company']; ?>;
    $.post("checkStateUser", {
        company_id: company_id
      },
      function(data) {
        if (data == 1) {
          // location.href = 'paycheckout.php';
          $('#verified').removeClass('d-none');
          $('#verifyemail').addClass('d-none');
        } else if (data == 3) {
          // location.href = 'trialcheckout.php';
          $('#verified').removeClass('d-none');
          $('#verifyemail').addClass('d-none');
        } else {
          setTimeout(checkuser, 2000);
        }
      }
    );
  }


  $(document).ready(function() {
    checkuser();
    

    function expiredVerify() {
      var company_id = <?php echo $_SESSION['id_company']; ?>;
      $.post("cancelVerify", {
          company_id: company_id
        },
        console.log('Verification expired in 1 hour!')
      );
    }

      expiredVerify();
  });