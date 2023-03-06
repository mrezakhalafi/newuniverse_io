function fetchCompanyAlias() {
    // get company alias
	let formData = new FormData();

	formData.append('f_pin', localStorage.F_PIN);

	var xmlHttp = new XMLHttpRequest();
	
	var url = "/chatcore/logics/fetch_company_alias";
	xmlHttp.onreadystatechange = function () {
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
			// console.log(xmlHttp.responseText);

			let data = JSON.parse(xmlHttp.responseText);

			localStorage.setItem('cc_alias', data.FIRST_NAME);
			localStorage.setItem('cc_alias_fpin', data.F_PIN);

			let objIndex = contactList.findIndex((obj => obj.id == "-999"));

			//Log object to Console.
			// console.log("Before update: ", contactList[objIndex])

			//Update object's name property.
			contactList[objIndex].pic = "/filepalio/image/" + data.IMAGE;
		}
	}
	xmlHttp.open("post", url);
	xmlHttp.send(formData);
}