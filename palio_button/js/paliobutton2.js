// function to make the button draggable and retractable

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