function fetchAPIKey() {
    // get company alias
	let formData = new FormData();

	formData.append('f_pin', localStorage.F_PIN);

	var xmlHttp = new XMLHttpRequest();
	
	var url = "/chatcore/logics/fetch_be_api_key";
	xmlHttp.onreadystatechange = function () {
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
			// console.log(xmlHttp.responseText);

			let data = JSON.parse(xmlHttp.responseText);

			localStorage.setItem('api_key', data.API);
		}
	}
	xmlHttp.open("post", url);
	xmlHttp.send(formData);
}