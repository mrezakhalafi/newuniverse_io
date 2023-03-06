function checkBlockSts() {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            data = JSON.parse(xmlHttp.responseText);

            blockList = [];

            for (const d of data) {
                
                let bl = {
                    from : d.F_PIN,
                    to: d.L_PIN
                }

                let isExist = blockList.some(el => el.from === d.F_PIN && el.to === d.L_PIN); // check for same pair

                if (!isExist) {
                    blockList.push(bl);
                }

                console.log("chec bklo");
                if(chat != null){
                    console.log("masuk sini");
                    if(chat.contact.id == "-999"){
                        mClassList(DOM.blockUserButton).add('d-none');
                    }
                }
            }
        }
    }
    xmlHttp.open("get", "/chatcore/logics/fetch_block_status?f_pin=" + user.id + "&flag=" + localStorage.FLAG);
    xmlHttp.send();
}