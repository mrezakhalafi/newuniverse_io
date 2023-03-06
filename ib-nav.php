<?php

// if (isset($_POST['submitLogout'])) {
//   session_destroy();
//   header("Location: index.php");
// }

?>
<script type="text/javascript" src="<?php echo base_url(); ?>countdown.js"></script>

<script>
  // Set the date we're counting down to
  // var countDownDate = new Date(countdown_time).getTime();

  // Update the count down every 1 second
  // var x = setInterval(function() {

  // Get today's date and time
  // var now = new Date().getTime();

  // Find the distance between now and the count down date
  // var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  // var years = Math.floor((distance % (1000 * 60 * 60 * 24 * 30 * 12 * 356)) / (1000 * 60 * 60 * 24 * 30 * 12));
  // var months = Math.floor((distance % (1000 * 60 * 60 * 24 * 30 * 12)) / (1000 * 60 * 60 * 24 * 30));
  // var days = Math.floor((distance % (1000 * 60 * 60 * 24 * 30)) / (1000 * 60 * 60 * 24));
  // var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  // var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  // var seconds = Math.floor((distance % (1000 * 60)) / 1000);


  // document.getElementById("days").innerHTML = days + "d ";
  // document.getElementById("hours").innerHTML = hours + "h ";
  // document.getElementById("minutes").innerHTML = minutes + "m ";
  // document.getElementById("seconds").innerHTML = seconds + "s ";

  // document.getElementById("days-mobile").innerHTML = days + "d ";
  // document.getElementById("hours-mobile").innerHTML = hours + "h ";
  // document.getElementById("minutes-mobile").innerHTML = minutes + "m ";
  // document.getElementById("seconds-mobile").innerHTML = seconds + "s ";

  // If the count down is over, write some text
  //   if (distance < 0) {
  //     clearInterval(x);
  //     document.getElementById("exlabel").style.display = "none";
  //     document.getElementById("excountdown").style.display = "none";
  //     document.getElementById("countdown-label-desktop").style.display = "none";
  //     document.getElementById("countdown-desktop").style.display = "none";
  //   }
  // }, 1000);
</script>

<style>
  .coutndown-header {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    border-radius: 6px;
    padding: .5rem 1rem;
  }

  .label {
    font-size: .75rem;
    font-weight: 700;
    color: rgba(34, 46, 58, .25);
    /* margin-right: 16px; */
    padding: .5rem 1rem;
  }

  .countdown-header .countdown-six-hours {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    width: 250px;
  }


  .countdown-header .countdown-six-hours .divider,
  .countdown-header .countdown-six-hours span {
    font-size: 1.75rem;
    font-weight: 700;
    color: #222e3a;
  }

  .countdown-header .countdown-six-hours .count {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
  }

  .countdown-header .countdown-six-hours .divider,
  .countdown-header .countdown-six-hours span {
    font-size: 1.75rem;
    font-weight: 700;
    color: #222e3a;
  }

  @media screen and (min-width: 992px) {
    #countdown-mbl {
      display: none;
    }
  }

  @media screen and (max-width: 991px) {

    #countdown-label-desktop,
    #countdown-desktop {
      display: none;
    }
  }

  @media screen and (max-width:600px) {
    .navbar-toggler {
      position: absolute;
      right: 20px;
      top: 15px;
    }
  }

  @media screen and (min-width:601px) and (max-width:768px) {
    .navbar-toggler {
      position: absolute;
      right: 30px;
      top: 20px;
    }
  }

  @media screen and (min-width:769px) and (max-width:992px) {
    .navbar-toggler {
      position: absolute;
      right: 40px;
      top: 25px;
    }
  }
</style>

</head>

<body data-spy="scroll" data-target=".navbar" onload="PR.prettyPrint()" style="overflow-x: hidden;">
  <p hidden>
    Live Streaming
    Video Call
    Chat
    Audio Call
    Chatbot
    Call SDK
    Video Call SDK
  </p>


  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top px-0" id="navtop-alt" style="transition: top 0.3s;">
    <div class="container" style="max-width: 90%">
      <a class="navbar-brand fontRobReg" href="<?php echo base_url(); ?>ib.php">
        <img src="<?php echo base_url(); ?>newAssets/ib_logo.png" id="logoImg">
      </a>

      <button class="navbar-toggler navbar-toggler-right" style="background-color: #007a87;" type="button" data-toggle="collapse" data-target="#navbar-section" aria-controls="navbar-section" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbar-section">
        <ul class="navbar-nav ml-auto">

          <li class="nav-item">
            <a class="nav-link nav-menu-link fontRobReg fs-18 greenText" href="<?php echo base_url(); ?>ucaas.php" style="color: #1a73e8;">UCaaS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-menu-link fontRobReg fs-18 greenText" href="<?php echo base_url(); ?>cpaas.php" style="color: #1a73e8;">CPaaS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-menu-link fontRobReg fs-18 greenText" href="#" style="color: #1a73e8;">Video Conference</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-menu-link fontRobReg fs-18 greenText" href="#" style="color: #1a73e8;">Telemedicine</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>