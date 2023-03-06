<?php

    include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/session_function.php');

    $dbconn = getDBConn();
    $currentPage = $_SESSION['current_page'];
    
    if( isset($_SESSION['previous_page']) ){
        $previousPage = $_SESSION['previous_page'];
    } else {
        $previousPage = null;
    }

    function sessionExpire()
    {
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
            // last request was more than 30 minutes ago
            $dbconn = getDBConn();

            $sess_token = $_SESSION['session_token'];

            $query1 = $dbconn->prepare('DELETE FROM SESSION WHERE SESSION_TOKEN = ?');
            $query1->bind_param('s', $sess_token);
            $query1->execute();
            $query1->close();

            session_unset();     // unset $_SESSdashION variable for the run-time 
            session_destroy();   // destroy session data in storage

            echo "<script>alert('You are now logged out');</script>";
            echo "<script>window.location.href = '" . base_url() . "';</script>";

            die();
        }
        $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

    } 


    // CHECK LOGIN STATE
    if( isset($_SESSION['id_user']) ){
        $userID = $_SESSION['id_user'];
        $sessionToken = $_SESSION['session_token'];

        //GET SESSION ID
        $query = $dbconn->prepare("SELECT * FROM SESSION WHERE SESSION_TOKEN = ?");
        $query->bind_param("s", $sessionToken);
        $query->execute();
        $last_session = $query->get_result()->fetch_assoc();
        $last_session_id = $last_session['ID'];
        $query->close();

        $query = $dbconn->prepare("INSERT INTO ACTIVITY_HISTORY (WHO, PREV_PAGE, CURR_PAGE, SESSION_TOKEN) VALUES (?, ?, ?, ?)");
        $query->bind_param('iiii', $userID, $previousPage, $currentPage, $last_session_id);
        $query->execute();
        $query->close();

        sessionExpire();

    } else {
        $userID = null;

        if( isset($_SESSION['session_token']) ){

            $sessionToken = $_SESSION['session_token'];

            //GET SESSION ID
            $query = $dbconn->prepare("SELECT * FROM SESSION WHERE SESSION_TOKEN = ?");
            $query->bind_param("s", $sessionToken);
            $query->execute();
            $session = $query->get_result()->fetch_assoc();
            $session_id = $session['ID'];
            $query->close();

            $query = $dbconn->prepare("INSERT INTO ACTIVITY_HISTORY (WHO, PREV_PAGE, CURR_PAGE, SESSION_TOKEN) VALUES (?, ?, ?, ?)");
            $query->bind_param('iiii', $userID, $previousPage, $currentPage, $session_id);
            $query->execute();
            $query->close();

        } else {
            $new_token = sha1(time());
            $_SESSION['session_token'] = $new_token;

            $query = $dbconn->prepare("INSERT INTO SESSION (USER_ID, SESSION_TOKEN) VALUES (?,?)");
            $query->bind_param("is", $userID, $new_token);
            $query->execute();
            $last_session_id = $query->insert_id;
            $query->close();

            $query = $dbconn->prepare("INSERT INTO ACTIVITY_HISTORY (WHO, PREV_PAGE, CURR_PAGE, SESSION_TOKEN) VALUES (?, ?, ?, ?)");
            $query->bind_param('iiii', $userID, $previousPage, $currentPage, $last_session_id);
            $query->execute();
            $query->close();

            // try to open another page directly without session
            if ($currentPage != 1 && $currentPage != 9 && $currentPage != 10) {
                redirect(base_url());
            }
            
        }

    }

?>

<script>

// AUTO MODAL LOGOUT POPUP WHILE USER LOGGED ON ANOTHER DEVICE    

 function is_logged_another_device(){

    let session_token_exist = '<?= getSession('session_token') ?>';
    let user_id = '<?= getSession('id_user') ?>';

    var formData = new FormData();

    formData.append('session_token_exist', session_token_exist);
    formData.append('user_id', user_id);

    if (session_token_exist && user_id){

        let xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function(){
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200){
                
                let response = xmlHttp.responseText;

                // PREVENT MULTIPLE

                if (response == 1 && !$('#modal-session-expire').hasClass('show')){

                    $("#close-session-expire").click(function() {
                        $('#logoutButton').click();
                    })

                    if (localStorage.lang == 1){
                        $("#modal-session-expire .modal-dialog .modal-content .modal-body").text("Saat ini anda telah keluar.");
                    }else{
                        $("#modal-session-expire .modal-dialog .modal-content .modal-body").text("You are now logged out.");
                    }

                    $("#modal-session-expire").modal("show");
                    clearInterval(check_is_logged_another_device);

                }

            }
        }
        xmlHttp.open("post", "/logics/is_logged_another_device");
        xmlHttp.send(formData);

    }
}


let check_is_logged_another_device = setInterval(function(){

    is_logged_another_device();

},1000);


</script>