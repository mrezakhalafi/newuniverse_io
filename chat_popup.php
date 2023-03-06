<?php 

    $version = 'v=1.69';

?>

<style>
    @media screen and (min-width: 1366px) {
        #chatSection {
            bottom: 4% !important;
        }
    }

    #chatSection {
        bottom: 4% !important;
    }

    #userListDropdown .dropdown-menu {
        max-height: 200px;
        overflow-y: auto;
    }
</style>

<div id="chatSection" class="animated">
    <div class="card shadow border-0" style="width: 350px; height: 400px;">
        <div class="card-header" style="background-color: #01686d; padding: 0px 20px; margin-bottom: 5px;">
            <div id="welcomeChat">
                <p class="fontRobReg fs-20 text-light">Welcome to Live Chat</p>
                <p class="fontRobReg fs-15 text-light">Please fill the details below before chatting with us</p>
            </div>
            <div id="userListDropdown">
                <a class="dropdown-toggle" href="#" role="button" id="userList" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div id="headerChat" class="animated fadeIn d-none py-2 dropdown">
                        <img src="cb-logo.png" class="mr-2" style="max-height: 40px; width: auto;">
                        <p class="fontRobReg fs-20 text-light d-inline m-0 align-self-center" id="chatUserName">Customer Support</p>
                        <!-- <button id="goLiveChat" class="btn nav-menu-btn fs-15" type="button">Click to start Live Chat</button> -->
                    </div>
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <!-- <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a> -->
                </div>
            </div>
        </div>
        <div class="shadow" id="notifChat">
            <div class="row m-0 align-items-center" id="startLive" style="display: none;">
                <span class="btn btn-link p-0 my-1 ml-3 fontRobReg" style="font-size: 12px; cursor: pointer; color: #01686d" onclick="goLiveChat();">Click here</span>
                <p class="fontRobReg my-1" style="font-size: 12px;">&nbsp;to start live chat.</p>
            </div>
            <div class="row m-0 align-items-center d-none" id="isLive">
                <span class="btn btn-link p-0 my-1 ml-3" style="font-size: 12px;">Customer Support 1</span>
                <p class="fontRobReg my-1" style="font-size: 12px;">&nbsp;is now online.</p>
            </div>
            <div class="row m-0 align-items-center justify-content-center d-none" id="isLoad" style="height: 28px;">
                <div class="spinner d-flex ml-3">
                    <div class="bounce1"></div>
                    <div class="bounce2"></div>
                    <div class="bounce3"></div>
                </div>
            </div>
        </div>
        <div class="card-body" id="chatBody" style="max-height: 100% !important; padding-left: 0px; padding-right: 0px;">
            <ul id="chat-ul" style="list-style-type: none; padding-left: 0;"></ul>
        </div>
        <div class="card-footer" style="padding-bottom: 5px;">
            <div class="row text-center" style="position: relative;">
                <div class="col-md-12 justify-content-center p-0">

                    <div class="animated fadeInDown" id="msgField">
                        <div class="input-group">
                            <input oninput="checkInput()" type="text" placeholder="Write a Message..." required name="isiChat" class="form-control mytext" id="mytext" style="margin-right: 1px;">
                            <div class="input-group-append">
                                <button onclick="scrollchat()" type="button" id="sendchat" class="btn nav-menu-btn-wht m-0" style="color: #01686d; height: 35px; font-size: 1rem;">Send</button>
                            </div>
                        </div>
                        <div id="suggest" class="row flex-column justify-content-start m-0 text-left pl-2">

                        </div>
                    </div>
                    <div id="startnewchat" style="display: none;">
                        <div class="row justify-content-center m-0 text-center">
                            <p class="fontRobBold m-0" style="font-size: 15px;">Your chat has ended</p>
                            <br>
                            <p class="fontRobReg m-0" style="font-size: 13px;">Ask more question by starting a new chat</p>
                        </div>
                        <div class="row justify-content-center m-2 text-center">
                            <button type="button" id="sendchat" class="btn nav-menu-btn-wht m-0" style="color: #01686d; font-size: 13px;">Start new chat</button>
                        </div>
                    </div>
                    <!-- <form class="animated" id="regChat">
						<input type="email" id="emailtxt" name="email" placeholder="Email" class="form-control my-2">
						<button type="button" id="goChatBtn" class="btn nav-menu-btn shadow m-0" onclick="sendInfo();">Lets Go!</button>
					</form> -->
                </div>
            </div>
        </div>
    </div>
</div>

<img src="<?php echo base_url(); ?>newAssets/chat bawah.svg" style="max-width: 40px; height: auto; display: block;" class="animated zoomIn" id="showChat">

<img src="<?php echo base_url(); ?>newAssets/Close.svg" style="max-width: 40px; height: auto; display: none;" class="animated zoomIn" id="closeChat">

<script src="https://cdn.jsdelivr.net/npm/javascript-obfuscator/dist/index.browser.js"></script>

<script src="js/chat.js?<?php echo $version; ?>"></script>