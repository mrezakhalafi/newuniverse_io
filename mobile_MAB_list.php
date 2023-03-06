<?php 

    include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php');
    $dbconnPLQ = dbConnPalioLite();

    // GET EXISTING DATA

    $f_pin = $_GET['f_pin'];

    // NEW F_PIN SET METHOD

    $queryCheckFpin = "SELECT F_PIN FROM USER_LIST WHERE F_PIN = '$f_pin' OR IMEI = '$f_pin'";
    $query = $dbconnPLQ->prepare($queryCheckFpin);
    $query->execute();
    $getNewFPIN = $query->get_result()->fetch_assoc();
    $query->close();

    $f_pin = $getNewFPIN['F_PIN'];

    // GET PROJECT LIST

    $query = $dbconnPLQ->prepare("SELECT uc.*, ucd.KEY, ucd.VALUE FROM UI_CONFIG uc LEFT JOIN UI_CONFIG_DETAIL ucd ON uc.ID = ucd.UI_CONFIG WHERE F_PIN = '$f_pin' GROUP BY uc.ID ORDER BY uc.ID DESC");
    $query->execute();
    $projectList = $query->get_result();
    $query->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Mobile MAB List</title>
</head>
<body>

    <div class="p-3 shadow-sm mb-4" style="border-bottom: 1px solid #e4e4e4">
        <div class="row">
                <img src="nexilis/assets/img/membership-back.png" style="width: 55px; height: auto; position:absolute" onclick="closeAndroid()">
            <div class="col-12 pt-1 text-center">
                <b id="text-header" style="font-size: 14px">My CPAAS Configuration</b>
            </div>
        </div>
    </div>

    <?php foreach($projectList as $i => $pl): ?>

        <div class="row m-3 p-3 shadow" style="border-radius: 20px; border: 1px solid #bdbdbd; border-left: 3px solid black">
            <div class="col-1">
                <div class="text-center" style="border-radius: 100%; width: 20px; height: 20px; margin-left: -10px; font-size: 12px; color: white; background-color: #6a6a6a; font-weight: bold; padding-top: 1px"><?= $i+1 ?></div>
            </div>
            <div class="col-11">
                <div class="row">
                    <div style="font-size: 12.5px"><b class="configuration-name-text">Configuration Name :</b> <?= $pl['NAME'] ?></div>

                    <?php       
                    
                    $date = $pl['ID'];
                    $seconds = $date / 1000;
                    $created_at = date("d F Y", $seconds);
                    
                    ?>

                    <div style="font-size: 12.5px"><b class="created-at-text">Created Date :</b> <?= $created_at ?></div>
                </div>
            </div>
            <div class="col-1"></div>
            <div class="col-11 mt-2">
                <div class="row gx-2">
                    <div class="col-4">
                        <button id="preview-text" class="btn btn-sm btn-primary w-100 preview-text" onclick="openPreview('<?= $pl['URL'] ?>')">Preview</button>
                    </div>
                    <div class="col-4">
                        <button id="share-text" class="btn btn-sm btn-success w-100 share-text" onclick="openShare('<?= $pl['URL'] ?>')">Share</button>
                    </div>
                    <div class="col-4">
                        <button id="delete-text" class="btn btn-sm btn-danger w-100 delete-text" onclick="deleteProject('<?= $pl['URL'] ?>')">Delete</button>
                    </div>
                </div>
            </div>
            
        </div>

    <?php endforeach; ?>

    <div id="modalURL" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div id="modalURL-content" class="modal-body">
                    <!-- Fill IN JS -->
                </div>
            </div>
        </div>
    </div>

    <div id="modalPreview" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div id="modalPreview-content" class="modal-body">
                    <!-- FILL IN JS -->
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    function openShare(url){

        let html = '';

        if (localStorage.lang == 1){

            html = `<p>Tautan Kustomisasi Anda :</p>
                    <input type="text" id="generate-key" readonly class="form-control" value="https://newuniverse.io/mobile_MAB?url=`+url+`">
                    <button class="btn btn-success w-100 mt-3" id="copy-link" onclick="saveKey()">Salin Tautan</button>`;
        }else{

            html = `<p>Your Customization Link :</p>
                    <input type="text" id="generate-key" readonly class="form-control" value="https://newuniverse.io/mobile_MAB?url=`+url+`">
                    <button class="btn btn-success w-100 mt-3" id="copy-link" onclick="saveKey()">Copy Link</button>`;
            
        }

        $('#modalURL-content').html(html);
        $('#modalURL').modal('show');

    }

    function saveKey(){

        var valueText = $("#generate-key").select().val();
        document.execCommand("copy");

        if (localStorage.lang == 1){
            $('#copy-link').text('Salin Tautan (Tersalin)');
        }else{
            $('#copy-link').text('Copy Link (Copied)');
        }

        $('#copy-link').css('background-color','#ff8100');
        $('#copy-link').css('border','1px solid #ff8100');

    }

    function deleteProject(url){

        let textTitle = '';
        let textDesc = '';
        let textYes = '';
        let textNo = '';

        if (localStorage.lang == 1){

            textTitle = 'Apakah anda yakin?';
            textDesc = 'Jika anda menghapus ini, semua kustomisasi anda akan hilang.';
            textYes = 'Iya';
            textNo = 'Tidak';

        }else{

            textTitle = 'Are you sure?';
            textDesc = 'If you delete this, your all customization will be lost.';
            textYes = 'Yes';
            textNo = 'No';

        }

        Swal.fire({
            title: textTitle,
            text: textDesc,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText : textYes,
            cancelButtonText: textNo
            }).then((result) => {
            if (result.isConfirmed) {
        
                confirmDelete(url);

            }
        })
    }

    function confirmDelete(url){

        // Swal.fire({
        //     icon: 'error',
        //     title: 'Oops...',
        //     text: 'Features doesn`t exist yet',
        // })

        let xmlHttp = new XMLHttpRequest();
            xmlHttp.onreadystatechange = function () {

                if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                    console.log(xmlHttp.responseText);

                    let response = xmlHttp.responseText;

                    if (response == 1){

                        let textTitle = '';
                        let textDesc = '';
                        let textYes = '';

                        if (localStorage.lang == 1){

                            textTitle = 'Sukses!';
                            textDesc = 'Konfigurasi anda berhasil dihapus.';
                            textYes = 'OKE';

                        }else{

                            textTitle = 'Success!';
                            textDesc = 'Your configuration has been deleted.';
                            textYes = 'OK';

                        }

                        Swal.fire({
                            icon: 'success',
                            title: textTitle,
                            text: textDesc,
                            confirmButtonText : textYes,
                            allowOutsideClick: false
                            }).then((result) => {

                                if (result.isConfirmed) {

                                    refreshPage()

                                }

                        })

                    }

                }
            }

            xmlHttp.open("post", "/delete_config?url="+url);
            xmlHttp.send();

    }

    function closeAndroid(){

        if (window.Android){

            window.Android.finishForm();

        }else{

            window.history.back();
            
        }

    }

    function refreshPage(){

        location.reload();

    }

    function openPreview(url){

        let html = '';

        if (localStorage.lang == 1){

            html = `<iframe style="border-radius: 10px; pointer-events: none; width:100%; height:750px; -webkit-transform: scale(0.80); margin-top: -80px; margin-bottom: -65px" src="/mobile_MAB.php?url=`+url+`&is_iframe=1"></iframe>
                    <button class="btn btn-sm btn-secondary w-100" data-bs-dismiss="modal">Tutup Pratinjau</button>`;

        }else{

            html = `<iframe style="border-radius: 10px; pointer-events: none; width:100%; height:750px; -webkit-transform: scale(0.80); margin-top: -80px; margin-bottom: -65px" src="/mobile_MAB.php?url=`+url+`&is_iframe=1"></iframe>
                    <button class="btn btn-sm btn-secondary w-100" data-bs-dismiss="modal">Close Preview</button>`;

        }
       
        $('#modalPreview-content').html(html);
        $('#modalPreview').modal('show');

    }

    if (localStorage.lang == 1){

        $('#text-header').text('Konfigurasi Custom CPAAS Saya');
        $('.configuration-name-text').text('Nama Konfigurasi :');
        $('.created-at-text').text('Dibuat Pada :');
        $('.preview-text').text('Pratinjau');
        $('.share-text').text('Bagikan');
        $('.delete-text').text('Hapus');
    }

</script>