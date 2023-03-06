let user = {};

let groupList = [];

let groupIsMember = [];

let groupMembers = [];

let topicList = [];

let ongoingComplaint = {};

// message status - 0:sent, 1:delivered, 2:read

let messages = [];

let bcHistory = [];

let blockList = [];

let complaint_history = [];

let msgs_complaint = [];

let MessageUtils = {
	getByGroupId: (groupId) => {
		return messages.filter(msg => msg.recvIsGroup && msg.recvId === groupId);
	},
	getByContactId: (contactId) => {
		return messages.filter(msg => {
			return !msg.recvIsGroup && ((msg.sender === user.id && msg.recvId === contactId) || (msg.sender === contactId && msg.recvId === user.id));
		});
	},
	getMessages: () => {
		return messages;
	},
	changeStatusById: (options) => {
		messages = messages.map((msg) => {
			if (options.isGroup) {
				if (msg.recvIsGroup && msg.recvId === options.id) msg.status = 2;
			} else {
				if (!msg.recvIsGroup && msg.sender === options.id && msg.recvId === user.id) msg.status = 2;
			}
			return msg;
		});
	},
	addMessage: (msg) => {
		messages.push(msg);
	}
};

if(localStorage.FLAG == 1){
	var dir = "/filepalio/image/";
} else {
	var dir = "/file/image/";
}
console.log(localStorage.F_PIN);
let botPic = "";
if (localStorage.FLAG == 1) {
	// botPic = "/chatcore/assets/img/palio.png";
	botPic = "/chatcore/assets/img/grey_circle.png";
	// if (location.href.includes('digisales')) {
	// 	botPic = "/chatcore/assets/img/logo_mtsp.png";
	// }
} else {
	botPic = "/chatcore/assets/img/cu_logo.webp";
}

var contactList = [
	{
		id: "-999",
		isStaff: "0",
		lastSeen: mDate().toString(),
		name: "<i class='fas fa-check-circle' style='color:#306EFF;''></i> Bot",
		number: null,
		pic: botPic,
		user_type: 0,
	}
];