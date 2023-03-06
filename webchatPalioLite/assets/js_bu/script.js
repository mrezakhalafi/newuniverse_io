let getById = (id, parent) => parent ? parent.getElementById(id) : getById(id, document);
let getByClass = (className, parent) => parent ? parent.getElementsByClassName(className) : getByClass(className, document);
let hex = '';
var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);

const DOM = {
	connectStatus: getById('connect-status'),
	statusText: getById('status-text'),
	chatListArea: getById("chat-list-area"),
	messageArea: getById("message-area"),
	inputArea: getById("input-area"),
	chatList: getById("chat-list"),
	chatListNavbar: getById('navbar', this.chatListArea),
	messages: getById("messages"),
	chatListItem: getByClass("chat-list-item"),
	messageAreaName: getById("name", this.messageArea),
	messageAreaPic: getById("pic", this.messageArea),
	messageAreaNavbar: getById("navbar", this.messageArea),
	messageAreaDetails: getById("details", this.messageAreaNavbar),
	messageAreaOverlay: getByClass("overlay", this.messageArea)[0],
	messageInput: getById("input"),
	openFileInput: getById("open-file"),
	fileInput: getById("file"),
	// msgSearchOpen: getById("open-search"),
	// msgSearchFormGroup: getById("search-form-group"),
	// msgSearchInput: getById("search-msg"),
	// msgSearchClose: getById("close-search"),
	profileSettings: getById("profile-settings"),
	profilePic: getById("profile-pic"),
	profilePicInput: getById("profile-pic-input"),
	inputName: getById("input-name"),
	username: getById("username"),
	membersSection: getById("members-section"),
	displayPic: getById("display-pic"),
	friendList: getById("friend-list"),
	groupList: getById("group-list"),
	infoArea: getById("info-area"),
	personName: getById("person-name"),
	personProfPic: getById("person-profile-pic"),
	personAbout: getById("person-about"),
	personGroup: getById("person-or-group-info"),
	documentPop: getById("document"),
	urlPreview: getById("urlPreview"),
	urlPreviewInner: getById("urlPreviewInner"),
	urlPreviewTitle: getById("website-title"),
	urlPreviewDesc: getById("website-description"),
	urlPreviewIcon: getById("website-icon"),
};

let mClassList = (element) => {
	return {
		add: (className) => {
			element.classList.add(className);
			return mClassList(element);
		},
		remove: (className) => {
			element.classList.remove(className);
			return mClassList(element);
		},
		contains: (className, callback) => {
			if (element.classList.contains(className))
				callback(mClassList(element));
		}
	};
};

// 'areaSwapped' is used to keep track of the swapping
// of the main area between chatListArea and messageArea
// in mobile-view
let areaSwapped = false;

// 'chat' is used to store the current chat
// which is being opened in the message area
let chat = null;

// this will contain all the chats that is to be viewed
// in the chatListArea
let chatList = [];

// this will be used to store the date of the last message
// in the message area
let lastDate = "";

// 'populateChatList' will generate the chat list
// based on the 'messages' in the datastore
let populateChatList = () => {
	chatList = [];

	// 'present' will keep track of the chats
	// that are already included in chatList
	// in short, 'present' is a Map DS
	let present = {};

	MessageUtils.getMessages()
		.sort((a, b) => mDate(a.time).subtract(b.time))
		.forEach((msg) => {
			let chat = {};

			// chat.isGroup = msg.recvIsGroup;
			chat.isGroup = false;
			let isPrivate = contactList.some(grp => grp.id === msg.recvId);

			if (!isPrivate) {
				chat.isGroup = true;
			}

			chat.msg = msg;

			let isFriend = contactList.some(el => (el.id === msg.recvId) || (el.id === msg.sender));

			if (chat.isGroup) {
				// chat.group = groupList.find((group) => (group.id === msg.recvId));
				// chat.name = chat.group.name;

				chat.group = groupList.find((group) => (group.id === msg.recvId));
				
				if (typeof chat.group === 'undefined') {
					chat.group = topicList.find((topic) => (topic.id === msg.recvId));
					chat.name = chat.group.title;
				} else {
					// chat.group = groupList.find((group) => (group.id === msg.recvId));
					// chat.name = chat.group.name;
					chat.name = chat.group.name;
				}
			} else {
				chat.contact = contactList.find((contact) => (msg.sender !== user.id) ? (contact.id === msg.sender) : (contact.id === msg.recvId));
				chat.name = chat.contact.name;
			}

			chat.unread = (msg.sender !== user.id && msg.status < 2) ? 1 : 0;

			if (typeof present[chat.name] !== 'undefined') {
				chatList[present[chat.name]].msg = msg;
				chatList[present[chat.name]].unread += chat.unread;
			} else {
				present[chat.name] = chatList.length;
				chatList.push(chat);
			}
		});
};

let viewChatList = () => {
	DOM.chatList.innerHTML = "";

	chatList
		.sort((a, b) => mDate(b.msg.time).subtract(a.msg.time))
		.forEach((elem, index) => {
			let statusClass = elem.msg.status < 2 ? "far" : "fas";
			let unreadClass = elem.unread ? "unread" : "";

			if (!elem.isGroup) {
				DOM.chatList.innerHTML += `
				<div class="chat-list-item d-flex flex-row w-100 p-2 border-bottom ${unreadClass}" onclick="generateMessageArea(this, ${index}, false, false)">
					<img src="${elem.isGroup ? elem.group.pic : elem.contact.pic}" alt="Profile Photo" class="img-fluid rounded-circle mr-2" style="height:50px; width:50px;">
					<div class="w-50">
						<div class="name">${elem.name}</div>
						<div class="small last-message">${elem.isGroup ? contactList.find(contact => contact.id === elem.msg.sender).name + ": " : ""}${elem.msg.sender === user.id ? "<i class=\"" + statusClass + " fa-check-circle mr-1\"></i>" : ""} ${richText(elem.msg.body)}</div>
					</div>
					<div class="flex-grow-1 text-right">
						<div class="small time">${mDate(elem.msg.time).chatListFormat()}</div>
						${elem.unread ? "<div class=\"badge badge-success badge-pill small\" id=\"unread-count\">" + elem.unread + "</div>" : ""}
					</div>
				</div>
				`;
			} else {
				/**
				 * if destination == chat_id -> custom topic
				 * if destination == group_id -> group lounge
				 */

				if (!elem.group.hasOwnProperty('group_id')) { // lounge

					DOM.chatList.innerHTML += `
					<div id="accordion-${elem.group.id}" style="width:100%;">
						<div class="card">
							<div class="card-header" id="group-${elem.group.id}">
								<div class="chat-list-item d-flex flex-row w-100 p-2 border-bottom ${unreadClass}" data-toggle="collapse" data-target="#topic-${elem.group.id}" aria-expanded="true" aria-controls="topic-${elem.group.id}">
									<img src="${elem.isGroup ? elem.group.pic : elem.contact.pic}" alt="Profile Photo" class="img-fluid rounded-circle mr-2" style="height:50px; width:50px;">
									<div class="w-50 align-self-center">
										<div class="name">${elem.name}</div>
									</div>
									<div class="w-50 align-self-center">
										<i class="fas fa-chevron-up" style="float:right"></i>
									</div>
								</div>
							</div>
							<div id="topic-${elem.group.id}" class="collapse show" aria-labelledby="group-${elem.group.id}" data-parent="#accordion-${elem.group.id}">
								<div class="card-body">
									<div class="chat-list-item d-flex flex-row w-100 p-2 border-bottom ${unreadClass}" onclick="generateMessageArea(this, ${index}, false, true)">
										<img src="${elem.isGroup ? elem.group.pic : elem.contact.pic}" alt="Profile Photo" class="img-fluid rounded-circle mr-2" style="height:50px; width:50px;">
										<div class="w-50 align-self-center">
											<div class="name">Lounge</div>
											<div class="small last-message">${elem.isGroup ? contactList.find(contact => contact.id === elem.msg.sender).name + ": " : ""}${elem.msg.sender === user.id ? "<i class=\"" + statusClass + " fa-check-circle mr-1\"></i>" : ""} ${richText(elem.msg.body)}</div>
										</div>
										<div class="flex-grow-1 text-right">
											<div class="small time">${mDate(elem.msg.time).chatListFormat()}</div>
											${elem.unread ? "<div class=\"badge badge-success badge-pill small\" id=\"unread-count\">" + elem.unread + "</div>" : ""}
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				 	`;
				} else { // custom topic
					let htmlContent =
						`<div class="chat-list-item d-flex flex-row w-100 p-2 border-bottom ${unreadClass}" onclick="generateMessageArea(this, ${index}, false, true)">
						<img src="${elem.isGroup ? elem.group.pic : elem.contact.pic}" alt="Profile Photo" class="img-fluid rounded-circle mr-2" style="height:50px; width:50px;">
						<div class="w-50 align-self-center">
							<div class="name">${elem.name}</div>
							<div class="small last-message">${elem.isGroup ? contactList.find(contact => contact.id === elem.msg.sender).name + ": " : ""}${elem.msg.sender === user.id ? "<i class=\"" + statusClass + " fa-check-circle mr-1\"></i>" : ""} ${richText(elem.msg.body)}</div>
						</div>
						<div class="flex-grow-1 text-right">
							<div class="small time">${mDate(elem.msg.time).chatListFormat()}</div>
							${elem.unread ? "<div class=\"badge badge-success badge-pill small\" id=\"unread-count\">" + elem.unread + "</div>" : ""}
						</div>
					</div>`;

					setTimeout(function () {
						document.getElementById('topic-' + elem.group.group_id).getElementsByClassName('card-body')[0].insertAdjacentHTML('beforeend', htmlContent);
					}, 100);
				}
			}
		});
};

let generateChatList = () => {
	populateChatList();
	viewChatList();
};

let richText = (content) => {
	let cont = content.replace(/\*([^\*]+)\*/g, "<strong>$1</strong>").replace(/\^([^\^]+)\^/g, "<u>$1</u>")
		.replace(/\_([^\_]+)\_/g, "<i>$1</i>").replace(/\~([^\~]+)\~/g, "<del>$1</del>");
	return cont;
};

let addDateToMessageArea = (date) => {
	DOM.messages.innerHTML += `
	<div class="mx-auto my-2 bg-primary text-white small py-1 px-2 rounded">
		${date}
	</div>
	`;
};

let addMessageToMessageArea = (msg) => {
	let msgDate = mDate(msg.time).getDate();
	if (lastDate != msgDate) {
		addDateToMessageArea(msgDate);
		lastDate = msgDate;
	}

	let htmlForGroup = "";

	if (chat.isGroup) {
		htmlForGroup = `
		<div class="small font-weight-bold text-primary">
			${contactList.find(contact => contact.id === msg.sender).name}
		</div>
		`;
	}

	let urlRegex = new RegExp("([a-zA-Z0-9]+://)?([a-zA-Z0-9_]+:[a-zA-Z0-9_]+@)?([a-zA-Z0-9.-]+\\.[A-Za-z]{2,4})(:[0-9]+)?([^ ])+");

	let sendStatus = `<i class="${msg.status < 2 ? "far" : "fas"} fa-check-circle"></i>`;

	let msgBody = "";

	// check message content
	if (msg.body.includes("a href")) { // has attachment

		if (msg.file == 'image') {
			msgBody = '<div class="flex-grow-1"><img src="../assets/img/thumb_image.png" width="100" height="100"><span>' + msg.body + '</span></div>';
		} else if (msg.file == 'video') {
			msgBody = '<div class="flex-grow-1"><img src="../assets/img/thumb_video.png" width="100" height="100"><span>' + msg.body + '</span></div>';
		} else if (msg.file == 'audio') {
			msgBody = '<div class="flex-grow-1"><img src="../assets/img/thumb_audio.png" width="100" height="100"><span>' + msg.body + '</span></div>';
		} else {
			msgBody = '<div class="flex-grow-1"><img src="../assets/img/thumb_document.png" width="100" height="100"><span>' + msg.body + '</span></div>';
		}

		// msgBody = '<div class="flex-grow-1"><img src=" ../assets/img/document.png" width="100" height="100"><span>' + msg.body + '</span></div>';
	} else if (urlRegex.test(msg.body)) { // contains url
		// msgBody = msg.body.replace(msg.body.match(urlRegex)[0], '<a href="'+ msg.body.match(urlRegex)[0] +'">'+ msg.body.match(urlRegex)[0] +'</a>');

		msgBody = `
			<a href="` + msg.body.match(urlRegex)[0] + `">
				<div class="flex-grow-1">
					<div class="row m-2">
						<div class="col-sm-4 align-self-center text-center">
							<img id="msg-url-icon-` + msg.id + `" class="mx-auto" style="height:100px; width:auto;">
						</div>
						<div class="col-sm-8 align-self-center">
							<h5 id="msg-url-title-` + msg.id + `"></h5>
							<p id="msg-url-desc-` + msg.id + `" style="font-size:14px;"></p>
						</div>
					</div>
				</div>
			</a>
			` + richText(msg.body.replace(msg.body.match(urlRegex)[0], "")) + `
		`;

		let contentUrl = msg.body.match(urlRegex)[0];

		// open xhr
		let xmlHttp = new XMLHttpRequest();
		xmlHttp.onreadystatechange = function () {
			if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
				// console.log(xmlHttp.responseText);

				let img = $(xmlHttp.responseText).filter('meta[property="og:image"]').attr("content");
				if (typeof img === 'undefined') {
					img = '../assets/img/document.png';
				}
				let title = $(xmlHttp.responseText).filter('title').text();
				let description = $(xmlHttp.responseText)
					.filter('meta[property="og:description"],meta[name="description"],meta[name="twitter:description"],meta[itemprop="description"]').attr("content");

				document.getElementById('msg-url-icon-' + msg.id).src = img;
				document.getElementById('msg-url-title-' + msg.id).innerHTML = title;
				document.getElementById('msg-url-desc-' + msg.id).innerHTML = description.substr(0, 50) + '...';
			}
		}

		xmlHttp.open("get", "https://cors.bridged.cc/" + contentUrl);
		xmlHttp.send(null);
	} else {
		msgBody = richText(msg.body);
	}

	// draft rich text
	// .replace(/^\*\*/g, "<b>").replace(/.\*\*/g, "</b>")

	DOM.messages.innerHTML += `
	<div class="align-self-${msg.sender === user.id ? "end self" : "start"} p-1 my-1 mx-3 rounded bg-white shadow-sm message-item" id="msg-${msg.id.toString()}">
		<div class="options">
			<a href="#"><i class="fas fa-angle-down text-muted px-2"></i></a>
		</div>
		${chat.isGroup ? htmlForGroup : ""}
		<div class="d-flex flex-row">
			<div class="body m-1 mr-2">${msgBody}</div>
			<div class="time ml-auto small text-right flex-shrink-0 align-self-end text-muted" style="width:75px;">
				${mDate(msg.time).getTime()}
				${(msg.sender === user.id) ? sendStatus : ""}
			</div>
		</div>
	</div>
	`;

	DOM.messages.scrollTo(0, DOM.messages.scrollHeight);
};

let offlineTimer = 0;

let fetchPeriodicInterval = setInterval(function () {
	fetchMessagePeriodic();
	fetchGroupPeriodic();
	fetchDiscussionPeriodic();
	fetchFriendPeriodic();

	if (user.isOnline === 0) {
		// mClassList(DOM.connectStatus).remove('status-online').add('status-offline');
		document.getElementById('connect-status').classList.remove('status-online');
		document.getElementById('connect-status').classList.add('status-offline');
		document.getElementById('status-text').textContent = ' Offline';
		offlineTimer += 1; // count while offline for 60 seconds
		if (offlineTimer === 30) {
			pendingMsg = [];
			offlineTimer = 0;
		}
	} else {
		// mClassList(DOM.connectStatus).remove('status-offline').add('status-online');
		document.getElementById('connect-status').classList.remove('status-offline');
		document.getElementById('connect-status').classList.add('status-online');
		document.getElementById('status-text').textContent = ' Online';
		if (pendingMsg.length > 0) {
			sendPendingMessage(pendingMsg);
		}
	}
}, 1000);

let generateMessageArea = (elem, chatIndex, isNewChat, isGroup) => {
	if (!isNewChat) {
		chat = chatList[chatIndex];
	} else {
		if (!isGroup) {
			chat = {
				contact: contactList.find(xyz => xyz.id === chatIndex),
				isGroup: isGroup,
				unread: 0,
				name: contactList.find(xyz => xyz.id === chatIndex).name
			};
		} else {
			let isNotTopic = groupList.some(xyz => xyz.id === chatIndex);

			if (!isNotTopic) {
				chat = {
					group: topicList.find(xyz => xyz.id === chatIndex),
					isGroup: isGroup,
					unread: 0,
					name: topicList.find(xyz => xyz.id === chatIndex).title
				};
			} else {
				chat = {
					group: groupList.find(xyz => xyz.id === chatIndex),
					isGroup: isGroup,
					unread: 0,
					name: groupList.find(xyz => xyz.id === chatIndex).name
				};
			}
		}
	}

	DOM.messageAreaDetails.innerHTML = "";

	mClassList(DOM.inputArea).contains("d-none", (elem) => elem.remove("d-none").add("d-flex"));
	mClassList(DOM.messageAreaOverlay).add("d-none");

	hideInfo();
	hideFriendList();
	hideGroupList();

	[...DOM.chatListItem].forEach((elem) => mClassList(elem).remove("active"));

	mClassList(elem).contains("unread", () => {
		MessageUtils.changeStatusById({
			isGroup: chat.isGroup,
			id: chat.isGroup ? chat.group.id : chat.contact.id
		});
		mClassList(elem).remove("unread");
		mClassList(elem.querySelector("#unread-count")).add("d-none");
	});

	if (window.innerWidth <= 575) {
		mClassList(DOM.chatListArea).remove("d-flex").add("d-none");
		mClassList(DOM.messageArea).remove("d-none").add("d-flex");
		areaSwapped = true;
	} else {
		mClassList(elem).add("active");
	}

	DOM.messageAreaName.innerHTML = chat.name;
	DOM.messageAreaPic.src = chat.isGroup ? chat.group.pic : chat.contact.pic;

	// Message Area details ("last seen ..." for contacts / "..names.." for groups)
	if (chat.isGroup) {

		let memberNames = groupMembers.map(function (elem) {
			return elem.name.trim();
		}).join(", ");

		DOM.messageAreaDetails.innerHTML = memberNames;

		let formData = new FormData();

		let group_id = groupList.some(grp => grp.id === localStorage.destination) ? localStorage.destination : chat.group.group_id;

		formData.append('group_id', group_id);

		let xmlHttp = new XMLHttpRequest();
		xmlHttp.onreadystatechange = function () {
			if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
				// get friends lpins
				data = JSON.parse(xmlHttp.responseText);

				for (const d of data) {

					let m = {
						group_id: d.GROUP_ID,
						f_pin: d.F_PIN,
						name: d.FIRST_NAME + " " + d.LAST_NAME,
						pic: "/webchat/assets/img/palio.png",
						position: d.POSITION,
						quote: d.QUOTE
					}

					let isMemberExist = groupMembers.filter(member => member.f_pin === m.f_pin);

					if (isMemberExist.length === 0) {
						groupMembers.push(m);
					}
				}
			}
		}
		xmlHttp.open("post", "/webchat/logics/fetch_group_members.php");
		xmlHttp.send(formData);
	} else {
		DOM.messageAreaDetails.innerHTML = `last seen ${mDate(chat.contact.lastSeen).lastSeenFormat()}`;
	}

	let msgs = chat.isGroup ? MessageUtils.getByGroupId(chat.group.id) : MessageUtils.getByContactId(chat.contact.id);

	DOM.messages.innerHTML = "";

	localStorage.setItem('destination', chat.isGroup ? chat.group.id : chat.contact.id);

	lastDate = "";
	msgs
		.sort((a, b) => mDate(a.time).subtract(b.time))
		.forEach((msg) => addMessageToMessageArea(msg));
};

// search result array
let searchResults = [];

let generateMsgSearchResult = (resultArr) => {
	DOM.messages.innerHTML = "";

	lastDate = "";
	resultArr
		.sort((a, b) => mDate(a.time).subtract(b.time))
		.forEach((msg) => addMessageToMessageArea(msg));
}

/** search message */
// DOM.msgSearchOpen.addEventListener('click', function (e) {
// 	e.preventDefault();
// 	e.stopPropagation();

// 	mClassList(DOM.msgSearchInput).remove('d-none');
// 	DOM.msgSearchInput.focus();
// });

// DOM.msgSearchInput.addEventListener('keyup', function (e) {
// 	searchResults = messages.filter(msg => msg.body.includes(DOM.msgSearchInput.value) && ((msg.sender === localStorage.F_PIN && msg.recvId === localStorage.destination) || (msg.sender === localStorage.destination && msg.recvId === localStorage.F_PIN)));

// 	if (e.key === 'Enter') {
// 		generateMsgSearchResult(searchResults);
// 	}

// 	if (DOM.msgSearchInput.value.trim() === "") {
// 		let msgs = chat.isGroup ? MessageUtils.getByGroupId(chat.group.id) : MessageUtils.getByContactId(chat.contact.id);

// 		DOM.messages.innerHTML = "";

// 		localStorage.setItem('destination', chat.isGroup ? chat.group.id : chat.contact.id);

// 		fetchPeriodicInterval = setInterval(function () {
// 			fetchMessagePeriodic();
// 		}, 1000);

// 		lastDate = "";
// 		msgs
// 			.sort((a, b) => mDate(a.time).subtract(b.time))
// 			.forEach((msg) => addMessageToMessageArea(msg));
// 	}
// });

let showChatList = () => {
	if (areaSwapped) {
		mClassList(DOM.chatListArea).remove("d-none").add("d-flex");
		mClassList(DOM.messageArea).remove("d-flex").add("d-none");
		areaSwapped = false;
	}
};

let pendingMsg = [];

let sendMessage = () => {
	sendFile();
	let value = DOM.messageInput.value;
	DOM.messageInput.value = "";
	if (value.trim() === "" && hasFile === false) {
		alert('Please write a message.');
		return;
	} else if (hasFile === true) {
		sendFile();
	} else {

		let msg_id = localStorage.F_PIN + Date.now().toString();

		hasFile = false;

		let msg = {
			id: msg_id,
			sender: localStorage.F_PIN,
			body: value,
			time: mDate().toString(),
			status: 1,
			// recvId: chat.isGroup ? chat.group.id : chat.contact.id,
			recvId: localStorage.destination,
			recvIsGroup: chat.isGroup
		};

		let scope = '3';
		let chat_id = '';
		let destination = localStorage.destination;

		if (chat.isGroup) {
			scope = '4';
			let isTopic = topicList.some(topic => topic.id === localStorage.destination);

			if (isTopic) {
				chat_id = localStorage.destination;
				destination = chat.group.group_id;
			}
		}

		if (user.isOnline === 1) {

			addMessageToMessageArea(msg);
			MessageUtils.addMessage(msg);
			generateChatList();

			// message form data
			var formData = new FormData();
			formData.append('message_id', msg_id);
			formData.append('destination', destination);
			formData.append('originator', localStorage.F_PIN);
			formData.append('content', value);
			formData.append('sent_time', Date.now());
			formData.append('scope', scope);
			formData.append('chat_id', chat_id);

			// open xhr
			var xmlHttp = new XMLHttpRequest();
			xmlHttp.onreadystatechange = function () {
				if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
					console.log(xmlHttp.responseText);
				}
			}
			xmlHttp.open("post", "/webchat/logics/send_message.php");
			xmlHttp.send(formData);
		} else {
			// const found = pendingMsg.some(el => el.id === msg.id);
			// if (!found) {
			// 	pendingMsg.push(msg);
			// }
			alert('You are currently offline. Please make sure your catchUp is online.');
		}
	}
};

let sendPendingMessage = (msgArr) => {

	msgArr.forEach((el, index) => {

		let scope = '3';
		let chat_id = '';
		let destination = el.recvId;

		if (el.recvIsGroup) {
			scope = '4';
			let isTopic = topicList.some(topic => topic.id === el.recvId);

			if (isTopic) {
				chat_id = el.recvId;
				destination = chat.group.group_id;
			}
		}

		// message form data
		var formData = new FormData();
		formData.append('message_id', el.id);
		formData.append('destination', destination);
		formData.append('originator', localStorage.F_PIN);
		formData.append('content', el.body);
		formData.append('sent_time', Date.now());
		formData.append('scope', scope);
		formData.append('chat_id', chat_id);

		// open xhr
		var xmlHttp = new XMLHttpRequest();
		xmlHttp.onreadystatechange = function () {
			if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
				console.log(xmlHttp.responseText);

				document.getElementById('msg-' + el.id).getElementsByClassName('fa-check-circle')[0].classList.remove('far');
				document.getElementById('msg-' + el.id).getElementsByClassName('fa-check-circle')[0].classList.add('fas');
			}
		}
		xmlHttp.open("post", "/webchat/logics/send_message.php");
		xmlHttp.send(formData);

		msgArr.splice(index, 1);
	});
};

// when user insert something
DOM.fileInput.addEventListener('input', function (evt) {

	if(this.files[0].size > 2097152){
       alert("File is too big!");
       this.value = "";
       return;
    };

	document.getElementById("document").classList.remove("d-none");
	
	let doc = this.value.split("\\");
	hex = Date.now().toString(16);

	hasFile = true;

	if (doc.length)
		// document.getElementById("document-name").innerHTML = doc[doc.length - 1];

		if (isImage(getExtension(doc[doc.length - 1]))) {
			document.getElementById("preview-img").innerHTML = "<img src='../assets/img/thumb_image.png' style='height:100px; width: auto;'>";
		} else if (isAudio(getExtension(doc[doc.length - 1]))) {
		document.getElementById("preview-img").innerHTML = "<img src='../assets/img/thumb_audio.png' style='height:100px; width: auto;'>";
	} else if (isVideo(getExtension(doc[doc.length - 1]))) {
		document.getElementById("preview-img").innerHTML = "<img src='../assets/img/thumb_video.png' style='height:100px; width: auto;'>";
	} else {
		document.getElementById("preview-img").innerHTML = "<img src='../assets/img/thumb_document.png' style='height:100px; width: auto;'>";
	}

	document.getElementById("document-name").innerHTML = localStorage.F_PIN + '-' + hex + '.' + getExtension(doc[doc.length - 1]);
});

// get uploaded file extension
let getExtension = (filename) => {
	var parts = filename.split('.');
	return parts[parts.length - 1];
}

// check if the uploaded file is video
let isVideo = (filename) => {
	var ext = getExtension(filename);
	switch (ext.toLowerCase()) {
		case 'm4v':
		case 'avi':
		case 'mpg':
		case 'mp4':
		case 'webm':
		case 'mov':
		case 'wmv':
		case 'flv':
		case 'mkv':
		case 'gif':
			// etc
			return true;
	}
	return false;
}

// check if the uploaded file is audio
let isAudio = (filename) => {
	var ext = getExtension(filename);
	switch (ext.toLowerCase()) {
		case 'm4a':
		case 'flac':
		case 'mp3':
		case 'wav':
		case 'wma':
		case 'aac':
			// etc
			return true;
	}
	return false;
}

// check if the uploaded file is image
let isImage = (filename) => {
	var ext = getExtension(filename);
	switch (ext.toLowerCase()) {
		case 'jpg':
		case 'jpeg':
		case 'png':
			// etc
			return true;
	}
	return false;
}

let hasFile = false;

let sendFile = () => {
	let value = DOM.fileInput.value;
	if (value === "") return;

	let root = location.protocol + '//' + location.host;

	let file = DOM.fileInput.files[0];
	let linkFile = "<a href=\'" + root + ":2809/file/image/" + localStorage.F_PIN + '-' + hex + '.' + getExtension(file.name) + "\' target=\'_blank\'>" + localStorage.F_PIN + '-' + hex + '.' + getExtension(file.name) + "</a>";

	let msg_id = localStorage.F_PIN + Date.now().toString();
	let filetype;

	if (isImage(getExtension(file.name))) {
		filetype = 'image';
	} else if (isAudio(getExtension(file.name))) {
		filetype = 'audio';
	} else if (isVideo(getExtension(file.name))) {
		filetype = 'video';
	} else {
		filetype = 'file';
	}
	
	let msg = {
		id: msg_id,
		sender: localStorage.F_PIN,
		body: linkFile,
		time: mDate().toString(),
		status: 1,
		recvId: chat.isGroup ? chat.group.id : chat.contact.id,
		recvIsGroup: chat.isGroup,
		file: filetype
	};

	let scope = '3';
	let chat_id = '';
	let destination = localStorage.destination;

	if (chat.isGroup) {
		scope = '4';
		let isTopic = topicList.some(topic => topic.id === localStorage.destination);

		if (isTopic) {
			chat_id = localStorage.destination;
			destination = chat.group.group_id;
		}
	}

	if (user.isOnline === 1) {
		addMessageToMessageArea(msg);
		MessageUtils.addMessage(msg);
		generateChatList();

		// message form data
		var formData = new FormData();
		formData.append('message_id', msg_id);
		formData.append('destination', destination);
		formData.append('originator', localStorage.F_PIN);
		formData.append('sent_time', Date.now());
		formData.append('file', file, file.name);
		formData.append('hex', hex);
		formData.append('scope', scope);
		formData.append('chat_id', chat_id);
		formData.append('is_chrome', isChrome);

		if (isVideo(file.name)) {
			var canvas = document.createElement('canvas');
			var video = document.createElement('video');
			var fullQuality = '';
			video.src = URL.createObjectURL(file);
			video.addEventListener('loadeddata', function () {
				canvas.getContext('2d').drawImage(video, 0, 0, video.videoWidth, video.videoHeight);
				fullQuality = canvas.toDataURL('image/jpeg', 1.0);
				formData.append('thumbnail', fullQuality);

				// open xhr
				var xmlHttp = new XMLHttpRequest();
				xmlHttp.onreadystatechange = function () {
					if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
						console.log(xmlHttp.responseText);
					}
				}
				xmlHttp.open("post", "/webchat/logics/send_file.php");
				xmlHttp.send(formData);
				DOM.documentPop.classList.add("d-none");
				DOM.fileInput.value = "";
			});
		} else {
			// open xhr
			var xmlHttp = new XMLHttpRequest();
			xmlHttp.onreadystatechange = function () {
				if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
					console.log(xmlHttp.responseText);
				}
			}
			xmlHttp.open("post", "/webchat/logics/send_file.php");
			xmlHttp.send(formData);
			DOM.documentPop.classList.add("d-none");
			DOM.fileInput.value = "";
		}
	} else {
		alert('You are currently offline. Please make sure your catchUp is online.');
	}
}

DOM.messageInput.addEventListener('keyup', function (e) {
	// send using enter key
	if (e.key === 'Enter') {
		if (DOM.messageInput.value.trim() === "" && hasFile === false) {
			alert('Please write a message.');
		} else {
			sendMessage();
		}
	}

	// if message contains url
	let urlRegex = new RegExp("([a-zA-Z0-9]+://)?([a-zA-Z0-9_]+:[a-zA-Z0-9_]+@)?([a-zA-Z0-9.-]+\\.[A-Za-z]{2,4})(:[0-9]+)?([^ ])+");

	if ((DOM.messageInput.value !== "" || DOM.messageInput.value.length > 0) && urlRegex.test(DOM.messageInput.value)) {
		let contentUrl = DOM.messageInput.value.match(urlRegex)[0];

		// open xhr
		let xmlHttp = new XMLHttpRequest();
		xmlHttp.onreadystatechange = function () {
			if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
				// console.log(xmlHttp.responseText);

				let img = $(xmlHttp.responseText).filter('meta[property="og:image"]').attr("content");
				if (typeof img === 'undefined') {
					img = '../assets/img/document.png';
				}
				// var title = $(data).filter('meta[property="og:title"]').attr("content");
				let title = $(xmlHttp.responseText).filter('title').text();
				let description = $(xmlHttp.responseText).
				filter('meta[property="og:description"],meta[name="description"],meta[name="twitter:description"],meta[itemprop="description"]').attr("content");

				DOM.urlPreviewIcon.src = img;
				DOM.urlPreviewTitle.innerHTML = title;
				DOM.urlPreviewDesc.innerHTML = description;

				mClassList(DOM.urlPreview).remove("d-none");
			}
		}

		xmlHttp.open("get", "https://cors.bridged.cc/" + contentUrl);
		xmlHttp.send(null);
	} else {
		mClassList(DOM.urlPreview).add("d-none");
	}
});

DOM.messageInput.addEventListener('oninput', function (e) {

});

let showProfileSettings = () => {
	DOM.profileSettings.style.left = 0;
	DOM.profilePic.src = user.pic;
	DOM.inputName.value = user.name;
};

let hideProfileSettings = () => {
	DOM.profileSettings.style.left = "-110%";
	DOM.username.innerHTML = user.name;
};

let isFriendListOpen = false;
let isGroupListOpen = false;

let showFriendList = () => {
	DOM.friendList.style.left = 0;
	DOM.friendList.innerHTML = "";
	mClassList(DOM.chatList).add('d-none');
	mClassList(DOM.friendList).remove('d-none');
	isFriendListOpen = true;
	DOM.chatListNavbar.innerHTML = `
	<i class="fas fa-arrow-left p-2 mx-3 my-1 text-white" style="font-size: 1.5rem; cursor: pointer;" onclick="hideFriendList()"></i>
						<div class="text-white font-weight-bold">New chat</div>
	`;

	contactList
		.sort((a, b) => {
			let fa = a.name.toLowerCase();
			let fb = b.name.toLowerCase();

			if (fa < fb) {
				return -1;
			}
			if (fa > fb) {
				return 1;
			}
			return 0;
		})
		.forEach((elem, index) => {

			if (elem.id !== localStorage.F_PIN) { // exclude self from friend list view, for arr = friend list
				DOM.friendList.innerHTML += `
		<div class="chat-list-item d-flex flex-row w-100 p-2 border-bottom" onclick="generateMessageArea(this, '${elem.id}', true, false)">
			<img src="${elem.pic}" alt="Profile Photo" class="img-fluid rounded-circle mr-2" style="height:50px; width:50px;">
			<div class="w-50">
				<div class="name">${elem.name}</div>
			</div>
		</div>
		`;
			}
		});
};

let hideFriendList = () => {
	DOM.friendList.style.left = "-110%";

	isFriendListOpen = false;

	mClassList(DOM.chatList).remove('d-none');
	mClassList(DOM.friendList).add('d-none');
	DOM.friendList.innerHTML = "";

	DOM.chatListNavbar.innerHTML = `
	<img alt="Profile Photo" class="img-fluid rounded-circle mr-2" style="height:50px; width:50px; cursor:pointer;" onclick="showProfileSettings()" id="display-pic" src="` + user.pic + `">
	<div class="w-50">
		<div class="text-white font-weight-bold" id="username">` + user.name + `</div>
		<div id="connect-status"></div>
		<div class="text-white" id="status-text"></div>
	</div>
	<div class="nav-item dropdown ml-auto">
		<i class="fa fa-users text-white" onclick="showFriendList()"></i>
	</div>
	<div class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v text-white"></i></a>
		<div class="dropdown-menu dropdown-menu-right">
			<a class="dropdown-item" href="#" onclick="showGroupList()">View Groups</a>
			<form method='POST'>
				<input type="submit" class="dropdown-item" name="submit" id="submit" value="Log Out">
			</form>
		</div>
	</div>
	`;

	init();
};

let updateFriendList = () => {
	if (isFriendListOpen) {
		DOM.friendList.innerHTML = "";
		contactList
			.sort((a, b) => {
				let fa = a.name.toLowerCase();
				let fb = b.name.toLowerCase();

				if (fa < fb) {
					return -1;
				}
				if (fa > fb) {
					return 1;
				}
				return 0;
			})
			.forEach((elem, index) => {

				if (elem.id !== localStorage.F_PIN) { // exclude self from friend list view, for arr = friend list
					DOM.friendList.innerHTML += `
					<div class="chat-list-item d-flex flex-row w-100 p-2 border-bottom" onclick="generateMessageArea(this, '${elem.id}', true, false)">
						<img src="${elem.pic}" alt="Profile Photo" class="img-fluid rounded-circle mr-2" style="height:50px; width:50px;">
						<div class="w-50">
							<div class="name">${elem.name}</div>
						</div>
					</div>
					`;
				}
			});
	}
};

let showGroupList = () => {
	DOM.groupList.style.left = 0;
	DOM.groupList.innerHTML = "";
	mClassList(DOM.chatList).add('d-none');
	mClassList(DOM.groupList).remove('d-none');
	isGroupListOpen = true;
	DOM.chatListNavbar.innerHTML = `
	<i class="fas fa-arrow-left p-2 mx-3 my-1 text-white" style="font-size: 1.5rem; cursor: pointer;" onclick="hideGroupList()"></i>
						<div class="text-white font-weight-bold">New chat</div>
	`;

	groupList
		.sort((a, b) => {
			let fa = a.name.toLowerCase();
			let fb = b.name.toLowerCase();

			if (fa < fb) {
				return -1;
			}
			if (fa > fb) {
				return 1;
			}
			return 0;
		})
		.forEach((elem, index) => {

			DOM.groupList.innerHTML += `
		<div id="accordion-groupList-${elem.id}" style="width:100%;">
			<div class="card">
				<div class="card-header" id="groupList-${elem.id}">
					<div class="chat-list-item d-flex flex-row w-100 p-2 border-bottom" data-toggle="collapse" data-target="#topic-groupList-${elem.id}" aria-expanded="true" aria-controls="topic-groupList-${elem.id}">
						<img src="${elem.pic}" alt="Profile Photo" class="img-fluid rounded-circle mr-2" style="height:50px; width:50px;">
						<div class="w-50 align-self-center">
							<div class="name">${elem.name}</div>
						</div>
						<div class="w-50 align-self-center">
							<i class="fas fa-chevron-up" style="float:right"></i>
						</div>
					</div>
				</div>
				<div id="topic-groupList-${elem.id}" class="collapse show" aria-labelledby="groupList-${elem.id}" data-parent="#accordion-groupList-${elem.id}">
					<div class="card-body">
						<div class="chat-list-item d-flex flex-row w-100 p-2 border-bottom" onclick="generateMessageArea(this, '${elem.id}', true, true)">
							<img src="${elem.pic}" alt="Profile Photo" class="img-fluid rounded-circle mr-2" style="height:50px; width:50px;">
							<div class="w-50 align-self-center">
								<div class="name">Lounge</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		`;

			let isTopicExist = topicList.filter(topic => topic.group_id === elem.id);

			if (isTopicExist.length > 0) {
				isTopicExist
					.sort((a, b) => {
						let fa = a.name.toLowerCase();
						let fb = b.name.toLowerCase();

						if (fa < fb) {
							return -1;
						}
						if (fa > fb) {
							return 1;
						}
						return 0;
					})
					.forEach((elem, index) => {
						let htmlContent =
							`<div class="chat-list-item d-flex flex-row w-100 p-2 border-bottom" onclick="generateMessageArea(this, '${elem.id}', true, true)">
					<img src="${elem.pic}" alt="Profile Photo" class="img-fluid rounded-circle mr-2" style="height:50px; width:50px;">
					<div class="w-50 align-self-center">
						<div class="name">${elem.title}</div>
					</div>
				</div>`;

						setTimeout(function () {
							document.getElementById('topic-groupList-' + elem.group_id).getElementsByClassName('card-body')[0].insertAdjacentHTML('beforeend', htmlContent);
						}, 100);
					});
			}

		});
};
let hideGroupList = () => {
	DOM.groupList.style.left = "-110%";

	isGroupListOpen = false;

	mClassList(DOM.chatList).remove('d-none');
	mClassList(DOM.groupList).add('d-none');
	DOM.groupList.innerHTML = "";

	DOM.chatListNavbar.innerHTML = `
	<img alt="Profile Photo" class="img-fluid rounded-circle mr-2" style="height:50px; width:50px; cursor:pointer;" onclick="showProfileSettings()" id="display-pic" src="` + user.pic + `">
	<div class="w-50">
		<div class="text-white font-weight-bold" id="username">` + user.name + `</div>
		<div id="connect-status"></div>
		<div class="text-white" id="status-text"></div>
	</div>
	<div class="nav-item dropdown ml-auto">
		<i class="fa fa-users text-white" onclick="showFriendList()"></i>
	</div>
	<div class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v text-white"></i></a>
		<div class="dropdown-menu dropdown-menu-right">
			<a class="dropdown-item" href="#" onclick="showGroupList()">View Groups</a>
			<form method='POST'>
				<input type="submit" class="dropdown-item" name="submit" id="submit" value="Log Out">
			</form>
		</div>
	</div>
	`;

	init();
};

let updateGroupList = () => {
	if (isGroupListOpen) {
		DOM.groupList.innerHTML = "";
		groupList
			.sort((a, b) => {
				let fa = a.name.toLowerCase();
				let fb = b.name.toLowerCase();

				if (fa < fb) {
					return -1;
				}
				if (fa > fb) {
					return 1;
				}
				return 0;
			})
			.forEach((elem, index) => {

				DOM.groupList.innerHTML += `
		<div id="accordion-groupList-${elem.id}" style="width:100%;">
			<div class="card">
				<div class="card-header" id="groupList-${elem.id}">
					<div class="chat-list-item d-flex flex-row w-100 p-2 border-bottom" data-toggle="collapse" data-target="#topic-groupList-${elem.id}" aria-expanded="true" aria-controls="topic-groupList-${elem.id}">
						<img src="${elem.pic}" alt="Profile Photo" class="img-fluid rounded-circle mr-2" style="height:50px; width:50px;">
						<div class="w-50 align-self-center">
							<div class="name">${elem.name}</div>
						</div>
						<div class="w-50 align-self-center">
							<i class="fas fa-chevron-up" style="float:right"></i>
						</div>
					</div>
				</div>
				<div id="topic-groupList-${elem.id}" class="collapse show" aria-labelledby="groupList-${elem.id}" data-parent="#accordion-groupList-${elem.id}">
					<div class="card-body">
						<div class="chat-list-item d-flex flex-row w-100 p-2 border-bottom" onclick="generateMessageArea(this, '${elem.id}', true, true)">
							<img src="${elem.pic}" alt="Profile Photo" class="img-fluid rounded-circle mr-2" style="height:50px; width:50px;">
							<div class="w-50 align-self-center">
								<div class="name">Lounge</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		`;

				let isTopicExist = topicList.filter(topic => topic.group_id === elem.id);

				if (isTopicExist.length > 0) {
					isTopicExist
						.sort((a, b) => {
							let fa = a.name.toLowerCase();
							let fb = b.name.toLowerCase();

							if (fa < fb) {
								return -1;
							}
							if (fa > fb) {
								return 1;
							}
							return 0;
						})
						.forEach((elem, index) => {
							let htmlContent =
								`<div class="chat-list-item d-flex flex-row w-100 p-2 border-bottom" onclick="generateMessageArea(this, '${elem.id}', true, true)">
					<img src="${elem.pic}" alt="Profile Photo" class="img-fluid rounded-circle mr-2" style="height:50px; width:50px;">
					<div class="w-50 align-self-center">
						<div class="name">${elem.title}</div>
					</div>
				</div>`;

							setTimeout(function () {
								document.getElementById('topic-groupList-' + elem.group_id).getElementsByClassName('card-body')[0].insertAdjacentHTML('beforeend', htmlContent);
							}, 100);
						});
				}

			});
	}
};

let showInfo = () => {

	DOM.messageArea.classList.remove('col-md-8');
	DOM.messageArea.classList.add('col-md-4');
	mClassList(DOM.infoArea).remove('d-none').add('d-flex');
	if (window.innerWidth <= 575) {
		mClassList(DOM.messageArea).remove('d-flex').add('d-none');
	}
	DOM.infoArea.style.left = 0;

	if (!chat.isGroup) {
		DOM.personGroup.innerHTML = 'Contact Info';
		DOM.personProfPic.src = chat.contact.pic;
		DOM.personName.value = chat.contact.name;
		// DOM.personAbout.value = contact.about;
	} else {
		DOM.personGroup.innerHTML = 'Group Info';
		DOM.personProfPic.src = chat.group.pic;

		if (typeof chat.group.name === 'undefined') {
			DOM.personName.value = groupList.find(grp => grp.id === chat.group.group_id).name;
		} else {
			DOM.personName.value = chat.group.name;
		}

		mClassList(DOM.membersSection).remove('d-none');

		DOM.membersSection.innerHTML = '';

		groupMembers
			.sort((a, b) => {
				let fa = a.name.toLowerCase();
				let fb = b.name.toLowerCase();

				if (fa < fb) {
					return -1;
				}
				if (fa > fb) {
					return 1;
				}
				return 0;
			})
			.forEach((elem, index) => {
				DOM.membersSection.innerHTML += `
			<div class="chat-list-item d-flex flex-row w-100 p-2 border-bottom">
				<img src="${elem.pic}" alt="Profile Photo" class="img-fluid rounded-circle mr-2" style="height:50px; width:50px;">
				<div class="w-50">
					<div class="name">${elem.name}</div>
					<div class="small last-message">${elem.quote === null ? "" : elem.quote}</div>
				</div>
			</div>
			`;
			});
	}

}

let hideInfo = () => {
	DOM.infoArea.style.left = '110%';
	mClassList(DOM.infoArea).remove('d-flex').add('d-none');
	if (window.innerWidth <= 575) {
		mClassList(DOM.messageArea).remove('d-none').add('d-flex');
	}
	DOM.messageArea.classList.remove('col-md-4');
	DOM.messageArea.classList.add('col-md-8');
};

window.addEventListener("resize", e => {
	if (window.innerWidth > 575) showChatList();
});

let init = () => {
	DOM.username.innerHTML = user.name;
	DOM.displayPic.src = user.pic;
	DOM.profilePic.stc = user.pic;
	DOM.profilePic.addEventListener("click", () => DOM.profilePicInput.click());
	DOM.profilePicInput.addEventListener("change", () => console.log(DOM.profilePicInput.files[0]));
	DOM.inputName.addEventListener("blur", (e) => user.name = e.target.value);
	generateChatList();

	console.log("Click the Image at top-left to open settings.");
};

// init();