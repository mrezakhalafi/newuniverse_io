$(document).ready(function () {

	$("#download-sample-code").on('click', function () {
		if (localStorage.lang == 0) {
			alert('Please sign up first before downloading the sample code!');
		} else {
			alert('Mohon lakukan registrasi terlebih dahulu sebelum mengunduh kode sampel!');
		}
		location.href = 'sign_up.php';
	});

	$("#lite-android").click(function () {
		
		$("#selected-version").attr("src", "newAssets/android3d.png");
		$("#practical-android").removeClass("d-none");
		$("#practical-ios").addClass("d-none");
		$("span#mainactivity-title").removeClass("d-none");
		$("span#mainactivity-title-ios").addClass("d-none");
		$("#nusdklite-small-tabs-3").click();
	});

	$("#lite-iOS").click(function () {
		
		$("#selected-version").attr("src", "newAssets/ios3d.png");
		$("#practical-android").addClass("d-none");
		$("#practical-ios").removeClass("d-none");
		$("span#mainactivity-title").addClass("d-none");
		$("span#mainactivity-title-ios").removeClass("d-none");
		$("#nusdklite-small-tabs-1-ios").click();
	});

	// practical android
	if (localStorage.country_code == 'ID') {
		if (localStorage.getItem('lang') == 1) {
			$("#LS-nusdklite1_ID").css("display", "block");
			$("#LS-nusdklite1").css("display", "none");
		} else if (localStorage.getItem('lang') == 0) {
			$("#LS-nusdklite1_ID").css("display", "none");
			$("#LS-nusdklite1").css("display", "block");
		}
	} else if (localStorage.country_code != 'ID') {
		$("#LS-nusdklite1_ID").css("display", "none");
		$("#LS-nusdklite1").css("display", "block");
	}

	$("#nusdklite-small-tabs-disclaimer").click(function () {
		$("#nusdklite0").css("display", "block");
		if (localStorage.country_code == 'ID') {
			if (localStorage.getItem('lang') == 1) {
				$("#LS-nusdklite0_ID").css("display", "block");
				$("#LS-nusdklite0").css("display", "none");
			} else if (localStorage.getItem('lang') == 0) {
				$("#LS-nusdklite0_ID").css("display", "none");
				$("#LS-nusdklite0").css("display", "block");
			}
		} else if (localStorage.country_code != 'ID') {
			$("#LS-nusdklite0_ID").css("display", "none");
			$("#LS-nusdklite0").css("display", "block");
		}
		$("#nusdklite1").css("display", "none");
		$("#nusdklite3").css("display", "none");
		$("#nusdklite5").css("display", "none");
	});

	$("#nusdklite-small-tabs-1").click(function () {
		$("#nusdklite0").css("display", "none");
		$("#nusdklite1").css("display", "block");
		if (localStorage.country_code == 'ID') {
			if (localStorage.getItem('lang') == 1) {
				$("#LS-nusdklite1_ID").css("display", "block");
				$("#LS-nusdklite1").css("display", "none");
			} else if (localStorage.getItem('lang') == 0) {
				$("#LS-nusdklite1_ID").css("display", "none");
				$("#LS-nusdklite1").css("display", "block");
			}
		} else if (localStorage.country_code != 'ID') {
			$("#LS-nusdklite1_ID").css("display", "none");
			$("#LS-nusdklite1").css("display", "block");
		}
		$("#nusdklite3").css("display", "none");
		$("#nusdklite5").css("display", "none");
	});

	$("#nusdklite-small-tabs-3").click(function () {
		$("#nusdklite3").css("display", "block");
		$("#nusdklite0").css("display", "none");
		$("#nusdklite1").css("display", "none");
		$("#nusdklite5").css("display", "none");
	});

	$("#nusdklite-small-tabs-5").click(function () {
		$("#nusdklite5").css("display", "block");
		$("#nusdklite0").css("display", "none");
		$("#nusdklite1").css("display", "none");
		$("#nusdklite3").css("display", "none");
	});

	$('.to-flutter').click(function (e) {
		e.preventDefault();
        e.stopPropagation();
		$('#mainactivity-title').text('MainActivity.java (Option 2)');
		$('#LS-nusdklite1-nonextend-flutter').show();
		$('#LS-nusdklite1').hide();
	});

	$('.to-native').click(function (e) {
		e.preventDefault();
        e.stopPropagation();
		$('#mainactivity-title').text('MainActivity.java (Option 1)');
		$('#LS-nusdklite1').show();
		$('#LS-nusdklite1-nonextend-flutter').hide();
	});
	// end practical android

	// practical ios
	$("#nusdklite-small-tabs-disclaimer-ios").click(function () {
		$("#nusdklite0-ios").css("display", "block");
		if (localStorage.country_code == 'ID') {
			if (localStorage.getItem('lang') == 1) {
				$("#LS-nusdklite0_ID-ios").css("display", "block");
				$("#LS-nusdklite0-ios").css("display", "none");
			} else if (localStorage.getItem('lang') == 0) {
				$("#LS-nusdklite0_ID-ios").css("display", "none");
				$("#LS-nusdklite0-ios").css("display", "block");
			}
		} else if (localStorage.country_code != 'ID') {
			$("#LS-nusdklite0_ID-ios").css("display", "none");
			$("#LS-nusdklite0-ios").css("display", "block");
		}
		$("#nusdklite1-ios").css("display", "none");
		$("#nusdklite3-ios").css("display", "none");
	});

	$("#nusdklite-small-tabs-1-ios").click(function () {
		$("#nusdklite0-ios").css("display", "none");
		$("#nusdklite1-ios").css("display", "block");
		$("#nusdklite3-ios").css("display", "none");
	});

	$("#nusdklite-small-tabs-3-ios").click(function () {
		$("#nusdklite3-ios").css("display", "block");
		$("#nusdklite0-ios").css("display", "none");
		$("#nusdklite1-ios").css("display", "none");
	});

	$('.to-flutter-ios').click(function (e) {
		e.preventDefault();
        e.stopPropagation();
		$('#mainactivity-title-ios').text('MainActivity.java (Option 2)');
		$('#LS-nusdklite1-nonextend-flutter-ios').show();
		$('#LS-nusdklite1-ios').hide();
	});

	$('.to-native-ios').click(function (e) {
		e.preventDefault();
        e.stopPropagation();
		$('#mainactivity-title-ios').text('MainActivity.java (Option 1)');
		$('#LS-nusdklite1-ios').show();
		$('#LS-nusdklite1-nonextend-flutter-ios').hide();
	});
	// end practical ios

    // start customer journey tabs
    $("#merchant-website-tab").click(function(e) {
        $("#merchant-website").removeClass("d-none");
        $("#buyer").addClass("d-none");
    })
    $("#buyer-tab").click(function(e) {
        $("#merchant-website").addClass("d-none");
        $("#buyer").removeClass("d-none");
    })
    // end customer journey tabs

	$('.carousel-item').first().addClass('active');

	if ($(window).width() <= 991) {
		$('#usecase-nav').attr('data-toggle', 'dropdown');
		$('#products-nav').attr('data-toggle', 'dropdown');
		$('#cat-nav').attr('data-toggle', 'dropdown');
		$('#solutions-nav').attr('data-toggle', 'dropdown');
		$('#blog-nav').attr('data-toggle', 'dropdown');
		$('#lang-nav').attr('data-toggle', 'dropdown');
		$('#platform-nav').attr('data-toggle', 'dropdown');
	} else if ($(window).width() >= 992) {
		$(function () {
			$("#products-li.dropdown").hover(
				function () {
					$('#products-menu.dropdown-menu', this).stop(true, true).fadeIn("fast");
					$(this).toggleClass('open');
				},
				function () {
					$('#products-menu.dropdown-menu', this).stop(true, true).fadeOut("fast");
					$(this).toggleClass('open');
				}
			);
		});
		$(function () {
			$("#usecase-li.dropdown").hover(
				function () {
					$('#usecase-menu.dropdown-menu', this).stop(true, true).fadeIn("fast");
					$(this).toggleClass('open');
				},
				function () {
					$('#usecase-menu.dropdown-menu', this).stop(true, true).fadeOut("fast");
					$(this).toggleClass('open');
				}
			);
		});
		$(function () {
			$("#solutions-li.dropdown").hover(
				function () {
					$('#solutions-menu.dropdown-menu', this).stop(true, true).fadeIn("fast");
					$(this).toggleClass('open');
				},
				function () {
					$('#solutions-menu.dropdown-menu', this).stop(true, true).fadeOut("fast");
					$(this).toggleClass('open');
				}
			);
		});

		$(function () {
			$("#blog-li.dropdown").hover(
				function () {
					$('#blog-menu.dropdown-menu', this).stop(true, true).fadeIn("fast");
					$(this).toggleClass('open');
				},
				function () {
					$('#blog-menu.dropdown-menu', this).stop(true, true).fadeOut("fast");
					$(this).toggleClass('open');
				}
			);
		});

		// $(function () {
		// 	$("#lang-li.dropdown").hover(
		// 		function () {
		// 			$('#lang-menu').addClass('dropdown-menu-right');
		// 			$('#lang-menu.dropdown-menu', this).stop(true, true).fadeIn("fast");
		// 			$(this).toggleClass('open');
		// 		},
		// 		function () {
		// 			$('#lang-menu.dropdown-menu', this).stop(true, true).fadeOut("fast");
		// 			$(this).toggleClass('open');
		// 		}
		// 	);
		// });

		$(document).on('click', function (e) {

			// console.log(e.target.id);

			if ((e.target.id == 'lang-nav' || e.target.id == 'lang-id') && $('#lang-menu').css('display') == 'none') {
				$('#lang-menu').addClass('dropdown-menu-right');
				$('#lang-menu.dropdown-menu', this).stop(true, true).fadeIn("fast");
				$(this).toggleClass('open');
			}else{
				$('#lang-menu.dropdown-menu', this).stop(true, true).fadeOut("fast");
			}

		});

		$(function () {
			$("#platform-li.dropdown").hover(
				function () {
					$('#platform-menu.dropdown-menu', this).stop(true, true).fadeIn("fast");
					$(this).toggleClass('open');
				},
				function () {
					$('#platform-menu.dropdown-menu', this).stop(true, true).fadeOut("fast");
					$(this).toggleClass('open');
				}
			);
		});
	}


	var yourHeight = 65;

	var scrolledY = window.scrollY;

	if (scrolledY) {
		window.scroll(0, scrolledY - yourHeight);
	}

	//include blog categories
	$('.cat-select').each(function () {
		$(this).click(function () {
			if ($(this).closest('#cat-available').length > 0) {
				$('#cat-include').append($(this));
				$('#cat-include').append(' ');
				$(this).removeClass('btn-success');
				$(this).addClass('btn-primary');
			} else if ($(this).closest('#cat-include').length > 0) {
				$('#cat-available').append($(this));
				$('#cat-available').append(' ');
				$(this).removeClass('btn-primary');
				$(this).addClass('btn-success');
			}
		});
	});

	if (localStorage.lang == 0) {
		$("#credit-1").attr("title", 'Up to 1,000 chars for each text. For each text sent, the credit will be deducted by the number of recipients of the message. For example, you can send 5,000 texts to 1,000 recipients.');
		$("#credit-2").attr("title", 'Up to 250 KB for each image. For each image sent, the credit will be deducted by the number of recipients of the image; For example, you can send 50 images to 1,000 recipients.');
		$("#credit-3").attr("title", 'Up to 2.5 MB for each video. For each video sent, the credit will be deducted by the number of recipients of the image; For example, you can send 5 videos to 1,000 recipients.');
		$("#credit-4").attr("title", 'Up to 3 minutes livestream to 1,000 recipients.');
		$("#credit-5").attr("title", 'If you, for example, have 10 team members, they can have 5,000 (50,000/10) minutes of VoIP Calls between them.');
		$("#credit-6").attr("title", 'If you, for example, have 10 team members, they can have 50 (500/10) minutes of Video Calls between them.');
	} else {
		$("#credit-1").attr("title", 'Hingga 1.000 karakter untuk setiap teks. Untuk setiap teks yang dikirim, kredit akan dikurangi dengan jumlah penerima pesan. Misalnya, kamu bisa mengirim 5.000 teks ke 1.000 penerima.');
		$("#credit-2").attr("title", 'Hingga 250 KB untuk setiap gambar. Untuk setiap gambar yang dikirim, kredit akan dikurangi dengan jumlah penerima gambar; Misalnya, kamu bisa mengirim 50 gambar ke 1.000 penerima.');
		$("#credit-3").attr("title", 'Hingga 2,5 MB untuk setiap video. Untuk setiap video yang dikirim, kredit akan dikurangi dengan jumlah penerima gambar; Misalnya, kamu bisa mengirim 5 video ke 1.000 penerima.');
		$("#credit-4").attr("title", 'Livestreaming hingga 3 menit untuk 1.000 penonton.');
		$("#credit-5").attr("title", 'Contoh: untuk 10 anggota tim, mereka dapat melakukan 5.000 (50.000 / 10) menit Panggilan VoIP di antara mereka.');
		$("#credit-6").attr("title", 'Contoh: 10 anggota tim, mereka dapat memiliki Video Call 50 (500/10) menit di antara mereka.');
	}

	$("a.credit-hint").click(function (e) {
		e.preventDefault();
	});

	$(".credit-hint").tooltip({
		placement: 'right'
	});

	$("#change-lang-EN").click(function () {
		$("#credit-1").attr("title", 'Up to 1,000 chars for each text. For each text sent, the credit will be deducted by the number of recipients of the message. For example, you can send 5,000 texts to 1,000 recipients.');
		$("#credit-2").attr("title", 'Up to 250 KB for each image. For each image sent, the credit will be deducted by the number of recipients of the image; For example, you can send 50 images to 1,000 recipients.');
		$("#credit-3").attr("title", 'Up to 2.5 MB for each video. For each video sent, the credit will be deducted by the number of recipients of the image; For example, you can send 5 videos to 1,000 recipients.');
		$("#credit-4").attr("title", 'Up to 3 minutes livestream to 1,000 recipients.');
		$("#credit-5").attr("title", 'If you, for example, have 10 team members, they can have 5,000 (50,000/10) minutes of VoIP Calls between them.');
		$("#credit-6").attr("title", 'If you, for example, have 10 team members, they can have 50 (500/10) minutes of Video Calls between them.');
		$("a.credit-hint").click(function (e) {
			e.preventDefault();
		});

		$(".credit-hint").tooltip({
			placement: 'right'
		});
	});

	$("#change-lang-ID").click(function () {
		$("#credit-1").attr("title", 'Hingga 1.000 karakter untuk setiap teks. Untuk setiap teks yang dikirim, kredit akan dikurangi dengan jumlah penerima pesan. Misalnya, kamu bisa mengirim 5.000 teks ke 1.000 penerima.');
		$("#credit-2").attr("title", 'Hingga 250 KB untuk setiap gambar. Untuk setiap gambar yang dikirim, kredit akan dikurangi dengan jumlah penerima gambar; Misalnya, kamu bisa mengirim 50 gambar ke 1.000 penerima.');
		$("#credit-3").attr("title", 'Hingga 2,5 MB untuk setiap video. Untuk setiap video yang dikirim, kredit akan dikurangi dengan jumlah penerima gambar; Misalnya, kamu bisa mengirim 5 video ke 1.000 penerima.');
		$("#credit-4").attr("title", 'Livestreaming hingga 3 menit untuk 1.000 penonton.');
		$("#credit-5").attr("title", 'Contoh: untuk 10 anggota tim, mereka dapat melakukan 5.000 (50.000 / 10) menit Panggilan VoIP di antara mereka.');
		$("#credit-6").attr("title", 'Contoh: 10 anggota tim, mereka dapat memiliki Video Call 50 (500/10) menit di antara mereka.');
		$("a.credit-hint").click(function (e) {
			e.preventDefault();
		});

		$(".credit-hint").tooltip({
			placement: 'right'
		});
	});

	if (localStorage.country_code == 'ID') {
		$('#promotion-price').attr('src', 'newAssets/PriceIDR.png');
		if (localStorage.getItem('lang') == 1) {
			$('#newpricing-6').html('Hanya dengan <strong>Rp450<sup>000</sup></strong> biaya langganan per bulan, kamu mendapatkan:');
			$('#newpricing-21').html('<p>Kami akan mengenakan biaya sebesar Rp3975 per MB untuk kelebihan penggunaan data setelah <i>Kredit Customer Engagement</i> habis, dan biaya tersebut akan dipotong dari saldo <i>Kredit Prabayar</i>. Saldo <i>Kredit Prabayar</i> hanya digunakan jika <i>Kredit Customer Engagement</i> telah habis.</p><p>Kamu dapat melakukan isi ulang saldo <i>Kredit Prabayar</i> kapanpun. Tidak ada masa kadaluarsa untuk saldo <i>Kredit Prabayar</i>. Kamu dapat mengajukan pengembalian saldo <i>Kredit Prabayar</i> jika kamu berhenti berlangganan.</p>');
		} else if (localStorage.getItem('lang') == 0) {
			$('#newpricing-6').html('For just <strong>Rp450<sup>000</sup></strong> monthly subscription, you get:');
			$('#newpricing-21').html('<p>We will charge Rp3975 per MB for any excess traffic once your <i>Customer Engagement Credit</i> runs out, and the amount will be deducted from your <i>Prepaid Credit</i> balance. Your <i>Prepaid Credit</i> balance will only be used when your <i>Customer Engagement Credit</i> runs out.</p><p>You may top up your <i>Prepaid Credit</i> balance anytime, and it has no expiry date. You may request a refund for your <i>Prepaid Credit</i> balance if you end your subscription.</p>');
		}
	} else if (localStorage.country_code != 'ID') {
		$('#newpricing-6').html('For just <strong>$33<sup>50</sup></strong> monthly subscription, you get:');
		$('#promotion-price').attr('src', 'newAssets/PriceUSD.png');
		$('#newpricing-21').html('<p>We will charge $0.000265 per KB for any excess traffic once your <i>Customer Engagement Credit</i> runs out, and the amount will be deducted from your <i>Prepaid Credit</i> balance. Your <i>Prepaid Credit</i> balance will only be used when your <i>Customer Engagement Credit</i> runs out.</p><p>You may top up your <i>Prepaid Credit</i> balance anytime, and it has no expiry date. You may request a refund for you <i>Prepaid Credit</i> balance if you end your subscription.</p>');
	}

	$("#change-lang-EN").click(function () {
		localStorage.lang = 0;
		$("#lang-nav").text('EN');
		$("#newpost").text('New Post');
		change_lang();
		if (localStorage.country_code == 'ID') {
			$('#newpricing-6').html('For just <strong>Rp450<sup>000</sup></strong> monthly subscription, you get:');
			$('#newpricing-21').html('<p>We will charge Rp3975 per MB for any excess traffic once your <i>Customer Engagement Credit</i> runs out, and the amount will be deducted from your <i>Prepaid Credit</i> balance. Your <i>Prepaid Credit</i> balance will only be used when your <i>Customer Engagement Credit</i> runs out.</p><p>You may top up your <i>Prepaid Credit</i> balance anytime, and it has no expiry date. You may request a refund for your <i>Prepaid Credit</i> balance if you end your subscription.</p>');
			if (localStorage.getItem('lang') == 1) {
				$("#LS-nusdklite0_ID").css("display", "block");
				$("#LS-nusdklite0").css("display", "none");
				$("#LS-nusdklite1_ID").css("display", "block");
				$("#LS-nusdklite1").css("display", "none");
			} else if (localStorage.getItem('lang') == 0) {
				$("#LS-nusdklite0_ID").css("display", "none");
				$("#LS-nusdklite0").css("display", "block");
				$("#LS-nusdklite1_ID").css("display", "none");
				$("#LS-nusdklite1").css("display", "block");
			}
		}
	});

	$("#change-lang-ID").click(function () {
		localStorage.lang = 1;
		$("#lang-nav").text('ID');
		$("#newpost").text('Post Baru');
		change_lang();
		if (localStorage.country_code == 'ID') {
			$('#newpricing-6').html('Hanya dengan <strong>Rp450<sup>000</sup></strong> biaya langganan per bulan, kamu mendapatkan:');
			$('#newpricing-21').html('<p>Kami akan mengenakan biaya sebesar Rp3975 per MB untuk kelebihan penggunaan data setelah <i>Kredit Customer Engagement</i> habis, dan biaya tersebut akan dipotong dari saldo <i>Kredit Prabayar</i>. Saldo <i>Kredit Prabayar</i> hanya digunakan jika <i>Kredit Customer Engagement</i> telah habis.</p><p>Kamu dapat melakukan isi ulang saldo <i>Kredit Prabayar</i> kapanpun. Tidak ada masa kadaluarsa untuk saldo <i>Kredit Prabayar</i>. Kamu dapat mengajukan pengembalian saldo <i>Kredit Prabayar</i> jika kamu berhenti berlangganan.</p>');
			if (localStorage.getItem('lang') == 1) {
				$("#LS-nusdklite0_ID").css("display", "block");
				$("#LS-nusdklite0").css("display", "none");
				$("#LS-nusdklite1_ID").css("display", "block");
				$("#LS-nusdklite1").css("display", "none");
			} else if (localStorage.getItem('lang') == 0) {
				$("#LS-nusdklite0_ID").css("display", "none");
				$("#LS-nusdklite0").css("display", "block");
				$("#LS-nusdklite1_ID").css("display", "none");
				$("#LS-nusdklite1").css("display", "block");
			}
		}
	});

	$('#categoryDropdown').bind('DOMSubtreeModified', function (event) {
		if (localStorage.lang == 1) {
			document.getElementsByName("src")[0].placeholder = "Cari Berita...";
		} else if (localStorage.lang == 0) {
			document.getElementsByName("src")[0].placeholder = "Search News...";

		}
	});

	$('#searchModal').bind('DOMSubtreeModified', function (event) {
		if (localStorage.lang == 1) {
			document.getElementsByName("qm")[0].placeholder = "Cari Blog";
			//   document.getElementsByName("qm")[0].placeholder = "Search the Blog";
		} else if (localStorage.lang == 0) {
			document.getElementsByName("qm")[0].placeholder = "Search the Blog";
			//   document.getElementsByName("qm")[0].placeholder = "Search the Blog";
		}
	});
});

function showhideFeatures() {
	if ($('#featurediv').hasClass('d-none')) {
		$('#featurediv').removeClass('d-none');
	} else {
		$('#featurediv').addClass('d-none');
	}
}

function showhideFeatures2() {
	if ($('#featurediv2').hasClass('d-none')) {
		$('#featurediv2').removeClass('d-none');
	} else {
		$('#featurediv2').addClass('d-none');
	}
}

function checkVisible() {

	if (localStorage.geolocSts == 1) {
		if (localStorage.country_code == 'ID') {
			$("#lang-li").css("display", "block");
			$("#id-office").css("display", "block");
			$("#gb-office").css("display", "block");
		} else if (localStorage.country_code != 'ID') {
			$("#lang-li").css("display", "none");
			$("#id-office").css("display", "none");
			$("#gb-office").css("display", "block");
		}
	} else if (localStorage.geolocSts == 0) {
		if (localStorage.country_code == 'ID') {
			$("#lang-li").css("display", "none");
			$("#id-office").css("display", "block");
			$("#gb-office").css("display", "none");
		} else if (localStorage.country_code != 'ID') {
			$("#lang-li").css("display", "none");
			$("#id-office").css("display", "none");
			$("#gb-office").css("display", "block");
		}
	}
	// // console.log('checkVisible');
}

function geoLoc() {

	$.ajax({
		url: 'https://api.ipgeolocation.io/ipgeo?apiKey=cacef90bd1af48e5a4e0a97e91439f51',
		type: 'GET',
		success: function (response) {
			// console.log('checking loc');
			localStorage.prevCountry = localStorage.country_code;
			localStorage.lastCheck = Math.floor(Date.now() / 1000); // epoch second

			if (localStorage.prevCountry != response.country_code2 || localStorage.prevCountry == null || typeof localStorage.prevCountry === 'undefined' || localStorage.getItem("language_dialog") == null) {
				localStorage.country_code = response.country_code2;
				if (response.country_code2 == 'ID') {
					console.log('masih belum pilih cuy')
					localStorage.lang_visible = 1;
					checkVisible();
					// $('#dialog-confirm').dialog({
					// 	classes: {
					// 		"ui-dialog-titlebar": "noTitleBar"
					// 	},
					// 	resizable: false,
					// 	height: "auto",
					// 	width: Math.min(600, $(window).width() * .8),
					// 	modal: true,
					// 	open: function(){
					// 		jQuery('.ui-widget-overlay').bind('click',function(){
					// 			$("html, body").animate({ scrollTop: 0 }, "fast");
					// 			console.log("Click Outside");
					// 		})
					// 	},
					// 	buttons: {
					// 		"Yes": function() {
					// 			localStorage.setItem("language_dialog", "1");
					// 			localStorage.lang = 1;
					// 			change_lang();
					// 			$(this).dialog("close");
					// 			location.reload();
					// 		},
					// 		"No": function() {
					// 			localStorage.setItem("language_dialog", "1");
					// 			localStorage.lang = 0;
					// 			$(this).dialog("close");
					// 			location.reload();
					// 		}
					// 	}
					// });

					$("#dialog-confirm .modal-footer #dialog-confirm-yes").click(function() {
						localStorage.setItem("language_dialog", "1");
						localStorage.lang = 1;
						change_lang();
						$("#dialog-confirm").modal("hide");
						location.reload();
					})

					$("#dialog-confirm .modal-footer #dialog-confirm-no").click(function() {
						localStorage.setItem("language_dialog", "1");
						localStorage.lang = 0;
						$("#dialog-confirm").modal("hide");
						location.reload();
					})

					$("#dialog-confirm").modal("show");

					$('html, body').css('overflow','hidden');

					// location.reload();
				} else {
					localStorage.lang = 0;
					localStorage.lang_visible = 0;
					checkVisible();
				}
			}
		},
		error: function (error) {
			localStorage.removeItem('lastCheck'); // remove variable so geoloc gets called next refresh
			localStorage.lang = 0;
			localStorage.lang_visible = 0;
			checkVisible();
			localStorage.country_code = 'EN';
		}
	});
}

var time;

function logout() {
	console.log("LOGGED OUT")
	// alert("You are now logged out.");
	// $('#logoutButton').click();
	// console.log("LOGGED OUT")
	$("#close-session-expire").click(function() {
		$('#logoutButton').click();
	})

	if (localStorage.lang == 1){
		$("#modal-session-expire .modal-dialog .modal-content .modal-body").text("Saat ini anda telah keluar.");
	}else{
		$("#modal-session-expire .modal-dialog .modal-content .modal-body").text("You are now logged out.");
	}

	$("#modal-session-expire").modal("show");

}

function resetTimer() {
	clearTimeout(time);
	console.log("RESETTIMER")
	time = setTimeout(logout, 1800000); // 30 minutes timeout
	// 1000 milliseconds = 1 second
}

var inactivityTime = function () {
	console.log('timer start');
	
	window.onload = resetTimer;
	// DOM Events
	document.onload = resetTimer;
	document.onmousemove = resetTimer;
	document.onmousedown = resetTimer; // touchscreen presses
	document.ontouchstart = resetTimer;
	document.onclick = resetTimer; // touchpad clicks
	document.onkeydown = resetTimer; // onkeypress is deprectaed
	document.addEventListener('scroll', resetTimer, true); // improved; see comments

	
};


/** check geoloc index-nav */
// <?php if ($geolocSts == 1) { ?>
//     // console.log('geoloc ON');

//     localStorage.prevGeoloc = localStorage.currentGeoloc;
//     localStorage.currentGeoloc = 'ON';        

//     localStorage.removeItem('switchLang');

//     var ONE_HOUR = 3600; //second

//      if (localStorage.country_code == null || typeof localStorage.country_code === 'undefined' || localStorage.lastCheck == null || typeof localStorage.lastCheck === 'undefined' || (Math.floor(Date.now() / 1000) - localStorage.lastCheck) > ONE_HOUR) {
//          geoLoc();
//      }

//     <?php  } else {
//     if ($language == 0) {
//     ?>
//         localStorage.clear();
//         localStorage.prevGeoloc = localStorage.currentGeoloc;
//         localStorage.currentGeoloc = 'OFF';

//         // console.log('geoloc OFF, EN only');
//         localStorage.lang = 0;
//         localStorage.lang_visible = 0;
//         localStorage.switchLang = 0;
//         localStorage.country_code = 'EN';

//     <?php } else if ($language == 1) { ?>
//         localStorage.clear();
//         localStorage.prevGeoloc = localStorage.currentGeoloc;
//         localStorage.currentGeoloc = 'OFF';

//         // console.log('geoloc OFF, ID only');
//         localStorage.lang = 1;
//         localStorage.lang_visible = 0;
//         localStorage.switchLang = 1;
//         localStorage.country_code = 'ID';

// <?php }
// } ?>

/** index nav */
// <?php if (isset($_SESSION['id_user'])) { ?>

// 	window.onload = function() {
// 		inactivityTime();
// 		checkVisible();
// 		PR.prettyPrint();
// 	}
// <?php } else { ?>

// 	window.onload = function() {
// 		PR.prettyPrint();
// 		checkVisible();
// 	}

// <?php } ?>

/** index activity layout links */
// <?php if (isset($_SESSION['id_user'])) { ?>
// 	$("#activity-layout").click(function() {
// 		$(this).prop("href", "downloads/res-pb.zip");
// 	});
// <?php } else { ?>
// 	$("#activity-layout").click(function() {
// 		if (localStorage.lang == 0) {
// 			alert('Please sign up first before downloading the sample code!');
// 		} else {
// 			alert('Mohon lakukan registrasi terlebih dahulu sebelum mengunduh kode sampel!');
// 		}
// 		location.href = 'sign_up.php';
// 	});
// <?php } ?>

/** palio button */
// $(function() {
// 	$("#wrap-all").draggable({
// 		containment: 'window'
// 	});

// 	$("body").tooltip({
// 		selector: '[data-toggle="tooltip"]'
// 	});

// 	$("#palio-button-1").click(function() {
// 		$("#feature-buttons").slideToggle("slow");
// 	});

// 	document.getElementById("palio-button-1").addEventListener("touchstart", tapHandler);

// 	var tapedTwice = false;

// 	function tapHandler(event) {
// 		if (!tapedTwice) {
// 			tapedTwice = true;
// 			setTimeout(function() {
// 				tapedTwice = false;
// 			}, 500);
// 			return false;
// 		}
// 		event.preventDefault();
// 		//action on double tap goes below
// 		$("#feature-buttons").slideToggle("slow");
// 	}
// });

/** smart features content */
// $(document).ready(function() {

//     if ($(window).width() < 992) {
//       $('.collapse').on('shown.bs.collapse', function() {
//         $(this).parent().find(".fa-chevron-down").removeClass("fa-chevron-down").addClass("fa-chevron-up");
//       }).on('hidden.bs.collapse', function() {
//         $(this).parent().find(".fa-chevron-up").removeClass("fa-chevron-up").addClass("fa-chevron-down");
//       });
//     }

//     if ($(window).width() >= 992) {
//       $('.card-header h4').mouseover(function() {
//         // $(this).click();
//         $(this).find('a').click();
//         // $(this).parent().find('.collapse').trigger('shown.bs.collapse');
//         $(this).find(".fa-chevron-down").removeClass("fa-chevron-down").addClass("fa-chevron-up");

//       })
//       $('.card-header h4').mouseout(function() {
//         // $(this).click();
//         $(this).find('a').click();
//         // $(this).parent().find('.collapse').trigger('hidden.bs.collapse');
//         $(this).find(".fa-chevron-up").removeClass("fa-chevron-up").addClass("fa-chevron-down");

//       })
//     }
//   });

/** blog post quill */
// var quill = new Quill('#editor-container', {
//     modules: {
//       toolbar: [
//         [{
//           'font': []
//         }],
//         [{
//           header: [1, 2, 3, 4, 5, 6, false]
//         }],
//         ['bold', 'italic', 'underline', 'strike'],
//         [{
//           'color': []
//         }, {
//           'background': []
//         }],
//         [{
//           'script': 'sub'
//         }, {
//           'script': 'super'
//         }],
//         [{
//           'header': 1
//         }, {
//           'header': 2
//         }],
//         ['blockquote', 'code-block'],
//         [{
//           'list': 'ordered'
//         }, {
//           'list': 'bullet'
//         }],
//         [{
//           'indent': '-1'
//         }, {
//           'indent': '+1'
//         }],
//         [{
//           'direction': 'rtl'
//         }, {
//           'align': []
//         }],
//         ['link', 'image', 'video', 'formula'],
//         ['clean']
//       ]
//     },
//     placeholder: 'Compose an epic...',
//     theme: 'snow' // or 'bubble'
//   });

//   function utf8_to_b64(str) {
//     return window.btoa(unescape(encodeURIComponent(str)));
//   }

//   function b64_to_utf8(str) {
//     return decodeURIComponent(escape(window.atob(str)));
//   }

//   $("#submit").click(function() {
//     var content = quill.root.innerHTML.trim();
//     var encodedContent = utf8_to_b64(content);
//     $("#content").val(encodedContent);
//   });

/** trustlogo header alt */
//<![CDATA[
    // var tlJsHost = ((window.location.protocol == "https:") ? "https://secure.trust-provider.com/" : "http://www.trustlogo.com/");
    // document.write(unescape("%3Cscript src='" + tlJsHost + "trustlogo/javascript/trustlogo.js' type='text/javascript'%3E%3C/script%3E"));
    //]]>

/** footer alt */
// AOS.init();
// new ClipboardJS('.copy-snippet');
// var sticky = new Sticky('.sticky');

/** usecase */
// $(document).ready(function() {

// 	if ($(window).width() < 992) {
// 		$('.collapse').on('shown.bs.collapse', function() {
// 			$(this).parent().find(".fa-chevron-down").removeClass("fa-chevron-down").addClass("fa-chevron-up");
// 		}).on('hidden.bs.collapse', function() {
// 			$(this).parent().find(".fa-chevron-up").removeClass("fa-chevron-up").addClass("fa-chevron-down");
// 		});
// 	}

// 	if ($(window).width() >= 992) {
// 		$('.card-header h4').mouseover(function() {
// 			// $(this).click();
// 			$(this).find('a').click();
// 			// $(this).parent().find('.collapse').trigger('shown.bs.collapse');
// 			$(this).find(".fa-chevron-down").removeClass("fa-chevron-down").addClass("fa-chevron-up");

// 		})
// 		$('.card-header h4').mouseout(function() {
// 			// $(this).click();
// 			$(this).find('a').click();
// 			// $(this).parent().find('.collapse').trigger('hidden.bs.collapse');
// 			$(this).find(".fa-chevron-up").removeClass("fa-chevron-up").addClass("fa-chevron-down");

// 		})
// 	}
// });

/** paycheckout geoloc */
// <?php if ($geolocSts == 1) { ?>
// 	console.log('geoloc ON');

// 	localStorage.prevGeoloc = localStorage.currentGeoloc;
// 	localStorage.currentGeoloc = 'ON';

// 	localStorage.removeItem('switchLang');


// 	function geoLoc() {

// 	  $.ajax({
// 		url: 'https://api.ipgeolocation.io/ipgeo?apiKey=cacef90bd1af48e5a4e0a97e91439f51',
// 		type: 'GET',
// 		success: function(response) {
// 		  console.log('checking loc');
// 		  localStorage.prevCountry = localStorage.country_code;
// 		  localStorage.lastCheck = Math.floor(Date.now() / 1000); // epoch second

// 		  if (localStorage.prevCountry != response.country_code2 || localStorage.prevCountry == null || typeof localStorage.prevCountry === 'undefined') {
// 			localStorage.country_code = response.country_code2;
// 			if (response.country_code2 == 'ID') {
// 			  localStorage.lang_visible = 1;
// 			  if (localStorage.lang != null || typeof localStorage.lang !== 'undefined') {
// 				localStorage.lang = 0;
// 			  }
// 			} else {
// 			  localStorage.lang = 0;
// 			  localStorage.lang_visible = 0;
// 			}
// 		  }
// 		},
// 		error: function(error) {
// 		  alert('Sorry, we are unable to get your current location.');
// 		  localStorage.removeItem('lastCheck');
// 		  localStorage.lang = 0;
// 		  localStorage.lang_visible = 0;
// 		  localStorage.country_code = 'EN';
// 		}
// 	  });
// 	}

// 	var ONE_HOUR = 3600; //second

// 	if (localStorage.country_code == null || typeof localStorage.country_code === 'undefined' || localStorage.lastCheck == null || typeof localStorage.lastCheck === 'undefined' || (Math.floor(Date.now() / 1000) - localStorage.lastCheck) > ONE_HOUR) {
// 	  geoLoc();
// 	}

// 	window.onload = function() {
// 	  if (localStorage.country_code == 'ID') {

// 		if (localStorage.getItem('lang') == 1) {
// 		  <?php if ($currency == 'IDR') { ?>
// 			console.log('IDR indonesia');
// 			$('#newpricing-6').html('Hanya dengan <strong>Rp450<sup>000</sup></strong> biaya langganan per bulan, kamu mendapatkan:');
// 		  <?php } else if ($currency == 'USD') { ?>
// 			console.log('USD indonesia');
// 			$('#newpricing-6').html('Hanya dengan <strong>$33<sup>50</sup></strong> biaya langganan per bulan, kamu mendapatkan:');
// 		  <?php } else { ?>
// 			console.log('IDR indonesia bhs indonesia');
// 			$('#newpricing-6').html('Hanya dengan <strong>Rp450<sup>000</sup></strong> biaya langganan per bulan, kamu mendapatkan:');
// 		  <?php } ?>
// 		} else if (localStorage.getItem('lang') == 0) {
// 		  <?php if ($currency == 'IDR') { ?>
// 			console.log('IDR indonesia bhs inggris');
// 			$('#newpricing-6').html('For just <strong>Rp450<sup>000</sup></strong> monthly subscription, you get:');
// 		  <?php } else if ($currency == 'USD') { ?>
// 			console.log('USD indonesia bhs inggris');
// 			$('#newpricing-6').html('For just <strong>$33<sup>50</sup></strong> monthly subscription, you get:');
// 		  <?php } else { ?>
// 			console.log('IDR indonesia bhs inggris');
// 			$('#newpricing-6').html('For just <strong>Rp450<sup>000</sup></strong> monthly subscription, you get:');
// 		  <?php } ?>
// 		}
// 	  } else if (localStorage.country_code != 'ID') {
// 		<?php if ($currency == 'IDR') { ?>
// 		  $('#newpricing-6').html('For just <strong>Rp450<sup>000</sup></strong> monthly subscription, you get:');
// 		<?php } else if ($currency == 'USD') { ?>
// 		  console.log('USD indonesia bhs inggris');
// 		  $('#newpricing-6').html('For just <strong>$33<sup>50</sup></strong> monthly subscription, you get:');
// 		<?php } else { ?>
// 		  console.log('USD english');
// 		  $('#newpricing-6').html('For just <strong>$33<sup>50</sup></strong> monthly subscription, you get:');
// 		<?php } ?>
// 	  }
// 	}

// 	<?php  } else {
// 	if ($language == 0) {
// 	?>
// 	  localStorage.clear();
// 	  localStorage.prevGeoloc = localStorage.currentGeoloc;
// 	  localStorage.currentGeoloc = 'OFF';

// 	  console.log('geoloc OFF, EN only');
// 	  localStorage.lang = 0;
// 	  localStorage.lang_visible = 0;
// 	  localStorage.switchLang = 0;
// 	  localStorage.country_code = 'EN';

// 	<?php } else if ($language == 1) { ?>
// 	  localStorage.clear();
// 	  localStorage.prevGeoloc = localStorage.currentGeoloc;
// 	  localStorage.currentGeoloc = 'OFF';

// 	  console.log('geoloc OFF, ID only');
// 	  localStorage.lang = 1;
// 	  localStorage.lang_visible = 0;
// 	  localStorage.switchLang = 1;
// 	  localStorage.country_code = 'ID';

//   <?php }
//   } ?>

/** paycheckout content */
// if (localStorage.lang == 0) {
// 	change_lang();
// 	$("#abc-1").text("Up to 5,000,000 Monthly Text Recipients");
// 	$("#abc-2").text("Up to 50,000 Monthly Image Recipients");
// 	$("#abc-3").text("Up to 5,000 Monthly Video Recipients");
// 	$("#abc-4").text("Up to 3,000 Monthly Minutes Livestream Recipients");
// 	$("#abc-5").text("Up to 50,000 Monthly Minutes 1-1 VoIP Calls");
// 	$("#abc-6").text("Up to 500 Monthly Minutes 1-1 Video Calls");

// 	$("#or-1").text(", or");
// 	$("#or-2").text(", or");
// 	$("#or-3").text(", or");
// 	$("#or-4").text(", or");
// 	$("#or-5").text(", or");

// 	$("#abcdesc-1").text("Up to 1,000 chars for each text. For each text sent, the credit will be deducted by the number of recipients of the message. For example, you can send 5,000 texts to 1,000 recipients.");
// 	$("#abcdesc-2").text("Up to 250 KB for each image. For each image sent, the credit will be deducted by the number of recipients of the image; For example, you can send 50 images to 1,000 recipients.");
// 	$("#abcdesc-3").text("Up to 2.5 MB for each video. For each video sent, the credit will be deducted by the number of recipients of the image; For example, you can send 5 videos to 1,000 recipients.");
// 	$("#abcdesc-4").text('Up to 3 minutes livestream to 1,000 recipients.');
// 	$("#abcdesc-5").text('If you, for example, have 10 team members, they can have 5,000 (50,000/10) minutes of VoIP Calls between them.');
// 	$("#abcdesc-6").text('If you, for example, have 10 team members, they can have 50 (500/10) minutes of Video Calls between them.');

//   } else if (localStorage.lang == 1) {
// 	change_lang();
// 	$("#pay-1").text("Detil Pemesanan:");
// 	$("#pay-2").text("Nomor Pesanan:");
// 	$("#pay-3").text("Tanggal Pesanan:");
// 	$("#pay-7").text("Paket Palio Lite:");
// 	$("#pay-8").text("Paket");
// 	$("#pay-10").text("Langganan Bulanan (batalkan kapan saja)");
// 	$("#pay-11").text("Hanya Satu Bulan (kamu akan mendapat pemberitahuan mendekati tanggal jatuh tempo)");
// 	$("#cancel").val('BATAL');

// 	$("#abc-1").text("Hingga 5.000.000 Penerima Teks Bulanan");
// 	$("#abc-2").text("Hingga 50.000 Penerima Gambar Bulanan");
// 	$("#abc-3").text("Hingga 5.000 Penerima Video Bulanan");
// 	$("#abc-4").text("Hingga 3.000 Menit Bulanan Penerima Siaran Langsung");
// 	$("#abc-5").text("Hingga 50.000 Menit Bulanan 1-1 Panggilan VoIP");
// 	$("#abc-6").text("Hingga 500 Menit Bulanan 1-1 Panggilan Video");

// 	$("#or-1").text(", atau");
// 	$("#or-2").text(", atau");
// 	$("#or-3").text(", atau");
// 	$("#or-4").text(", atau");
// 	$("#or-5").text(", atau");

// 	$("#abcdesc-1").text('Hingga 1.000 karakter untuk setiap teks. Untuk setiap teks yang dikirim, kredit akan dikurangi dengan jumlah penerima pesan. Misalnya, kamu bisa mengirim 5.000 teks ke 1.000 penerima.');
// 	$("#abcdesc-2").text('Hingga 250 KB untuk setiap gambar. Untuk setiap gambar yang dikirim, kredit akan dikurangi dengan jumlah penerima gambar; Misalnya, kamu bisa mengirim 50 gambar ke 1.000 penerima.');
// 	$("#abcdesc-3").text('Hingga 2,5 MB untuk setiap video. Untuk setiap video yang dikirim, kredit akan dikurangi dengan jumlah penerima gambar; Misalnya, kamu bisa mengirim 5 video ke 1.000 penerima.');
// 	$("#abcdesc-4").text('Livestreaming hingga 3 menit untuk 1.000 penonton.');
// 	$("#abcdesc-5").text('Contoh: untuk 10 anggota tim, mereka dapat melakukan 5.000 (50.000 / 10) menit Panggilan VoIP di antara mereka.');
// 	$("#abcdesc-6").text('Contoh: 10 anggota tim, mereka dapat memiliki Video Call 50 (500/10) menit di antara mereka.');
//   }

//   $("a.credit-hint").click(function(e) {
// 	e.preventDefault();
//   });

//   $(".credit-hint").tooltip({
// 	placement: 'right'
//   });

/** checkout geoloc */
// <?php if ($geolocSts == 1) { ?>
// 	console.log('geoloc ON');

// 	localStorage.prevGeoloc = localStorage.currentGeoloc;
// 	localStorage.currentGeoloc = 'ON';

// 	localStorage.removeItem('switchLang');



// 	function geoLoc() {

// 		$.ajax({
// 			url: 'https://api.ipgeolocation.io/ipgeo?apiKey=cacef90bd1af48e5a4e0a97e91439f51',
// 			type: 'GET',
// 			success: function(response) {
// 				console.log('checking loc');
// 				localStorage.prevCountry = localStorage.country_code;
// 				localStorage.lastCheck = Math.floor(Date.now() / 1000); // epoch second

// 				if (localStorage.prevCountry != response.country_code2 || localStorage.prevCountry == null || typeof localStorage.prevCountry === 'undefined') {
// 					localStorage.country_code = response.country_code2;
// 					if (response.country_code2 == 'ID') {
// 						localStorage.lang_visible = 1;
// 						if (localStorage.lang != null || typeof localStorage.lang !== 'undefined') {
// 							localStorage.lang = 0;
// 						}
// 					} else {
// 						localStorage.lang = 0;
// 						localStorage.lang_visible = 0;
// 					}
// 				}
// 			},
// 			error: function(error) {
// 				alert('Sorry, we are unable to get your current location.');
// 				localStorage.removeItem('lastCheck');
// 				localStorage.lang = 0;
// 				localStorage.lang_visible = 0;
// 				localStorage.country_code = 'EN';
// 			}
// 		});
// 	}

// 	var ONE_HOUR = 3600; //second

// 	if (localStorage.country_code == null || typeof localStorage.country_code === 'undefined' || localStorage.lastCheck == null || typeof localStorage.lastCheck === 'undefined' || (Math.floor(Date.now() / 1000) - localStorage.lastCheck) > ONE_HOUR) {
// 		geoLoc();
// 	}


// 	<?php  } else {
// 	if ($language == 0) {
// 	?>
// 		localStorage.clear();
// 		localStorage.prevGeoloc = localStorage.currentGeoloc;
// 		localStorage.currentGeoloc = 'OFF';

// 		console.log('geoloc OFF, EN only');
// 		localStorage.lang = 0;
// 		localStorage.lang_visible = 0;
// 		localStorage.switchLang = 0;
// 		localStorage.country_code = 'EN';

// 	<?php } else if ($language == 1) { ?>
// 		localStorage.clear();
// 		localStorage.prevGeoloc = localStorage.currentGeoloc;
// 		localStorage.currentGeoloc = 'OFF';

// 		console.log('geoloc OFF, ID only');
// 		localStorage.lang = 1;
// 		localStorage.lang_visible = 0;
// 		localStorage.switchLang = 1;
// 		localStorage.country_code = 'ID';

// <?php }
// } ?>

/** checkout content */
// if (localStorage.lang == 0) {
// 	change_lang();
// 	$("#abc-1").text("Up to 5,000,000 Monthly Text Recipients");
// 	$("#abc-2").text("Up to 50,000 Monthly Image Recipients");
// 	$("#abc-3").text("Up to 5,000 Monthly Video Recipients");
// 	$("#abc-4").text("Up to 3,000 Monthly Minutes Livestream Recipients");
// 	$("#abc-5").text("Up to 50,000 Monthly Minutes 1-1 VoIP Calls");
// 	$("#abc-6").text("Up to 500 Monthly Minutes 1-1 Video Calls");

// 	$("#or-1").text(", or");
// 	$("#or-2").text(", or");
// 	$("#or-3").text(", or");
// 	$("#or-4").text(", or");
// 	$("#or-5").text(", or");

// 	$("#abcdesc-1").text("Up to 1,000 chars for each text. For each text sent, the credit will be deducted by the number of recipients of the message. For example, you can send 5,000 texts to 1,000 recipients.");
// 	$("#abcdesc-2").text("Up to 250 KB for each image. For each image sent, the credit will be deducted by the number of recipients of the image; For example, you can send 50 images to 1,000 recipients.");
// 	$("#abcdesc-3").text("Up to 2.5 MB for each video. For each video sent, the credit will be deducted by the number of recipients of the image; For example, you can send 5 videos to 1,000 recipients.");
// 	$("#abcdesc-4").text('Up to 3 minutes livestream to 1,000 recipients.');
// 	$("#abcdesc-5").text('If you, for example, have 10 team members, they can have 5,000 (50,000/10) minutes of VoIP Calls between them.');
// 	$("#abcdesc-6").text('If you, for example, have 10 team members, they can have 50 (500/10) minutes of Video Calls between them.');

// } else if (localStorage.lang == 1) {
// 	change_lang();
// 	$("#pay-1").text("Detil Pemesanan:");
// 	$("#pay-2").text("Nomor Pesanan:");
// 	$("#pay-3").text("Tanggal Pesanan:");
// 	$("#pay-7").text("Paket Palio Lite:");
// 	$("#pay-8").text("Paket");
// 	$("#pay-10").text("Langganan Bulanan (batalkan kapan saja)");
// 	$("#pay-11").text("Hanya Satu Bulan (kamu akan mendapat pemberitahuan mendekati tanggal jatuh tempo)");
// 	$("#cancel").val('BATAL');

// 	$("#abc-1").text("Hingga 5.000.000 Penerima Teks Bulanan");
// 	$("#abc-2").text("Hingga 50.000 Penerima Gambar Bulanan");
// 	$("#abc-3").text("Hingga 5.000 Penerima Video Bulanan");
// 	$("#abc-4").text("Hingga 3.000 Menit Bulanan Penerima Siaran Langsung");
// 	$("#abc-5").text("Hingga 50.000 Menit Bulanan 1-1 Panggilan VoIP");
// 	$("#abc-6").text("Hingga 500 Menit Bulanan 1-1 Panggilan Video");

// 	$("#or-1").text(", atau");
// 	$("#or-2").text(", atau");
// 	$("#or-3").text(", atau");
// 	$("#or-4").text(", atau");
// 	$("#or-5").text(", atau");

// 	$("#abcdesc-1").text('Hingga 1.000 karakter untuk setiap teks. Untuk setiap teks yang dikirim, kredit akan dikurangi dengan jumlah penerima pesan. Misalnya, kamu bisa mengirim 5.000 teks ke 1.000 penerima.');
// 	$("#abcdesc-2").text('Hingga 250 KB untuk setiap gambar. Untuk setiap gambar yang dikirim, kredit akan dikurangi dengan jumlah penerima gambar; Misalnya, kamu bisa mengirim 50 gambar ke 1.000 penerima.');
// 	$("#abcdesc-3").text('Hingga 2,5 MB untuk setiap video. Untuk setiap video yang dikirim, kredit akan dikurangi dengan jumlah penerima gambar; Misalnya, kamu bisa mengirim 5 video ke 1.000 penerima.');
// 	$("#abcdesc-4").text('Livestreaming hingga 3 menit untuk 1.000 penonton.');
// 	$("#abcdesc-5").text('Contoh: untuk 10 anggota tim, mereka dapat melakukan 5.000 (50.000 / 10) menit Panggilan VoIP di antara mereka.');
// 	$("#abcdesc-6").text('Contoh: 10 anggota tim, mereka dapat memiliki Video Call 50 (500/10) menit di antara mereka.');
// }

// $("a.credit-hint").click(function(e) {
// 	e.preventDefault();
// });

// $(".credit-hint").tooltip({
// 	placement: 'right'
// });

/** usocial */
// if (localStorage.lang == 1) {
// 	document.getElementsByName("linkgp")[0].href = "https://play.google.com/store/apps/details?id=io.newuniverse.IndonesiaBisa&hl=in&gl=US";
// }

/** contact button */
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
		$('#to-cU').attr('href', 'chatcore/pages/login_page.php');
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