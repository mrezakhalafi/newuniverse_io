<style>
	.contactUs-buttons {
		z-index: 500;
		display: flex;
		position: fixed;
		bottom: 2%;
		right: 4%;
	}

	.contactUs-buttons img {
		max-width: 30px !important;
		height: auto;
		display: block;
		margin: auto 5px;
	}
</style>

<div class="contactUs-buttons">
	<a href="<?php echo base_url(); ?>contactus.php"><span data-translate="palioButton-5"></span></a>
	<a href="#" id="link-whatsapp"><span data-translate="palioButton-6"></span></a>
	<!-- <a href="#" id="to-cU"><span data-translate="palioButton-7"></span></a> -->
</div>

<script>
	$(document).ready(function() {
	if ($(window).width() <= 991) {
		var phone = '';

		$('#contactus-email').attr('data-placement', 'left');
		$('#contactus-wa').attr('data-placement', 'left');
		$('#contactus-cu').attr('data-placement', 'left');

		$('#to-cU').click(function(e) {
			e.preventDefault();
			e.stopPropagation();
			triggerAppOpen();
		});

		if (localStorage.country_code == 'ID') {
			phone = '628119607282';
			$('#link-whatsapp').attr('href', 'https://api.whatsapp.com/send?phone=' + phone + '&app_absent=0');
		} else if (typeof localStorage.country_code === 'undefined' || localStorage.country_code != 'ID') {
			phone = '61414256049';
			$('#link-whatsapp').attr('href', 'https://api.whatsapp.com/send?phone=' + phone + '&app_absent=0');
		}
	} else if ($(window).width() >= 992) {
		$('#to-cU').attr('href', 'chatcore/pages/login_page.php?env=0');
		$('#to-cU').attr('target', '_blank');

		var phone = '';

		if (localStorage.country_code == 'ID') {
			phone = '628119607282';
			$('#link-whatsapp').attr('href', 'https://web.whatsapp.com/send?phone=' + phone);
		} else if (typeof localStorage.country_code === 'undefined' || localStorage.country_code != 'ID') {
			phone = '61414256049';
			$('#link-whatsapp').attr('href', 'https://web.whatsapp.com/send?phone=' + phone);
		}

		$('#link-whatsapp').attr('target', '_blank');
	}
});

var fallbackToStore = function() {
	window.location.replace('market://details?id=io.newuniverse.catchup');
};
var openApp = function() {
	window.location.replace('catchup://catchup?destination=025a395de8');
};
var triggerAppOpen = function() {
	openApp();
	setTimeout(fallbackToStore, 250);
};
</script>