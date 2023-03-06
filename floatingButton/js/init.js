let init = () => {
    let ccButton = document.createElement('img');
    // let chatButton = document.createElement('img');
    // let callButton = document.createElement('img');
    // let lsButton = document.createElement('img');

    ccButton.setAttribute('data-html', true);
    ccButton.setAttribute('data-toggle', 'tooltip');
    ccButton.setAttribute('data-placement', 'right');
    ccButton.src = 'http://192.168.0.56/floatingButton/assets/button_cc.png';
    ccButton.setAttribute('title', "Berikan Pelangganmu <i>Contact Center</i> canggih langsung dari aplikasimu. Libatkan pelanggan melalui <i>VoIP/Video Call</i> atau <i>chat</i> sederhana ...");

    let featureButtons = document.createElement('div');
    featureButtons.id = 'feature-buttons';
    featureButtons.className = 'icon-bar';

    let wrapper = document.createElement('div');
    wrapper.id = 'wrap-all';
    wrapper.className = 'icon-bar-wrap';

    let pButton = document.createElement('img');
    pButton.src = 'http://192.168.0.56/floatingButton/assets/palio_button.png';

    let pButtonWrap = document.createElement('div');
    pButtonWrap.id = 'palio-button-1';
    pButtonWrap.className = 'palio-button';

    featureButtons.appendChild(ccButton);
    pButtonWrap.appendChild(pButton);

    wrapper.appendChild(featureButtons);
    wrapper.appendChild(pButtonWrap);

    document.querySelector("body").appendChild(wrapper);
}

let link = document.createElement( "link" );
link.href = "http://192.168.0.56/floatingButton/css/style.css";
link.type = "text/css";
link.rel = "stylesheet";
link.media = "screen,print";

document.getElementsByTagName( "head" )[0].appendChild( link );