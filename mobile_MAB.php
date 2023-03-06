<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php');
$dbconnPLQ = dbConnPalioLite();

// GET EXISTING DATA

$f_pin = $_GET['f_pin'];
$url =  $_GET['url'];

// FOR SHOW/HIDE APPLY THIS THEME (OPEN IN PREVIEW OR SHARE VIA LINK)

$is_iframe = 0;

if (isset($_GET['is_iframe'])) {
    $is_iframe = 1;
}

// NEW F_PIN SET METHOD

$queryCheckFpin = "SELECT F_PIN, BE FROM USER_LIST WHERE F_PIN = '$f_pin' OR IMEI = '$f_pin'";
$query = $dbconnPLQ->prepare($queryCheckFpin);
$query->execute();
$getNewFPIN = $query->get_result()->fetch_assoc();
$query->close();

$f_pin = $getNewFPIN['F_PIN'];
$be = $getNewFPIN['BE'];

// print_r($f_pin); 

if (isset($url)) {

    $query = $dbconnPLQ->prepare("SELECT * FROM UI_CONFIG_DETAIL
                                    LEFT JOIN UI_CONFIG
                                    ON
                                    UI_CONFIG.ID = UI_CONFIG_DETAIL.UI_CONFIG 
                                    WHERE URL = '$url'");
    $query->execute();
    $prefsDataRaw = $query->get_result();
    $query->close();

    $query = $dbconnPLQ->prepare("SELECT * FROM UI_CONFIG WHERE URL = '$url'");
    $query->execute();
    $projectName = $query->get_result()->fetch_assoc();
    $query->close();

    $f_pinLoadURL = $projectName['F_PIN'];

    $query = $dbconnPLQ->prepare("SELECT * FROM USER_LIST WHERE F_PIN = '$f_pinLoadURL'");
    $query->execute();
    $beRaw = $query->get_result()->fetch_assoc();
    $query->close();

    $be = $beRaw['BE'];
}

$prefsData = [];

foreach ($prefsDataRaw as $pdr) {

    $key = $pdr['KEY'];
    $value = $pdr['VALUE'];

    $prefsData[$key] = $value;
}

// print_r($prefsData);
// print_r($projectName);

// FUNCTION TRANSLATE VALUE TO WORDING FOR BURGER

function translateBurger($number)
{

    if ($number == '_fb2') {
        return 'Content URL';
    } else if ($number == '_fb2') {
        return 'Contact Center';
    } else if ($number == '_fb9') {
        return 'Message';
    } else if ($number == '_fb6') {
        return 'Call';
    } else if ($number == '_fb7') {
        return 'Live Streaming';
    } else if ($number == '_fb8') {
        return 'Notification Center';
    } else if ($number == '_fb11') {
        return 'Call Audio';
    } else if ($number == '_fb12') {
        return 'Call Video';
    } else if ($number == '_fb99') {
        return 'Open Post';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Mobile MAB Editor</title>
</head>

<style>
    html,
    body {
        overflow-x: hidden;
        max-height: 100%;
        background-color: #f7f7f7;
        font-family: 'Poppins';
    }

    .bg-top {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin: 10px;
    }

    #background-section {
        position: absolute;
        margin-top: 150px;
        width: 100%;
    }

    @media(min-width: 390px) {

        #background-section {
            margin-top: 230px;
        }

    }

    img {
        object-fit: cover;
    }

    .disabled {
        opacity: 0.4;
    }

    .form-check-input:checked {
        background-color: #198754;
        border-color: #198754;
    }

    p {
        font-size: 0.9rem;
    }
</style>

<body style="height: 100vh; background-image: url('background-white.webp')" class="d-none">

    <!-- BACKGROUND -->

    <section id="background-section" style="<?php echo isset($prefsData['app_builder_background']) ? 'margin-top: 0px; height: 100%' : '' ?>">
        <label for="<?= !isset($url) ? 'backgroundFloating' : '' ?>" onclick="multipleSelectAndroid()" style="width: 100%; height: 100%">

            <?php

            if (isset($prefsData['app_builder_background'])) :

                $oldBackground = explode(",", $prefsData['app_builder_background']); ?>

                <img id="bgPreviewFloating" style="width: 100%; height: 100%; object-fit: cover" src="dashboardv2/uploads/mab_mobile/<?= $oldBackground[0] ?>">
                <!-- <img id="bgPreviewFloating" style="width: 100%; height: 100%; object-fit: cover" src="<?= $oldBackground[0] ?>"> -->

                <p id="click-here-background" style="font-size: 1rem" class="d-none text-center"><b>Tap here</b> to <br /> Upload background</p>

            <?php else : ?>

                <img id="bgPreviewFloating" style="width: 100%; height: 100%; object-fit: cover; margin-bottom: -30px; filter: grayscale(1)" src="upload-image.png">
                <p id="click-here-background" style="font-size: 1rem" class="text-center"><b>Tap here</b> to <br /> Upload background</p>

            <?php endif; ?>

        </label>
        <input type="file" accept="image/*" id="backgroundFloating" multiple class="d-none" onchange="changeBackground()">
    </section>

    <!-- CHANGE CPAAS MODEL -->

    <?php if (!isset($url)) : ?>
        <div id="accessModel" class="row px-3" style="border-bottom: 1px solid #c5c5c5; border-top: 1px solid #c5c5c5; border-left: 1px solid #c5c5c5; border-right: 1px solid #c5c5c5; height: 45px">
            <div id="floatingBut" class="col-4 p-2 d-flex justify-content-center" style="background-color: #ff9b35; z-index: 10; border-radius: 100px; font-size: 13px; font-weight: bold; padding-top: 12px !important" onclick="switchFloatingMode()">
                <span class="text-center" style="background-color: #b53838; color: white; border: 1px solid #b53838;border-radius: 100px; margin-right: 6px; margin-top: 0px; width: 17px; height: 17px; font-size: 10px; margin-left: -13px">
                    A
                </span>
                Floating
            </div>
            <div id="dockedBut" class="col-4 p-2 d-flex justify-content-center" style="background-color: #efefef; z-index: 10; border-radius: 100px; font-size: 13px; font-weight: bold; padding-top: 12px !important" onclick="switchDockMode()">
                <span class="text-center" style="background-color: #b53838; color: white; border: 1px solid #b53838;border-radius: 100px; margin-right: 6px; margin-top: 0px; width: 17px; height: 17px; font-size: 10px; margin-left: -13px">
                    B
                </span>
                Docked
            </div>
            <div id="hamburgerBut" class="col-4 p-2 d-flex justify-content-center" style="background-color: #efefef; z-index: 10; border-radius: 100px; font-size: 13px; font-weight: bold; padding-top: 12px !important" onclick="switchBurgerMode()">
                <span class="text-center" style="background-color: #b53838; color: white; border: 1px solid #b53838;border-radius: 100px; margin-right: 6px; margin-top: 0px; width: 17px; height: 17px; font-size: 10px; margin-left: -13px">
                    C
                </span>
                Hamburger
            </div>
        </div>
    <?php endif; ?>

    <div class="m-3">

        <?php if (isset($url)) : ?>
            <div style="position:relative;z-index: 100;background-color: #0dcaf0; width: fit-content;padding: px;border-radius: 5px;">
                <p style="padding: 8px; font-size: 14px; font-weight: bold"><span id="app-name-text" style="font-weight: 500">Theme Name :</span> <?= $projectName['NAME'] ?></p>
            </div>
        <?php endif; ?>

        <div id="featureButon" class="col-4 d-flex justify-content-center p-2 bg-dark text-white sticky-top" onclick="chooseFeature()" style="border-radius: 20px; font-size: 14px; visibility:hidden">Feature List</div>
        <div id="fontButton" class="col-3 d-flex justify-content-center p-2 bg-secondary text-white sticky-top btn-sm mt-2" onclick="chooseFont()" style="border-radius: 20px; visibility:hidden">Font</div>
    </div>

    <?php if (!isset($url)) : ?>
        <div onclick="closeEditor()" class="text-center" style="background-color: #555555; position: absolute; width: 40px; height: 40px; border-radius: 50%; padding-top: 3px; margin-top: -90px; margin-left: 15px; transform:rotate(180deg)"><span style="font-size: 23px; color: white">
                ➤</span>
        </div>
    <?php endif; ?>

    <!-- SECTION FLOATING -->

    <section id="floating-interface">
        <div class="row" style="width: 120px; right: 0 !important; float: right; margin-top: -80px">

            <?php if (!isset($url)) : ?>
                <div class="col-12 d-flex justify-content-end">
                    <span id="add-more-text" class="text-end" style="margin-right: 17px; z-index: 10; font-size: 13px">Add <br /> more</span>
                </div>
            <?php endif; ?>

            <div class="col-12 d-flex justify-content-end" onclick="openCPAASMore('1')">
                <div id="addMore-Floating" class="bg-top d-flex justify-content-center <?= $prefsData['fb4_icon'] ? '' : 'disabled' ?>" style="z-index: 10; background-color: #ff9b35">
                    <span style="font-size: 35px">+</span>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <div id="closeFloating4-icon" onclick="resetCPAASIcon('4','1')" class="close-icon bg-danger d-flex justify-content-center d-none" style="z-index: 10; width: 30px; height: 30px; border-radius: 50%; margin-top: 21px; margin-left: -4px">
                    <img src="close-round.png" style="width: 15px; height: 15px; border-radius: 20px; margin-top: 8px; filter: invert(1)">
                </div>
                <div class="bg-top bg-info d-flex justify-content-center" style="z-index: 10" onclick="openCPAASModal('4','1')">
                    <img id="cpaasFloating4-icon" class="<?= $prefsData['fb3_icon'] ? '' : 'disabled' ?>" src="<?= $prefsData['fb4_icon'] ? 'dashboardv2/uploads/mab_mobile/' . $prefsData['fb4_icon'] : "empty-image.png" ?>" style="width: 30px; height: 30px; border-radius: 20px; margin-top: 10px">
                </div>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <div id="closeFloating3-icon" onclick="resetCPAASIcon('3','1')" class="close-icon bg-danger d-flex justify-content-center d-none" style="z-index: 10; width: 30px; height: 30px; border-radius: 50%; margin-top: 21px; margin-left: -4px">
                    <img src="close-round.png" style="width: 15px; height: 15px; border-radius: 20px; margin-top: 8px; filter: invert(1)">
                </div>
                <div class="bg-top bg-info d-flex justify-content-center" style="z-index: 10" onclick="openCPAASModal('3','1')">
                    <img id="cpaasFloating3-icon" class="<?= $prefsData['fb2_icon'] ? '' : 'disabled' ?>" src="<?= $prefsData['fb3_icon'] ? 'dashboardv2/uploads/mab_mobile/' . $prefsData['fb3_icon'] : "empty-image.png" ?>" style="width: 30px; height: 30px; border-radius: 20px; margin-top: 10px">
                </div>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <div id="closeFloating2-icon" onclick="resetCPAASIcon('2','1')" class="close-icon bg-danger d-flex justify-content-center d-none" style="z-index: 10; width: 30px; height: 30px; border-radius: 50%; margin-top: 21px; margin-left: -4px">
                    <img src="close-round.png" style="width: 15px; height: 15px; border-radius: 20px; margin-top: 8px; filter: invert(1)">
                </div>
                <div class="bg-top bg-info d-flex justify-content-center" style="z-index: 10" onclick="openCPAASModal('2','1')">
                    <img id="cpaasFloating2-icon" class="<?= $prefsData['fb1_icon'] ? '' : 'disabled' ?>" src="<?= $prefsData['fb2_icon'] ? 'dashboardv2/uploads/mab_mobile/' . $prefsData['fb2_icon'] : "empty-image.png" ?>" style="width: 30px; height: 30px; border-radius: 20px; margin-top: 10px">
                </div>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <div id="closeFloating1-icon" onclick="resetCPAASIcon('1','1')" class="close-icon bg-danger d-flex justify-content-center d-none" style="z-index: 10; width: 30px; height: 30px; border-radius: 50%; margin-top: 21px; margin-left: -4px">
                    <img src="close-round.png" style="width: 15px; height: 15px; border-radius: 20px; margin-top: 8px; filter: invert(1)">
                </div>
                <div class="bg-top bg-info d-flex justify-content-center" style="z-index: 10" onclick="openCPAASModal('1','1')">
                    <img id="cpaasFloating1-icon" src="<?= $prefsData['fb1_icon'] ? 'dashboardv2/uploads/mab_mobile/' . $prefsData['fb1_icon'] : "empty-image.png" ?>" style="width: 30px; height: 30px; border-radius: 20px; margin-top: 10px">
                </div>
            </div>

            <?php if (!isset($url)) : ?>
                <div id="closeFloatingMain-icon" onclick="resetCPAASIcon('0','1')" class="<?= $prefsData['cpaas_icon'] ? '' : 'd-none' ?> close-icon bg-danger d-flex justify-content-center" style="z-index: 10; width: 30px; height: 30px; border-radius: 50%; margin-top: 420px; background-color: #e2e3e3; margin-left: -10px; position: absolute">
                    <img src="close-round.png" style="width: 15px; height: 15px; border-radius: 20px; margin-top: 8px; ; filter: invert(1)">
                </div>
            <?php endif; ?>

            <label for="<?= !isset($url) ? 'cpaasIcon-Floating' : '' ?>">
                <div class="col-12 d-flex justify-content-end">
                    <div class="bg-light d-flex justify-content-center" style="width: 65px; height: 65px; border-radius: 50%; margin: 10px; border: 1px solid #c5c5c5; z-index: 10">
                        <img id="cpaasMainFloating-icon" src="<?= $prefsData['cpaas_icon'] ? 'dashboardv2/uploads/mab_mobile/' . $prefsData['cpaas_icon'] : "empty-image.png" ?>" style="width: 45px; height: 45px; border-radius: 20px; margin-top: 9px">
                    </div>
                </div>
            </label>
            <input type="file" accept="image/*" id="cpaasIcon-Floating" class="d-none" onchange="changeCPAASMainIcon('1')">
        </div>

        <div class="row gx-0 fixed-bottom">

            <?php if (!isset($url)) : ?>
                <div class="row gx-0 p-3 pb-0">
                    <div class="col-2 d-flex justify-content-start" style="margin-top: -90px; position: absolute">
                        <div id="addTabFloating" class="bg-success text-center" style="width: 40px; height: 40px; border-radius: 50%; padding-top: 3px" onclick="btnAddBarFloating()"><span style="font-size: 23px; color: white">+</span></div>
                    </div>
                </div>
                <div class="row gx-0 p-3 pt-0" style="margin-bottom: 20px">
                    <div class="col-2 d-flex justify-content-start" style="margin-top: -50px; position: absolute">
                        <div id="deleteTabFloating" class="bg-danger text-center disabled" style="width: 40px; height: 40px; border-radius: 50%; padding-top: 3px; margin-top: 10px" onclick="btnDelBarFloating()"><span style="font-size: 23px; color: white">-</span></div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- 2 DEFAULT TAB -->

            <div id="tab-bar" class="row gx-0" style="width: 100%; height: 45px">
                <div id="tab1Floating" class="col d-flex justify-content-center align-items-center bg-info" onclick="openTabModal('1','1')">

                    <?php
                    if (isset($prefsData['tab1_icon'])) : ?>
                        <img id="tab1Floating-icon" src="/dashboardv2/uploads/mab_mobile/<?= $prefsData['tab1_icon'] ?>" style="width: 30px; height: 30px; border-radius: 5px">
                    <?php else : ?>
                        <img id="tab1Floating-icon" src="empty-image.png" style="width: 30px; height: 30px; border-radius: 5px">
                    <?php endif;
                    ?>

                    <span style="font-size: 14px; position: absolute; margin-top: -70px; font-weight: bold" class="<?= $url ? 'd-none' : '' ?>">TAB 1</span>
                </div>
                <div id="tab2Floating" class="col d-flex justify-content-center align-items-center bg-info" onclick="openTabModal('2','1')">

                    <?php
                    if (isset($prefsData['tab2_icon'])) : ?>
                        <img id="tab2Floating-icon" src="/dashboardv2/uploads/mab_mobile/<?= $prefsData['tab2_icon'] ?>" style="width: 30px; height: 30px; border-radius: 5px">
                    <?php else : ?>
                        <img id="tab2Floating-icon" src="empty-image.png" style="width: 30px; height: 30px; border-radius: 5px">
                    <?php endif;
                    ?>

                    <span style="font-size: 14px; position: absolute; margin-top: -70px; font-weight: bold" class="<?= $url ? 'd-none' : '' ?>">TAB 2</span>
                </div>

                <!-- IF THERE IS MORE THAN 2 TAB ON DATABASE -->

                <?php if (isset($prefsData['tab3_page'])) : ?>

                    <div id="tab3Floating" class="col d-flex justify-content-center align-items-center bg-info" onclick="openTabModal('3','1')">

                        <?php
                        if (isset($prefsData['tab3_icon'])) : ?>
                            <img id="tab3Floating-icon" src="/dashboardv2/uploads/mab_mobile/<?= $prefsData['tab3_icon'] ?>" style="width: 30px; height: 30px; border-radius: 5px">
                        <?php else : ?>
                            <img id="tab3Floating-icon" src="empty-image.png" style="width: 30px; height: 30px; border-radius: 5px">
                        <?php endif;
                        ?>

                        <span style="font-size: 14px; position: absolute; margin-top: -70px; font-weight: bold" class="<?= $url ? 'd-none' : '' ?>">TAB 3</span>

                    </div>

                <?php endif; ?>

                <?php if (isset($prefsData['tab4_page'])) : ?>

                    <div id="tab4Floating" class="col d-flex justify-content-center align-items-center bg-info" onclick="openTabModal('4','1')">

                        <?php
                        if (isset($prefsData['tab4_icon'])) : ?>
                            <img id="tab4Floating-icon" src="/dashboardv2/uploads/mab_mobile/<?= $prefsData['tab4_icon'] ?>" style="width: 30px; height: 30px; border-radius: 5px">
                        <?php else : ?>
                            <img id="tab4Floating-icon" src="empty-image.png" style="width: 30px; height: 30px; border-radius: 5px">
                        <?php endif;
                        ?>

                        <span style="font-size: 14px; position: absolute; margin-top: -70px; font-weight: bold" class="<?= $url ? 'd-none' : '' ?>">TAB 4</span>

                    </div>

                <?php endif; ?>

                <?php if (isset($prefsData['tab5_page'])) : ?>

                    <div id="tab5Floating" class="col d-flex justify-content-center align-items-center bg-info" onclick="openTabModal('5','1')">

                        <?php
                        if (isset($prefsData['tab5_icon'])) : ?>
                            <img id="tab5Floating-icon" src="/dashboardv2/uploads/mab_mobile/<?= $prefsData['tab5_icon'] ?>" style="width: 30px; height: 30px; border-radius: 5px">
                        <?php else : ?>
                            <img id="tab5Floating-icon" src="empty-image.png" style="width: 30px; height: 30px; border-radius: 5px">
                        <?php endif;
                        ?>

                        <span style="font-size: 14px; position: absolute; margin-top: -70px; font-weight: bold" class="<?= $url ? 'd-none' : '' ?>">TAB 5</span>

                    </div>

                <?php endif; ?>

                <?php if (isset($prefsData['tab6_page'])) : ?>

                    <div id="tab6Floating" class="col d-flex justify-content-center align-items-center bg-info" onclick="openTabModal('6','1')">

                        <?php
                        if (isset($prefsData['tab6_icon'])) : ?>
                            <img id="tab6Floating-icon" src="/dashboardv2/uploads/mab_mobile/<?= $prefsData['tab6_icon'] ?>" style="width: 30px; height: 30px; border-radius: 5px">
                        <?php else : ?>
                            <img id="tab6Floating-icon" src="empty-image.png" style="width: 30px; height: 30px; border-radius: 5px">
                        <?php endif;
                        ?>

                        <span style="font-size: 14px; position: absolute; margin-top: -70px; font-weight: bold" class="<?= $url ? 'd-none' : '' ?>">TAB 6</span>

                    </div>

                <?php endif; ?>

            </div>
        </div>
    </section>

    <!-- SECTION DOCKED -->

    <section id="docked-interface">
        <div class="row gx-0 fixed-bottom">
            <div class="row gx-0 p-3" style="margin-bottom: 20px">
                <div class="col-3">

                    <?php if (!isset($url)) : ?>
                        <div id="addTabDocked" class="bg-success text-center" style="width: 40px; height: 40px; border-radius: 50%; padding-top: 3px" onclick="btnAddBarDocked()"><span style="font-size: 23px; color: white">+</span></div>
                    <?php else : ?>
                        <div id="addTabDocked" class="" style="width: 40px; height: 40px; border-radius: 50%; padding-top: 3px" onclick="btnAddBarDocked()"><span style="font-size: 23px; color: white">+</span></div>
                    <?php endif; ?>

                </div>
                <div class="col-6 d-flex justify-content-center">

                    <div id="closeDocked3-icon" onclick="resetCPAASIcon('3','2')" class="close-icon bg-danger d-flex justify-content-center d-none" style="z-index: 10; width: 30px; height: 30px; border-radius: 50%; margin-top: -37px; margin-left: 190px; position: absolute">
                        <img src="close-round.png" style="width: 15px; height: 15px; border-radius: 20px; margin-top: 8px; ; filter: invert(1)">
                    </div>
                    <div class="d-flex justify-content-center" style="width: 50px; height: 50px; border-radius: 50%; margin-top: -14px; margin-left: 114px; border: 1px solid #c5c5c5; position: absolute; background-color: #0dcaf0" onclick="openCPAASModal('3','2')">
                        <img id="cpaasDocked3-icon" class="<?= $prefsData['fb2_icon'] ? '' : 'disabled' ?>" src="<?= $prefsData['fb3_icon'] ? 'dashboardv2/uploads/mab_mobile/' . $prefsData['fb3_icon'] : "empty-image.png" ?>" style="width: 30px; height: 30px; border-radius: 20px; margin-top: 10px">
                    </div>

                    <div id="closeDocked2-icon" onclick="resetCPAASIcon('2','2')" class="close-icon bg-danger d-flex justify-content-center d-none" style="z-index: 10; width: 30px; height: 30px; border-radius: 50%; margin-top: -37px; margin-left: -190px; position: absolute">
                        <img src="close-round.png" style="width: 15px; height: 15px; border-radius: 20px; margin-top: 8px; ; filter: invert(1)">
                    </div>
                    <div class="d-flex justify-content-center" style="width: 50px; height: 50px; border-radius: 50%; margin-top: -14px; margin-left: -114px; border: 1px solid #c5c5c5; position: absolute; background-color: #0dcaf0" onclick="openCPAASModal('2','2')">
                        <img id="cpaasDocked2-icon" class="<?= $prefsData['fb1_icon'] ? '' : 'disabled' ?>" src="<?= $prefsData['fb2_icon'] ? 'dashboardv2/uploads/mab_mobile/' . $prefsData['fb2_icon'] : "empty-image.png" ?>" style="width: 30px; height: 30px; border-radius: 20px; margin-top: 10px">
                    </div>

                    <div id="closeDocked5-icon" onclick="resetCPAASIcon('5','2')" class="close-icon bg-danger d-flex justify-content-center d-none" style="z-index: 10; width: 30px; height: 30px; border-radius: 50%; margin-top: 17px; margin-left: 250px; position: absolute">
                        <img src="close-round.png" style="width: 15px; height: 15px; border-radius: 20px; margin-top: 8px; ; filter: invert(1)">
                    </div>
                    <div class="d-flex justify-content-center" style="width: 50px; height: 50px; border-radius: 50%; margin-top: 40px; margin-left: 175px; border: 1px solid #c5c5c5; position: absolute; background-color: #0dcaf0" onclick="openCPAASModal('5','2')">
                        <img id="cpaasDocked5-icon" class="<?= $prefsData['fb4_icon'] ? '' : 'disabled' ?>" src="<?= $prefsData['fb5_icon'] ? 'dashboardv2/uploads/mab_mobile/' . $prefsData['fb5_icon'] : "empty-image.png" ?>" style="width: 30px; height: 30px; border-radius: 20px; margin-top: 10px">
                    </div>

                    <div id="closeDocked4-icon" onclick="resetCPAASIcon('4','2')" class="close-icon bg-danger d-flex justify-content-center d-none" style="z-index: 10; width: 30px; height: 30px; border-radius: 50%; margin-top: 17px; margin-left: -250px; position: absolute">
                        <img src="close-round.png" style="width: 15px; height: 15px; border-radius: 20px; margin-top: 8px; ; filter: invert(1)">
                    </div>
                    <div class="d-flex justify-content-center" style="width: 50px; height: 50px; border-radius: 50%; margin-top: 40px; margin-left: -175px; border: 1px solid #c5c5c5; position: absolute; background-color: #0dcaf0" onclick="openCPAASModal('4','2')">
                        <img id="cpaasDocked4-icon" class="<?= $prefsData['fb3_icon'] ? '' : 'disabled' ?>" src="<?= $prefsData['fb4_icon'] ? 'dashboardv2/uploads/mab_mobile/' . $prefsData['fb4_icon'] : "empty-image.png" ?>" style="width: 30px; height: 30px; border-radius: 20px; margin-top: 10px">
                    </div>

                    <?php if (!isset($url)) : ?>
                        <div id="closeDockedMain-icon" onclick="resetCPAASIcon('0','2')" class="close-icon bg-danger d-flex justify-content-center <?= $prefsData['cpaas_icon'] ? '' : 'd-none' ?>" style="z-index: 10; width: 30px; height: 30px; border-radius: 50%; margin-top: 40px; margin-left: -3px; position: absolute">
                            <img src="close-round.png" style="width: 15px; height: 15px; border-radius: 20px; margin-top: 8px; ; filter: invert(1)">
                        </div>
                    <?php endif; ?>

                    <label for="<?= !isset($url) ? 'cpaasIcon-Docked' : '' ?>">
                        <div class="bg-light d-flex justify-content-center" style="z-index: 10; width: 65px; height: 65px; border-radius: 50%; margin-top: 79px; border: 1px solid #c5c5c5; position: absolute; margin-left: -32px">
                            <img id="cpaasMainDocked-icon" src="<?= $prefsData['cpaas_icon'] ? 'dashboardv2/uploads/mab_mobile/' . $prefsData['cpaas_icon'] : "empty-image.png" ?>" style="width: 45px; height: 45px; border-radius: 20px; margin-top: 9px">
                        </div>
                    </label>

                    <input type="file" accept="image/*" id="cpaasIcon-Docked" class="d-none" onchange="changeCPAASMainIcon('2')">

                    <div class="d-flex justify-content-center" style="width: 50px; height: 50px; border-radius: 50%; margin-top: -41px; border: 1px solid #c5c5c5; position: absolute; background-color: #0dcaf0" onclick="openCPAASModal('1','2')">
                        <img id="cpaasDocked1-icon" src="<?= $prefsData['fb1_icon'] ? 'dashboardv2/uploads/mab_mobile/' . $prefsData['fb1_icon'] : "empty-image.png" ?>" style="width: 30px; height: 30px; border-radius: 20px; margin-top: 10px">
                    </div>
                    <div id="closeDocked1-icon" onclick="resetCPAASIcon('1','2')" class="close-icon bg-danger d-flex justify-content-center d-none" style="z-index: 10; width: 30px; height: 30px; border-radius: 50%; margin-top: -80px; position: absolute">
                        <img src="close-round.png" style="width: 15px; height: 15px; border-radius: 20px; margin-top: 8px; ; filter: invert(1)">
                    </div>

                </div>
                <div class="col-3 d-flex justify-content-end"></div>
                <div class="col-3">

                    <?php if (!isset($url)) : ?>
                        <div id="deleteTabDocked" class="disabled bg-danger text-center" style="width: 40px; height: 40px; border-radius: 50%; padding-top: 3px; margin-top: 10px" onclick="btnDelBarDocked()"><span style="font-size: 23px; color: white">-</span></div>
                    <?php else : ?>
                        <div id="deleteTabDocked" class="disabled" style="width: 40px; height: 40px; border-radius: 50%; padding-top: 3px; margin-top: 10px" onclick="btnDelBarDocked()"><span style="font-size: 23px; color: white">-</span></div>
                    <?php endif; ?>

                </div>
                <div class="col-9 d-flex justify-content-end"></div>
            </div>

            <!-- 2 DEFAULT TAB -->

            <div id="tab-barDocked" class="row gx-0" style="width: 100%; height: 45px">
                <div id="tab1Docked" class="col d-flex justify-content-center align-items-center" style="background-color: #0dcaf0" onclick="openTabModal('1','2')">

                    <?php
                    if (isset($prefsData['tab1_icon'])) : ?>
                        <img id="tab1Docked-icon" src="dashboardv2/uploads/mab_mobile/<?= $prefsData['tab1_icon'] ?>" style="width: 30px; height: 30px; border-radius: 5px">
                    <?php else : ?>
                        <img id="tab1Docked-icon" src="empty-image.png" style="width: 30px; height: 30px; border-radius: 5px">
                    <?php endif;
                    ?>

                    <span id="tab1-docked-text" style="font-size: 14px; position: absolute; margin-top: -70px; font-weight: bold" class="<?= $url ? 'd-none' : '' ?>">TAB 1</span>
                </div>
                <div id="tab2Docked" class="col d-flex justify-content-center align-items-center" style="background-color: #0dcaf0" onclick="openTabModal('2','2')">

                    <?php
                    if (isset($prefsData['tab2_icon'])) : ?>
                        <img id="tab2Docked-icon" src="dashboardv2/uploads/mab_mobile/<?= $prefsData['tab2_icon'] ?>" style="width: 30px; height: 30px; border-radius: 5px">
                    <?php else : ?>
                        <img id="tab2Docked-icon" src="empty-image.png" style="width: 30px; height: 30px; border-radius: 5px">
                    <?php endif;
                    ?>

                    <span id="tab2-docked-text" style="font-size: 14px; position: absolute; margin-top: -70px; font-weight: bold" class="<?= $url ? 'd-none' : '' ?>">TAB 2</span>
                </div>

                <!-- IF THERE IS MORE THAN 2 TAB ON DATABASE -->

                <?php if (isset($prefsData['tab3_page'])) : ?>

                    <div id="tab3Docked" class="col d-flex justify-content-center align-items-center" style="background-color: #0dcaf0" onclick="openTabModal('3','2')">

                        <?php
                        if (isset($prefsData['tab3_icon'])) : ?>
                            <img id="tab3Docked-icon" src="dashboardv2/uploads/mab_mobile/<?= $prefsData['tab3_icon'] ?>" style="width: 30px; height: 30px; border-radius: 5px">
                        <?php else : ?>
                            <img id="tab3Docked-icon" src="empty-image.png" style="width: 30px; height: 30px; border-radius: 5px">
                        <?php endif;
                        ?>

                        <span id="tab3-docked-text" style="font-size: 14px; position: absolute; margin-top: -70px; font-weight: bold" class="<?= $url ? 'd-none' : '' ?>">TAB 3</span>

                    </div>

                <?php endif; ?>

                <?php if (isset($prefsData['tab4_page'])) : ?>

                    <div id="tab4Docked" class="col d-flex justify-content-center align-items-center" style="background-color: #0dcaf0" onclick="openTabModal('4','2')">

                        <?php
                        if (isset($prefsData['tab4_icon'])) : ?>
                            <img id="tab4Docked-icon" src="dashboardv2/uploads/mab_mobile/<?= $prefsData['tab4_icon'] ?>" style="width: 30px; height: 30px; border-radius: 5px">
                        <?php else : ?>
                            <img id="tab4Docked-icon" src="empty-image.png" style="width: 30px; height: 30px; border-radius: 5px">
                        <?php endif;
                        ?>

                        <span id="tab4-docked-text" style="font-size: 14px; position: absolute; margin-top: -70px; font-weight: bold" class="<?= $url ? 'd-none' : '' ?>">TAB 4</span>

                    </div>

                <?php endif; ?>

                <?php if (isset($prefsData['tab5_page'])) : ?>

                    <div id="tab5Docked" class="col d-flex justify-content-center align-items-center" style="background-color: #0dcaf0" onclick="openTabModal('5','2')">

                        <?php
                        if (isset($prefsData['tab5_icon'])) : ?>
                            <img id="tab5Docked-icon" src="dashboardv2/uploads/mab_mobile/<?= $prefsData['tab5_icon'] ?>" style="width: 30px; height: 30px; border-radius: 5px">
                        <?php else : ?>
                            <img id="tab5Docked-icon" src="empty-image.png" style="width: 30px; height: 30px; border-radius: 5px">
                        <?php endif;
                        ?>

                        <span id="tab5-docked-text" style="font-size: 14px; position: absolute; margin-top: -70px; font-weight: bold" class="<?= $url ? 'd-none' : '' ?>">TAB 5</span>

                    </div>

                <?php endif; ?>

                <?php if (isset($prefsData['tab6_page'])) : ?>

                    <div id="tab6Docked" class="col d-flex justify-content-center align-items-center" style="background-color: #0dcaf0" onclick="openTabModal('6','2')">

                        <?php
                        if (isset($prefsData['tab6_icon'])) : ?>
                            <img id="tab6Docked-icon" src="dashboardv2/uploads/mab_mobile/<?= $prefsData['tab6_icon'] ?>" style="width: 30px; height: 30px; border-radius: 5px">
                        <?php else : ?>
                            <img id="tab6Docked-icon" src="empty-image.png" style="width: 30px; height: 30px; border-radius: 5px">
                        <?php endif;
                        ?>

                        <span id="tab6-docked-text" style="font-size: 14px; position: absolute; margin-top: -70px; font-weight: bold" class="<?= $url ? 'd-none' : '' ?>">TAB 6</span>

                    </div>

                <?php endif; ?>

            </div>
        </div>
    </section>

    <!-- SECTION BURGER -->

    <?php if (isset($prefsData['fb1_content'])) : ?>

    <?php endif; ?>

    <section id="hamburger-interface" style="margin-top: -114px">
        <div class="row gx-0">
            <div class="col-7 d-flex justify-content-end p-2">
                <div id="closeBurger1-icon" onclick="resetCPAASIcon('1','3')" class="close-icon bg-danger d-flex justify-content-center d-none" style="z-index: 10; width: 30px; height: 30px; border-radius: 50%; position: absolute">
                    <img src="close-round.png" style="width: 15px; height: 15px; border-radius: 20px; margin-top: 8px; ; filter: invert(1)">
                </div>
            </div>
            <div class="col-5 d-flex justify-content-center p-2" style="z-index: 10; background-color: #0dcaf0; border-radius: 10px 0px 0px 10px" onclick="openModalBurger('1','3')">
                <span id="burger-content-1" class="text-dark" style="font-size: 13px"><?= $prefsData['fb1_content'] ? translateBurger($prefsData['fb1_content']) : "+" ?></span>
            </div>
        </div>
        <div class="row gx-0">
            <div class="col-7 d-flex justify-content-end p-2">
                <div id="closeBurger2-icon" onclick="resetCPAASIcon('2','3')" class="close-icon bg-danger d-flex justify-content-center d-none" style="z-index: 10; width: 30px; height: 30px; border-radius: 50%; position: absolute">
                    <img src="close-round.png" style="width: 15px; height: 15px; border-radius: 20px; margin-top: 8px; ; filter: invert(1)">
                </div>
            </div>
            <div class="col-5 d-flex justify-content-center p-2" style="z-index: 10; background-color: #0dcaf0; border-radius: 10px 0px 0px 10px" onclick="openModalBurger('2','3')">
                <span id="burger-content-2" class="text-dark <?= $prefsData['fb1_content'] ? '' : 'disabled' ?>" style="font-size: 13px"><?= $prefsData['fb2_content'] ? translateBurger($prefsData['fb2_content']) : "+" ?></span>
            </div>
        </div>
        <div class="row gx-0">
            <div class="col-7 d-flex justify-content-end p-2">
                <div id="closeBurger3-icon" onclick="resetCPAASIcon('3','3')" class="close-icon bg-danger d-flex justify-content-center d-none" style="z-index: 10; width: 30px; height: 30px; border-radius: 50%; position: absolute">
                    <img src="close-round.png" style="width: 15px; height: 15px; border-radius: 20px; margin-top: 8px; ; filter: invert(1)">
                </div>
            </div>
            <div class="col-5 d-flex justify-content-center p-2" style="z-index: 10; background-color: #0dcaf0; border-radius: 10px 0px 0px 10px" onclick="openModalBurger('3','3')">
                <span id="burger-content-3" class="text-dark <?= $prefsData['fb2_content'] ? '' : 'disabled' ?>" style="font-size: 13px"><?= $prefsData['fb3_content'] ? translateBurger($prefsData['fb3_content']) : "+" ?></span>
            </div>
        </div>
        <div class="row gx-0">
            <div class="col-7 d-flex justify-content-end p-2">
                <div id="closeBurger4-icon" onclick="resetCPAASIcon('4','3')" class="close-icon bg-danger d-flex justify-content-center d-none" style="z-index: 10; width: 30px; height: 30px; border-radius: 50%; position: absolute">
                    <img src="close-round.png" style="width: 15px; height: 15px; border-radius: 20px; margin-top: 8px; ; filter: invert(1)">
                </div>
            </div>
            <div class="col-5 d-flex justify-content-center p-2" style="z-index: 10; background-color: #0dcaf0; border-radius: 10px 0px 0px 10px" onclick="openModalBurger('4','3')">
                <span id="burger-content-4" class="text-dark <?= $prefsData['fb3_content'] ? '' : 'disabled' ?>" style="font-size: 13px"><?= $prefsData['fb4_content'] ? translateBurger($prefsData['fb4_content']) : "+" ?></span>
            </div>
        </div>
        <div class="row gx-0">
            <div class="col-7"></div>
            <div class="col-5 d-flex justify-content-center p-2" style="z-index: 10; background-color: #ff9b35; border-radius: 10px 0px 0px 10px" onclick="openCPAASMoreBurger()">
                <span id="btnAddMore2" class="text-dark <?= $prefsData['fb4_content'] ? '' : 'disabled' ?>"><span style="font-size: 13px">Add more</span></span>
            </div>
        </div>

        <div class="row gx-0 fixed-bottom">

            <?php if (!isset($url)) : ?>

                <div class="row gx-0 p-3" style="margin-bottom: 20px">

                    <div class="col-6 d-flex justify-content-start">
                        <div id="addTabBurger" class="bg-success text-center" style="width: 40px; height: 40px; border-radius: 50%; padding-top: 3px" onclick="btnAddBarBurger()"><span style="font-size: 23px; color: white">+</span></div>
                    </div>
                    <div class="col-6"></div>

                    <div class="col-6 d-flex justify-content-start">
                        <div id="deleteTabBurger" class="bg-danger text-center disabled" style="width: 40px; height: 40px; border-radius: 50%; padding-top: 3px; margin-top: 10px" onclick="btnDelBarBurger()"><span style="font-size: 23px; color: white">-</span></div>
                    </div>
                    <div class="col-6"></div>

                </div>

            <?php endif; ?>

            <!-- 2 DEFAULT TAB -->

            <div id="tab-barBurger" class="row gx-0" style="width: 100%; height: 45px">
                <div id="tab1Burger" class="col d-flex justify-content-center align-items-center text-white" onclick="openTabModal('1','3')" style="background-color: #0dcaf0">

                    <?php
                    if (isset($prefsData['tab1_icon'])) : ?>
                        <img id="tab1Burger-icon" src="dashboardv2/uploads/mab_mobile/<?= $prefsData['tab1_icon'] ?>" style="width: 30px; height: 30px; border-radius: 5px">
                    <?php else : ?>
                        <img id="tab1Burger-icon" src="empty-image.png" style="width: 30px; height: 30px; border-radius: 5px">
                    <?php endif;
                    ?>

                    <span style="font-size: 14px; position: absolute; margin-top: -70px; font-weight: bold; color: black" class="<?= $url ? 'd-none' : '' ?>">TAB 1</span>
                </div>
                <div id="tab2Burger" class="col d-flex justify-content-center align-items-center text-white" onclick="openTabModal('2','3')" style="background-color: #0dcaf0">

                    <?php
                    if (isset($prefsData['tab2_icon'])) : ?>
                        <img id="tab2Burger-icon" src="dashboardv2/uploads/mab_mobile/<?= $prefsData['tab2_icon'] ?>" style="width: 30px; height: 30px; border-radius: 5px">
                    <?php else : ?>
                        <img id="tab2Burger-icon" src="empty-image.png" style="width: 30px; height: 30px; border-radius: 5px">
                    <?php endif;
                    ?>

                    <span style="font-size: 14px; position: absolute; margin-top: -70px; font-weight: bold; color: black" class="<?= $url ? 'd-none' : '' ?>">TAB 2</span>
                </div>

                <!-- IF THERE IS MORE THAN 2 TAB ON DATABASE -->

                <?php if (isset($prefsData['tab3_page'])) : ?>

                    <div id="tab3Burger" class="col d-flex justify-content-center align-items-center text-info" onclick="openTabModal('3','3')" style="background-color: #0dcaf0">

                        <?php
                        if (isset($prefsData['tab3_icon'])) : ?>
                            <img id="tab3Burger-icon" src="dashboardv2/uploads/mab_mobile/<?= $prefsData['tab3_icon'] ?>" style="width: 30px; height: 30px; border-radius: 5px">
                        <?php else : ?>
                            <img id="tab3Burger-icon" src="empty-image.png" style="width: 30px; height: 30px; border-radius: 5px">
                        <?php endif;
                        ?>

                        <span style="font-size: 14px; position: absolute; margin-top: -70px; font-weight: bold; color: black" class="<?= $url ? 'd-none' : '' ?>">TAB 3</span>

                    </div>

                <?php endif; ?>

                <?php if (isset($prefsData['tab4_page'])) : ?>

                    <div id="tab4Burger" class="col d-flex justify-content-center align-items-center text-info" onclick="openTabModal('4','3')" style="background-color: #0dcaf0">

                        <?php
                        if (isset($prefsData['tab4_icon'])) : ?>
                            <img id="tab4Burger-icon" src="dashboardv2/uploads/mab_mobile/<?= $prefsData['tab4_icon'] ?>" style="width: 30px; height: 30px; border-radius: 5px">
                        <?php else : ?>
                            <img id="tab4Burger-icon" src="empty-image.png" style="width: 30px; height: 30px; border-radius: 5px">
                        <?php endif;
                        ?>

                        <span style="font-size: 14px; position: absolute; margin-top: -70px; font-weight: bold; color: black" class="<?= $url ? 'd-none' : '' ?>">TAB 4</span>

                    </div>

                <?php endif; ?>

                <?php if (isset($prefsData['tab5_page'])) : ?>

                    <div id="tab5Burger" class="col d-flex justify-content-center align-items-center text-info" onclick="openTabModal('5','3')" style="background-color: #0dcaf0">

                        <?php
                        if (isset($prefsData['tab5_icon'])) : ?>
                            <img id="tab5Burger-icon" src="dashboardv2/uploads/mab_mobile/<?= $prefsData['tab5_icon'] ?>" style="width: 30px; height: 30px; border-radius: 5px">
                        <?php else : ?>
                            <img id="tab5Burger-icon" src="empty-image.png" style="width: 30px; height: 30px; border-radius: 5px">
                        <?php endif;
                        ?>

                        <span style="font-size: 14px; position: absolute; margin-top: -70px; font-weight: bold; color: black" class="<?= $url ? 'd-none' : '' ?>">TAB 5</span>

                    </div>

                <?php endif; ?>

                <?php if (isset($prefsData['tab6_page'])) : ?>

                    <div id="tab6Burger" class="col d-flex justify-content-center align-items-center text-info" onclick="openTabModal('6','3')" style="background-color: #0dcaf0">

                        <?php
                        if (isset($prefsData['tab6_icon'])) : ?>
                            <img id="tab6Burger-icon" src="dashboardv2/uploads/mab_mobile/<?= $prefsData['tab6_icon'] ?>" style="width: 30px; height: 30px; border-radius: 5px">
                        <?php else : ?>
                            <img id="tab6Burger-icon" src="empty-image.png" style="width: 30px; height: 30px; border-radius: 5px">
                        <?php endif;
                        ?>

                        <span style="font-size: 14px; position: absolute; margin-top: -70px; font-weight: bold; color: black" class="<?= $url ? 'd-none' : '' ?>">TAB 6</span>

                    </div>

                <?php endif; ?>

            </div>
        </div>
    </section>

    <div id="btnSaveDiv" class="row fixed-bottom <?= isset($url) ? 'd-none' : '' ?>" style="margin-bottom: 220px; z-index: 9 !important">
        <div class="col-12 d-flex justify-content-center">
            <button id="submit-button" class="btn btn-success shadow d-none" onclick="openSaveProject()"><b>Save</b> and <b>Share</b> <i class="fa fa-paper-plane" style="margin-left: 5px" aria-hidden="true"></i></button>
        </div>
    </div>

    <div id="background-preview" class="row d-flex justify-content-center fixed-bottom <?= isset($url) ? '' : 'd-none' ?>" style="margin-bottom: 280px; z-index: 0">

        <?php if (isset($url) && isset($prefsData['app_builder_background'])) :

            $background = explode(',', $prefsData['app_builder_background']);

            foreach ($background as $index => $bg) { ?>

                <div id="bg-preview-<?= $index ?>" class="col-auto px-2">

                    <?php if (!isset($url)) : ?>
                        <div style="width: 20px; height: 20px; font-size: 12px; padding-left: 6px; position: absolute; margin-top: -3px; margin-left: -5px; color: white; border-radius: 20px; background-color: #dc3545; padding-top: 1px">X</div>
                    <?php endif; ?>

                    <img src="dashboardv2/uploads/mab_mobile/<?= $bg ?>" style="width: 55px; height: 120px; border-radius: 5px; object-fit: cover; border: 1px dashed grey">
                </div>

            <?php } ?>

        <?php else : ?>

            <!-- FILL IN JS -->

        <?php endif; ?>

    </div>

    <?php

    if (isset($url) && $is_iframe == 0) : ?>

        <div id="btnApplyConfig" class="row fixed-bottom" style="margin-bottom: 200px">
            <div class="col-12 d-flex justify-content-center">
                <a href="https://newuniverse.io/nexilis/logics/fetch_ui_config?id=<?= $be ?>&url=<?= $url ?>"><button id="apply-theme-text" class="btn shadow" style="background-color: #ff8100; color: white"><b>Apply</b> This Theme <i class="fa fa-check" style="margin-left: 5px" aria-hidden="true"></i></button></a>
            </div>
        </div>

    <?php endif; ?>

    <!-- MODAL CONFIGURE BAR -->

    <div id="modalTabConfigure" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div id="modalTabConfigure-content" class="modal-content">
                <!-- Fill in JS -->
            </div>
        </div>
    </div>

    <!-- MODAL CHOOSE FONT -->

    <div id="modalFont" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Choose Font</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <select id="fonts" class="form-select form-select-sm mb-2 mt-2">
                        <option selected value="">Select your fonts</option>
                        <option <?= $prefsData['app_font'] == "1" ? " selected" : "" ?> value="1">Poppins</option>
                        <option value="2">Roboto</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" onclick="changeFont()">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL FEATURE LIST -->

    <div id="modalFeatureList" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Feature List</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="feature-sms" <?= $prefsData['enable_sms'] ? "checked" : "" ?>>
                        <label class="form-check-label" for="feature-sms">
                            SMS
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="feature-osint" <?= $prefsData['enable_osint'] ? "checked" : "" ?>>
                        <label class="form-check-label" for="feature-osint">
                            OSINT Search
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="feature-scan" <?= $prefsData['enable_scan'] ? "checked" : "" ?>>
                        <label class="form-check-label" for="feature-scan">
                            ID Scan
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="feature-email" <?= $prefsData['enable_mail'] ? "checked" : "" ?>>
                        <label class="form-check-label" for="feature-email">
                            Email
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" onclick="changeFeature()">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL CPAAS -->

    <div id="modalCPAAS" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div id="modalCPAAS-content" class="modal-body">
                    <!-- Fill In JS -->
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL Error -->

    <div id="modalError" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div id="modalError-body" class="modal-body">
                    <!-- Fill In JS -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalLoading" tabindex="-1" role="dialog" aria-labelledby="modalLoading" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-0 text-center pb-3" id="modalLoading">
                    <img src="dashboardv2/assets/loading_build.gif" style="width: 75%"><br />
                    <p><b>Submitting data in progress</b></p>
                    <p>Please wait...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL BURGER -->

    <div id="modalTabBurger" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div id="modalTabBurger-content" class="modal-content">
                <!-- Fill in JS -->
            </div>
        </div>
    </div>

    <div id="modalURL" class="modal fade" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div id="modalURL-content" class="modal-body">
                    <!-- Fill In JS -->
                </div>
            </div>
        </div>
    </div>

    <div id="modalProjectName" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div id="modalProjectName-content" class="modal-body">
                    <p id="rename-config-text">Rename your configuration :</p>
                    <input type="text" class="form-control" id="projectName" placeholder="Example : Theme 1">
                    <small id="configuration-name" class="text-danger">Please fill this configuration name.</small>
                    <button id="btn-save" class="btn btn-success w-100 mt-3" onclick="saveAllConfiguration()"><b>Save</b></button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://kit.fontawesome.com/06e606701b.js" crossorigin="anonymous"></script>

<script>
    // OBJECT FOR SEND TO BACKEND

    // IF ISSET LOAD DATA FROM DATABASE

    let mobileConfiguration = new Map();
    let keyFromDB = "";
    var global_url_load;
    var F_PIN = '';
    F_PIN = '<?= $f_pin ?>';
    var global_tab1_url = '';
    var global_tab3_url = '';

    <?php if (isset($prefsData)) :

        foreach (array_keys($prefsData) as $pd) :  ?>

            // CHECKING IF FROM DB IS ICON, SET /dashboard IN SRC

            keyFromDB = '<?= $pd ?>';

            if (keyFromDB.includes('icon')) {

                mobileConfiguration.set('<?= $pd ?>', 'dashboardv2/uploads/mab_mobile/<?= $prefsData[$pd] ?>');

            } else {

                mobileConfiguration.set('<?= $pd ?>', '<?= $prefsData[$pd] ?>');

            }


    <?php endforeach;

    endif; ?>

    // CHECK IF THERE IS FB CUSTOM URL, IF EXIST ADD TO ARRAY

    let urlContent = '';
    let urlContentSplit = '';

    if (mobileConfiguration.has('app_builder_button_url')) {

        urlContent = mobileConfiguration.get('app_builder_button_url');
        urlContentSplit = urlContent.split(",");

    }

    // FILL FB URL TO MOBILE CONFIGURATION (FB1_URL)

    for (var i = 0; i < urlContentSplit.length; i++) {

        var index = urlContentSplit[i].split("|")[0];
        var url = urlContentSplit[i].split("|")[1];

        mobileConfiguration.set('fb' + (parseInt(index) + 1) + '_url', url);

        // var url = urlContentSplit[i];
        // var underscore_url = url.split("_")[2];

        // mobileConfiguration.set('fb'+(parseInt(index)+1)+'_url',url);

    }

    // TEMP OBJECT FOR IMAGE (BASE_64) PREVIEW IN DEVICE

    let mapTemp = new Map();

    // SET SECTION WHILE FIRST OPEN (DEFAULT FLOATING)

    <?php if ($prefsData['access_model'] == 1) : ?>

        $("#floating-interface").addClass("d-none");
        $("#docked-interface").removeClass("d-none");
        $("#hamburger-interface").addClass("d-none");
        $('body').removeClass('d-none');

        $("#floatingBut").css("background-color", "#efefef");
        $("#dockedBut").css("background-color", "#ff9b35");
        $("#hamburgerBut").css("background-color", "#efefef");

        setX('2');
        mobileConfiguration.set('access_model', '1');


    <?php elseif ($prefsData['access_model'] == 2) : ?>

        $("#floating-interface").addClass("d-none");
        $("#docked-interface").addClass("d-none");
        $("#hamburger-interface").removeClass("d-none");
        $('body').removeClass('d-none');

        $("#floatingBut").css("background-color", "#efefef");
        $("#dockedBut").css("background-color", "#efefef");
        $("#hamburgerBut").css("background-color", "#ff9b35");

        setX('3');
        mobileConfiguration.set('access_model', '2');

    <?php else : ?>

        $("#floating-interface").removeClass("d-none");
        $("#docked-interface").addClass("d-none");
        $("#hamburger-interface").addClass("d-none");
        $('body').removeClass('d-none');

        setX('1');
        mobileConfiguration.set('access_model', '0');

    <?php endif; ?>

    // TOTAL EXISTING FIRST LAUNCH TAB

    let tabFloatingBar = 2;
    let tabDockedBar = 1;
    let tabBurgerBar = 2;
    let backgroundArray = [];

    // IF ALREADY SUBMIT TAB BEFORE GET DATA

    <?php if (isset($prefsData['tab3_page'])) : ?>

        tabFloatingBar += 1;
        tabBurgerBar += 1;

    <?php endif; ?>

    <?php if (isset($prefsData['tab4_page'])) : ?>

        tabFloatingBar += 1;
        tabBurgerBar += 1;
        tabDockedBar += 2;

    <?php endif; ?>

    <?php if (isset($prefsData['tab5_page'])) : ?>

        tabFloatingBar += 1;
        tabBurgerBar += 1;

    <?php endif; ?>

    <?php if (isset($prefsData['tab6_page'])) : ?>

        tabFloatingBar += 1;
        tabBurgerBar += 1;
        tabDockedBar += 2;

    <?php endif; ?>

    // ADD TAB FLOATING

    function btnAddBarFloating() {

        if (cannotChange() == 1) {
            return;
        }

        if (tabFloatingBar < 6) {

            tabFloatingBar = tabFloatingBar + 1;
            console.log(tabFloatingBar);

            let html = `<div id="tab` + tabFloatingBar + `Floating" class="col d-flex justify-content-center align-items-center bg-info" onclick="openTabModal('` + tabFloatingBar + `','1')">
                            <img id="tab` + tabFloatingBar + `Floating-icon" src="empty-image.png" style="width: 30px; height: 30px; border-radius: 20px">
                            <span style="font-size: 14px; position: absolute; margin-top: -70px; font-weight: bold">TAB ` + tabFloatingBar + `</span>                
                        </div>`;

            $('#tab-bar').append(html);

        } else {

            let textDesc = '';

            if (localStorage.lang == 1) {
                textDesc = 'Tidak dapat menambahkan tab (Maksimal 6)';
            } else {
                textDesc = 'Can`t Add More Tab! (Maximum 6)';
            }

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: textDesc,
            })

        }

        $('#deleteTabFloating').removeClass('disabled');

        if (tabFloatingBar > 5) {

            $('#addTabFloating').addClass('disabled');

        }

    }

    // DELETE TAB FLOATING

    function btnDelBarFloating() {

        if (cannotChange() == 1) {
            return;
        }

        if (tabFloatingBar > 2) {

            if (tabFloatingBar == 3) {
                mobileConfiguration.delete('tab3_page');
                mobileConfiguration.delete('tab3_icon');
            } else if (tabFloatingBar == 4) {
                mobileConfiguration.delete('tab4_page');
                mobileConfiguration.delete('tab4_icon');
            } else if (tabFloatingBar == 5) {
                mobileConfiguration.delete('tab5_page');
                mobileConfiguration.delete('tab5_icon');
            } else if (tabFloatingBar == 6) {
                mobileConfiguration.delete('tab6_page');
                mobileConfiguration.delete('tab6_icon');
            }

            tabFloatingBar = tabFloatingBar - 1;
            console.log(tabFloatingBar);

            $('#tab' + (tabFloatingBar + 1) + 'Floating').remove();

        } else {

            let textDesc = '';

            if (localStorage.lang == 1) {
                textDesc = 'Tidak dapat menghapus tab (Minimal 2)';
            } else {
                textDesc = 'Can`t Delete More Tab! (Minimum 2)';
            }

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: textDesc,
            })

        }

        $('#addTabFloating').removeClass('disabled');

        if (tabFloatingBar < 3) {

            $('#deleteTabFloating').addClass('disabled');

        }

    }

    // OPEN MODAL TAB CONFIGURATION

    function openTabModal(tab, model) {

        if (cannotChange() == 1) {
            return;
        }

        let html = '';

        html = `<div class="modal-header">`;

        if (localStorage.lang == 1) {
            html += `<h6 class="modal-title">Konfigurasi Tab ` + tab + `</h6>`;
        } else {
            html += `<h6 class="modal-title">Configure Tab ` + tab + `</h6>`;
        }

        html += `<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-12 text-center">`;

        if (localStorage.lang == 1) {
            html += `<p style="margin-bottom:3px">Ikon Tab ` + tab + ` <span style="color: red">*</span></p>`;
        } else {
            html += `<p style="margin-bottom:3px">Tab ` + tab + ` Icon<span style="color: red">*</span></p>`;
        }

        html += `<label for="tabIcon-` + tab + `">
                                <img id="tabIconPreview-` + tab + `" src="${ mobileConfiguration.get('tab'+tab+'_icon') ? mobileConfiguration.get('tab'+tab+'_icon') : 'empty-image.png'}" style="width: 100px; height: 100px; object-fit: cover; object-position: center; border-radius: 20px; border: 1px solid #ced4da">
                            </label>
                            <input id="tabIcon-` + tab + `" type="file" accept="image/*" onchange="changeTabIcon('` + tab + `')" class="d-none">                                
                        </div>
                    </div>`;

        if (localStorage.lang == 1) {
            html += `<small>Konten Tab ` + tab + ` <span style="color: red">*</span></small>`;
        } else {
            html += `<small>Tab ` + tab + ` Content <span style="color: red">*</span></small>`;
        }

        html += `<select id="tabContent-` + tab + `" class="form-select form-select-sm mb-2 mt-2" onchange="checkOption('` + tab + `')" onfocus="saveOldTabValue('` + tab + `')">`;

        if (localStorage.lang == 1) {
            html += `<option value="0">Pilih opsi anda</option>`;
        } else {
            html += `<option value="0">Select your option</option>`;
        }

        html += `<option ${mobileConfiguration.get('tab'+tab+'_page') == "1" ? "selected" : ""} value="1">Homepage</option>
                        <option ${mobileConfiguration.get('tab'+tab+'_page') == "2" ? "selected" : ""} value="2">Chats & Group</option>
                        <option ${mobileConfiguration.get('tab'+tab+'_page') == "3" ? "selected" : ""} value="3">Content Posting</option>
                        <option ${mobileConfiguration.get('tab'+tab+'_page') == "4" ? "selected" : ""} value="4">Settings & User Profile</option>
                        <option ${mobileConfiguration.get('tab'+tab+'_page') == "5" ? "selected" : ""} value="5">Secure Folder</option>
                        <option ${mobileConfiguration.get('tab'+tab+'_page') == "6" ? "selected" : ""} value="6">Call Log</option>
                    </select>
                    <div id="subContent-` + tab + `">`;

        // IF ALREADY SELECT SUB CONTENT BEFORE

        if (mobileConfiguration.get('tab' + tab + '_page') == "1" && mobileConfiguration.has('url_default_content')) {

            if (localStorage.lang == 1) {
                html += `<small>Konten : <span style="color: red">*</span></small>`;
            } else {
                html += `<small>Content : <span style="color: red">*</span></small>`;
            }

            html += `<div class="form-check mt-1">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" ${mobileConfiguration.get('url_default_content') == 0 ? 'checked' : ''} id="flexRadioDefault1" onclick="fillRadio(0,1)">
                                    <label class="form-check-label" for="flexRadioDefault1"> 
                                    <small>Timeline Content</small>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" ${mobileConfiguration.get('url_default_content') == 1 ? 'checked' : ''} id="flexRadioDefault2" onclick="fillRadio(1,1)">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                    <small>Grid Content</small>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" ${mobileConfiguration.get('url_default_content') == 2 ? 'checked' : ''} id="flexRadioDefault3" onclick="fillRadio(2,1)">
                                    <label class="form-check-label" for="flexRadioDefault3">
                                    <small>Mixed Content</small>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" ${mobileConfiguration.get('url_default_content') == 3 ? 'checked' : ''} id="flexRadioDefault4" onclick="fillRadio(3,1)">
                                    <label class="form-check-label" for="flexRadioDefault4">
                                    <small>E-Commerce</small>
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" ${mobileConfiguration.get('url_default_content') == 4 ? 'checked' : ''} id="flexRadioDefault5" onclick="fillRadio(4,1)">
                                    <label class="form-check-label" for="flexRadioDefault5">
                                    <small>Video Content</small>
                                    </label>
                                </div>
                                <input value="${mobileConfiguration.get('url_default_content')}" type="text" list="content" id="url_content" class="form-control form-control-sm" placeholder="'www.website.com' or pick existing options" name="url_content" onchange="chooseSubContent(1);">`;
        }

        console.log(tab);

        if (mobileConfiguration.get('tab' + tab + '_page') == "3" && mobileConfiguration.has('tab3_default_content')) {

            if (localStorage.lang == 1) {
                html += `<small>Konten : <span style="color: red">*</span></small>`;
            } else {
                html += `<small>Content : <span style="color: red">*</span></small>`;
            }

            html += `<div class="form-check mt-1">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" ${mobileConfiguration.get('tab3_default_content') == 0 ? 'checked' : ''} id="flexRadioDefault1" onclick="fillRadio(0,3)">
                                    <label class="form-check-label" for="flexRadioDefault1"> 
                                    <small>Timeline Content</small>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" ${mobileConfiguration.get('tab3_default_content') == 1 ? 'checked' : ''} id="flexRadioDefault2" onclick="fillRadio(1,3)">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                    <small>Grid Content</small>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" ${mobileConfiguration.get('tab3_default_content') == 2 ? 'checked' : ''} id="flexRadioDefault3" onclick="fillRadio(2,3)">
                                    <label class="form-check-label" for="flexRadioDefault3">
                                    <small>Mixed Content</small>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" ${mobileConfiguration.get('tab3_default_content') == 3 ? 'checked' : ''} id="flexRadioDefault4" onclick="fillRadio(3,3)">
                                    <label class="form-check-label" for="flexRadioDefault4">
                                    <small>E-Commerce</small>
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" ${mobileConfiguration.get('tab3_default_content') == 4 ? 'checked' : ''} id="flexRadioDefault5" onclick="fillRadio(4,3)">
                                    <label class="form-check-label" for="flexRadioDefault5">
                                    <small>Video Content</small>
                                    </label>
                                </div>
                                <input value="${mobileConfiguration.get('tab3_default_content')}" type="text" list="content" id="tab3_content" class="form-control form-control-sm" placeholder="'www.website.com' or pick existing options" name="url_content" onchange="chooseSubContent(3);">`;

        }


        if (localStorage.lang == 1) {

            html += `</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                    <button type="button" class="btn btn-success" onclick="saveTabConfig('` + tab + `','` + model + `')">Simpan perubahan</button>
                </div>`;

        } else {

            html += `</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" onclick="saveTabConfig('` + tab + `','` + model + `')">Save changes</button>
                </div>`;

        }

        $('#modalTabConfigure-content').append(html);
        $('#modalTabConfigure').modal('show');

        // IF BEFORE CHOOSE TAB 1/3 AND SHOW RADIO, RUN EVENT LISTERNER AGAIN

        customTab1();
        customTab3();
    }

    // MODAL BURGER CPAAS

    function openModalBurger(tab) {

        if (cannotChange() == 1) {
            return;
        }

        // DISABLE POP UP MODAL WHILE DISABLED (NOT FILL PREV FILE)

        if ($('#burger-content-' + tab).hasClass('disabled')) {

            let textDesc = '';

            if (localStorage.lang == 1) {
                textDesc = 'Harap isi tombol sebelumnya.';
            } else {
                textDesc = 'Please fill the previous button.';
            }

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: textDesc,
            })

            return;
        }

        let html = '';

        html = `<div class="modal-header">`;

        if (localStorage.lang == 1) {

            html += `<h6 class="modal-title">Konfigurasi  CPAAS ` + tab + `</h6>`;

        } else {

            html += `<h6 class="modal-title">Configure CPAAS ` + tab + `</h6>`;

        }

        html += `<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">`;

        if (localStorage.lang == 1) {
            html += `<small>Fitur Tombol ` + tab + ` <span style="color: red">*</span></small>`;
        } else {
            html += `<small>Button ` + tab + ` Features <span style="color: red">*</span></small>`;
        }

        html += `<select id="tabContentBurger-` + tab + `" class="form-select form-select-sm mb-2 mt-2" onchange="checkURL('` + tab + `','3')" onfocus="saveOldCPAASValue('` + tab + `','3')">`;

        if (localStorage.lang == 1) {
            html += `<option value="0">Pilih opsi anda</option>`;
        } else {
            html += `<option value="0">Select your option</option>`;
        }

        html += `       <option ${mobileConfiguration.get('fb'+tab+'_content') == "_fb2" ? "selected" : ""} value="_fb2">Content URL</option>
                        <option ${mobileConfiguration.get('fb'+tab+'_content') == "_fb9" ? "selected" : ""} value="_fb9">Contact Center</option>
                        <option ${mobileConfiguration.get('fb'+tab+'_content') == "_fb6" ? "selected" : ""} value="_fb6">Message</option>
                        <option ${mobileConfiguration.get('fb'+tab+'_content') == "_fb7" ? "selected" : ""} value="_fb7">Call</option>
                        <option ${mobileConfiguration.get('fb'+tab+'_content') == "_fb8" ? "selected" : ""} value="_fb8">Live Streaming</option>
                        <option ${mobileConfiguration.get('fb'+tab+'_content') == "_fb3" ? "selected" : ""} value="_fb3">Notification Center</option>
                        <option ${mobileConfiguration.get('fb'+tab+'_content') == "_fb11" ? "selected" : ""} value="_fb11">Call Audio</option>
                        <option ${mobileConfiguration.get('fb'+tab+'_content') == "_fb12" ? "selected" : ""} value="_fb12">Call Video</option>
                        <option ${mobileConfiguration.get('fb'+tab+'_content') == "_fb99" ? "selected" : ""} value="_fb99">Open Post</option>
                    </select>
                    <div id="subContent-` + tab + `">`;

        // IF ALREADY SELECT SUB CONTENT BEFORE

        if (mobileConfiguration.get('fb' + tab + '_url')) {

            if (localStorage.lang == 1) {
                html += `<small>URL Anda : <span style="color: red">*</span></small>`;
            } else {
                html += `<small>Your URL : <span style="color: red">*</span></small>`;
            }

            html += `<div class="input-group flex-nowrap pt-2">
                        <input type="text" value="${mobileConfiguration.get('fb'+tab+'_url')}" id="customURL-` + tab + `" class="form-control form-control-sm" placeholder="www.website.com" aria-label="Your URL" aria-describedby="addon-wrapping">
                    </div>`;

        }

        if (localStorage.lang == 1) {

            html += `</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                        <button type="button" class="btn btn-success" onclick="saveTabConfigBurger('` + tab + `')">Simpan perubahan</button>
                    </div>`;

        } else {

            html += `</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" onclick="saveTabConfigBurger('` + tab + `')">Save changes</button>
                    </div>`;

        }


        $('#modalTabBurger-content').append(html);
        $('#modalTabBurger').modal('show');

    }

    // WHEN MODAL CLOSE DELETE ALL DOM

    $('#modalTabConfigure').on('hidden.bs.modal', function() {

        $('#modalTabConfigure-content').html("");

    })

    $('#modalTabBurger').on('hidden.bs.modal', function() {

        $('#modalTabBurger-content').html("");

    })

    // SAVE ALL TAB CONFIGURATION IN MODAL

    function saveTabConfig(tab, model) {

        let tabPage = $('#tabContent-' + tab).val();
        let iconPage = $('#tabIconPreview-' + tab).attr('src');
        let noSubContent = true;

        // ADD MORE CHECK IF USER PICK TAB 1 HOMEPAGE OR TAB 3 CONTENT

        if (tabPage == 1 || tabPage == 3) {

            noSubContent = false;

            if (tabPage == 1) {

                let url_content = $('#url_content').val();

                if (url_content) {
                    noSubContent = true;
                }

                // SAVE URL OR RADIO IN MOBILE CONFIGURATION

                chooseSubContent(tabPage);

            }

            if (tabPage == 3) {

                let url_tab3 = $('#tab3_content').val();

                if (url_tab3) {
                    noSubContent = true;
                }

                // SAVE URL OR RADIO IN MOBILE CONFIGURATION

                chooseSubContent(tabPage);

            }

        }

        // VALIDATION ADD TAB

        if (tabPage != 0 && iconPage != "empty-image.png" && noSubContent == true) {

            mobileConfiguration.set('tab' + tab + '_page', tabPage);
            mobileConfiguration.set('tab' + tab + '_icon', mapTemp.get('tab' + tab + '_icon') ? mapTemp.get('tab' + tab + '_icon') : mobileConfiguration.get('tab' + tab + '_icon'));

            // mapTemp.delete('tab'+tab+'_icon');

            if (model == 1) {
                model = 'Floating';
            } else if (model == 2) {
                model = 'Docked';
            } else if (model == 3) {
                model = 'Burger';
            }

            $('#tab' + tab + model + '-icon').attr('src', iconPage);
            $('#modalTabConfigure').modal('hide');

        } else if (tabPage != 0 && iconPage == "empty-image.png" && noSubContent == true) {

            let textDesc = '';

            if (localStorage.lang == 1) {
                textDesc = 'Harap isi icon tab.';
            } else {
                textDesc = 'Please fill the tab icons.';
            }

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: textDesc,
            })


        } else {

            let textDesc = '';

            if (localStorage.lang == 1) {
                textDesc = 'Harap isi semua isian.';
            } else {
                textDesc = 'Please fill all the required fields.';
            }

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: textDesc,
            })

        }

    }

    // SAVE CPAAS MODAL BURGER MODE 

    function saveTabConfigBurger(tab) {

        let tabPage = $('#tabContentBurger-' + tab).val();
        let cpaasURL = $('#customURL-' + tab).val();
        let noSubContent = true;

        // CHECK IF THERE IS SUB CONTENT FOR URL, ADDING TO VALIDATION

        if (tabPage == '_fb2') {

            noSubContent = false;

            if (cpaasURL) {

                noSubContent = true;

            } else {

                noSubContent = false;

            }

        }

        // VALIDATION ADD TAB

        console.log(tabPage);

        if (tabPage != 0 && noSubContent == true) {

            if (tabPage == '_fb2') {
                $("#burger-content-" + tab).text("Content URL");
            } else if (tabPage == '_fb9') {
                $("#burger-content-" + tab).text("Contact Center");
            } else if (tabPage == '_fb6') {
                $("#burger-content-" + tab).text("Message");
            } else if (tabPage == '_fb7') {
                $("#burger-content-" + tab).text("Call");
            } else if (tabPage == '_fb8') {
                $("#burger-content-" + tab).text("Live Streaming");
            } else if (tabPage == '_fb3') {
                $("#burger-content-" + tab).text("Notification Center");
            } else if (tabPage == '_fb11') {
                $("#burger-content-" + tab).text("Call Audio");
            } else if (tabPage == '_fb12') {
                $("#burger-content-" + tab).text("Call Video");
            } else if (tabPage == '_fb99') {
                $("#burger-content-" + tab).text("New Post");
            }

            // SHOW X WHILE FIRST TIME, DO NOT SHOW X ON EDIT (AND IN CASE INPUT TWICE AFTER DELETE NOT SHOWING X)

            if (!mobileConfiguration.has('fb' + tab + '_content') || ((mobileConfiguration.has('fb' + tab + '_content') && mobileConfiguration.get('fb' + tab + '_content') == ''))) {

                $('#closeBurger' + tab + '-icon').removeClass('d-none');

            }

            mobileConfiguration.set('fb' + tab + '_content', tabPage);

            if (cpaasURL) {

                mobileConfiguration.set('fb' + tab + '_url', cpaasURL);

            } else {

                mobileConfiguration.delete('fb' + tab + '_url');

            }

            $('#modalTabBurger').modal('hide');

            // OPEN NEXT FILL AFTER THIS FILL IS FILLED

            if (tab == '4') {

                $('#btnAddMore2').removeClass('disabled');
                $('#closeBurger' + (parseInt(tab) - 1) + '-icon').addClass('d-none');

            } else {

                $('#burger-content-' + (parseInt(tab) + 1)).removeClass('disabled');
                $('#closeBurger' + (parseInt(tab) - 1) + '-icon').addClass('d-none');

            }

        } else {

            let textDesc = '';

            if (localStorage.lang == 1) {
                textDesc = 'Harap isi semua isian.';
            } else {
                textDesc = 'Please fill all the required fields.';
            }

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: textDesc,
            })

        }
    }

    // WHEN CHANGE TAB ICON IN MODAL

    function changeTabIcon(tab) {

        let source = $("#tabIcon-" + tab)[0].files[0];
        let name = $("#tabIcon-" + tab)[0].files[0].name;

        if (source) {
            let reader = new FileReader();

            reader.onload = function() {

                let base64_icon = reader.result;

                $("#tabIconPreview-" + tab).attr("src", base64_icon);

                // SET FILE TO MAIN OBJECT AND BASE 64 FILE TO TEMP OBJECT

                mapTemp.set('tab' + tab + '_icon', base64_icon);

            }

            reader.readAsDataURL(source);

        }

    }

    // WHEN CHANGE CPAAS ICON IN MODAL

    function changeCPAASIcon(position) {

        let source = $("#cpaasIcon-" + position)[0].files[0];
        let name = $("#cpaasIcon-" + position)[0].files[0].name;

        if (source) {
            let reader = new FileReader();

            reader.onload = function() {

                let base64_icon = reader.result;

                $("#cpaasIconPreview-" + position).attr("src", base64_icon);

                // SET FILE TO MAIN OBJECT AND BASE 64 FILE TO TEMP OBJECT

                mapTemp.set('fb' + position + '_icon', base64_icon);

            }

            reader.readAsDataURL(source);

        }

    }

    // WHEN CHANGE CPAAS ICON IN MODAL (MULTIPLE/ ADD MORE)

    function changeCPAASIconMore(model, position) {

        var modelText = '';

        if (model == 1) {
            modelText = 'Floating';
        } else if (model == 2) {
            modelText = 'Docked';
        } else if (model == 3) {
            modelText = 'Burger';
        }

        let source = $("#cpaasIcon-" + modelText + position)[0].files[0];
        let name = $("#cpaasIcon-" + modelText + position)[0].files[0].name;

        if (source) {
            let reader = new FileReader();

            reader.onload = function() {

                let base64_icon = reader.result;

                // APPEAR DELETE X BUTTON

                if (!mobileConfiguration.has('fb' + position + '_content') && !mapTemp.has('fb' + position + '_content')) {

                    $('#closeCPAAS' + (parseInt(position) - 1) + '-icon').addClass('d-none');
                    $('#closeCPAAS' + position + '-icon').removeClass('d-none');

                }

                // ON ADD MORE MODAL
                $("#cpaasIconPreview-" + modelText + position).attr("src", base64_icon);

                // SET FILE TO MAIN OBJECT AND BASE 64 FILE TO TEMP OBJECT

                mapTemp.set('fb' + position + '_icon', base64_icon);

                checkFillAddMore(position, model);

            }

            reader.readAsDataURL(source);

        }
    }

    // GET OLD VALUE BEFORE SELECT ONCHANGE

    function saveOldTabValue(tab) {

        let tabPage = $('#tabContent-' + tab).val();
        localStorage.setItem('old_tab', tabPage);

    }

    function saveOldCPAASValue(tab, model) {

        let cpaasContent = '';

        if (model == 3) {

            cpaasContent = $('#tabContentBurger-' + tab).val();

        } else {

            cpaasContent = $('#cpaasContent-' + tab).val();

        }

        localStorage.setItem('old_cpaas', cpaasContent);

    }

    function saveOldCPAASMoreValue(tab, model) {

        let cpaasContent = '';

        if (model == 3) {

            cpaasContent = $('#cpaasContent-Burger' + tab).val();

        } else {

            cpaasContent = $('#cpaasContent-Floating' + tab).val();

        }

        localStorage.setItem('old_cpaas', cpaasContent);

    }

    // FOR APPEND NEW DROPDOWN IF CHOOSE CONTENT OR HOMEPAGES

    function checkOption(tab) {

        let html = "";
        let tabPage = $('#tabContent-' + tab).val();
        console.log(tabPage);

        if (checkDuplicateTab(tabPage) == 1) {

            let textDesc = '';

            if (localStorage.lang == 1) {
                textDesc = 'Tab Konten Duplikat.';
            } else {
                textDesc = 'Duplicate Tab Content.';
            }

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: textDesc,
            })

            if (localStorage.getItem('old_tab') == 0) {

                $('#tabContent-' + tab).val(0);

            } else {

                $('#tabContent-' + tab).val(localStorage.getItem('old_tab'));

            }

            return;
        }

        if (tabPage == 1) {

            if (localStorage.lang == 1) {
                html = `<small>Konten : <span style="color: red">*</span></small>`;
            } else {
                html = `<small>Content : <span style="color: red">*</span></small>`;
            }

            html += `<div class="form-check mt-1">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" onclick="fillRadio(0,1)">
                        <label class="form-check-label" for="flexRadioDefault1"> 
                           <small>Timeline Content</small>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" onclick="fillRadio(1,1)">
                        <label class="form-check-label" for="flexRadioDefault2">
                           <small>Grid Content</small>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3" onclick="fillRadio(2,1)">
                        <label class="form-check-label" for="flexRadioDefault3">
                           <small>Mixed Content</small>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4" onclick="fillRadio(3,1)">
                        <label class="form-check-label" for="flexRadioDefault4">
                           <small>E-Commerce</small>
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault5" onclick="fillRadio(4,1)">
                        <label class="form-check-label" for="flexRadioDefault5">
                           <small>Video Content</small>
                        </label>
                    </div>`;

            if (localStorage.lang == 1) {
                html += `<input type="text" list="content" id="url_content" class="form-control form-control-sm" placeholder="'www.website.com' atau pilih dari beberapa opsi" name="url_content" onchange="chooseSubContent(1);">`;
            } else {
                html += `<input type="text" list="content" id="url_content" class="form-control form-control-sm" placeholder="'www.website.com' or pick existing options" name="url_content" onchange="chooseSubContent(1);">`;
            }

        } else if (tabPage == 3) {

            if (localStorage.lang == 1) {
                html = `<small>Konten : <span style="color: red">*</span></small>`;
            } else {
                html = `<small>Content : <span style="color: red">*</span></small>`;
            }

            html += `<div class="form-check mt-1">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" onclick="fillRadio(0,3)">
                        <label class="form-check-label" for="flexRadioDefault1"> 
                           <small>Timeline Content</small>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" onclick="fillRadio(1,3)">
                        <label class="form-check-label" for="flexRadioDefault2">
                           <small>Grid Content</small>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3" onclick="fillRadio(2,3)">
                        <label class="form-check-label" for="flexRadioDefault3">
                           <small>Mixed Content</small>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4" onclick="fillRadio(3,3)">
                        <label class="form-check-label" for="flexRadioDefault4">
                           <small>E-Commerce</small>
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault5" onclick="fillRadio(4,3)">
                        <label class="form-check-label" for="flexRadioDefault5">
                           <small>Video Content</small>
                        </label>
                    </div>`;

            if (localStorage.lang == 1) {
                html += `<input type="text" list="content" id="tab3_content" class="form-control form-control-sm" placeholder="'www.website.com' atau pilih dari beberapa opsi" name="url_content" onchange="chooseSubContent(3);">`;
            } else {
                html += `<input type="text" list="content" id="tab3_content" class="form-control form-control-sm" placeholder="'www.website.com' or pick existing options" name="url_content" onchange="chooseSubContent(3);">`;
            }


        }

        $('#subContent-' + tab).html(html);

        // IF CHOOSE TAB 1/3 WITH RADIO, RUN EVENT LISTENER

        customTab1();
        customTab3();
    }

    // ADD TAB DOCKED

    function btnAddBarDocked() {

        if (cannotChange() == 1) {
            return;
        }

        if (tabDockedBar < 5) {
            tabDockedBar = tabDockedBar + 2;
            tabDockedBar2 = tabDockedBar + 1;
            console.log(tabDockedBar);
            console.log(tabDockedBar2);

            let html = `<div id="tab` + tabDockedBar + `Docked" class="col d-flex justify-content-center align-items-center" style="background-color: #0dcaf0" onclick="openTabModal('` + tabDockedBar + `','2')">
                             <img id="tab` + tabDockedBar + `Docked-icon" src="empty-image.png" style="width: 30px; height: 30px; border-radius: 20px">
                            <span id="tab` + tabDockedBar + `-docked-text" style="font-size: 14px; position: absolute; margin-top: -70px; font-weight: bold">TAB ` + tabDockedBar + `</span>         
                        </div>
                        <div id="tab` + tabDockedBar2 + `Docked" class="col d-flex justify-content-center align-items-center" style="background-color: #0dcaf0" onclick="openTabModal('` + tabDockedBar2 + `','2')">
                            <img id="tab` + tabDockedBar2 + `Docked-icon" src="empty-image.png" style="width: 30px; height: 30px; border-radius: 20px">
                            <span id="tab` + tabDockedBar2 + `-docked-text" style="font-size: 14px; position: absolute; margin-top: -70px; font-weight: bold">TAB ` + tabDockedBar2 + `</span>         
                        </div>`;
            $('#tab-barDocked').append(html);

            $('#tab2-docked-text').text('T2');
            $('#tab3-docked-text').text('T3');
            $('#tab5-docked-text').text('T5');
            $('#tab6-docked-text').text('T6');

            if (tabDockedBar > 3) {

                $('#tab1-docked-text').text('T1');
                $('#tab4-docked-text').text('T4');

                $('#tab3-docked-text').css('margin-left', '-30px');
                $('#tab4-docked-text').css('margin-left', '30px');
            }

        } else {

            let textDesc = '';

            if (localStorage.lang == 1) {
                textDesc = 'Tidak dapat menambahkan tab (Maksimal 6)';
            } else {
                textDesc = 'Can`t Add More Tab! (Maximum 6)';
            }

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: textDesc,
            })

        }

        $('#deleteTabDocked').removeClass('disabled');

        if (tabDockedBar > 4) {

            $('#addTabDocked').addClass('disabled');

        }

    }

    // DELETE TAB DOCKED

    function btnDelBarDocked() {

        if (cannotChange() == 1) {
            return;
        }

        if (tabDockedBar > 1) {

            if (tabFloatingBar == 4) {
                mobileConfiguration.delete('tab3_page');
                mobileConfiguration.delete('tab3_icon');
                mobileConfiguration.delete('tab4_page');
                mobileConfiguration.delete('tab4_icon');
            } else if (tabFloatingBar == 6) {
                mobileConfiguration.delete('tab5_page');
                mobileConfiguration.delete('tab5_icon');
                mobileConfiguration.delete('tab6_page');
                mobileConfiguration.delete('tab6_icon');
            }

            tabDockedBar = tabDockedBar - 2;
            tabDockedBar2 = tabDockedBar - 1;
            console.log(tabDockedBar);
            console.log(tabDockedBar2);

            $('#tab' + (tabDockedBar + 2) + 'Docked').remove();
            $('#tab' + (tabDockedBar + 3) + 'Docked').remove();

        } else {

            let textDesc = '';

            if (localStorage.lang == 1) {
                textDesc = 'Tidak dapat menghapus tab (Minimal 2)';
            } else {
                textDesc = 'Can`t Delete More Tab! (Minimum 2)';
            }

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: textDesc,
            })

        }

        $('#tab1-docked-text').text('TAB 1');
        $('#tab4-docked-text').text('TAB 4');
        $('#tab5-docked-text').text('TAB 5');
        $('#tab6-docked-text').text('TAB 6');

        if (tabDockedBar < 5) {

            $('#tab2-docked-text').text('T2');
            $('#tab3-docked-text').text('T3');

            $('#tab3-docked-text').css('margin-left', '');
            $('#tab4-docked-text').css('margin-left', '');
        }

        if (tabDockedBar == 1) {
            $('#tab2-docked-text').text('TAB 2');
        }

        $('#addTabDocked').removeClass('disabled');

        if (tabDockedBar < 3) {

            $('#deleteTabDocked').addClass('disabled');

        }

    }

    // ADD TAB BURGER

    function btnAddBarBurger() {

        if (cannotChange() == 1) {
            return;
        }

        if (tabBurgerBar < 6) {

            tabBurgerBar = tabBurgerBar + 1;
            console.log(tabBurgerBar);

            let html = `<div id="tab` + tabBurgerBar + `Burger" class="col d-flex justify-content-center align-items-center text-white" onclick="openTabModal('` + tabBurgerBar + `','3')" style="background-color: #0dcaf0">
                            <img id="tab` + tabBurgerBar + `Burger-icon" src="empty-image.png" style="width: 30px; height: 30px; border-radius: 20px">
                            <span style="font-size: 14px; position: absolute; margin-top: -70px; font-weight: bold; color: black">TAB ` + tabBurgerBar + `</span>         
                        </div>`;

            $('#tab-barBurger').append(html);

        } else {

            let textDesc = '';

            if (localStorage.lang == 1) {
                textDesc = 'Tidak dapat menambahkan tab (Maksimal 6)';
            } else {
                textDesc = 'Can`t Add More Tab! (Maximum 6)';
            }

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: textDesc,
            })

        }

        $('#deleteTabBurger').removeClass('disabled');

        if (tabBurgerBar > 5) {

            $('#addTabBurger').addClass('disabled');

        }

    }

    // DELETE TAB BURGER

    function btnDelBarBurger() {

        if (cannotChange() == 1) {
            return;
        }

        if (tabBurgerBar > 2) {

            if (tabBurgerBar == 3) {
                mobileConfiguration.delete('tab3_page');
                mobileConfiguration.delete('tab3_icon');
            } else if (tabBurgerBar == 4) {
                mobileConfiguration.delete('tab4_page');
                mobileConfiguration.delete('tab4_icon');
            } else if (tabBurgerBar == 5) {
                mobileConfiguration.delete('tab5_page');
                mobileConfiguration.delete('tab5_icon');
            } else if (tabBurgerBar == 6) {
                mobileConfiguration.delete('tab6_page');
                mobileConfiguration.delete('tab6_icon');
            }

            tabBurgerBar = tabBurgerBar - 1;
            console.log(tabBurgerBar);

            $('#tab' + (tabBurgerBar + 1) + 'Burger').remove();

        } else {

            let textDesc = '';

            if (localStorage.lang == 1) {
                textDesc = 'Tidak dapat menghapus tab (Minimal 2)';
            } else {
                textDesc = 'Can`t Delete More Tab! (Minimum 2)';
            }

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: textDesc,
            })

        }

        $('#addTabBurger').removeClass('disabled');

        if (tabBurgerBar < 3) {

            $('#deleteTabBurger').addClass('disabled');

        }

    }

    // SWITCH MODE TO FLOATING

    function switchFloatingMode() {

        if (cannotChange() == 1) {
            return;
        }

        let textTitle = '';
        let textDesc = '';
        let textYes = '';
        let textNo = '';

        if (localStorage.lang == 1) {
            textTitle = 'Apakah anda yakin?';
            textDesc = 'Jika Anda mengubah modelnya, semua penyesuaian Anda akan hilang.';
            textYes = 'Iya';
            textNo = 'Batalkan';
        } else {
            textTitle = 'Are you sure?';
            textDesc = 'If you changed the model, your all customization will be lost.';
            textYes = 'Yes';
            textNo = 'Cancel';
        }

        Swal.fire({
            title: textTitle,
            text: textDesc,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: textYes,
            cancelButtonText: textNo
        }).then((result) => {
            if (result.isConfirmed) {

                $("#floatingBut").css("background-color", "#ff9b35");
                $("#dockedBut").css("background-color", "#efefef");
                $("#hamburgerBut").css("background-color", "#efefef");

                $("#floating-interface").removeClass("d-none");
                $("#docked-interface").addClass("d-none");
                $("#hamburger-interface").addClass("d-none");

                mobileConfiguration.set('access_model', '0');

                $('#submit-button').addClass('d-none');
                $('#background-preview').html("");

                clearTabAndCPAAS('1');
                setX('1');

                // DESTROY MODAL WHILE SWITCHING (NO CACHE)

                $('#modalCPAAS-content').html('');

            }
        })

    }

    // SWITCH MODE TO DOCKED

    function switchDockMode() {

        if (cannotChange() == 1) {
            return;
        }

        let textTitle = '';
        let textDesc = '';
        let textYes = '';
        let textNo = '';

        if (localStorage.lang == 1) {
            textTitle = 'Apakah anda yakin?';
            textDesc = 'Jika Anda mengubah modelnya, semua penyesuaian Anda akan hilang.';
            textYes = 'Iya';
            textNo = 'Batalkan';
        } else {
            textTitle = 'Are you sure?';
            textDesc = 'If you changed the model, your all customization will be lost.';
            textYes = 'Yes';
            textNo = 'Cancel';
        }

        Swal.fire({
            title: textTitle,
            text: textDesc,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: textYes,
            cancelButtonText: textNo
        }).then((result) => {
            if (result.isConfirmed) {

                $("#floatingBut").css("background-color", "#efefef");
                $("#dockedBut").css("background-color", "#ff9b35");
                $("#hamburgerBut").css("background-color", "#efefef");

                $("#floating-interface").addClass("d-none");
                $("#docked-interface").removeClass("d-none");
                $("#hamburger-interface").addClass("d-none");

                mobileConfiguration.set('access_model', '1');

                $('#submit-button').addClass('d-none');
                $('#background-preview').html("");

                clearTabAndCPAAS('2');
                setX('2');

                // DESTROY MODAL WHILE SWITCHING (NO CACHE)

                $('#modalCPAAS-content').html('');

            }
        })

    }

    // SWITCH MODE TO BURGER

    function switchBurgerMode() {

        if (cannotChange() == 1) {
            return;
        }

        let textTitle = '';
        let textDesc = '';
        let textYes = '';
        let textNo = '';

        if (localStorage.lang == 1) {
            textTitle = 'Apakah anda yakin?';
            textDesc = 'Jika Anda mengubah modelnya, semua penyesuaian Anda akan hilang.';
            textYes = 'Iya';
            textNo = 'Batalkan';
        } else {
            textTitle = 'Are you sure?';
            textDesc = 'If you changed the model, your all customization will be lost.';
            textYes = 'Yes';
            textNo = 'Cancel';
        }

        Swal.fire({
            title: textTitle,
            text: textDesc,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: textYes,
            cancelButtonText: textNo
        }).then((result) => {
            if (result.isConfirmed) {

                $("#floatingBut").css("background-color", "#efefef");
                $("#dockedBut").css("background-color", "#efefef");
                $("#hamburgerBut").css("background-color", "#ff9b35");

                $("#floating-interface").addClass("d-none");
                $("#docked-interface").addClass("d-none");
                $("#hamburger-interface").removeClass("d-none");

                mobileConfiguration.set('access_model', '2');

                $('#submit-button').addClass('d-none');
                $('#background-preview').html("");

                clearTabAndCPAAS('3');
                setX('3');

                // DESTROY MODAL WHILE SWITCHING (NO CACHE)

                $('#modalCPAAS-content').html('');

            }
        })

    }

    // FUNCTION CHANGE BACKGROUND

    function changeBackground() {

        let source = $("#backgroundFloating")[0].files[0];
        let name = $("#backgroundFloating")[0].files[0].name;

        // console.log(name);

        // LOOP IN CASE MULTIPLE FILE TO GET ALL BASE 64 SAVED ON ARRAY

        Array.from($("#backgroundFloating")[0].files).forEach(file => {

            if (source) {
                let reader = new FileReader();

                reader.onload = function() {

                    let base64_bg = reader.result;

                    $('#background-section').css('margin-top', '0px');
                    $('#background-section').css('height', '100%');

                    $("#bgPreviewFloating").attr("src", base64_bg);
                    $("#bgPreviewFloating").css("filter", 'grayscale(0)');
                    $('#click-here-background').addClass('d-none');

                    // PUSH TO ARRAY 

                    backgroundArray.push(reader.result);

                    // SET TO PREVIEW SECTION

                    let position = backgroundArray.length - 1;

                    let html = `<div id="bg-preview-` + position + `" class="col-auto px-2">
                                    <div onclick="deletePreviewBG('` + position + `')" style="width: 20px; height: 20px; font-size: 12px; padding-left: 6px; position: absolute; margin-top: -3px; margin-left: -5px; color: white; border-radius: 20px; background-color: #dc3545; padding-top: 1px">X</div>
                                    <img onclick="changeImagePreview('` + reader.result + `')" src="` + reader.result + `" style="width: 55px; height: 120px; border-radius: 5px; object-fit: cover; border: 1px dashed grey">
                                </div>`;

                    $('#background-preview').removeClass('d-none');
                    $('#background-preview').append(html);

                }

                reader.readAsDataURL(file);

            }

        });

    }

    // FUNCTION CHANGE FONTS

    function chooseFont() {

        $('#modalFont').modal('show');

    }

    function changeFont() {

        let font = $('#fonts').val();

        mobileConfiguration.set('app_font', font);

        $('#modalFont').modal('hide');

    }

    // FUNCTION CHANGE FEATURES CHECKBOX

    function chooseFeature() {

        $('#modalFeatureList').modal('show');

    }

    function changeFeature() {

        if ($('#feature-sms').is(":checked")) {

            mobileConfiguration.set('enable_sms', '1');

        }

        if ($('#feature-osint').is(":checked")) {

            mobileConfiguration.set('enable_osint', '1');

        }

        if ($('#feature-scan').is(":checked")) {

            mobileConfiguration.set('enable_scan', '1');

        }

        if ($('#feature-email').is(":checked")) {

            mobileConfiguration.set('enable_email', '1');

        }

        $('#modalFeatureList').modal('hide');

    }

    // FOR TAB 1 AND TAB 3 SUB CONTENT

    function chooseSubContent(tab) {

        if (tab == 1) {

            mobileConfiguration.set('url_default_content', $('#url_content').val());

        } else if (tab == 3) {

            mobileConfiguration.set('tab3_default_content', $('#tab3_content').val());

        }

    }

    // FUNCTION CONFIGURE CPAAS

    function openCPAASModal(position, model) {

        if (cannotChange() == 1) {
            return;
        }

        var modelText = '';

        if (model == 1) {
            modelText = 'Floating';
        } else if (model == 2) {
            modelText = 'Docked';
        }

        // DISABLE POP UP MODAL WHILE DISABLED (NOT FILL PREV FILE)

        if ($('#cpaas' + modelText + position + '-icon').hasClass('disabled')) {

            let textDesc = '';

            if (localStorage.lang == 1) {
                textDesc = 'Harap isi tombol sebelumnya.';
            } else {
                textDesc = 'Please fill the previous button.';
            }

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: textDesc,
            })

            return;
        }

        let html = `<div class="modal-header">`;

        if (localStorage.lang == 1) {
            html += `<h6 class="modal-title">Konfigurasi Tombol CPAAS ` + position + `</h6>`;
        } else {
            html += `<h6 class="modal-title">Configure CPAAS Button ` + position + `</h6>`;
        }

        html += `<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="col-12 text-center">`;

        if (localStorage.lang == 1) {
            html += `<p style="margin-bottom: 3px">Ikon CPAAS ` + position + ` <span style="color: red">*</span></p>`;
        } else {
            html += `<p style="margin-bottom: 3px">CPAAS Icon ` + position + ` <span style="color: red">*</span></p>`;
        }

        html += `<label for="cpaasIcon-` + position + `">
                                    <img id="cpaasIconPreview-` + position + `" src="${ mobileConfiguration.get('fb'+position+'_icon') ? mobileConfiguration.get('fb'+position+'_icon') : 'empty-image.png'}"" style="width: 100px; height: 100px; object-fit: cover; object-position: center; border-radius: 20px; border: 1px solid #ced4da">
                                </label>
                                <input id="cpaasIcon-` + position + `" type="file" accept="image/*" onchange="changeCPAASIcon('` + position + `')" class="d-none">                                
                            </div>
                        </div>`;

        if (localStorage.lang == 1) {

            html += `<small>Fitur Tombol ` + position + ` <span style="color: red">*</span></small>`;


        } else {

            html += `<small>Button ` + position + ` Features <span style="color: red">*</span></small>`;


        }

        html += `<select id="cpaasContent-` + position + `" onchange="checkURL('` + position + `','` + model + `')" onfocus="saveOldCPAASValue('` + position + `','` + model + `')" class="form-select form-select-sm mb-2 mt-2">`;


        if (localStorage.lang == 1) {
            html += `<option value="0">Pilih opsi anda</option>`;
        } else {
            html += `<option value="0">Select your option</option>`;
        }

        html += `<option ${mobileConfiguration.get('fb'+position+'_content') == "_fb2" ? "selected" : ""} value="_fb2">Custom URL</option>
                            <option ${mobileConfiguration.get('fb'+position+'_content') == "_fb9" ? "selected" : ""} value="_fb9">Contact Center</option>
                            <option ${mobileConfiguration.get('fb'+position+'_content') == "_fb6" ? "selected" : ""} value="_fb6">Message</option>
                            <option ${mobileConfiguration.get('fb'+position+'_content') == "_fb7" ? "selected" : ""} value="_fb7">Call</option>
                            <option ${mobileConfiguration.get('fb'+position+'_content') == "_fb8" ? "selected" : ""} value="_fb8">Live Streaming</option>
                            <option ${mobileConfiguration.get('fb'+position+'_content') == "_fb3" ? "selected" : ""} value="_fb3">Notification Center</option>
                            <option ${mobileConfiguration.get('fb'+position+'_content') == "_fb11" ? "selected" : ""} value="_fb11">Call Audio</option>
                            <option ${mobileConfiguration.get('fb'+position+'_content') == "_fb12" ? "selected" : ""} value="_fb812">Call Video</option>
                            <option ${mobileConfiguration.get('fb'+position+'_content') == "_fb99" ? "selected" : ""} value="_fb99">Open Post</option>
                        </select>
                        <div id="subContent-` + position + `">`;


        // IF ALREADY SELECT SUB CONTENT BEFORE

        if (mobileConfiguration.get('fb' + position + '_url')) {

            if (localStorage.lang == 1) {

                html += `<small>URL Anda : <span style="color: red">*</span></small>`;

            } else {

                html += `<small>Your URL : <span style="color: red">*</span></small>`;

            }


            html += `<div class="input-group flex-nowrap pt-2">
                        <input type="text" value="${mobileConfiguration.get('fb'+position+'_url')}" id="customURL-` + position + `" class="form-control form-control-sm" placeholder="www.website.com" aria-label="Your URL" aria-describedby="addon-wrapping">
                    </div>`;

        }

        if (localStorage.lang == 1) {

            html += `    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                        <button type="button" class="btn btn-success" onclick="saveCPAASConfig('` + position + `','` + model + `')">Simpan perubahan</button>
                    </div>`;

        } else {

            html += `    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" onclick="saveCPAASConfig('` + position + `','` + model + `')">Save changes</button>
                    </div>`;

        }


        $('#modalCPAAS-content').html(html);

        $('#modalCPAAS').modal('show');

    }

    function saveCPAASConfig(position, model) {

        var modelText = '';
        let noSubContent = true;

        if (model == 1) {
            modelText = 'Floating';
        } else if (model == 2) {
            modelText = 'Docked';
        }

        let contentCPAAS = $('#cpaasContent-' + position).val();
        let iconPage = $('#cpaasIconPreview-' + position).attr('src');
        let cpaasURL = $('#customURL-' + position).val();

        // CHECK IF THERE IS SUB CONTENT FOR URL, ADDING TO VALIDATION

        if (contentCPAAS == '_fb2') {

            noSubContent = false;

            if (cpaasURL) {

                noSubContent = true;

            } else {

                noSubContent = false;

            }

        }

        if (contentCPAAS != 0 && iconPage != "empty-image.png" && noSubContent == true) {

            // SHOW X WHILE FIRST TIME, DO NOT SHOW X ON EDIT (AND IN CASE INPUT TWICE AFTER DELETE NOT SHOWING X)

            if (!mobileConfiguration.has('fb' + position + '_icon') || ((mobileConfiguration.has('fb' + position + '_icon') && mobileConfiguration.get('fb' + position + '_icon') == ''))) {

                $('#close' + modelText + position + '-icon').removeClass('d-none');

            }

            mobileConfiguration.set('fb' + position + '_content', contentCPAAS);
            mobileConfiguration.set('fb' + position + '_icon', mapTemp.get('fb' + position + '_icon') ? mapTemp.get('fb' + position + '_icon') : mobileConfiguration.get('fb' + position + '_icon'));

            // IF USER FILL WITH URL

            if (cpaasURL) {

                mobileConfiguration.set('fb' + position + '_url', cpaasURL);

            } else {

                mobileConfiguration.delete('fb' + position + '_url');

            }

            $('#cpaas' + modelText + position + '-icon').attr('src', iconPage);

            $('#modalCPAAS').modal('hide');

            // TURN ON NEXT FB IF THIS FB HAS BEEN FILLED (IF 4 = OPEN ADD MORE) AND DELETE X BUTTON ON PREV FB

            if (model == 2) {

                // IF DOCKED UNTIL 5

                $('#cpaas' + modelText + (parseInt(position) + 1) + '-icon').removeClass('disabled');
                $('#close' + modelText + (parseInt(position) - 1) + '-icon').addClass('d-none');

            } else {

                if (position == '4') {

                    $('#addMore-' + modelText).removeClass('disabled');
                    $('#close' + modelText + (parseInt(position) - 1) + '-icon').addClass('d-none');

                } else {

                    $('#cpaas' + modelText + (parseInt(position) + 1) + '-icon').removeClass('disabled');
                    $('#close' + modelText + (parseInt(position) - 1) + '-icon').addClass('d-none');

                }
            }

        } else {

            let textDesc = '';

            if (localStorage.lang == 1) {
                textDesc = 'Harap isi semua isian.';
            } else {
                textDesc = 'Please fill all the required fields.';
            }

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: textDesc,
            })

        }

    }

    // FUNCTION ADD MORE CPAAS

    function openCPAASMore(model) {

        if (cannotChange() == 1) {
            return;
        }

        var modelText = '';

        if (model == 1) {
            modelText = 'Floating';
        } else if (model == 2) {
            modelText = 'Docked';
        }

        // DISABLE POP UP MODAL WHILE DISABLED (NOT FILL PREV FILE)

        if ($('#addMore-' + modelText).hasClass('disabled')) {

            let textDesc = '';

            if (localStorage.lang == 1) {
                textDesc = 'Harap isi tombol sebelumnya.';
            } else {
                textDesc = 'Please fill the previous button.';
            }

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: textDesc,
            })

            return;

        }

        let html = `<div class="modal-header">`;

        if (localStorage.lang == 1) {
            html += `<h6 class="modal-title">Konfigurasi Tombol CPAAS ${modelText} Button</h6>`;
        } else {
            html += `<h6 class="modal-title">Configure CPAAS ${modelText} Button</h6>`;
        }

        html += `<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div id="add-more-cpaas-body" class="modal-body">
                        <div id="cpaasIconDiv-` + modelText + `1" class="row mb-2" style="border-bottom: 1px solid #e5e5e5; margin-top: 10px !important; margin-bottom: 20px !important; padding-bottom: 10px !important">
                            <div class="col-5 d-flex justify-content-center">
                                <label for="cpaasIcon-` + modelText + `1">
                                    <img id="cpaasIconPreview-` + modelText + `1" src="${ mobileConfiguration.get('fb1_icon') ? mobileConfiguration.get('fb1_icon') : "empty-image.png" }" style="width: 100px; height: 100px; object-fit: cover; object-position: center; border-radius: 20px; border: 1px solid #ced4da">
                                </label>
                                <input id="cpaasIcon-` + modelText + `1" type="file" accept="image/*" class="d-none" onchange="changeCPAASIconMore('` + model + `','1')">                                
                            </div>
                            <div class="col-7 d-flex justify-content-center">
                                <div class="row">
                                    <div class="col-10">`;

        if (localStorage.lang == 1) {
            html += `<small>Fitur Tombol 1 <span style="color: red">*</span></p></small>`;
        } else {
            html += `<small>Button 1 Features <span style="color: red">*</span></p></small>`;
        }

        html += `</div>
                                    <div class="col-2">
                                        <div id="closeCPAAS1-icon" onclick="resetCPAASIconModal('1','` + model + `')" class="close-icon bg-danger d-flex justify-content-center d-none" style="z-index: 10; width: 30px; height: 30px; border-radius: 50%; margin-left: -4px">
                                            <img src="close-round.png" style="width: 15px; height: 15px; border-radius: 20px; margin-top: 8px; filter: invert(1)">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <select id="cpaasContent-` + modelText + `1" class="form-select form-select-sm mb-2 mt-2" onchange="saveSelectMore('1','` + model + `')" onfocus="saveOldCPAASMoreValue('1','` + model + `')">`;

        if (localStorage.lang == 1) {
            html += `<option value="0">Pilih opsi anda</option>`;
        } else {
            html += `<option value="0">Select your option</option>`;
        }

        html += `<option ${ mobileConfiguration.get('fb1_content') == '_fb2' ? "selected" : "" } value="_fb2">Custom URL</option>
                                            <option ${ mobileConfiguration.get('fb1_content') == '_fb9' ? "selected" : "" } value="_fb9">Contact Center</option>
                                            <option ${ mobileConfiguration.get('fb1_content') == '_fb6' ? "selected" : "" } value="_fb6">Message</option>
                                            <option ${ mobileConfiguration.get('fb1_content') == '_fb7' ? "selected" : "" } value="_fb7">Call</option>
                                            <option ${ mobileConfiguration.get('fb1_content') == '_fb8' ? "selected" : "" } value="_fb8">Live Streaming</option>
                                            <option ${ mobileConfiguration.get('fb1_content') == '_fb3' ? "selected" : "" } value="_fb3">Notification Center</option>
                                            <option ${ mobileConfiguration.get('fb1_content') == '_fb11' ? "selected" : "" } value="_fb11">Call Audio</option>
                                            <option ${ mobileConfiguration.get('fb1_content') == '_fb12' ? "selected" : "" } value="_fb12">Call Video</option>
                                            <option ${ mobileConfiguration.get('fb1_content') == '_fb99' ? "selected" : "" } value="_fb99">Open Post</option>
                                        </select>
                                        <div id="subContent-1">`;

        // IF ALREADY SELECT SUB CONTENT BEFORE

        if (mobileConfiguration.get('fb1_url')) {

            html += `<div class="input-group flex-nowrap pt-2">
                            <input type="text" onchange="saveURLTemp('1')" value="${mobileConfiguration.get('fb1_url')}" id="customURL-1" class="form-control form-control-sm" placeholder="www.website.com" aria-label="Your URL" aria-describedby="addon-wrapping">
                        </div>`;

        }

        html += `</div>
                                </div>
                            </div>
                        </div>
                    </div>

                        <div id="cpaasIconDiv-` + modelText + `2" class="row mb-2" style="border-bottom: 1px solid #e5e5e5; margin-top: 10px !important; margin-bottom: 20px !important; padding-bottom: 10px !important">
                            <div class="col-5 d-flex justify-content-center">
                                <label for="cpaasIcon-` + modelText + `2">
                                    <img id="cpaasIconPreview-` + modelText + `2" src="${ mobileConfiguration.get('fb2_icon') ? mobileConfiguration.get('fb2_icon') : "empty-image.png" }" style="width: 100px; height: 100px; object-fit: cover; object-position: center; border-radius: 20px; border: 1px solid #ced4da">
                                </label>
                                <input id="cpaasIcon-` + modelText + `2" type="file" accept="image/*" class="d-none" onchange="changeCPAASIconMore('` + model + `','2')">                                
                            </div>
                            <div class="col-7 d-flex justify-content-center">
                                <div class="row">
                                    <div class="col-10">`;

        if (localStorage.lang == 1) {
            html += `<small>Fitur Tombol 2 <span style="color: red">*</span></p></small>`;
        } else {
            html += `<small>Button 2 Features <span style="color: red">*</span></p></small>`;
        }

        html += `</div>
                                    <div class="col-2">
                                        <div id="closeCPAAS2-icon" onclick="resetCPAASIconModal('2','` + model + `')" class="close-icon bg-danger d-flex justify-content-center d-none" style="z-index: 10; width: 30px; height: 30px; border-radius: 50%; margin-left: -4px">
                                            <img src="close-round.png" style="width: 15px; height: 15px; border-radius: 20px; margin-top: 8px; filter: invert(1)">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <select id="cpaasContent-` + modelText + `2" class="form-select form-select-sm mb-2 mt-2" onchange="saveSelectMore('2','` + model + `')" onfocus="saveOldCPAASMoreValue('2','` + model + `')">`;

        if (localStorage.lang == 1) {
            html += `<option value="0">Pilih opsi anda</option>`;
        } else {
            html += `<option value="0">Select your option</option>`;
        }

        html += `<option ${ mobileConfiguration.get('fb2_content') == '_fb2' ? "selected" : "" } value="_fb2">Custom URL</option>
                                            <option ${ mobileConfiguration.get('fb2_content') == '_fb9' ? "selected" : "" } value="_fb9">Contact Center</option>
                                            <option ${ mobileConfiguration.get('fb2_content') == '_fb6' ? "selected" : "" } value="_fb6">Message</option>
                                            <option ${ mobileConfiguration.get('fb2_content') == '_fb7' ? "selected" : "" } value="_fb7">Call</option>
                                            <option ${ mobileConfiguration.get('fb2_content') == '_fb8' ? "selected" : "" } value="_fb8">Live Streaming</option>
                                            <option ${ mobileConfiguration.get('fb2_content') == '_fb3' ? "selected" : "" } value="_fb3">Notification Center</option>
                                            <option ${ mobileConfiguration.get('fb2_content') == '_fb11' ? "selected" : "" } value="_fb11">Call Audio</option>
                                            <option ${ mobileConfiguration.get('fb2_content') == '_fb12' ? "selected" : "" } value="_fb12">Call Video</option>
                                            <option ${ mobileConfiguration.get('fb2_content') == '_fb99' ? "selected" : "" } value="_fb99">Open Post</option>
                                        </select>
                                        <div id="subContent-2">`;

        // IF ALREADY SELECT SUB CONTENT BEFORE

        if (mobileConfiguration.get('fb2_url')) {

            html += `<div class="input-group flex-nowrap pt-2">
                            <input type="text" onchange="saveURLTemp('2')" value="${mobileConfiguration.get('fb2_url')}" id="customURL-2" class="form-control form-control-sm" placeholder="www.website.com" aria-label="Your URL" aria-describedby="addon-wrapping">
                        </div>`;

        }

        html += `</div>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                        <div id="cpaasIconDiv-` + modelText + `3" class="row mb-2" style="border-bottom: 1px solid #e5e5e5; margin-top: 10px !important; margin-bottom: 20px !important; padding-bottom: 10px !important">
                            <div class="col-5 d-flex justify-content-center">
                                <label for="cpaasIcon-` + modelText + `3">
                                    <img id="cpaasIconPreview-` + modelText + `3" src="${ mobileConfiguration.get('fb3_icon') ? mobileConfiguration.get('fb3_icon') : "empty-image.png" }" style="width: 100px; height: 100px; object-fit: cover; object-position: center; border-radius: 20px; border: 1px solid #ced4da">
                                </label>
                                <input id="cpaasIcon-` + modelText + `3" type="file" accept="image/*" class="d-none" onchange="changeCPAASIconMore('` + model + `','3')">                                
                            </div>
                            <div class="col-7 d-flex justify-content-center">
                                <div class="row">
                                    <div class="col-10">`;

        if (localStorage.lang == 1) {
            html += `<small>Fitur Tombol 3 <span style="color: red">*</span></p></small>`;
        } else {
            html += `<small>Button 3 Features <span style="color: red">*</span></p></small>`;
        }

        html += `</div>
                                    <div class="col-2">
                                        <div id="closeCPAAS3-icon" onclick="resetCPAASIconModal('3','` + model + `')" class="close-icon bg-danger d-flex justify-content-center d-none" style="z-index: 10; width: 30px; height: 30px; border-radius: 50%; margin-left: -4px">
                                            <img src="close-round.png" style="width: 15px; height: 15px; border-radius: 20px; margin-top: 8px; filter: invert(1)">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <select id="cpaasContent-` + modelText + `3" class="form-select form-select-sm mb-2 mt-2" onchange="saveSelectMore('3','` + model + `')" onfocus="saveOldCPAASMoreValue('3','` + model + `')">`;

        if (localStorage.lang == 1) {
            html += `<option value="0">Pilih opsi anda</option>`;
        } else {
            html += `<option value="0">Select your option</option>`;
        }

        html += `<option ${ mobileConfiguration.get('fb3_content') == '_fb2' ? "selected" : "" } value="_fb2">Custom URL</option>
                                            <option ${ mobileConfiguration.get('fb3_content') == '_fb9' ? "selected" : "" } value="_fb9">Contact Center</option>
                                            <option ${ mobileConfiguration.get('fb3_content') == '_fb6' ? "selected" : "" } value="_fb6">Message</option>
                                            <option ${ mobileConfiguration.get('fb3_content') == '_fb7' ? "selected" : "" } value="_fb7">Call</option>
                                            <option ${ mobileConfiguration.get('fb3_content') == '_fb8' ? "selected" : "" } value="_fb8">Live Streaming</option>
                                            <option ${ mobileConfiguration.get('fb3_content') == '_fb3' ? "selected" : "" } value="_fb3">Notification Center</option>
                                            <option ${ mobileConfiguration.get('fb3_content') == '_fb11' ? "selected" : "" } value="_fb11">Call Audio</option>
                                            <option ${ mobileConfiguration.get('fb3_content') == '_fb12' ? "selected" : "" } value="_fb12">Call Video</option>
                                            <option ${ mobileConfiguration.get('fb3_content') == '_fb99' ? "selected" : "" } value="_fb99">Open Post</option>
                                        </select>
                                        <div id="subContent-3">`;

        // IF ALREADY SELECT SUB CONTENT BEFORE

        if (mobileConfiguration.get('fb3_url')) {

            html += `<div class="input-group flex-nowrap pt-2">
                            <input type="text" onchange="saveURLTemp('3')" value="${mobileConfiguration.get('fb3_url')}" id="customURL-3" class="form-control form-control-sm" placeholder="www.website.com" aria-label="Your URL" aria-describedby="addon-wrapping">
                        </div>`;

        }

        html += `</div>
                                </div>
                            </div>
                        </div>
                    </div>

                        <div id="cpaasIconDiv-` + modelText + `4" class="row mb-2" style="border-bottom: 1px solid #e5e5e5; margin-top: 10px !important; margin-bottom: 20px !important; padding-bottom: 10px !important">
                            <div class="col-5 d-flex justify-content-center">
                                <label for="cpaasIcon-` + modelText + `4">
                                    <img id="cpaasIconPreview-` + modelText + `4" src="${ mobileConfiguration.get('fb4_icon') ? mobileConfiguration.get('fb4_icon') : "empty-image.png" }" style="width: 100px; height: 100px; object-fit: cover; object-position: center; border-radius: 20px; border: 1px solid #ced4da">
                                </label>
                                <input id="cpaasIcon-` + modelText + `4" type="file" accept="image/*" class="d-none" onchange="changeCPAASIconMore('` + model + `','4')">                                
                            </div>
                            <div class="col-7 d-flex justify-content-center">
                                <div class="row">
                                    <div class="col-10">`;

        if (localStorage.lang == 1) {
            html += `<small>Fitur Tombol 4 <span style="color: red">*</span></p></small>`;
        } else {
            html += `<small>Button 4 Features <span style="color: red">*</span></p></small>`;
        }

        html += `</div>
                                    <div class="col-2">
                                        <div id="closeCPAAS4-icon" onclick="resetCPAASIconModal('4','` + model + `')" class="close-icon bg-danger d-flex justify-content-center d-none" style="z-index: 10; width: 30px; height: 30px; border-radius: 50%; margin-left: -4px">
                                            <img src="close-round.png" style="width: 15px; height: 15px; border-radius: 20px; margin-top: 8px; filter: invert(1)">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <select id="cpaasContent-` + modelText + `4" class="form-select form-select-sm mb-2 mt-2" onchange="saveSelectMore('4','` + model + `')" onfocus="saveOldCPAASMoreValue('4','` + model + `')">`;

        if (localStorage.lang == 1) {
            html += `<option value="0">Pilih opsi anda</option>`;
        } else {
            html += `<option value="0">Select your option</option>`;
        }

        html += `<option ${ mobileConfiguration.get('fb4_content') == '_fb2' ? "selected" : "" } value="_fb2">Custom URL</option>
                                            <option ${ mobileConfiguration.get('fb4_content') == '_fb9' ? "selected" : "" } value="_fb9">Contact Center</option>
                                            <option ${ mobileConfiguration.get('fb4_content') == '_fb6' ? "selected" : "" } value="_fb6">Message</option>
                                            <option ${ mobileConfiguration.get('fb4_content') == '_fb7' ? "selected" : "" } value="_fb7">Call</option>
                                            <option ${ mobileConfiguration.get('fb4_content') == '_fb8' ? "selected" : "" } value="_fb8">Live Streaming</option>
                                            <option ${ mobileConfiguration.get('fb4_content') == '_fb3' ? "selected" : "" } value="_fb3">Notification Center</option>
                                            <option ${ mobileConfiguration.get('fb4_content') == '_fb11' ? "selected" : "" } value="_fb11">Call Audio</option>
                                            <option ${ mobileConfiguration.get('fb4_content') == '_fb12' ? "selected" : "" } value="_fb12">Call Video</option>
                                            <option ${ mobileConfiguration.get('fb4_content') == '_fb99' ? "selected" : "" } value="_fb99">Open Post</option>
                                        </select>
                                        <div id="subContent-4">`;

        // IF ALREADY SELECT SUB CONTENT BEFORE

        if (mobileConfiguration.get('fb4_url')) {

            html += `<div class="input-group flex-nowrap pt-2">
                            <input type="text" onchange="saveURLTemp('4')" value="${mobileConfiguration.get('fb4_url')}" id="customURL-4" class="form-control form-control-sm" placeholder="www.website.com" aria-label="Your URL" aria-describedby="addon-wrapping">
                        </div>`;

        }

        html += `</div>
                                </div>
                            </div>
                        </div>
                    </div>`;

        // LOOP IF FILE MORE THAN 4 DEFAULT

        // TOTALDIV FOR APPEND START FROM (DEFAULT IS 5)

        let totalDiv = 5;

        mobileConfiguration.forEach((values, keys) => {

            if (keys.includes('fb') && keys.includes('icon') && values != '') {

                // FILTER NUMBER FROM KEYS TO GET POSITION

                let position = keys.match(/\d+/)[0];

                if (position > 4) {

                    html += `<div id="cpaasIconDiv-` + modelText + position + `" class="row mb-2" style="border-bottom: 1px solid #e5e5e5; margin-top: 10px !important; margin-bottom: 20px !important; padding-bottom: 10px !important">
                                <div class="col-5 d-flex justify-content-center">
                                    <label for="cpaasIcon-` + modelText + position + `">
                                        <img id="cpaasIconPreview-` + modelText + position + `" src="${ mobileConfiguration.get('fb'+position+'_icon') ? mobileConfiguration.get('fb'+position+'_icon') : "empty-image.png" }" style="width: 100px; height: 100px; object-fit: cover; object-position: center; border-radius: 20px; border: 1px solid #ced4da">
                                    </label>
                                    <input id="cpaasIcon-` + modelText + position + `" type="file" accept="image/*" class="d-none" onchange="changeCPAASIconMore('` + model + `','` + position + `')">                                
                                </div>
                                <div class="col-7 d-flex justify-content-center">
                                    <div class="row">
                                        <div class="col-10">`;

                    if (localStorage.lang == 1) {
                        html += `<small>Fitur Tombol ` + totalDiv + ` <span style="color: red">*</span></p></small>`;
                    } else {
                        html += `<small>Button ` + totalDiv + ` Features <span style="color: red">*</span></p></small>`;
                    }

                    html += `</div>
                                        <div class="col-2">
                                            <div id="closeCPAAS` + position + `-icon" onclick="resetCPAASIconModal('` + position + `','` + model + `')" class="close-icon bg-danger d-flex justify-content-center d-none" style="z-index: 10; width: 30px; height: 30px; border-radius: 50%; margin-left: -4px">
                                                <img src="close-round.png" style="width: 15px; height: 15px; border-radius: 20px; margin-top: 8px; filter: invert(1)">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <select id="cpaasContent-` + modelText + position + `" class="form-select form-select-sm mb-2 mt-2" onchange="saveSelectMore('` + position + `','` + model + `')" onfocus="saveOldCPAASMoreValue('` + position + `','` + model + `')">`;

                    if (localStorage.lang == 1) {
                        html += `<option value="0">Pilih opsi anda</option>`;
                    } else {
                        html += `<option value="0">Select your option</option>`;
                    }

                    html += `<option ${mobileConfiguration.get('fb'+position+'_content') == "_fb2" ? "selected" : ""} value="_fb2">Custom URL</option>
                                                <option ${mobileConfiguration.get('fb'+position+'_content') == "_fb9" ? "selected" : ""} value="_fb9">Contact Center</option>
                                                <option ${mobileConfiguration.get('fb'+position+'_content') == "_fb6" ? "selected" : ""} value="_fb6">Message</option>
                                                <option ${mobileConfiguration.get('fb'+position+'_content') == "_fb7" ? "selected" : ""} value="_fb7">Call</option>
                                                <option ${mobileConfiguration.get('fb'+position+'_content') == "_fb8" ? "selected" : ""} value="_fb8">Live Streaming</option>
                                                <option ${mobileConfiguration.get('fb'+position+'_content') == "_fb3" ? "selected" : ""} value="_fb3">Notification Center</option>
                                                <option ${mobileConfiguration.get('fb'+position+'_content') == "_fb11" ? "selected" : ""} value="_fb11">Call Audio</option>
                                                <option ${mobileConfiguration.get('fb'+position+'_content') == "_fb12" ? "selected" : ""} value="_fb812">Call Video</option>
                                                <option ${mobileConfiguration.get('fb'+position+'_content') == "_fb99" ? "selected" : ""} value="_fb99">Open Post</option>
                                            </select>
                                            <div id="subContent-` + position + `">`;

                    // IF ALREADY SELECT SUB CONTENT BEFORE

                    if (mobileConfiguration.get('fb' + position + '_url')) {

                        html += `<div class="input-group flex-nowrap pt-2">
                                <input type="text" onchange="saveURLTemp('` + position + `')" value="${mobileConfiguration.get('fb'+position+'_url')}" id="customURL-` + position + `" class="form-control form-control-sm" placeholder="www.website.com" aria-label="Your URL" aria-describedby="addon-wrapping">
                            </div>`;

                    }

                    html += `</div>
                                    </div>
                                </div>
                            </div>
                        </div>`;

                    totalDiv = totalDiv + 1;

                }
            }

        });

        if (localStorage.lang == 1) {

            html += `<div id="div-addMore" class="row">
                            <div class="d-flex justify-content-center">
                                <button id="btn-addMore" class="btn btn-sm btn-outline-success w-75 text-center" onclick="addMoreAppend('` + model + `','` + totalDiv + `')">Tambah Lainnya</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                        <button type="button" class="btn btn-success" onclick="checkValidationModal('` + model + `')">Simpan perubahan</button>
                    </div>`;

        } else {

            html += `<div id="div-addMore" class="row">
                            <div class="d-flex justify-content-center">
                                <button id="btn-addMore" class="btn btn-sm btn-outline-success w-75 text-center" onclick="addMoreAppend('` + model + `','` + totalDiv + `')">Add More</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" onclick="checkValidationModal('` + model + `')">Save changes</button>
                    </div>`;

        }

        $('#modalCPAAS-content').html(html);

        setX(model);

        $('#modalCPAAS').modal('show');

        // COPY MOBILE CONFIGURATION TO TEMP FOR TEMP DUPLICATE CHECK LATER

        mobileConfiguration.forEach((values, keys) => {

            if (keys.includes('fb') && keys.includes('content')) {

                mapTemp.set(keys, mobileConfiguration.get(keys));
            }

        });

    }

    // FUNCTION ADD MORE CPAAS

    function openCPAASMoreBurger() {

        if (cannotChange() == 1) {
            return;
        }

        // DISABLE POP UP MODAL WHILE DISABLED (NOT FILL PREV FILE)

        if ($('#btnAddMore2').hasClass('disabled')) {

            let textDesc = '';

            if (localStorage.lang == 1) {
                textDesc = 'Harap isi tombol sebelumnya.';
            } else {
                textDesc = 'Please fill the previous button.';
            }

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: textDesc,
            })

            return;
        }

        var model = 3;

        let html = `<div class="modal-header">`;

        if (localStorage.lang == 1) {
            html += `<h6 class="modal-title">Konfigurasi Tombol Burger CPAAS</h6>`;
        } else {
            html += `<h6 class="modal-title">Configure CPAAS Burger Button</h6>`;
        }

        html += `<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div id="add-more-cpaas-body" class="modal-body">
                        <div id="cpaasIconDiv-Burger1" class="row mb-2" style="border-bottom: 1px solid #e5e5e5; margin-top: 10px !important; margin-bottom: 20px !important; padding-bottom: 10px !important">
                            <div class="col-12 d-flex justify-content-center">
                                <div class="row">
                                    <div class="col-10">`;

        if (localStorage.lang == 1) {
            html += `<small>Fitur Tombol 1 <span style="color: red">*</span></p></small>`;
        } else {
            html += `<small>Button 1 Features <span style="color: red">*</span></p></small>`;
        }

        html += `</div>
                                    <div class="col-2 d-flex justify-content-end">
                                        <div id="closeCPAAS1-icon" onclick="resetCPAASIconModal('1','3')" class="close-icon bg-danger d-flex justify-content-center d-none" style="z-index: 10; width: 30px; height: 30px; border-radius: 50%">
                                            <img src="close-round.png" style="width: 15px; height: 15px; border-radius: 20px; margin-top: 8px; filter: invert(1)">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <select id="cpaasContent-Burger1" class="form-select form-select-sm mb-2 mt-2" onchange="saveSelectMore('1','3')" onfocus="saveOldCPAASMoreValue('1','3')">`;

        if (localStorage.lang == 1) {
            html += `<option value="0">Pilih opsi anda</option>`;
        } else {
            html += `<option value="0">Select your option</option>`;
        }

        html += `<option ${ mobileConfiguration.get('fb1_content') == '_fb2' ? "selected" : "" } value="_fb2">Custom URL</option>
                                            <option ${ mobileConfiguration.get('fb1_content') == '_fb9' ? "selected" : "" } value="_fb9">Contact Center</option>
                                            <option ${ mobileConfiguration.get('fb1_content') == '_fb6' ? "selected" : "" } value="_fb6">Message</option>
                                            <option ${ mobileConfiguration.get('fb1_content') == '_fb7' ? "selected" : "" } value="_fb7">Call</option>
                                            <option ${ mobileConfiguration.get('fb1_content') == '_fb8' ? "selected" : "" } value="_fb8">Live Streaming</option>
                                            <option ${ mobileConfiguration.get('fb1_content') == '_fb3' ? "selected" : "" } value="_fb3">Notification Center</option>
                                            <option ${ mobileConfiguration.get('fb1_content') == '_fb11' ? "selected" : "" } value="_fb11">Call Audio</option>
                                            <option ${ mobileConfiguration.get('fb1_content') == '_fb12' ? "selected" : "" } value="_fb12">Call Video</option>
                                            <option ${ mobileConfiguration.get('fb1_content') == '_fb99' ? "selected" : "" } value="_fb99">Open Post</option>
                                        </select>
                                        <div id="subContent-1">`;

        // IF ALREADY SELECT SUB CONTENT BEFORE

        if (mobileConfiguration.get('fb1_url')) {

            html += `<div class="input-group flex-nowrap pt-2">
                            <input type="text" onchange="saveURLTemp('1')" value="${mobileConfiguration.get('fb1_url')}" id="customURL-1" class="form-control form-control-sm" placeholder="www.website.com" aria-label="Your URL" aria-describedby="addon-wrapping">
                        </div>`;

        }

        html += `</div>
                                </div>
                            </div>
                        </div>
                    </div>

                        <div id="cpaasIconDiv-Burger2" class="row mb-2" style="border-bottom: 1px solid #e5e5e5; margin-top: 10px !important; margin-bottom: 20px !important; padding-bottom: 10px !important">
                            <div class="col-12 d-flex justify-content-center">
                                <div class="row">
                                    <div class="col-10">`;

        if (localStorage.lang == 1) {
            html += `<small>Fitur Tombol 2 <span style="color: red">*</span></p></small>`;
        } else {
            html += `<small>Button 2 Features <span style="color: red">*</span></p></small>`;
        }

        html += `</div>
                                    <div class="col-2 d-flex justify-content-end">
                                        <div id="closeCPAAS2-icon" onclick="resetCPAASIconModal('2','3')" class="close-icon bg-danger d-flex justify-content-center d-none" style="z-index: 10; width: 30px; height: 30px; border-radius: 50%">
                                            <img src="close-round.png" style="width: 15px; height: 15px; border-radius: 20px; margin-top: 8px; filter: invert(1)">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <select id="cpaasContent-Burger2" class="form-select form-select-sm mb-2 mt-2" onchange="saveSelectMore('2','3')" onfocus="saveOldCPAASMoreValue('2','3')">`;

        if (localStorage.lang == 1) {
            html += `<option value="0">Pilih opsi anda</option>`;
        } else {
            html += `<option value="0">Select your option</option>`;
        }

        html += `<option ${ mobileConfiguration.get('fb2_content') == '_fb2' ? "selected" : "" } value="_fb2">Custom URL</option>
                                            <option ${ mobileConfiguration.get('fb2_content') == '_fb9' ? "selected" : "" } value="_fb9">Contact Center</option>
                                            <option ${ mobileConfiguration.get('fb2_content') == '_fb6' ? "selected" : "" } value="_fb6">Message</option>
                                            <option ${ mobileConfiguration.get('fb2_content') == '_fb7' ? "selected" : "" } value="_fb7">Call</option>
                                            <option ${ mobileConfiguration.get('fb2_content') == '_fb8' ? "selected" : "" } value="_fb8">Live Streaming</option>
                                            <option ${ mobileConfiguration.get('fb2_content') == '_fb3' ? "selected" : "" } value="_fb3">Notification Center</option>
                                            <option ${ mobileConfiguration.get('fb2_content') == '_fb11' ? "selected" : "" } value="_fb11">Call Audio</option>
                                            <option ${ mobileConfiguration.get('fb2_content') == '_fb12' ? "selected" : "" } value="_fb12">Call Video</option>
                                            <option ${ mobileConfiguration.get('fb2_content') == '_fb99' ? "selected" : "" } value="_fb99">Open Post</option>
                                        </select>
                                        <div id="subContent-2">`;

        // IF ALREADY SELECT SUB CONTENT BEFORE

        if (mobileConfiguration.get('fb2_url')) {

            html += `<div class="input-group flex-nowrap pt-2">
                                <input type="text" onchange="saveURLTemp('2')" value="${mobileConfiguration.get('fb2_url')}" id="customURL-2" class="form-control form-control-sm" placeholder="www.website.com" aria-label="Your URL" aria-describedby="addon-wrapping">
                            </div>`;

        }

        html += `</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div id="cpaasIconDiv-Burger3" class="row mb-2" style="border-bottom: 1px solid #e5e5e5; margin-top: 10px !important; margin-bottom: 20px !important; padding-bottom: 10px !important">
                            <div class="col-12 d-flex justify-content-center">
                                <div class="row">
                                    <div class="col-10">`;

        if (localStorage.lang == 1) {
            html += `<small>Fitur Tombol 3 <span style="color: red">*</span></p></small>`;
        } else {
            html += `<small>Button 3 Features <span style="color: red">*</span></p></small>`;
        }

        html += `</div>
                                    <div class="col-2 d-flex justify-content-end">
                                        <div id="closeCPAAS3-icon" onclick="resetCPAASIconModal('3','3')" class="close-icon bg-danger d-flex justify-content-center d-none" style="z-index: 10; width: 30px; height: 30px; border-radius: 50%">
                                            <img src="close-round.png" style="width: 15px; height: 15px; border-radius: 20px; margin-top: 8px; filter: invert(1)">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <select id="cpaasContent-Burger3" class="form-select form-select-sm mb-2 mt-2" onchange="saveSelectMore('3','3')" onfocus="saveOldCPAASMoreValue('3','3')">`;

        if (localStorage.lang == 1) {
            html += `<option value="0">Pilih opsi anda</option>`;
        } else {
            html += `<option value="0">Select your option</option>`;
        }

        html += `<option ${ mobileConfiguration.get('fb3_content') == '_fb2' ? "selected" : "" } value="_fb2">Custom URL</option>
                                            <option ${ mobileConfiguration.get('fb3_content') == '_fb9' ? "selected" : "" } value="_fb9">Contact Center</option>
                                            <option ${ mobileConfiguration.get('fb3_content') == '_fb6' ? "selected" : "" } value="_fb6">Message</option>
                                            <option ${ mobileConfiguration.get('fb3_content') == '_fb7' ? "selected" : "" } value="_fb7">Call</option>
                                            <option ${ mobileConfiguration.get('fb3_content') == '_fb8' ? "selected" : "" } value="_fb8">Live Streaming</option>
                                            <option ${ mobileConfiguration.get('fb3_content') == '_fb3' ? "selected" : "" } value="_fb3">Notification Center</option>
                                            <option ${ mobileConfiguration.get('fb3_content') == '_fb11' ? "selected" : "" } value="_fb11">Call Audio</option>
                                            <option ${ mobileConfiguration.get('fb3_content') == '_fb12' ? "selected" : "" } value="_fb12">Call Video</option>
                                            <option ${ mobileConfiguration.get('fb3_content') == '_fb99' ? "selected" : "" } value="_fb99">Open Post</option>
                                        </select>
                                        <div id="subContent-3">`;

        // IF ALREADY SELECT SUB CONTENT BEFORE

        if (mobileConfiguration.get('fb3_url')) {

            html += `<div class="input-group flex-nowrap pt-2">
                                <input type="text" onchange="saveURLTemp('3')" value="${mobileConfiguration.get('fb3_url')}" id="customURL-3" class="form-control form-control-sm" placeholder="www.website.com" aria-label="Your URL" aria-describedby="addon-wrapping">
                            </div>`;

        }

        html += `</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="cpaasIconDiv-Burger4" class="row mb-2" style="border-bottom: 1px solid #e5e5e5; margin-top: 10px !important; margin-bottom: 20px !important; padding-bottom: 10px !important">
                            <div class="col-12 d-flex justify-content-center">
                                <div class="row">
                                    <div class="col-10">`;

        if (localStorage.lang == 1) {
            html += `<small>Fitur Tombol 4 <span style="color: red">*</span></p></small>`;
        } else {
            html += `<small>Button 4 Features <span style="color: red">*</span></p></small>`;
        }

        html += `</div>
                                    <div class="col-2 d-flex justify-content-end">
                                        <div id="closeCPAAS4-icon" onclick="resetCPAASIconModal('4','3')" class="close-icon bg-danger d-flex justify-content-center d-none" style="z-index: 10; width: 30px; height: 30px; border-radius: 50%">
                                            <img src="close-round.png" style="width: 15px; height: 15px; border-radius: 20px; margin-top: 8px; filter: invert(1)">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <select id="cpaasContent-Burger4" class="form-select form-select-sm mb-2 mt-2" onchange="saveSelectMore('4','3')" onfocus="saveOldCPAASMoreValue('4','3')">`;

        if (localStorage.lang == 1) {
            html += `<option value="0">Pilih opsi anda</option>`;
        } else {
            html += `<option value="0">Select your option</option>`;
        }

        html += `<option ${ mobileConfiguration.get('fb4_content') == '_fb2' ? "selected" : "" } value="_fb2">Custom URL</option>
                                            <option ${ mobileConfiguration.get('fb4_content') == '_fb9' ? "selected" : "" } value="_fb9">Contact Center</option>
                                            <option ${ mobileConfiguration.get('fb4_content') == '_fb6' ? "selected" : "" } value="_fb6">Message</option>
                                            <option ${ mobileConfiguration.get('fb4_content') == '_fb7' ? "selected" : "" } value="_fb7">Call</option>
                                            <option ${ mobileConfiguration.get('fb4_content') == '_fb8' ? "selected" : "" } value="_fb8">Live Streaming</option>
                                            <option ${ mobileConfiguration.get('fb4_content') == '_fb3' ? "selected" : "" } value="_fb3">Notification Center</option>
                                            <option ${ mobileConfiguration.get('fb4_content') == '_fb11' ? "selected" : "" } value="_fb11">Call Audio</option>
                                            <option ${ mobileConfiguration.get('fb4_content') == '_fb12' ? "selected" : "" } value="_fb12">Call Video</option>
                                            <option ${ mobileConfiguration.get('fb4_content') == '_fb99' ? "selected" : "" } value="_fb99">Open Post</option>
                                        </select>
                                        <div id="subContent-4">`;

        // IF ALREADY SELECT SUB CONTENT BEFORE

        if (mobileConfiguration.get('fb4_url')) {

            html += `<div class="input-group flex-nowrap pt-2">
                                <input type="text" onchange="saveURLTemp('4')" value="${mobileConfiguration.get('fb4_url')}" id="customURL-4" class="form-control form-control-sm" placeholder="www.website.com" aria-label="Your URL" aria-describedby="addon-wrapping">
                            </div>`;

        }

        html += `</div>
                                    </div>
                                </div>
                            </div>
                        </div>`;

        // LOOP IF FILE MORE THAN 4 DEFAULT

        // TOTALDIV FOR APPEND START FROM (DEFAULT IS 5)

        let totalDiv = 5;

        mobileConfiguration.forEach((values, keys) => {

            if (keys.includes('fb') && keys.includes('content') && values != '') {

                // FILTER NUMBER FROM KEYS TO GET POSITION

                let position = keys.match(/\d+/)[0];

                if (position > 4) {

                    html += `<div id="cpaasIconDiv-Burger` + position + `" class="row mb-2" style="border-bottom: 1px solid #e5e5e5; margin-top: 10px !important; margin-bottom: 20px !important; padding-bottom: 10px !important">
                                <div class="col-12 d-flex justify-content-center">
                                    <div class="row">
                                        <div class="col-10">`;

                    if (localStorage.lang == 1) {
                        html += `<small>Fitur Tombol ` + totalDiv + ` <span style="color: red">*</span></p></small>`;
                    } else {
                        html += `<small>Button ` + totalDiv + ` Features <span style="color: red">*</span></p></small>`;
                    }

                    html += `</div>
                                        <div class="col-2 d-flex justify-content-end">
                                            <div id="closeCPAAS` + position + `-icon" onclick="resetCPAASIconModal('` + position + `','3')" class="close-icon bg-danger d-flex justify-content-center d-none" style="z-index: 10; width: 30px; height: 30px; border-radius: 50%">
                                                <img src="close-round.png" style="width: 15px; height: 15px; border-radius: 20px; margin-top: 8px; filter: invert(1)">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <select id="cpaasContent-Burger` + position + `" class="form-select form-select-sm mb-2 mt-2" onchange="saveSelectMore('` + position + `','3')" onfocus="saveOldCPAASMoreValue('` + position + `','3')">`;

                    if (localStorage.lang == 1) {
                        html += `<option value="0">Pilih opsi anda</option>`;
                    } else {
                        html += `<option value="0">Select your option</option>`;
                    }

                    html += `<option ${mobileConfiguration.get('fb'+position+'_content') == "_fb2" ? "selected" : ""} value="_fb2">Custom URL</option>
                                                <option ${mobileConfiguration.get('fb'+position+'_content') == "_fb9" ? "selected" : ""} value="_fb9">Contact Center</option>
                                                <option ${mobileConfiguration.get('fb'+position+'_content') == "_fb6" ? "selected" : ""} value="_fb6">Message</option>
                                                <option ${mobileConfiguration.get('fb'+position+'_content') == "_fb7" ? "selected" : ""} value="_fb7">Call</option>
                                                <option ${mobileConfiguration.get('fb'+position+'_content') == "_fb8" ? "selected" : ""} value="_fb8">Live Streaming</option>
                                                <option ${mobileConfiguration.get('fb'+position+'_content') == "_fb3" ? "selected" : ""} value="_fb3">Notification Center</option>
                                                <option ${mobileConfiguration.get('fb'+position+'_content') == "_fb11" ? "selected" : ""} value="_fb11">Call Audio</option>
                                                <option ${mobileConfiguration.get('fb'+position+'_content') == "_fb12" ? "selected" : ""} value="_fb812">Call Video</option>
                                                <option ${mobileConfiguration.get('fb'+position+'_content') == "_fb99" ? "selected" : ""} value="_fb99">Open Post</option>
                                            </select>
                                             <div id="subContent-` + position + `">`;

                    // IF ALREADY SELECT SUB CONTENT BEFORE

                    if (mobileConfiguration.get('fb' + position + '_url')) {

                        html += `<div class="input-group flex-nowrap pt-2">
                                    <input type="text" onchange="saveURLTemp('` + position + `')" value="${mobileConfiguration.get('fb'+position+'_url')}" id="customURL-` + position + `" class="form-control form-control-sm" placeholder="www.website.com" aria-label="Your URL" aria-describedby="addon-wrapping">
                                </div>`;

                    }

                    html += `</div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;

                    totalDiv = totalDiv + 1;

                }
            }
        });

        if (localStorage.lang == 1) {

            html += `<div id="div-addMore" class="row">
                            <div class="d-flex justify-content-center">
                                <button id="btn-addMore" class="btn btn-sm btn-outline-success w-75 text-center" onclick="addMoreAppend('` + model + `','` + totalDiv + `')">Tambah Lainnya</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                        <button type="button" class="btn btn-success" onclick="checkValidationModal('` + model + `')">Simpan perubahan</button>
                    </div>`;

        } else {

            html += `<div id="div-addMore" class="row">
                            <div class="d-flex justify-content-center">
                                <button id="btn-addMore" class="btn btn-sm btn-outline-success w-75 text-center" onclick="addMoreAppend('` + model + `','` + totalDiv + `')">Add More</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" onclick="checkValidationModal('` + model + `')">Save changes</button>
                    </div>`;

        }

        $('#modalCPAAS-content').html(html);

        $('#modalCPAAS').modal('show');

        setX('3');

        // COPY MOBILE CONFIGURATION TO TEMP FOR TEMP DUPLICATE CHECK LATER

        mobileConfiguration.forEach((values, keys) => {

            if (keys.includes('fb') && keys.includes('content')) {

                mapTemp.set(keys, mobileConfiguration.get(keys));
            }

        });

    }

    // CHANGE MAIN CPAAS ICON

    function changeCPAASMainIcon(model) {

        let source = '';
        let name = '';

        if (model == 1) {
            source = $("#cpaasIcon-Floating")[0].files[0];
            name = $("#cpaasIcon-Floating")[0].files[0].name;
        } else if (model == 2) {
            source = $("#cpaasIcon-Docked")[0].files[0];
            name = $("#cpaasIcon-Docked")[0].files[0].name;
        }

        if (source) {
            let reader = new FileReader();

            reader.onload = function() {

                let base64_bg = reader.result;

                if (model == 1) {

                    $("#cpaasMainFloating-icon").attr("src", base64_bg);
                    $('#closeFloatingMain-icon').removeClass('d-none');

                } else if (model == 2) {

                    $("#cpaasMainDocked-icon").attr("src", base64_bg);
                    $('#closeDockedMain-icon').removeClass('d-none');

                }

                mobileConfiguration.set('cpaas_icon', reader.result);

            }

            reader.readAsDataURL(source);

        }
    }

    // APPEND CPAAS ICON ON MODAL 

    function addMoreAppend(model, position) {

        var modelText = '';

        if (model == 1) {
            modelText = 'Floating';
        } else if (model == 2) {
            modelText = 'Docked';
        } else if (model == 3) {
            modelText = 'Burger';
        }

        // DISABLE POP UP MODAL WHILE DISABLED (NOT FILL PREV FILE)

        if ($('#btn-addMore').hasClass('disabled')) {
            return;
        } else {
            $('#btn-addMore').addClass('disabled');
        }

        if (model == 3) {

            var html = `<div id="cpaasIconDiv-` + modelText + position + `" class="row mb-2" style="border-bottom: 1px solid #e5e5e5; margin-top: 10px !important; margin-bottom: 20px !important; padding-bottom: 10px !important">
                            <div class="col-12 d-flex justify-content-center">
                                <div class="row">
                                    <div class="col-10">`;

            if (localStorage.lang == 1) {
                html += `<small>Fitur Tombol ` + position + ` <span style="color: red">*</span></p></small>`;
            } else {
                html += `<small>Button ` + position + ` Features <span style="color: red">*</span></p></small>`;
            }

            html += `</div>
                                    <div class="col-2 d-flex justify-content-end">
                                        <div id="closeCPAAS` + position + `-icon" onclick="resetCPAASIconModal('` + position + `','3')" class="close-icon bg-danger d-flex justify-content-center d-none" style="z-index: 10; width: 30px; height: 30px; border-radius: 50%">
                                            <img src="close-round.png" style="width: 15px; height: 15px; border-radius: 20px; margin-top: 8px; filter: invert(1)">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <select id="cpaasContent-` + modelText + position + `" class="form-select form-select-sm mb-2 mt-2" onchange="saveSelectMore('` + position + `','3')" onfocus="saveOldCPAASMoreValue('` + position + `','3')">`;

            if (localStorage.lang == 1) {
                html += `<option value="0">Pilih opsi anda</option>`;
            } else {
                html += `<option value="0">Select your option</option>`;
            }

            html += `<option value="_fb2">Custom URL</option>        
                                            <option value="_fb9">Contact Center</option>
                                            <option value="_fb6">Message</option>
                                            <option value="_fb7">Call</option>
                                            <option value="_fb8">Live Streaming</option>
                                            <option value="_fb3">Notification Center</option>
                                            <option value="_fb11">Call Audio</option>
                                            <option value="_fb12">Call Video</option>
                                            <option value="_fb99">Open Post</option>
                                        </select>
                                        <div id="subContent-` + position + `">`;

            // IF ALREADY SELECT SUB CONTENT BEFORE

            if (mobileConfiguration.get('fb' + position + '_url')) {

                html += `<div class="input-group flex-nowrap pt-2">
                                <input type="text" onchange="saveURLTemp('` + position + `')" value="${mobileConfiguration.get('fb'+position+'_url')}" id="customURL-` + position + `" class="form-control form-control-sm" placeholder="www.website.com" aria-label="Your URL" aria-describedby="addon-wrapping">
                            </div>`;

            }

            html += `</div>
                                    </div>
                                </div>
                            </div>`;

        } else {

            var html = `<div id="cpaasIconDiv-` + modelText + position + `" class="row mb-2" style="border-bottom: 1px solid #e5e5e5; margin-top: 10px !important; margin-bottom: 20px !important; padding-bottom: 10px !important">
                            <div class="col-5 d-flex justify-content-center">
                                <label for="cpaasIcon-` + modelText + position + `">
                                    <img id="cpaasIconPreview-` + modelText + position + `" src="${ mobileConfiguration.get('fb'+position+'_icon') ? mobileConfiguration.get('fb'+position+'_icon') : "empty-image.png" }" style="width: 100px; height: 100px; object-fit: cover; object-position: center; border-radius: 20px; border: 1px solid #ced4da">
                                </label>
                                <input id="cpaasIcon-` + modelText + position + `" type="file" accept="image/*" class="d-none" onchange="changeCPAASIconMore('` + model + `','` + position + `')">                                
                            </div>
                            <div class="col-7 d-flex justify-content-center">
                                <div class="row">
                                    <div class="col-10">`;

            if (localStorage.lang == 1) {
                html += `<small>Fitur Tombol ` + position + ` <span style="color: red">*</span></p></small>`;
            } else {
                html += `<small>Button ` + position + ` Features <span style="color: red">*</span></p></small>`;
            }

            html += `</div>
                                    <div class="col-2">
                                        <div id="closeCPAAS` + position + `-icon" onclick="resetCPAASIconModal('` + position + `','` + model + `')" class="close-icon bg-danger d-flex justify-content-center d-none" style="z-index: 10; width: 30px; height: 30px; border-radius: 50%; margin-left: -4px">
                                            <img src="close-round.png" style="width: 15px; height: 15px; border-radius: 20px; margin-top: 8px; filter: invert(1)">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <select id="cpaasContent-` + modelText + position + `" class="form-select form-select-sm mb-2 mt-2" onchange="saveSelectMore('` + position + `','` + model + `')" onfocus="saveOldCPAASMoreValue('` + position + `','` + model + `')">`;

            if (localStorage.lang == 1) {
                html += `<option value="0">Pilih opsi anda</option>`;
            } else {
                html += `<option value="0">Select your option</option>`;
            }

            html += `<option value="_fb2">Custom URL</option>        
                                            <option value="_fb9">Contact Center</option>
                                            <option value="_fb6">Message</option>
                                            <option value="_fb7">Call</option>
                                            <option value="_fb8">Live Streaming</option>
                                            <option value="_fb3">Notification Center</option>
                                            <option value="_fb11">Call Audio</option>
                                            <option value="_fb12">Call Video</option>
                                            <option value="_fb99">Open Post</option>
                                        </select>
                                        <div id="subContent-` + position + `">`;

            // IF ALREADY SELECT SUB CONTENT BEFORE

            if (mobileConfiguration.get('fb' + position + '_url')) {

                html += `<div class="input-group flex-nowrap pt-2">
                                <input type="text" onchange="saveURLTemp('` + position + `')" value="${mobileConfiguration.get('fb'+position+'_url')}" id="customURL-` + position + `" class="form-control form-control-sm" placeholder="www.website.com" aria-label="Your URL" aria-describedby="addon-wrapping">
                            </div>`;

            }

            html += `</div>
                                    </div>
                                </div>
                            </div>`;

        }

        $('#add-more-cpaas-body').append(html);
        $('#btn-addMore').attr('onclick', 'addMoreAppend("' + model + '","' + (parseInt(position) + 1) + '")');
        $('#div-addMore').insertAfter('#cpaasIconDiv-' + modelText + (parseInt(position)));

    }

    // SAVE SELECT TO TEMP MAP WHILE CHANGING IN ADD MORE CPAAS MODAL

    function saveSelectMore(position, model) {

        var modelText = '';

        if (model == 1) {
            modelText = 'Floating';
        } else if (model == 2) {
            modelText = 'Docked';
        } else if (model == 3) {
            modelText = 'Burger';
        }

        // CHECK FOR DUPLICATE

        let FBContent = "";

        if (model == 3) {
            FBContent = $('#cpaasContent-Burger' + position).val();
        } else {
            FBContent = $('#cpaasContent-' + modelText + position).val();
        }

        if (checkDuplicateFBModal(FBContent) == 1) {

            let textDesc = '';

            if (localStorage.lang == 1) {
                textDesc = 'CPAAS Konten Duplikat.';
            } else {
                textDesc = 'Duplicate CPAAS Content.';
            }

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: textDesc,
            })

            if (localStorage.getItem('old_cpaas') == 0) {

                $('#cpaasContent-' + modelText + position).val(0);

            } else {

                $('#cpaasContent-' + modelText + position).val(localStorage.getItem('old_cpaas'));

            }

            // SET MAPTEMP TO NULL FOR PREVENT DUPLICATE

            // mapTemp.set('fb'+position+'_content','');

            return;
        }

        // APPEAR DELETE X BUTTON

        // IF NOT SET (NEW) OR NOT NULL (AFTER DELETE) MAKE A MOVE FOR X

        if ((!mobileConfiguration.has('fb' + position + '_content') || mobileConfiguration.get('fb' + position + '_content') == '') || (!mapTemp.has('fb' + position + '_content') || mapTemp.get('fb' + position + '_content') == '')) {

            $('#closeCPAAS' + position + '-icon').removeClass('d-none');
            $('#closeCPAAS' + (parseInt(position) - 1) + '-icon').addClass('d-none');

        }

        var value = $('#cpaasContent-' + modelText + position).val();
        mapTemp.set('fb' + position + '_content', value);

        if (value == '_fb2') {
            checkURLMore(position, model);
        } else {
            $('#customURL-' + position).addClass('d-none');
        }

        checkFillAddMore(position, model);

    }

    // SAVE MODAL ADD MORE CPAAS 

    function checkValidationModal(model) {

        let isValidate = [];

        mapTemp.forEach((values, keys) => {

            let position = keys.match(/\d+/)[0];

            // IF FLOATING, ADD IMAGE VALIDATION

            if (model != 3) {

                if (!mapTemp.has('fb' + position + '_icon')) {

                    isValidate.push(false);

                }

            }

            // IF NULL OF NOT SELECTED DROPDOWN

            if (values == '0' || !mapTemp.has('fb' + position + '_content')) {

                isValidate.push(false);

            } else {

                // FOR URL CONTENT VALIDATION

                if (values == '_fb2') {

                    let position = keys.match(/\d+/)[0];
                    let url = $('#customURL-' + position).val();

                    if (url) {

                        isValidate.push(true);

                    } else {

                        isValidate.push(false);

                    }

                } else {

                    isValidate.push(true);

                }

            }

        });

        if (!isValidate.includes(false)) {

            saveAddMoreCPAAS(model);

        } else {

            let textDesc = '';

            if (localStorage.lang == 1) {
                textDesc = 'Harap isi semua isian.';
            } else {
                textDesc = 'Please fill all the required fields.';
            }

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: textDesc,
            })

        }

    }

    // SAVE ALL ADD MORE CPAASS IN MODAL

    function saveAddMoreCPAAS(model) {

        var modelText = '';

        if (model == 1) {
            modelText = 'Floating';
        } else if (model == 2) {
            modelText = 'Docked';
        } else if (model == 3) {
            modelText = 'Burger';
        }

        var position = "";

        // MOVE ALL TEMP TO REAL MAP

        mapTemp.forEach((values, keys) => {

            // FILTER NUMBER FROM KEYS TO GET POSITION

            position = keys.match(/\d+/)[0];

            if (model == 3) {

                var textValue = mapTemp.get('fb' + position + '_content');

                if (textValue == '') {

                    $('#burger-content-' + position).text('+');

                } else {

                    $('#burger-content-' + position).text(translateBurger(textValue));

                }

                mobileConfiguration.set(keys, mapTemp.get(keys));

            } else {

                // SET SELECT CHOOSEN

                mobileConfiguration.set(keys, mapTemp.get(keys));

                // SET ICON CHOOSEN

                let tempIcon = mapTemp.get('fb' + position + '_icon');

                if (tempIcon == '') {

                    $("#cpaas" + modelText + position + '-icon').attr("src", 'empty-image.png');

                } else {

                    $("#cpaas" + modelText + position + '-icon').attr("src", tempIcon);

                }

            }

        });

        // FOR DISSAPEAR ALL X IN MAIN PHONE AND SET X IN LAST FB

        if (model == 3) {

            $('#closeBurger1-icon').addClass('d-none');
            $('#closeBurger2-icon').addClass('d-none');
            $('#closeBurger3-icon').addClass('d-none');
            $('#closeBurger4-icon').addClass('d-none');

            setX('3');

        } else if (model == 2) {

            $('#closeDocked1-icon').addClass('d-none');
            $('#closeDocked2-icon').addClass('d-none');
            $('#closeDocked3-icon').addClass('d-none');
            $('#closeDocked4-icon').addClass('d-none');

            setX('2');

        } else if (model == 1) {

            $('#closeFloating1-icon').addClass('d-none');
            $('#closeFloating2-icon').addClass('d-none');
            $('#closeFloating3-icon').addClass('d-none');
            $('#closeFloating4-icon').addClass('d-none');

            setX('1');

        }

        $('#modalCPAAS').modal('hide');

    }

    // FUNCTION TRANSLATE VALUE TO WORDING FOR BURGER

    function translateBurger(number) {

        console.log(number);

        if (number == '_fb2') {
            return 'Custom URL';
        } else if (number == '_fb9') {
            return 'Contact Center';
        } else if (number == '_fb6') {
            return 'Message';
        } else if (number == '_fb7') {
            return 'Call';
        } else if (number == '_fb8') {
            return 'Live Streaming';
        } else if (number == '_fb3') {
            return 'Notification Center';
        } else if (number == '_fb11') {
            return 'Call Audio';
        } else if (number == '_fb12') {
            return 'Call Video';
        } else if (number == '_fb99') {
            return 'Open Post';
        }

    }

    // FUNCTION TO CHECK IS URL IN CPAAS

    function checkURL(position, model) {

        // CHECK FOR DUPLICATE

        let FBContent = "";

        if (model == 3) {
            FBContent = $('#tabContentBurger-' + position).val();
        } else {
            FBContent = $('#cpaasContent-' + position).val();
        }

        if (checkDuplicateFB(FBContent) == 1) {

            let textDesc = '';

            if (localStorage.lang == 1) {
                textDesc = 'CPAAS Konten Duplikat.';
            } else {
                textDesc = 'Duplicate CPAAS Content.';
            }

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: textDesc,
            })

            if (localStorage.getItem('old_cpaas') == 0) {

                if (model == 3) {
                    $('#tabContentBurger-' + position).val(0);
                } else {
                    $('#cpaasContent-' + position).val(0);
                }

            } else {
                if (model == 3) {
                    $('#tabContentBurger-' + position).val(localStorage.getItem('old_cpaas'));
                } else {
                    $('#cpaasContent-' + position).val(localStorage.getItem('old_cpaas'));
                }

            }


            return;
        }

        if ($('#cpaasContent-' + position).val() == '_fb2' || $('#tabContentBurger-' + position).val() == '_fb2') {

            let html = '';

            if (localStorage.lang == 1) {

                html = `<small>URL Anda <span style="color: red">*</span></small>
                        <div class="input-group flex-nowrap pt-2">
                            <input type="text" id="customURL-` + position + `" class="form-control form-control-sm" placeholder="www.website.com" aria-label="Your URL" aria-describedby="addon-wrapping">
                        </div>`;

            } else {

                html = `<small>Your URL <span style="color: red">*</span></small>
                        <div class="input-group flex-nowrap pt-2">
                            <input type="text" id="customURL-` + position + `" class="form-control form-control-sm" placeholder="www.website.com" aria-label="Your URL" aria-describedby="addon-wrapping">
                        </div>`;

            }

            $('#subContent-' + position).html(html);

        } else {

            $('#subContent-' + position).html("");

        }

    }

    // FUNCTION TO CHECK IS URL IN CPAAS IN MODAL ADD MORE

    function checkURLMore(position, model) {

        var modelText = '';

        if (model == 1) {
            modelText = 'Floating';
        } else if (model == 2) {
            modelText = 'Docked';
        } else if (model == 3) {
            modelText = 'Burger';
        }

        if ($('#cpaasContent-' + modelText + position).val() == '_fb2') {

            var html = `<div class="input-group flex-nowrap pt-2">
                            <input type="text" onchange="saveURLTemp('` + position + `')" id="customURL-` + position + `" class="form-control form-control-sm" placeholder="www.website.com" aria-label="Your URL" aria-describedby="addon-wrapping">
                        </div>`;

            $('#subContent-' + position).html(html);

        } else {

            $('#subContent-' + position).html("");

            mapTemp.set('fb' + position + '_url', '');

        }

    }

    // SAVE URL ON MODAL ADD MORE

    function saveURLTemp(position) {

        let url = $('#customURL-' + position).val();

        mapTemp.set('fb' + position + '_url', url);

    }

    // CLEAR ALL TAB AND CPAAS ICON WHILE SWITCHING MODE

    function clearTabAndCPAAS(modelFrom) {

        mobileConfiguration.clear();
        mapTemp.clear();

        mobileConfiguration.set('access_model', parseInt(modelFrom - 1).toString());

        for (var i = 1; i <= 6; i++) {
            $('#tab' + i + 'Floating-icon').attr('src', 'empty-image.png');
        }

        for (var i = 1; i <= 6; i++) {
            $('#tab' + i + 'Docked-icon').attr('src', 'empty-image.png');
        }

        for (var i = 1; i <= 6; i++) {
            $('#tab' + i + 'Burger-icon').attr('src', 'empty-image.png');
        }

        for (var i = 1; i <= 4; i++) {
            $('#cpaasFloating' + i + '-icon').attr('src', 'empty-image.png');
        }

        for (var i = 1; i <= 4; i++) {
            $('#cpaasDocked' + i + '-icon').attr('src', 'empty-image.png');
        }

        for (var i = 1; i <= 4; i++) {
            $('#burger-content-' + i).text("+");
        }

        $('#cpaasMainFloating-icon').attr('src', 'empty-image.png');
        $('#cpaasMainDocked-icon').attr('src', 'empty-image.png');

        // RESET BG

        $('#background-section').css('margin-top', '');
        $('#background-section').css('height', '');
        $("#bgPreviewFloating").attr("src", 'upload-image.png');
        $("#bgPreviewFloating").css('filter', 'grayscale(1)');
        $('#click-here-background').removeClass('d-none');
        $('.close-icon').addClass('d-none');

    }

    // CLEAR CPAAS ICON X IN OUTSIDE

    function resetCPAASIcon(position, model) {

        if (cannotChange() == 1) {
            return;
        }

        if (model == 1) {

            // IF MAIN BUTTON (IS 0) OTHER FB 1-4

            if (position == 0) {

                $('#cpaasMainFloating-icon').attr('src', 'empty-image.png');
                $('#closeFloatingMain-icon').addClass('d-none');

            } else {

                $('#cpaasFloating' + position + '-icon').attr('src', 'empty-image.png');
                $('#closeFloating' + position + '-icon').addClass('d-none');

                var furtherPos = parseInt(position) + 1;

                // FOR DISABLE AGAIN NEXT FB IF THIS FB IS DELETED

                if (position == 4) {
                    $('#addMore-Floating').addClass('disabled');
                } else {
                    $('#cpaasFloating' + furtherPos + '-icon').addClass('disabled');
                }

                $('#closeFloating' + (parseInt(position) - 1) + '-icon').removeClass('d-none');

            }

        } else if (model == 2) {

            if (position == 0) {

                $('#cpaasMainDocked-icon').attr('src', 'empty-image.png');
                $('#closeDockedMain-icon').addClass('d-none');

            } else {

                $('#cpaasDocked' + position + '-icon').attr('src', 'empty-image.png');
                $('#closeDocked' + position + '-icon').addClass('d-none');

                // TURN ON DELETE FOR PREVIOUS FB

                var furtherPos = parseInt(position) + 1;
                $('#cpaasDocked' + furtherPos + '-icon').addClass('disabled');
                $('#closeDocked' + (parseInt(position) - 1) + '-icon').removeClass('d-none');

            }

        } else if (model == 3) {

            $('#burger-content-' + position).text('+');
            $('#closeBurger' + position + '-icon').addClass('d-none');

            // TURN ON DELETE FOR PREVIOUS FB
            var furtherPos = parseInt(position) + 1;

            if (position == 4) {
                $("#btnAddMore2").addClass('disabled');
            } else {
                $('#burger-content-' + furtherPos).addClass('disabled');
            }

            $('#closeBurger' + (parseInt(position) - 1) + '-icon').removeClass('d-none');

        }

        // DELETE FROM MAP

        mobileConfiguration.delete('fb' + position + '_content');
        mobileConfiguration.delete('fb' + position + '_icon');
        mobileConfiguration.delete('fb' + position + '_url');

    }

    // CLEAR CPAAS ICON X IN OUTSIDE

    function resetCPAASIconModal(position, model) {

        if (model == 1) {

            $('#cpaasIconPreview-Floating' + position).attr('src', 'empty-image.png');
            $('#closeCPAAS' + position + '-icon').addClass('d-none');
            $('#closeCPAAS' + (parseInt(position) - 1) + '-icon').removeClass('d-none');

            $('#cpaasContent-Floating' + position).val("0");

            mapTemp.set('fb' + position + '_icon', '');
            mapTemp.set('fb' + position + '_content', '');
            mapTemp.set('fb' + position + '_url', '');

            // REMOVE BELOW FB DIV IF DELETE THIS DIV

            $('#cpaasIconDiv-Floating' + (parseInt(position) + 1)).remove();

        } else if (model == 2) {

            $('#cpaasIconPreview-Docked' + position).attr('src', 'empty-image.png');
            $('#closeCPAAS' + position + '-icon').addClass('d-none');
            $('#closeCPAAS' + (parseInt(position) - 1) + '-icon').removeClass('d-none');

            $('#cpaasContent-Docked' + position).val("0");

            mapTemp.set('fb' + position + '_icon', '');
            mapTemp.set('fb' + position + '_content', '');
            mapTemp.set('fb' + position + '_url', '');

            // REMOVE BELOW FB DIV IF DELETE THIS DIV

            $('#cpaasIconDiv-Docked' + (parseInt(position) + 1)).remove();

        } else if (model == 3) {

            $('#cpaasContent-Burger' + position).val("0");
            $('#closeCPAAS' + position + '-icon').addClass('d-none');
            $('#closeCPAAS' + (parseInt(position) - 1) + '-icon').removeClass('d-none');

            mapTemp.set('fb' + position + '_content', '');
            mapTemp.set('fb' + position + '_url', '');

            // REMOVE BELOW FB DIV IF DELETE THIS DIV

            $('#cpaasIconDiv-Burger' + (parseInt(position) + 1)).remove();

        }

        // SUITABLE BUTTON ADD MORE TO CURRENT FB AFTER DELETED

        $('#btn-addMore').addClass('disabled');
        $('#btn-addMore').attr('onclick', 'addMoreAppend("' + model + '","' + (parseInt(position) + 1) + '")');
        $('#subContent-' + position).html("");

    }

    // RESET TEMP MAP WHILE CLOSE ANY MODAL

    // $("#CPAASModal").on('hide.bs.modal', function(){

    //     mapTemp.clear();

    // });

    // $("#modalTabConfigure").on('hide.bs.modal', function(){

    //     mapTemp.clear();

    // });

    // CHECK ADD MORE FILL TO NEXT ANOTHER ADD MORE 

    function checkFillAddMore(position, model) {

        var images = mapTemp.get('fb' + position + '_icon');
        var content = mapTemp.get('fb' + position + '_content');

        // console.log(position);
        // console.log(images);
        // console.log(content);

        if (model == 3) {

            if (content) {

                $('#btn-addMore').removeClass('disabled');

            }

        } else {

            if (images && content) {

                $('#btn-addMore').removeClass('disabled');

            }

        }

    }

    // RUN FIRST TIME CHECK X TO COUNT TOTAL FB TO SET X IN THAT PLACE

    function setX(model) {

        if (cannotChange() == 1) {
            return;
        }

        let totalFB = 0;

        // COUNT TOTAL FB

        mobileConfiguration.forEach((values, keys) => {

            if (keys.includes('fb') && keys.includes('content') && values != '') {


                totalFB = parseInt(keys.match(/\d+/)[0]);


            }

        });

        console.log("TOTAL FB = ", totalFB);

        if (model == 1) {

            $('#closeFloating' + totalFB + '-icon').removeClass('d-none');

            // DISABLE FLOATING BUT IF FB >4 ENABLE AGAIN

            $('#addMore-Floating').addClass('disabled');

            if (totalFB >= 4) {

                $('#addMore-Floating').removeClass('disabled');

            }

            // DISABLE ALL FB BUT IF EXIST DATA ENABLE AGAIN

            for (var i = 2; i <= 4; i++) {

                $('#cpaasFloating' + i + '-icon').addClass('disabled');

                if (i <= (totalFB + 1)) {

                    $('#cpaasFloating' + i + '-icon').removeClass('disabled');

                }

            }

        } else if (model == 2) {

            $('#closeDocked' + totalFB + '-icon').removeClass('d-none');

        } else if (model == 3) {

            $('#closeBurger' + totalFB + '-icon').removeClass('d-none');

            // DISABLE BURGER BUT IF FB >4 ENABLE AGAIN

            $('#btnAddMore2').addClass('disabled');

            if (totalFB >= 4) {

                $('#btnAddMore2').removeClass('disabled');

            }

            // DISABLE ALL FB BUT IF EXIST DATA ENABLE AGAIN

            for (var i = 2; i <= 4; i++) {

                $('#burger-content-' + i).addClass('disabled');

                if (i <= (totalFB + 1)) {

                    $('#burger-content-' + i).removeClass('disabled');

                }

            }

        }

        // X IN MODAL

        $('#closeCPAAS' + totalFB + '-icon').removeClass('d-none');

    }

    // SCRIPT CONVERT BASE64 TO OBJECT

    function dataURLtoFile(dataurl, filename) {
        var arr = dataurl.split(','),
            mime = arr[0].match(/:(.*?);/)[1],
            bstr = atob(arr[1]),
            n = bstr.length,
            u8arr = new Uint8Array(n);

        while (n--) {
            u8arr[n] = bstr.charCodeAt(n);
        }

        return new File([u8arr], filename, {
            type: mime
        });
    }

    // NEW FORMAT BASE 64 FOR APPEND

    function newFormat(base64_link) {

        var format = base64_link.split(";");

        if (format[0].slice(-4) == "jpeg" || format[0].slice(-4) == "webp") {
            var ext = format[0].slice(-4);
        } else {
            var ext = format[0].slice(-3);
        }

        var rand = Math.floor(Math.random() * 1000000000000);

        var converted_link = dataURLtoFile(base64_link, rand + "." + ext);

        return converted_link;
    }

    // MODAL FOR RENAME CONFIGURATION

    function openSaveProject() {

        if (mobileConfiguration.get('access_model') == 1) {

            // FOR DOCKED MODE TO FILL MINIMUM 2 MAIN TAB

            if (mobileConfiguration.has('tab1_page') && mobileConfiguration.has('tab2_page')) {

                $('#modalProjectName').modal('show');

            } else {

                let textDesc = '';

                if (localStorage.lang == 1) {
                    textDesc = 'Untuk mode docked harap isi 2 tab utama.';
                } else {
                    textDesc = 'For docked mode please fill in the 2 main tabs.';
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: textDesc,
                })

            }

        } else {

            $('#modalProjectName').modal('show');

        }

    }

    $('#configuration-name').hide();

    // FUNCTION SUBMIT

    function saveAllConfiguration() {

        var projectName = $('#projectName').val();

        if (!projectName) {
            $('#configuration-name').show();

            return;
        }

        $('#modalProjectName').modal('hide');

        // CONVERT BACKGROUND FROM BASE 64 TO FILES

        if (backgroundArray.length > 0) {
            // console.log("Background Array = ", backgroundArray);
            var backgroundFiles = [];

            for (var i = 0; i < backgroundArray.length; i++) {

                if (backgroundArray[i] != "") {
                    backgroundFiles.push(backgroundArray[i]);
                }
            }

            // console.log("Background after format (Base 64 to FILES) = " + backgroundFiles);

        } else {
            var backgroundFiles = "";
        }

        // JOIN SINGLE TAB CONTENT TO ARRAY (TAB 1 = 2, TAB 2 = 3 BECOME 2,3)

        var customTabRaw = [];

        for (var i = 1; i <= 6; i++) {

            if (mobileConfiguration.has('tab' + i + '_page')) {

                customTabRaw.push(mobileConfiguration.get('tab' + i + '_page'));

            }

        }

        var customTab = customTabRaw.join(",");

        if (customTab) {

            mobileConfiguration.set('app_builder_custom_tab', customTab);

        }

        // JOIN SINGLE CPAAS CONTENT TO ARRAY (TAB 1 = 2, TAB 2 = 3 BECOME 2,3)

        var indexFB = [];
        var customFBRaw = [];
        var customFBURLRaw = [];
        var customFBIconRaw = [];

        // COUNT TOTAL FB

        mobileConfiguration.forEach((values, keys) => {

            if (keys.includes('fb') && keys.includes('content')) {

                var index = keys.match(/\d+/)[0];

                indexFB.push(index);
            }

        });

        console.log(indexFB);

        // SET FB TO CONTENT URL ICON BASED ON INDEX WHICH FILLED

        for (var i = 0; i < indexFB.length; i++) {

            if (mobileConfiguration.has('fb' + indexFB[i] + '_content')) {

                let getContent = mobileConfiguration.get('fb' + indexFB[i] + '_content');
                let getIcon = mobileConfiguration.get('fb' + indexFB[i] + '_icon')

                customFBRaw.push(getContent);

                if (getIcon) {
                    customFBIconRaw.push(getIcon);
                }

            }

            if (mobileConfiguration.get('fb' + indexFB[i] + '_url') && mobileConfiguration.get('fb' + indexFB[i] + '_url') != '') {

                // -1 FOR INDEX (FB1_ICON WILL BE INDEX 0 OF 0|www.com)

                // let getURL = (parseInt(indexFB[i])-1) + "|_fb2_" + mobileConfiguration.get('fb'+indexFB[i]+'_url');
                let getURL = ("_fb2_" + mobileConfiguration.get('fb' + indexFB[i] + '_url'));

                customFBURLRaw.push(getURL);

            }

        }

        var customFB = customFBRaw.join(",");
        var customFBURL = customFBURLRaw.join(",");
        var customFBIcon = customFBIconRaw.join(",");

        if (customFB) {

            mobileConfiguration.set('app_builder_custom_buttons', customFB);

        }

        if (customFBURL) {

            mobileConfiguration.set('app_builder_button_url', customFBURL);

        }

        console.log("Custom Tab = ", customTab);
        console.log("Custom FB = ", customFB);
        console.log("Custom URL = ", customFBURL);
        console.log("Custom Icon = ", customFBIcon);

        // console.log(mobileConfiguration);

        // UPLOAD TO SERVER

        var formData = new FormData();

        mobileConfiguration.forEach((values, keys) => {

            // SORT OLD BG NOT UPDATED

            if (!values.includes('dashboardv2')) {

                // SORT BASE 64 WHO NEED TO CHANGE TO FILES

                if (values.includes('base64')) {

                    formData.append(keys, newFormat(values));

                } else {

                    formData.append(keys, values);

                }
            } else {

                // USING OLD IMAGE IF USER DIDN'T CHANGE ICON

                formData.append(keys, values.replace('dashboardv2/uploads/mab_mobile/', ''));

            }

        });

        // CONVERT BASE64 TO FILES RIGHT BEFORE UPLOADING

        for (var i = 0; i < backgroundFiles.length; i++) {

            formData.append('app_builder_background[]', newFormat(backgroundFiles[i]));

        }

        for (var i = 0; i < customFBIconRaw.length; i++) {

            // FILTER APPEND JUST FOR BASE64 FILE, NOT FROM DB

            if (!customFBIconRaw[i].includes('dashboardv2')) {

                formData.append('app_builder_button_icon[]', newFormat(customFBIconRaw[i]));

            }

        }

        for (var pair of formData.entries()) {

            console.log(pair[0] + ', ' + pair[1]);

        }

        var f_pin = '';

        if (window.Android) {
            f_pin = window.Android.getFPin();

            if (f_pin == "" || f_pin === undefined) {

                f_pin = '<?= $f_pin ?>';

            }

        } else {
            f_pin = '<?= $f_pin ?>';
        }

        formData.append('f_pin', f_pin);
        formData.append('project-name', projectName);

        if (mobileConfiguration) {

            $('#modalLoading').modal('show');

            let xmlHttp = new XMLHttpRequest();
            xmlHttp.onreadystatechange = function() {

                if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                    console.log(xmlHttp.responseText);

                    let response = xmlHttp.responseText.split("|")[1];
                    global_url_load = response;

                    setTimeout(function() {
                        $('#modalLoading').modal('hide');
                    }, 500);

                    let textTitle = '';
                    let textDesc = '';

                    if (localStorage.lang == 1) {
                        textTitle = 'Sukses!';
                        textDesc = 'Konfigurasi anda telah disimpan';
                    } else {
                        textTitle = 'Success!';
                        textDesc = 'Your settings already saved.';
                    }

                    Swal.fire({
                        icon: 'success',
                        title: textTitle,
                        text: textDesc,
                        allowOutsideClick: false,
                        onClose: showURL(response),
                    }).then((result) => {

                        // if (result.isConfirmed) {

                        // applyAndroid();

                        // }

                    })

                    // setTimeout(function(){

                    //     $('#modalURL').modal('show');
                    // },3000);

                }
            }

            xmlHttp.open("post", "/submit_mab_mobile");
            xmlHttp.send(formData);

        } else {

            let textDesc = '';

            if (localStorage.lang == 1) {
                textDesc = 'Harap isi MAB Builder.';
            } else {
                textDesc = 'Please fill MAB Builder.';
            }

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: textDesc,
            })

        }
    }

    // AFTER INSERT TO DB SHOW MODAL TO GET URL (HASH)

    function showURL(response) {

        setTimeout(function() {

            applyAndroid();

        }, 500);

        let html = '';

        if (localStorage.lang == 1) {

            html = `<p>Tautan Kustomisasi Anda :</p>
                    <input type="text" id="generate-key" readonly class="form-control" value="https://newuniverse.io/mobile_MAB?url=` + response + `">
                    <button class="btn btn-success w-100 mt-3" id="copy-link" onclick="saveKey()">Salin Tautan</button>
                    <div class="row">
                        <div class="col-6">
                            <button class="btn btn-sm btn-success w-100 mt-3" onclick="goToList('` + response + `')">Konfigurasi Saya</button>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-sm btn-secondary w-100 mt-3" onclick="closeEditorReal()">Tutup Editor</button>
                        </div>
                    </div>`;

        } else {

            html = `<p>Your Customization Link :</p>
                    <input type="text" id="generate-key" readonly class="form-control" value="https://newuniverse.io/mobile_MAB?url=` + response + `">
                    <button class="btn btn-success w-100 mt-3" id="copy-link" onclick="saveKey()">Copy Link</button>
                    <div class="row">
                        <div class="col-6">
                            <button class="btn btn-sm btn-success w-100 mt-3" onclick="goToList('` + response + `')">My Configuration</button>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-sm btn-secondary w-100 mt-3" onclick="closeEditorReal()">Close Editor</button>
                        </div>
                    </div>`;
        }

        $('#modalURL-content').html(html);
        $('#modalURL').modal('show');

    }

    // FUNCTION COPY URL

    function saveKey() {

        var valueText = $("#generate-key").select().val();
        document.execCommand("copy");

        if (localStorage.lang == 1) {
            $('#copy-link').text('Salin Tautan (Tersalin)');
        } else {
            $('#copy-link').text('Copy Link (Copied)');
        }

        $('#copy-link').css('background-color', '#ff8100');
        $('#copy-link').css('border', '1px solid #ff8100');
    }

    function closeEditor() {

        if (cannotChange() == 1) {
            return;
        }

        if (mobileConfiguration.size > 1 || backgroundArray.length > 0) {

            let textTitle = '';
            let textDesc = '';
            let textYes = '';
            let textNo = '';

            if (localStorage.lang == 1) {
                textTitle = 'Apakah anda yakin?';
                textDesc = 'Jika Anda kembali, semua penyesuaian Anda akan hilang.';
                textYes = 'Iya';
                textNo = 'Batalkan';
            } else {
                textTitle = 'Are you sure?';
                textDesc = 'If you go back, your all customization will be lost.';
                textYes = 'Yes';
                textNo = 'Cancel';
            }

            Swal.fire({
                title: textTitle,
                text: textDesc,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: textYes,
                cancelButtonText: textNo
            }).then((result) => {
                if (result.isConfirmed) {

                    window.Android.finishForm();

                }
            })

        } else {

            window.Android.finishForm();

        }

    }

    function closeEditorReal() {

        window.Android.finishForm();

    }

    function applyAndroid() {

        console.log("Apply Android");

        var formData = new FormData();

        let xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function() {

            if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                console.log(xmlHttp.responseText);

                let response = xmlHttp.responseText;
                console.log("FETCH UI CONFIG", response);

                window.Android.successChangeTheme(response);


            }
        }

        xmlHttp.open("post", "/nexilis/logics/fetch_ui_config?url=" + global_url_load);
        xmlHttp.send(formData);

    }

    function multipleSelectAndroid() {

        window.Android.onClickBackground();

    }

    function cannotChange() {

        let url = new URLSearchParams(window.location.search).get("url");

        if (url) {
            return 1;
        } else {
            return 0;
        }

    }

    function checkDuplicateFB(FBContent) {

        // alert(FBContent);
        // CHECK FOR DUPLICATE

        let is_duplicate = true;
        let duplicate = [];

        // console.log(duplicate);

        // FOR VALIDATION IN MODAL SINGLE

        mobileConfiguration.forEach((values, keys) => {

            if (keys.includes('fb') && keys.includes('content')) {

                if ((mobileConfiguration.get(keys) == FBContent) && (mobileConfiguration.get(keys) != '_fb2')) {
                    duplicate.push(true);

                    console.log("Duplikat di MOB CON");
                } else {
                    duplicate.push(false);
                }

                // console.log(mobileConfiguration.get(keys));
            }

        });

        if (duplicate.includes(true)) {
            // console.log("Duplicate Tab");
            return 1;
        } else {
            // console.log("Not Duplicate Tab");
            return 0;
        }

    }

    function checkDuplicateFBModal(FBContent) {

        // alert(FBContent);
        // CHECK FOR DUPLICATE

        let is_duplicate = true;
        let duplicate = [];

        // console.log(duplicate);

        // FOR VALIDATION IN MODAL ADD MORE

        mapTemp.forEach((values, keys) => {

            if (keys.includes('fb') && keys.includes('content')) {

                if ((mapTemp.get(keys) == FBContent) && (mapTemp.get(keys) != '_fb2')) {
                    duplicate.push(true);

                    console.log("Duplikat di MAP TEMP");
                } else {
                    duplicate.push(false);
                }

                // console.log(mapTemp.get(keys));
            }

        });

        if (duplicate.includes(true)) {
            // console.log("Duplicate Tab");
            return 1;
        } else {
            // console.log("Not Duplicate Tab");
            return 0;
        }

    }

    // CHECK ON SELECT TAB FOR DUPLICATE

    function checkDuplicateTab(tab) {

        let is_duplicate = true;
        let duplicate = [];

        mobileConfiguration.forEach((values, keys) => {

            if (keys.includes('tab') && keys.includes('page')) {

                if (mobileConfiguration.get(keys) == tab) {
                    duplicate.push(true);
                } else {
                    duplicate.push(false);
                }

                // console.log(mobileConfiguration.get(keys));
            }

        });

        if (duplicate.includes(true)) {
            console.log("Duplicate Tab");
            return 1;
        } else {
            console.log("Not Duplicate Tab");
            return 0;
        }

    }

    // FILL VALUE IN INPUT IN TAB 1/3 OPTION

    function fillRadio(value, tab) {

        if (tab == 1) {

            if (mobileConfiguration.get('tab3_default_content') == value) {

                let textDesc = '';

                if (localStorage.lang == 1) {
                    textDesc = 'Tab Konten Duplikat.';
                } else {
                    textDesc = 'Duplicate Tab Content.';
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: textDesc,
                })

                $('#flexRadioDefault' + (value + 1)).prop('checked', false);

            } else {

                $('#url_content').val(value);

            }

        } else if (tab == 3) {

            if (mobileConfiguration.get('url_default_content') == value) {

                let textDesc = '';

                if (localStorage.lang == 1) {
                    textDesc = 'Tab Konten Duplikat.';
                } else {
                    textDesc = 'Duplicate Tab Content.';
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: textDesc,
                })

                $('#flexRadioDefault' + (value + 1)).prop('checked', false);

            } else {

                $('#tab3_content').val(value);

            }

        }
    }

    // TO TURN ON SEND AND SAVE CONFIGURATION

    var checkFill = setInterval(function() {

        if (mobileConfiguration.size > 1 || backgroundArray.length > 0) {

            $('#submit-button').removeClass('d-none');

            // clearInterval(checkFill);

            if (backgroundArray.length > 0) {

                for (var i = 0; i <= backgroundArray.length; i++) {

                    // CHECK IF BACKGROUND ALREADY DELETED AND NO INPUT INSTEAD BACKGROUND

                    if (mobileConfiguration.size < 2 && backgroundArray[i] == '') {

                        $('#submit-button').addClass('d-none');

                    }

                }

            }

        } else {

            $('#submit-button').addClass('d-none');

        }

    }, 100);

    // DELETE BACKGROUND PREVIEW

    function deletePreviewBG(position) {

        // console.log(position);

        // DELETE FROM DIV

        $('#bg-preview-' + position).remove();

        // IF IMAGE DELETED IS THE LAST (SAME AS PREVIEW)

        if (backgroundArray[position] == $('#bgPreviewFloating').attr('src')) {

            // MAKE NULL IN ARRAY

            backgroundArray[position] = "";

            // FOR CHECKING IF THERE IS NO IMAGE EXIST USE DEFAULT IMAGE

            let is_image_exist = '';

            // LOOP FOR IMAGE LAST FOR PREVIEW

            for (var i = (backgroundArray.length - 2); i >= 0; i--) {

                console.log("LOOP" + i);
                backgroundArray[position] = "";

                if (backgroundArray[i] != '') {

                    $("#bgPreviewFloating").attr("src", backgroundArray[i]);
                    is_image_exist = true;

                    break;

                }
            }

            // USE DEFAULT IMAGE

            if (is_image_exist != true) {

                $('#background-section').css('margin-top', '');
                $('#background-section').css('height', '');
                $("#bgPreviewFloating").attr("src", 'upload-image.png');
                $("#bgPreviewFloating").css("filter", 'grayscale(1)');
                $('#click-here-background').removeClass('d-none');

            }

        } else {

            // IF IMAGE DELETED IS NOT THE BACKGROUND PREVIEWED, JUST DELETE

            backgroundArray[position] = "";

        }
    }

    function changeImagePreview(url) {

        $('#bgPreviewFloating').attr('src', url);

    }

    // TAB 1 CUSTOM CONTENT LISTENER FOR RADIO

    function customTab1() {

        // CUSTOMIZE RADIO WHILE INPUT CHANGE ON CUSTOM TAB 1/3 CONTENT

        $('#url_content').on("input", function() {

            let value = $(this).val();
            var numberRegex = /^[0-9].*$/;

            // IF INPUT IN FIRST CHARACTER

            if (!global_tab1_url || $(this).val().trim().length == 0) {

                // IF INPUT INCLUDE NUMBER = CHECK THE CHOOSEN ONE

                if (numberRegex.test(value)) {

                    // NUMBER IN POSITION 0 = AFFECTED TO RADIO (EX: 0)

                    if ($('#url_content').val().length == 1) {

                        $('#flexRadioDefault1').prop('checked', false);
                        $('#flexRadioDefault2').prop('checked', false);
                        $('#flexRadioDefault3').prop('checked', false);
                        $('#flexRadioDefault4').prop('checked', false);
                        $('#flexRadioDefault5').prop('checked', false);

                        if (value == 0) {

                            $('#flexRadioDefault1').prop('checked', true);

                        } else if (value == 1) {

                            $('#flexRadioDefault2').prop('checked', true);

                        } else if (value == 2) {

                            $('#flexRadioDefault3').prop('checked', true);

                        } else if (value == 3) {

                            $('#flexRadioDefault4').prop('checked', true);

                        } else if (value == 4) {

                            $('#flexRadioDefault5').prop('checked', true);

                        } else {

                            console.log('Luar');
                            $(this).val(global_tab1_url);

                        }

                    } else {

                        // IF ALREADY INPUT RADIO VALUE, INPUT AGAIN, PREVENT IT

                        $(this).val(global_tab1_url);

                    }

                } else if (value == '') {

                    // IF INPUT IS NON NUMBER = RESET RADIO

                    $('#flexRadioDefault1').prop('checked', false);
                    $('#flexRadioDefault2').prop('checked', false);
                    $('#flexRadioDefault3').prop('checked', false);
                    $('#flexRadioDefault4').prop('checked', false);
                    $('#flexRadioDefault5').prop('checked', false);

                }

                // IF INPUT IS RADIO SELECTION SAVE IT TO GLOBAL

                if (value == 1 || value == 2 || value == 3 || value == 4 || value == 0) {

                    global_tab1_url = value;

                }

            } else {

                // IF INPUT IN NOT FIRST CHARACTER

                // IF INPUT NUMBER AGAIN AFTER RADIO SELECTION, PREVENT IT

                if (numberRegex.test($('#url_content').val()) && $('#url_content').val().length > 1) {

                    $(this).val(global_tab1_url);

                }

            }
        });

    }

    // TAB 3 CUSTOM CONTENT LISTENER FOR RADIO

    function customTab3() {

        $('#tab3_content').on("input", function() {

            let value = $(this).val();
            var numberRegex = /^[0-9].*$/;

            // IF INPUT IN FIRST CHARACTER

            if (!global_tab3_url || $(this).val().trim().length == 0) {

                // IF INPUT INCLUDE NUMBER = CHECK THE CHOOSEN ONE

                if (numberRegex.test(value)) {

                    // NUMBER IN POSITION 0 = AFFECTED TO RADIO (EX: 0)

                    if ($('#tab3_content').val().length == 1) {

                        $('#flexRadioDefault1').prop('checked', false);
                        $('#flexRadioDefault2').prop('checked', false);
                        $('#flexRadioDefault3').prop('checked', false);
                        $('#flexRadioDefault4').prop('checked', false);
                        $('#flexRadioDefault5').prop('checked', false);

                        if (value == 0) {

                            $('#flexRadioDefault1').prop('checked', true);

                        } else if (value == 1) {

                            $('#flexRadioDefault2').prop('checked', true);

                        } else if (value == 2) {

                            $('#flexRadioDefault3').prop('checked', true);

                        } else if (value == 3) {

                            $('#flexRadioDefault4').prop('checked', true);

                        } else if (value == 4) {

                            $('#flexRadioDefault5').prop('checked', true);

                        } else {

                            console.log('Luar');
                            $(this).val(global_tab3_url);

                        }

                    } else {

                        // IF ALREADY INPUT RADIO VALUE, INPUT AGAIN, PREVENT IT

                        $(this).val(global_tab3_url);

                    }

                } else if (value == '') {

                    // IF INPUT IS NON NUMBER = RESET RADIO

                    $('#flexRadioDefault1').prop('checked', false);
                    $('#flexRadioDefault2').prop('checked', false);
                    $('#flexRadioDefault3').prop('checked', false);
                    $('#flexRadioDefault4').prop('checked', false);
                    $('#flexRadioDefault5').prop('checked', false);

                }

                // IF INPUT IS RADIO SELECTION SAVE IT TO GLOBAL

                if (value == 1 || value == 2 || value == 3 || value == 4 || value == 0) {

                    global_tab3_url = value;

                }

            } else {

                // IF INPUT IN NOT FIRST CHARACTER

                // IF INPUT NUMBER AGAIN AFTER RADIO SELECTION, PREVENT IT

                if (numberRegex.test($('#tab3_content').val()) && $('#tab3_content').val().length > 1) {

                    $(this).val(global_tab3_url);

                }

            }
        });
    }

    // GO TO MY CUSTOM CONFIGURATION LIST 

    function goToList(url) {

        location.href = "mobile_MAB_list?f_pin=" + F_PIN;

    }

    // SECTION TRANSLATE

    if (localStorage.lang == 1) {

        $('#submit-button').html('<b>Simpan</b> dan <b>Bagikan</b> <i class="fa fa-paper-plane" style="margin-left: 5px" aria-hidden="true"></i>');
        $('#click-here-background').html('<b>Sentuh</b> untuk <br> mengunggah latar belakang');
        $('#rename-config-text').text('Atur nama konfigurasi anda :');
        $('#projectName').attr('placeholder', 'Contoh : Tema 1');
        $('#add-more-text').html('Tambah <br> lainnya');
        $('#btnAddMore2').html('<span style="font-size: 13px">Tambah lainnya</span>');
        $('#btn-save').html('<b>Simpan</b>');
        $('#apply-theme-text').html('<b>Gunakan</b> Tema Ini <i class="fa fa-check" style="margin-left: 5px" aria-hidden="true"></i>');
        $('#app-name-text').html('Nama Tema :');

    }
</script>