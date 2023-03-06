function fetchUserType(){
    let formData = new FormData();

	formData.append('f_pin', localStorage.F_PIN);

	var xmlHttp = new XMLHttpRequest();
	
	var url = "/chatcore/logics/fetch_user_type";
	xmlHttp.onreadystatechange = function () {
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
			// console.log(xmlHttp.responseText);

			if (xmlHttp.responseText === 'null') {
				localStorage.setItem('user_type', 'common');
			} else {
                localStorage.setItem('user_type', 'staff');
            }
		}
	}
	xmlHttp.open("post", url);
	xmlHttp.send(formData);
}

