// setInterval(function () {
//     fetchNotifPeriodic();
// }, 2000);

// complain notif modal
function complainIdentity(name, thumb) {
  document.getElementById("complain-name").innerHTML = name;
  document.getElementById("complain-thumb").src = thumb;
  if (localStorage.getItem("complain_channel") == "0") {
    document.getElementById("cc-channel").innerHTML = "Chat";
  } else if (localStorage.getItem("complain_channel") == "1") {
    document.getElementById("cc-channel").innerHTML = "Audio Call";
  } else if (localStorage.getItem("complain_channel") == "2") {
    document.getElementById("cc-channel").innerHTML = "Video Call";
  }
}

function fetchNotifPeriodic() {
  // var formData = new FormData();
  // formData.append('f_pin', localStorage.F_PIN);

  var xmlHttp = new XMLHttpRequest();
  xmlHttp.onreadystatechange = function () {
    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
      // get friends lpins
      data = JSON.parse(xmlHttp.responseText);

      // Put the object into storage

      if (data != 0) {
        localStorage.setItem("complain", data.CUSTOMER_F_PIN);
        localStorage.setItem("complain_name", data.CUSTOMER_NAME);
        localStorage.setItem("complain_channel", data.CHANNEL.toString());
        localStorage.setItem("complainID", data.COMPLAINT_ID);

        if (data.CUSTOMER_THUMB == null || data.CUSTOMER_THUMB.trim() == "") {
          var thumb = "/chatcore/assets/img/default_pp.png";
        } else {
          // var thumb = "https://qmera.io/filepalio/image/" + data.CUSTOMER_THUMB;
          var thumb = location.protocol + '//' + location.host + "filepalio/image/" + data.CUSTOMER_THUMB;
        }

        // console.log('complain channel: ' + localStorage.getItem('complain_channel'));
        complainIdentity(data.CUSTOMER_NAME, thumb);
        mClassList(DOM.complainModal).remove("d-none");
        mClassList(DOM.complainModal).add("d-block");
        // if (user != null && user.user_type == 24) {
        mClassList(DOM.finishComplain).remove("d-none");
        // }
      } else {
        mClassList(DOM.complainModal).remove("d-block");
        mClassList(DOM.complainModal).add("d-none");
        if (user != null && user.user_type == 24) {
          if (isOngoingCC == true && chat.is_complain == 1) {
            mClassList(DOM.finishComplain).remove("d-none");
          } else {
            mClassList(DOM.finishComplain).add("d-none");
          }
        }
      }
    }
  };
  xmlHttp.open("get", "/chatcore/logics/fetch_notif?f_pin=" + localStorage.F_PIN);
  xmlHttp.send();
}
