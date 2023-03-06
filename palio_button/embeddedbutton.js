var domain = window.location.hostname;
var xmlHttp = new XMLHttpRequest();
xmlHttp.onreadystatechange = function () {
    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {

        // check if the domain registered
        if(xmlHttp.responseText == "registered"){
            // console.log(xmlHttp.responseText);
            console.log("Please enjoy your palio button!");
            // console.log(userAgent);

            // fetch the floating button and insert required js
            fetch('http://103.94.169.26:8082/palio_button/paliobutton.html').then(response => response.text()).then(data => {

                var paliobutton = data.replace(/\s*\n\s*/g, "");
                document.body.insertAdjacentHTML('afterbegin', paliobutton);

                var script1 = document.createElement('script');
                script1.src = "http://103.94.169.26:8082/palio_button/js/jquery.min.js";
                document.head.append(script1);
                
                var script2 = document.createElement('script');
                script2.src = "http://103.94.169.26:8082/palio_button/js/jquery-ui.min.js";
                script2.onload = function() {
                    var $ = window.jQuery;
                    $(function () {
                        $("#wrap-all").draggable({
                            containment: 'window'
                        });

                        $("body").tooltip({
                            selector: '[data-toggle="tooltip"]'
                        });

                        $("#palio-button-1").click(function () {
                            $("#feature-buttons").slideToggle("slow")
                        });

                        document.getElementById("palio-button-1").addEventListener("touchstart", tapHandler);
                        var tapedTwice = false;

                        function tapHandler(event) {
                            if (!tapedTwice) {
                                tapedTwice = true;
                                setTimeout(function () {
                                    tapedTwice = false
                                }, 500);
                                return false
                            }
                            event.preventDefault();
                            $("#feature-buttons").slideToggle("slow")
                        }
                    });
                };
                document.head.append(script2);

                var link  = document.createElement('link');
                link.rel  = 'stylesheet';
                link.type = 'text/css';
                link.href = 'http://103.94.169.26:8082/palio_button/css/paliopay.css';
                document.head.append(link);

                var script4 = document.createElement('script');
                script4.src = "http://103.94.169.26:8082/palio_button/js/xendit.min.js";
                document.head.append(script4);

                var script3 = document.createElement('script');
                script3.src = "http://103.94.169.26:8082/palio_button/js/paliopay.js";
                document.head.append(script3);

            });

        } else {
            alert("Your domain not registered! Please register at palio.io.");
        }

    } 
}
xmlHttp.open("get", "http://103.94.169.26:8082/palio_button/php/paliochecker?domain=" + domain);
xmlHttp.send();