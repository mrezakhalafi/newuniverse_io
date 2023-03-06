<link rel="stylesheet" href="css/style.css" crossorigin="anonymous">

<div class="icon-bar-wrap" id="wrap-all">
    <div class="icon-bar"  id="feature-buttons">
        <!-- <a href="chatcore/pages/login_page.php?env=1" target="_blank"><span data-translate="palioButton-1"></span></a>
        <a href="chatcore/pages/login_page.php?env=1" target="_blank"><span data-translate="palioButton-2"></span></a>
        <span data-translate="palioButton-3"></span>
        <span data-translate="palioButton-4"></span> -->
        <img data-html="true" data-toggle="tooltip" data-placement="right" src="assets/button_cc.png" alt="cc" class="paliobutton" title="Berikan Pelangganmu <i>Contact Center</i> canggih langsung dari aplikasimu. Libatkan pelanggan melalui <i>VoIP/Video Call</i> atau <i>chat</i> sederhana ..." />
        <img data-html="true" data-toggle="tooltip" data-placement="right" src="assets/button_chat.png" alt="chat" class="paliobutton" title="Siarkan pesan untuk memberi tahu pelanggan kamu tentang produk baru, diskon khusus, dan promosi. Kamu juga dapat menambahkan fitur yang memungkinkan pelangganmu untuk mengobrol satu sama lain. Makin banyak alasan untuk mereka menghabiskan lebih banyak waktu di aplikasimu..." />
        <img data-html="true" data-toggle="tooltip" data-placement="right" src="assets/button_call.png" alt="call" class="paliobutton" title="Selain itu, kamu dapat menyediakan fitur <i>VoIP & Video Call</i> kepada pelangganmu untuk meningkatkan loyalitas mereka..." />
        <img data-html="true" data-toggle="tooltip" data-placement="right" src="assets/button_stream.png" alt="stream" class="paliobutton" title="Umumkan dan iklankan produk baru, diskon, dan konten promosi lainnya dengan <i>livestreaming</i> ke pelangganmu... " />'
    </div>
    <div class="palio-button" id="palio-button-1">
        <img src="assets/palio_button.png" alt="palio" />
    </div>
</div>


<script src="js/jquery-3.4.1.min.js"></script>
<script>
    $(function()
{
	$("#wrap-all").draggable(
	{
		containment: 'window'
	});
	$("body").tooltip(
	{
		selector: '[data-toggle="tooltip"]'
	});
	$("#palio-button-1").click(function()
	{
		$("#feature-buttons").slideToggle("slow")
	});
	document.getElementById("palio-button-1").addEventListener("touchstart", tapHandler);
	var tapedTwice = false;

	function tapHandler(event)
	{
		if (!tapedTwice)
		{
			tapedTwice = true;
			setTimeout(function()
			{
				tapedTwice = false
			}, 500);
			return false
		}
		event.preventDefault();
		$("#feature-buttons").slideToggle("slow")
	}
});

</script>