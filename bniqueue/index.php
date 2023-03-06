<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="BNI Queue System">
    <meta name="description" content="BNI Queue System" />

    <title>BNI Queue System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/gridstack.min.css" />
    <link rel="stylesheet" href="css/gridstack-extra.min.css" />
    <script type="text/javascript" src="js/gridstack-static.js"></script>

    <style>
        body {
            max-width: 100%;
            overflow-x: hidden;
        }

        .grid-stack-item>.grid-stack-item-content {
            margin: 0;
            position: absolute;
            width: auto;
            overflow-x: hidden;
            border-radius: 10px !important;
            /* border: 1px solid black; */
            inset: 1px;
            background-color: #FF6600;
        }

        .grid-stack>.grid-stack-item>.grid-stack-item-content {
            padding: 10px;
        }

        .inner {
            /* height: 100%;
            width: 100%; */
            overflow: hidden;
            color: white;
            position: absolute;
            top: 5px;
            right: 5px;
            bottom: 5px;
            left: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .inner .service-icon {
            height: 75px;
            width: auto;
            margin-bottom: 15px;
        }

        .main-logo {
            width: auto;
            height: 70px;
        }

        .float-right {
            display: flex;
            justify-content: right;
            align-items: center;
        }

        .orange {
            background-color: #FF6600;
        }

        .turquoise {
            background-color: #006699;
        }

        .btn {
            color: white;
            font-weight: bold;
        }

        #staticBackdrop .modal-footer .row {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container-fluid">

        <div class="row mt-2">
            <div class="col-6">
                <img src="images/main_logo.png" class="main-logo">
            </div>
            <div class="col-6 float-right">
                <img src="images/murni.png" class="main-logo">
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-12">
                <h5><strong>Selamat datang di Layanan Antrian BNI, mohon hidupkan GPS anda agar kami dapat menentukan Kantor BNI terdekat dengan lokasi anda.</strong></h5>
            </div>
        </div>

    </div>


    <div class="grid-stack mt-4" id="grid">

    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-3 text-center">

                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-6">
                            <button type="button" class="btn turquoise w-100" id="modal-cancel" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn turquoise w-100" id="modal-proceed">OK</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    let grid_stack = GridStack.init({
        float: false,
        disableOneColumnMode: true,
        column: 2,
        margin: 2.5,
    });

    let gridElements = [];

    let serviceData = [];

    let serviceId = 0;

    let modalProcess = new bootstrap.Modal(document.getElementById('staticBackdrop'));

    function requestProceed() {
        if (window.Android) {
            window.Android.sendQueueBNI(serviceId);
        } else if (window.webkit && window.webkit.messageHandlers && window.webkit.messageHandlers.sendQueueBNI) {
            window.webkit.messageHandlers.sendQueueBNI.postMessage({
                param1: serviceId,
            });
        }
        console.log('sendQueueBNI(' + serviceId + ')');
    }

    function openService(id) {
        console.log(id);
        serviceId = id;
        let modalBody = document.querySelector('#staticBackdrop .modal-body');
        let serviceName = serviceData.find(sd => sd.SERVICE_ID == id).SERVICE_NAME;
        modalBody.innerHTML = `
        <h6>Kami sedang memproses permintaan ${serviceName} anda, dan kami akan memberikan notifikasi Kantor-Kantor Cabang BNI terdekat yang dapat anda kunjungi. </h6>
        `;
        let modalProceed = document.getElementById('modal-proceed');
        modalProceed.removeEventListener('click', requestProceed);
        modalProceed.addEventListener('click', requestProceed);
        modalProcess.toggle();
    }

    function fillGrid(data) {
        gridElements = [];

        data.forEach(ele => {
            let size = 1;
            let icon = '';
            if (ele.SERVICE_ID == 2) {
                icon = 'images/tabungan.png';
            }
            if (ele.SERVICE_ID == 3) {
                icon = 'images/rekeningkoran.png';
            }
            if (ele.SERVICE_ID == 4) {
                icon = 'images/kreditusaha.png';
            }
            if (ele.SERVICE_ID == 5) {
                icon = 'images/kreditmahasiswa.png';
            }
            if (ele.SERVICE_ID == 6) {
                icon = 'images/umkm.png';
            }
            let computed = `
            <a onclick="event.stopPropagation(); openService('${ele.SERVICE_ID}');">
                <div class="inner">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 text-center">
                                <img class="service-icon" src="${icon}">
                                <h6><strong>${ele.SERVICE_NAME}</strong></h6>
                            </div
                        </div>
                    </div>
                </div>
            </a>
            `;
            gridElements.push({
                id: ele.SERVICE_ID,
                minW: size,
                minH: size,
                maxW: size,
                maxH: size,
                content: computed
            });
        })

        grid_stack.removeAll();
        grid_stack.load(gridElements, true);
    }

    function fetchServices() {
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function() {
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                let data = JSON.parse(xmlHttp.responseText);
                serviceData = data;
                fillGrid(data);
            }
        }
        xmlHttp.open("get", "logics/fetch_services");
        xmlHttp.send();
    }

    fetchServices();
</script>

</html>