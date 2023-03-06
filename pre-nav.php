<!-- <script>
  $(document).ready(function () {
    var swidth = screen.width;
    if (swidth < 992){
      document.getElementById("navtop-alt").style.height = "88px";
    } else {
      document.getElementById("navtop-alt").style.height = "65px";
    }
  });
</script>
<script>
  function resize(){
    var swidth = screen.width;
    if (swidth < 992){	
      document.getElementById("navtop-alt").style.height = "88px";
    } else {
      document.getElementById("navtop-alt").style.height = "65px";
    }
  }  

  window.onresize = resize;
</script> -->
<script>
  var prevScrollpos = window.pageYOffset;
  window.onscroll = function() {
    var currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
      document.getElementById("navtop-alt").style.top = "0";
    } else {
      document.getElementById("navtop-alt").style.top = "-88px";
    }
    prevScrollpos = currentScrollPos;
  }
</script>





</head>

<body data-spy="scroll" data-target=".navbar" onload="PR.prettyPrint()" style="overflow-x: hidden;">
  <!--<p hidden>
    Live Streaming
    Video Call
    Chat
    Audio Call
    Chatbot
    Call SDK
    Video Call SDK
  </p>-->

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top px-0" id="navtop-alt" style="transition: top 0.3s;">
    <div class="container" style="max-width: 90%">
      <a class="navbar-brand fontRobReg" href="<?php echo base_url(); ?>prelaunch-index.php">
        <img src="<?php echo base_url(); ?>main_logo.png" id="logoImg">
      </a>
      <button class="navbar-toggler navbar-toggler-right" style="background-color: #007a87;" type="button" data-toggle="collapse" data-target="#navbar-section" aria-controls="navbar-section" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbar-section">
        
      </div>
    </div>
  </nav>