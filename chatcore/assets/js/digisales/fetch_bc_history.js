function addHistoryToArr(arr, id, m) {
    let found = bcHistory.some(el => el.id === id);
    if (!found) {
        arr.push(m);

        if (bcHistoryOpen) {
            addBCtoBCArea(m);
        }
    }
}

function fetchBCHistory() {

	var xhr = new XMLHttpRequest();

	xhr.addEventListener("readystatechange", function () {
		if (this.readyState === 4 && xmlHttp.status == 200) {
            let history = JSON.parse(xhr.responseText);

            history.forEach(el => {

                let m = {
                    id: el.MESSAGE_ID,
                    title: el.TITLE,
                    content: el.CONTENT,
                    start: el.START,
                    link: el.LINK,
                    image: el.IMAGE_ID,
                    thumb: el.THUMB_ID,
                    audio: el.AUDIO_ID,
                    video: el.VIDEO_ID,
                    file: el.FILE_ID,
                }

                let found = bcHistory.some(el => el.id == m.id);
                if (!found) {
                    bcHistory.push(m);
                }
            })
		}
	});

	xhr.open("GET", "/chatcore/logics/digisales/fetch_bc_history?f_pin=" + user.id + "&t=" + new Date().getTime());
	xhr.send();
}

function fetchBCHistoryPeriodic() {
    var xhr = new XMLHttpRequest();

	xhr.addEventListener("readystatechange", function () {
		if (this.readyState === 4 && xmlHttp.status == 200) {
            let history = JSON.parse(xhr.responseText);

            history.forEach(el => {

                let m = {
                    id: el.MESSAGE_ID,
                    title: el.TITLE,
                    content: el.CONTENT,
                    start: el.START,
                    link: el.LINK,
                    image: el.IMAGE_ID,
                    thumb: el.THUMB_ID,
                    audio: el.AUDIO_ID,
                    video: el.VIDEO_ID,
                    file: el.FILE_ID,
                }

                addHistoryToArr(bcHistory, m.id, m);
            })
		}
	});

	xhr.open("GET", "/chatcore/logics/digisales/fetch_bc_history?f_pin=" + user.id + "&t=" + new Date().getTime());
	xhr.send();
}