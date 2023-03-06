window.onscroll = function () { scrollFunction() };
var nftmeOut = null;
var show = false;
var allMessage = [];
function questionClick(id, question) {
	var username = localStorage.getItem("username");
	JProcess.send_question(username, id);
	$('.opt').css('display', 'none');
	var sendDisplay = '<div class="row justify-content-end my-2">\n\
	<div class="d-flex justify-content-center chatSender">\n\
	<p class="align-self-center mx-2 my-2 fontRobReg fs-15 text-light">'+ question + '</p>\n\
	</div>\n\
	</div>';
	$('#chatBody').append(sendDisplay);
	var objMsg = {
		message_text: question,
		flag: "1"
	};
	allMessage.push(objMsg);
	localStorage.setItem("allMessage", JSON.stringify(allMessage));
	$("#chatBody").animate({ scrollTop: $('#chatBody').prop("scrollHeight") }, 0);
}
function backtomenu() {
	$('.opt').css('display', 'none');
	var username = localStorage.getItem("username");
	JProcess.back_menu(username);
	var sendDisplay = '<div class="row justify-content-end my-2">\n\
	<div class="d-flex justify-content-center chatSender2">\n\
	<p class="align-self-center mx-2 my-2 fontRobReg fs-15" style="color: #1A73E8;">Go to menu</p>\n\
	</div>\n\
	</div>';
	$('#chatBody').append(sendDisplay);
	var objMsg = {
		message_text: 'Go to menu',
		flag: "1"
	};
	allMessage.push(objMsg);
	localStorage.setItem("allMessage", JSON.stringify(allMessage));
	$("#chatBody").animate({ scrollTop: $('#chatBody').prop("scrollHeight") }, 0);
}
function scrollFunction() {
	var myNav = document.getElementById('navtop-alt');
	var myNav2 = document.getElementById('navtop-alt2');
	if (myNav != null) {
		if (document.body.scrollTop > 580 || document.documentElement.scrollTop > 580) {
			myNav.classList.add("scrolled");
			myNav.classList.add("shadow");
			myNav.classList.remove("unscrolled");
		} else {
			if (!show) {
				myNav.classList.add("unscrolled");
				myNav.classList.remove("scrolled");
				myNav.classList.remove("shadow");
			}
		}
	}
	if (myNav2 != null) {
		if (document.body.scrollTop > 580 || document.documentElement.scrollTop > 580) {
			myNav2.classList.add("scrolled");
			myNav2.classList.add("shadow");
			myNav2.classList.remove("unscrolled");
		} else {
			if (!show) {
				myNav2.classList.add("unscrolled");
				myNav2.classList.remove("scrolled");
				myNav2.classList.remove("shadow");
			}
		}
	}
}
// $(document).click(function(){
// 	$('.navbar-collapse').collapse('hide');
// });
function showChat() {
	$('#showChat').css('display', 'none');
	$('#chatSection').addClass("fadeInUp");
	$('#chatSection').removeClass("fadeOutDown");
	$('#chatSection').css('display', 'block');
	$('#closeChat').css('display', 'block');
	goChat();
}
function closeChat() {
	$('#closeChat').css('display', 'none');
	$('#chatSection').addClass("fadeOutDown");
	$('#chatSection').removeClass("fadeInUp");
	$('#chatSection').css('display', 'block');
	$('#showChat').css('display', 'block');
	//	setTimeout(function(){
	//		$('#chatSection').css('display','none');
	//	}, 2000);
}
function goChat() {
	$('#regChat').addClass("fadeOutUp");
	$('#regChat').css('display', 'block');
	setTimeout(function () {
		$('#regChat').css('display', 'none');
		$('#regChat').removeClass("fadeOutUp");
	}, 1000)
	$('#chatBody').css('display', 'block');
	$('#welcomeChat').addClass('d-none');
	$('#headerChat').removeClass('d-none');
}
function closeSession() {
	var username = localStorage.getItem("username");
	JProcess.closeSession(username);
}
$(document).ready(function () {
	ResendInfo();
	if (localStorage.getItem("allMessage") === null) {
		//do nothing
	} else {
		allMessage = localStorage.getItem("allMessage");
		allMessage = JSON.parse(allMessage);
		var data = localStorage.getItem("allMessage");
		var allMsg = JSON.parse(data);
		goChat();
		console.log(allMsg.length);
		for (var i = 0; i < allMsg.length; i++) {
			if (allMsg[i].flag == "1") {
				var sendDisplay = '<div class="row justify-content-end my-2"><div class="d-flex justify-content-center chatSender"><p class="align-self-center mx-2 my-2 fontRobReg fs-15 text-light">' + allMsg[i].message_text + '</p></div></div>';
				$('#chatBody').append(sendDisplay);
			} else if (allMsg[i].flag == "2") {
				if (allMsg[i].T0 != undefined) {
					notFoundTimeout();
				}
				if (allMsg[i].option != undefined) {
					var option = allMsg[i].option;
					var sendDisplay = '<div class="row justify-content-start my-2"><div class="d-flex justify-content-center chatReceiver"><p class="text-dark align-self-center mx-2 my-2 fontRobReg fs-15" style="color: #646464;">' + allMsg[i].message_text + '</p></div></div>';
					$('.opt').css('display', 'none');
					sendDisplay += '<div class="row justify-content-start my-2 opt">';
					for (var j = 0; j < option.length; j++) {
						if (option[j].question_id == "-1") {
							$('#msgField').css('display', 'none');
							$('#startnewchat').css('display', 'block');
							$('#notifChat').css('display', 'none');
						} else if (option[j].question_id == "24") {
							sendDisplay += '<div class="chatSender2 d-flex mx-1 my-1 fontRobReg fs-15">\n\
							<a class="m-0 align-self-center mx-2 text-decoration-none" style="cursor: pointer; color: #1A73E8;" onclick="redirectSignUp();">'+ option[j].question + '</a>\n\
							</div>';
						} else {
							sendDisplay += '<div class="chatSender2 d-flex mx-1 my-1">\n\
							<a class="m-0 align-self-center mx-2 text-decoration-none fontRobReg fs-15" style="cursor: pointer; color: #1A73E8;" onclick="questionClick('+ option[j].question_id + ',\'' + option[j].question + '\');">' + option[j].question + '</a>\n\
							</div>';

						}
					}
					sendDisplay += '</div>';
					$('#chatBody').append(sendDisplay);
				} else {
					var sendDisplay = '<div class="row justify-content-start my-2"><div class="d-flex justify-content-center chatReceiver"><p class="text-dark align-self-center mx-2 my-2 fontRobReg fs-15" style="color: #646464;">' + allMsg[i].message_text + '</p></div></div>';
					$('#chatBody').append(sendDisplay);
				}
			}
		}
	}
});
function sendInfo() {
	var username = $('#emailtxt').val();
	localStorage.setItem("username", username);
	JProcess.sendCS(username);
	sessionStorage.setItem("username", username);
	goChat();
}
function ResendInfo() {
	var username = localStorage.getItem("username");
	if (username != null) {
		setTimeout(function () {
			JProcess.resendCS(username)
		}, 2000);
		localStorage.setItem("username", username);
		console.log('ada');
		var state_newChat = localStorage.getItem('state_newChat');
		if (state_newChat == '1') {
			$('#chatBox').attr("disabled", true);
			$('#sendChat').attr("disabled", true);
		}
	} else {
		console.log('nothing');
		setTimeout(function () {
			var text = Math.floor(Math.random() * 1000);
			var concat_usename = "customer_" + text;
			console.log(concat_usename)
			JProcess.resendCS(concat_usename)
			localStorage.setItem("username", concat_usename);
			console.log('JProcess.resendCS')
		}, 2000);
		$('#chatBox').attr("disabled", false);
		$('#sendChat').attr("disabled", false);
		allMessage = [];
	}
}
function newChat() {
	$('#chatBody').empty();
	$('#startnewchat').css('display', 'none');
	$('#msgField').css('display', 'block');
	$('#notifChat').css('display', 'block');
	localStorage.setItem('liveState', '0');
	$('#startLive').removeClass('d-none');
	$('#isLive').addClass('d-none');
	$('#sendChat').attr('onclick', 'sendMessageC()')
	closeSession();
	localStorage.clear();
	ResendInfo();
	localStorage.setItem('state_newChat', '0');
}
function redirectSignUp() {
	newChat();
	location.replace("../sign_up.php");
}
function sendMessageC() {
	$('#suggest').empty();
	var message = $('#chatBox').val();
	if (message == "" || message == null) {
		// donothing
	} else {
		var username = localStorage.getItem("username");
		JProcess.sendMessageCS(username, message);
		var sendDisplay = '<div class="row justify-content-end my-2"><div class="d-flex justify-content-center chatSender"><p class="align-self-center mx-2 my-2 fontRobReg fs-15 text-light">' + message + '</p></div></div>';
		$('#chatBody').append(sendDisplay);
		$("#chatBody").animate({ scrollTop: $('#chatBody').prop("scrollHeight") }, 0);
		$('#chatBox').val("");
		var objMsg = {
			message_text: message,
			flag: "1"
		};
		allMessage.push(objMsg);
		localStorage.setItem("allMessage", JSON.stringify(allMessage));
	}
}
function incomingMessage(response) {
	setTimeout(function () {
		var data = eval(response);
		if (data[0].T0 != undefined) {
			notFoundTimeout();
		}
		if (data[0].T06 != undefined) {
			var sendDisplay = '<div class="row justify-content-start my-2"><div class="d-flex justify-content-center chatReceiver"><p class="text-dark align-self-center mx-2 my-2 fontRobReg fs-15" style="color: #646464;">' + data[0].T06 + '</p></div></div>';
			$('#chatBody').append(sendDisplay);
			var objMsg = {
				message_text: data[0].T06,
				flag: "2"
			};
			allMessage.push(objMsg);
			localStorage.setItem("allMessage", JSON.stringify(allMessage));
		}
		var message = data[0].A07;
		if (data[0].option != undefined) {
			var option = data[0].option;
			var flag = false;
			var sendDisplay = '<div class="row justify-content-start my-2"><div class="d-flex justify-content-center chatReceiver"><p class="text-dark align-self-center mx-2 my-2 fontRobReg fs-15" style="color: #646464;">' + message + '</p></div></div>';
			sendDisplay += '<div class="row justify-content-start my-2 opt">';
			for (var i = 0; i < option.length; i++) {
				if (option[i].question_id == "-1") {
					flag = true;
					$('#msgField').css('display', 'none');
					$('#startnewchat').css('display', 'block');
					$('#notifChat').css('display', 'none');
					clearTimeout(nftmeOut);
				} else if (option[i].question_id == "24") {
					sendDisplay += '<div class="chatSender2 d-flex mx-1 my-1 fontRobReg fs-15">\n\
					<a class="m-0 align-self-center mx-2 text-decoration-none" style="cursor: pointer; color: #1A73E8;" onclick="redirectSignUp();">'+ option[i].question + '</a>\n\
					</div>';
				} else if (option[i].question_id == "cu0") {
					sendDisplay += '<div class="chatSender2 d-flex mx-1 my-1 fontRobReg fs-15">\n\
					<a class="m-0 align-self-center mx-2 text-decoration-none" style="cursor: pointer; color: #1A73E8;" onclick="redirectContact();">'+ option[i].question + '</a>\n\
					</div>';
				} else {
					sendDisplay += '<div class="chatSender2 d-flex mx-1 my-1">\n\
					<a class="m-0 align-self-center mx-2 text-decoration-none fontRobReg fs-15" style="cursor: pointer; color: #1A73E8;" onclick="questionClick('+ option[i].question_id + ',\'' + option[i].question + '\');">' + option[i].question + '</a>\n\
					</div>';
				}
			}
			if (flag) {
				localStorage.setItem('state_newChat', '1');
				$('#chatBox').attr("disabled", true);
				$('#sendChat').attr("disabled", true);
			}
			sendDisplay += '</div>';
			$('#chatBody').append(sendDisplay);
			var objMsg = {
				message_text: message,
				option: option,
				flag: "2"
			};
			allMessage.push(objMsg);
			localStorage.setItem("allMessage", JSON.stringify(allMessage));
			flag = false;
		} else {
			var sendDisplay = '<div class="row justify-content-start my-2"><div class="d-flex justify-content-center chatReceiver"><p class="text-dark align-self-center mx-2 my-2 fontRobReg fs-15" style="color: #646464;">' + message + '</p></div></div>';
			$('#chatBody').append(sendDisplay);
			if (data[0].T0 != undefined) {
				var objMsg = {
					message_text: message,
					T0: data[0].T0,
					flag: "2"
				};
			} else {
				var objMsg = {
					message_text: message,
					flag: "2"
				};
			}
			allMessage.push(objMsg);
			localStorage.setItem("allMessage", JSON.stringify(allMessage));
		}
		$("#chatBody").animate({ scrollTop: $('#chatBody').prop("scrollHeight") }, 0);
		idleTimeout();
	}, 100);
}
function suggestion(p_resp) {
	var data = eval(p_resp);
	$('#suggest').empty();
	for (var i = 0; i < data.length; i++) {
		var span = "";
		if (i == 0) {
			span += '<span class="fontRobLite mt-3" style="color: #323232; font-style: italic; font-size: 13px;">Did you mean?</span>';
			span += "<span  class='suggestSpan fontRobReg fs-15 my-1' onclick='sendSuggest(\"" + data[i].id + "\",\"" + data[i].suggest + "\")' >" + data[i].suggest + "</span>";
		} else {
			span += "<span  class='suggestSpan fontRobReg fs-15 my-1' onclick='sendSuggest(\"" + data[i].id + "\",\"" + data[i].suggest + "\")' >" + data[i].suggest + "</span>";
		}
		$('#suggest').append(span);
	}
}
function sendSuggest(id, suggest) {
	$('#suggest').empty();
	var username = localStorage.getItem("username");
	JProcess.send_suggest(username, id);
	var sendDisplay = '<div class="row justify-content-end my-2">\n\
	<div class="d-flex justify-content-center chatSender">\n\
	<p class="align-self-center mx-2 my-2 fontRobReg fs-15 text-light">'+ suggest + '</p>\n\
	</div>\n\
	</div>';
	$('#chatBody').append(sendDisplay);
	$('#chatBox').val("");
	var objMsg = {
		message_text: suggest,
		flag: "1"
	};
	allMessage.push(objMsg);
	localStorage.setItem("allMessage", JSON.stringify(allMessage));
	$("#chatBody").animate({ scrollTop: $('#chatBody').prop("scrollHeight") }, 0);
}
$(document).ready(function () {
	$('#chatBox').on('keyup', function (event) {
		var message_text = $('#chatBox').val();
		var message_temp = message_text.split(" ");
		if (event.keyCode == 13) {
			event.preventDefault();
			if (localStorage.getItem('liveState') == '1') {
				sendLiveChat();
			} else {
				sendMessageC();
			}
		} else if (event.keyCode == 32) {
			var message = $('#chatBox').val();
			var result = message.split(" ");
			var lastIndex = result[result.length - 2];
			console.log("1" + lastIndex)
			if (lastIndex != "" && lastIndex != null && lastIndex != undefined && lastIndex != " ") {
				console.log("2" + lastIndex)
				var username = localStorage.getItem('username');
				JProcess.suggestion(username, lastIndex.trim());
			}
		} else if (message_temp[message_temp.length - 1] == "" || message_temp[message_temp.length - 1] == " ") {
			var message = $('#chatBox').val();
			var result = message.split(" ");
			var lastIndex = result[result.length - 2];
			console.log("1" + lastIndex)
			if (lastIndex != "" && lastIndex != null && lastIndex != undefined && lastIndex != " ") {
				console.log("2" + lastIndex)
				var username = localStorage.getItem('username');
				JProcess.suggestion(username, lastIndex.trim());
			}
		} else {
			$('#suggest').empty();
		}
	});
});
var timeout = "";
function idleTimeout() {
	clearTimeout(timeout);
	timeout = setTimeout(function () {
		closeSession();
		localStorage.clear();
		localStorage.setItem('state_newChat', '0');
		$('#msgField').css('display', 'none');
		$('#notifChat').css('display', 'none');
		$('#startnewchat').css('display', 'block');
	}, 60000 * 2);
}
function notFoundTimeout() {
	nftmeOut = setTimeout(function () {
		var username = localStorage.getItem("username");
		JProcess.no_results(username);
	}, 60000 * 2);
}
function redirectContact() {
	newChat();
	location.replace('../contactus.php');
}
function goLiveChat() {
	$('#startLive').addClass('d-none');
	$('#isLoad').removeClass('d-none');
	setTimeout(function () {
		$('#isLoad').addClass('d-none');
		$('#isLive').removeClass('d-none');
		$('#sendChat').attr('onclick', 'sendLiveChat()');
		localStorage.setItem('liveState', '1');
	}, 1000);
}
function sendLiveChat() {
	$('#suggest').empty();
	var message = $('#chatBox').val();
	if (message == "" || message == null) {
		// donothing
	} else {
		var username = localStorage.getItem("username");
		JProcess.sendLiveChat(username, message);
		var sendDisplay = '<div class="row justify-content-end my-2"><div class="d-flex justify-content-center chatSender"><p class="align-self-center mx-2 my-2 fontRobReg fs-15 text-light">' + message + '</p></div></div>';
		$('#chatBody').append(sendDisplay);
		$("#chatBody").animate({ scrollTop: $('#chatBody').prop("scrollHeight") }, 0);
		$('#chatBox').val("");
		var objMsg = {
			message_text: message,
			flag: "1"
		};
		allMessage.push(objMsg);
		localStorage.setItem("allMessage", JSON.stringify(allMessage));
	}
}
$(document).ready(function () {

	$('.carousel-item').first().addClass('active');

	var old_value;
	var value = ['Custom ', 100, 150, 200, 250, 300, 350, 400, 450, 500, 550, 600, 650, 700, 750, 800, 850, 900, 950, 1000, 'Custom '];

	//start pricing rangeslider
	$('#js-range-slider').ionRangeSlider({
		skin: "big",
		type: "single",
		values: value,
		postfix: 'GB',
		onFinish: function () {
			old_value = $('#js-range-slider').val();
			console.log(old_value);
			if (old_value != 'Custom ') {
				var fee = 3 / 4 * old_value;
				$('#sub-value').html('I want <strong><b>' + old_value + 'GB</b></strong> bandwidth quota for <strong><b>$' + fee + '</b></strong> per month');
			} else {
				$('#sub-value').text('I want a custom subscription');
			}
		}
	});

	if ($(window).width() <= 979) {
		$('#usecase-nav').attr('data-toggle', 'dropdown');
		$('#products-nav').attr('data-toggle', 'dropdown');
		$('#cat-nav').attr('data-toggle', 'dropdown');
	} else if ($(window).width() >= 980) {
		$(function () {
			$("#products-li.dropdown").hover(
				function () {
					$('#products-menu.dropdown-menu', this).stop(true, true).fadeIn("fast");
					$(this).toggleClass('open');
				},
				function () {
					$('#products-menu.dropdown-menu', this).stop(true, true).fadeOut("fast");
					$(this).toggleClass('open');
				});
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
				});
		});
		$(function () {
			$("#cat-li.dropdown").hover(
				function () {
					$('#cat-menu.dropdown-menu', this).stop(true, true).fadeIn("fast");
					$(this).toggleClass('open');
				},
				function () {
					$('#cat-menu.dropdown-menu', this).stop(true, true).fadeOut("fast");
					$(this).toggleClass('open');
				});
		});
	}


	var yourHeight = 65;

	var scrolledY = window.scrollY;

	if (scrolledY) {
		window.scroll(0, scrolledY - yourHeight);
	}
});