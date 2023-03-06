<meta name="viewport" content="width=device-width, initial-scale=1">

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
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top px-0" id="navtop-alt">
    <div class="container" style="max-width: 90%">
      <a class="navbar-brand fontRobReg" href="<?php echo base_url(); ?>index.php">
        <img src="<?php echo base_url(); ?>newAssets/new-u-logo-alt.svg" id="logoImg">
      </a>
      <button class="navbar-toggler navbar-toggler-right" style="background-color: #1a73e8;" type="button" data-toggle="collapse" data-target="#navbar-section" aria-controls="navbar-section" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbar-section">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown position-static">
            <a class="nav-link nav-menu-link dropdown-toggle fontRobReg  fs-16" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: #1a73e8;">Products</a>
            <div class="dropdown-menu py-2 w-100">
              <div class="d-lg-flex justify-content-around w-100">
                  <div class="col d-flex justify-content-start text-left text-lg-center p-0">
                    <a class="dropdown-item fontRobReg fs-16 py-2" href="<?php echo base_url(); ?>livestream.php" style="display: inline;  color: #1a73e8;">Live Streaming</a> 
                  </div>
                  <div class="col d-flex justify-content-start text-left text-lg-center p-0">
                    <a class="dropdown-item fontRobReg fs-16 py-2" href="<?php echo base_url(); ?>videocall.php" style="display: inline;  color: #1a73e8;">Video Call</a>
                  </div>
                  <div class="col d-flex justify-content-start text-left text-lg-center p-0">
                    <a class="dropdown-item fontRobReg fs-16 py-2" href="<?php echo base_url(); ?>audiocall.php" style="display: inline;  color: #1a73e8;">Audio Call</a>
                  </div>
                  <div class="col d-flex justify-content-start text-left text-lg-center p-0">
                    <a class="dropdown-item fontRobReg fs-16 py-2" href="<?php echo base_url(); ?>screenshare.php" style="display: inline;  color: #1a73e8;">Screen Sharing</a>
                  </div>
                  <div class="col d-flex justify-content-start text-left text-lg-center p-0">
                    <a class="dropdown-item fontRobReg fs-16 py-2" href="<?php echo base_url(); ?>whiteboard.php" style="display: inline;  color: #1a73e8;">Whiteboarding</a>
                  </div>
                  <div class="col d-flex justify-content-start text-left text-lg-center p-0">
                    <a class="dropdown-item fontRobReg fs-16 py-2" href="<?php echo base_url(); ?>instantmessaging.php" style="display: inline;  color: #1a73e8;">Unified Messaging</a>
                  </div>
                  <div class="col d-flex justify-content-start text-left text-lg-center p-0">
                    <a class="dropdown-item fontRobReg fs-16 py-2" href="<?php echo base_url(); ?>chatbot.php" style="display: inline;  color: #1a73e8;">ChatBot</a>
                  </div>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-menu-link fontRobReg fs-16" href="<?php echo base_url(); ?>usecase.php" style="color: #1a73e8;">Use Case</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-menu-link fontRobReg fs-16" href="<?php echo base_url(); ?>newpricing.php" style="color: #1a73e8;">Pricing</a>
          </li>

          <?php if(!getSession('id_company')){ ?>
          
          <li class="nav-item">
            <a class="btn nav-menu-btn-wht-alt" href="<?php echo base_url(); ?>login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="btn nav-menu-btn-wht-alt" href="#subscribe">Subscribe</a>
          </li>
          
          <?php } else { ?>
          
          <li class="nav-item">
            <a class="btn nav-menu-btn-wht-alt" href="<?php echo base_url(); ?>newdashboard.php">Dashboard</a>
          </li>
          
          <?php } ?>
          
          
          <!-- <li class="nav-item">
            <a class="btn nav-menu-btn-wht-alt" href="<?php echo base_url(); ?>contactus.php">Contact Us</a>
          </li> --> 
        </ul>
      </div>
    </div>
  </nav>