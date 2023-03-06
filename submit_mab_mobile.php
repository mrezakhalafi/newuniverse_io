<?php 

    ini_set('display_errors', 1); 
    ini_set('display_startup_errors', 1); 
    error_reporting(E_ALL);

    include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php');
    $dbconn = dbConnPalioLite();

    // GET BE

    $f_pin = $_POST['f_pin'];

    $query = $dbconn->prepare("SELECT * FROM USER_LIST WHERE F_PIN = '$f_pin'");
    $query->execute();
    $user = $query->get_result()->fetch_assoc();
    $query->close();

    $be = $user['BE'];

    // DECLARATION SECTION

    $data = $_POST; 
    $valuesRaw = [];
    $uiConfig = floor(microtime(true) * 1000);

    $id = $uiConfig;
    $projectName = $_POST['project-name'];
    $url = base64_encode($uiConfig.":".$f_pin);

    // FILES SECTION

    $fileArrayTemp = [];
    
    if (isset($_FILES)) {

        foreach($_FILES as $key => $file){

            if (is_array($file['name'])){

                $jumlahFile = count($file['name']);

                if ($jumlahFile > 0) {

                    $folderUpload = $_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/uploads/mab_mobile';
                    $appIconTemp = [];
                    $backgroundTemp = [];

                    for ($i = 0; $i < $jumlahFile; $i++) {

                        $namaFile = $file['name'][$i];
                        $lokasiTmp = $file['tmp_name'][$i];
                        $namaBaru = $uiConfig . '_' . $namaFile;
                        $lokasiBaru = "{$folderUpload}/{$namaBaru}";

                        if (!in_array($namaBaru, $fileArrayTemp)){

                            if (move_uploaded_file($lokasiTmp, $lokasiBaru)) {

                                // echo ("Berhasil Upload");

                                // FILTER IF (1.jpg, 2.jpg, base64://aaa) JOINED OLD VALUES WITH NEW ONE
                        
                                if ($key == 'app_builder_button_icon' && isset($_POST['app_builder_button_icon'])){

                                    array_push($appIconTemp, $_POST['app_builder_button_icon']);

                                }

                                if ($key == 'app_builder_background' && isset($_POST['app_builder_background'])){

                                    array_push($backgroundTemp, $_POST['app_builder_background']);

                                }

                                // SEPARATE ARRAY FOR BACKGROUND AND FB NOT IN ONE ARRAY

                                if ($key == 'app_builder_button_icon'){

                                    array_push($appIconTemp, $namaBaru);

                                }

                                if ($key == 'app_builder_background'){

                                    array_push($backgroundTemp, $namaBaru);

                                }

                            }
                        }
                    }
                }

                // SEPARATE ARRAY FOR BACKGROUND AND FB NOT IN ONE ARRAY

                if ($key == 'app_builder_button_icon'){

                    $keyName = implode(",", $appIconTemp);

                }

                if ($key == 'app_builder_background'){
     
                    $keyName = implode(",", $backgroundTemp);

                }

                array_push($valuesRaw, "('$id','$key','$keyName')"); 
            
            }else{

                $folderUpload = $_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/uploads/mab_mobile';

                $namaFile = $file['name'];
                $lokasiTmp = $file['tmp_name'];
                $namaBaru = $uiConfig . '_' . $namaFile;
                $lokasiBaru = "{$folderUpload}/{$namaBaru}";

                if (!in_array($namaBaru, $fileArrayTemp)){

                    if (move_uploaded_file($lokasiTmp, $lokasiBaru)) {

                        // echo ("Berhasil Upload");

                        array_push($valuesRaw, "('$id','$key','$namaBaru')"); 

                    }

                }

            }
        }

    }

    // POST SECTION

    // LOOP POST DATA TO ARRAY

    foreach (array_keys($data) as $dt){

        if ($dt != 'f_pin' && $dt != 'project-name'){

            // IF DETECTED UPLOAD NEW FILE, USE ABOVE FUNCTION TO PUSH

            if (!($dt == 'app_builder_button_icon' && isset($_FILES['app_builder_button_icon'])) && 
                !($dt == 'app_builder_background' && isset($_FILES['app_builder_background']))){

                array_push($valuesRaw, "('$id','$dt','$data[$dt]')"); 
                
            }

        }

    }

    $values = implode(",", $valuesRaw);

    // INSERT IN PREFS

    // $sql = "INSERT INTO `PREFS` (`BE`,`KEY`,`VALUE`,`UI_CONFIG`) VALUES $values";
    // $query = $dbconn->prepare($sql);
    // $querySavePrefs = $query->execute();
    // $query->close();

    // echo($sql);

    // INSERT IN UI CONFIG

    $sql = "INSERT INTO UI_CONFIG (`ID`,`NAME`,`F_PIN`,`URL`) VALUES ($id, '$projectName', '$f_pin', '$url')";
    $query = $dbconn->prepare($sql);
    $querySaveConfig = $query->execute();
    $query->close();

    // echo($sql);

    // INSERT IN UI CONFIG DETAIL TOO

    $sql = "INSERT INTO `UI_CONFIG_DETAIL` (`UI_CONFIG`,`KEY`,`VALUE`) VALUES $values";
    $query = $dbconn->prepare($sql);
    $querySavePrefs = $query->execute();
    $query->close();

    if ($querySaveConfig && $querySavePrefs){
        echo("BERHASIL|".$url);
    }else{
        echo("GAGAL|0");
    }

?>