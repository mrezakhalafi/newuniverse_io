<link rel="icon" type="image/x-icon" href="newAssets/fav.ico">
<?php include($_SERVER['DOCUMENT_ROOT'].'/header2.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/url_function.php');?>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/db_conn.php');?>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/session_function.php');?>

<?php

if(isset($_POST['submitInfo'])){
    $dbconn = getDBConn();
    $featureName = array("Live Streaming", "VoIp Call", "Video Call", "Chat Bot", "Screen Sharing", "White Boarding","Instant Messaging");
    $featurePrice = array(10, 10, 12, 10, 10, 10,0);

    // $company_name = $_POST['companyName'];
    // $phone_number = $_POST['phoneNumber'];
    // $product_interest = $_POST['productInterest'];
    // $development_type = $_POST['developmentType'];
    // $industry_type = $_POST['industryType'];
    // $domain = $_POST['domain'];
    // $address = $_POST['address'];

    //=================== QUERY SIGNUP.PHP ===========================
        $email = $_SESSION['email'];
        $password = $_SESSION['password'];
        $username = $_SESSION['username'];
        $query = $dbconn->prepare(" INSERT INTO COMPANY_INFO (PHONE_NUMBER, COMPANY_NAME, PRODUCT_INTEREST, DEVELOPMENT_TYPE, INDUSTRY_TYPE, CREATED_DATE) VALUES (?, ?, ?, ?, ?, NOW());");
        $query->bind_param("sssss", $phone_number, $company_name, $product_interest, $development_type, $industry_type);
        $query->execute();
        if(!$dbconn->commit()){
            echo "Commit insert company info gagal ";
        }
        
        $query->close();


        //=================== QUERY name.php ===========================
        //---- INSERT COMPANY INFO
        $company_id = '';
        $query= $dbconn->prepare("SELECT COMPANY FROM COMPANY_INFO WHERE COMPANY_NAME = ? AND PHONE_NUMBER = ?");
        $query->bind_param("ss", $company_name, $phone_number);
        $query->execute();
        $itemUser = $query->get_result()->fetch_assoc();
        $company_id = $itemUser['ID'];
        $query->close();

        // $query = $dbconn->prepare("SELECT * FROM USER_ACCOUNT WHERE EMAIL_ACCOUNT = ?");
        // $query->bind_param("s", $email);
        // $query->execute();
        // $query->close();

        $query = $dbconn->prepare("INSERT INTO USER_ACCOUNT (COMPANY, USERNAME, EMAIL_ACCOUNT, PASSWORD, STATUS) VALUES ('$company_id', ?, ?, MD5(?), ?);");
        $query->bind_param("sssi", $username, $email, $password, $status);
        $query->execute();
        
        if(!$dbconn->commit()){
            echo "Commit insert company info gagal ";
        }
        $query->close();


        //--INSERT FEATURE
        //--INSERT FEATURE_SUBSCRIBE
        for($i = 0; $i < count($featureName); $i++){
            
            $query = $dbconn->prepare("INSERT INTO SUBSCRIBE (COMPANY, PRODUCT, START_DATE, END_DATE, STATUS) 
            VALUES (?, ?, now(), (SELECT current_date+interval 7 day),?);");
            $query->bind_param("isi", $company_id, $featureName[$i], $featurePrice[$i]);
            $query->execute();
        
            if(!$dbconn->commit()){
                echo "Commit insert company info gagal ";
            }
        
            $query->close();

            $query = $dbconn->prepare("SELECT MAX(S.start_date) as VAR_MAX from SUBSCRIBE S, PRODUCT P, COMPONENT C, SERVICE 
            SE, SUBSCRIPTION SO, PRICE PI WHERE S.PRODUCT = P.ID AND P.ID=C.PRODUCT AND C.SUBSCRIPTION=SO.ID AND C.SERVICE=SE.ID AND C.PRICE=P.ID AND 
            S.COMPANY = ? AND SE.SERVICE_NAME ?");
            $query->bind_param("si", $featureName[$i], $company_id);
            $query->execute();
            $itemUser3 = $query->get_result()->fetch_assoc();
            $idFeature = $itemUser3['ID'];
        
            $query->close();

            $query = $dbconn->prepare(" INSERT INTO SUBSCRIBE (COMPANY, PRODUCT, START_DATE, END_DATE, STATUS) 
            VALUES (?, ?, now(), (SELECT current_date+interval 7 day),?);");
            $query->bind_param("i", $idFeature);
            $query->execute();
        
            if(!$dbconn->commit()){
                echo "Commit insert company info gagal ";
            }
        
            $query->close();

        }

        //--UPDATE COMPANY
        $company = '';


        $query = $dbconn->prepare("SELECT COMPANY  FROM COMPANY_INFO WHERE COMPANY_NAME = ? AND PHONE_NUMBER = ?;");
        $query->bind_param("s", $company_name);
        $query->execute();
        $itemUser2 = $query->get_result()->fetch_assoc();
        $company = $itemUser2['COMPANY']; 


        $query = $dbconn->prepare("UPDATE COMPANY SET `DOMAIN`= ? WHERE  `COMPANY_INFO`= ?");
        $query->bind_param("sii", $domain, $company, $company_id);
        $query->execute();

        if(!$dbconn->commit()){
            echo "Commit insert company info gagal ";
        }
        
        $query->close();



        //--INSERT USAGE_
        $query = $dbconn->prepare("INSERT INTO usage_ (COMPANY, BANDWITH, USAGE_) VALUES ( ?, 200000, 0);");
        $query->bind_param("i", $company_id);
        $query->execute();



        //insert message
        $id = 1;
        $ket = "New User";

        $query = $dbconn->prepare("INSERT INTO message(COMPANY, M_ID, MESSAGE_DATE, MESSAGE_DESC) VALUES(?, ?, now(), ?)");
        $query->bind_param("iis", $company_id, $id, $ket);
        $query->execute();

        if(!$dbconn->commit()){
            echo "Commit insert company info gagal ";
        }

        $query->close();
    
    // $query= $dbconn->prepare("SELECT COUNT(*) as cnt FROM company_info WHERE COMPANY_NAME = ? ");
    // $query->bind_param("s", $company_name);
    // $query->execute();
    // $itemUser = $query->get_result()->fetch_assoc();
    // $cnt = $itemUser['cnt'];

    // $msg = "";

    // $query->close();

    // if($cnt > 0) {
        // $msg = 'Company has registered!';
        //echo '<script>alert("Perusahaan Sudah Terdaftar")</script>';
    // } else {
        // $_SESSION['address'] = $address;
        

        // redirect(base_url()."product.php"); 
    // }


        $query= $dbconn->prepare("SELECT * FROM company WHERE ID= ?");
        $query->bind_param("i", $company_id);
        $query->execute();
        $CompanyItem = $query->get_result()->fetch_assoc();

        $query->close();
        setSession('email',$CompanyItem['EMAIL_ACCOUNT']);
        setSession('password',$CompanyItem['PASSWORD']);
        setSession('id_company',$company_id);

        redirect(base_url()."newdashboard.php");

}

?>

<?php echo("disini ada text" . $_POST); ?>

<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <label class="title-modal">Prompt</label>
                <p class="text-modal fs-20"><?php if(!empty($msg)){echo $msg;}else{echo "error";} ?></p>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5">
            <form method="POST">
                <h3 class="text-left fontRobReg fc-70 fs-30"><strong>Let us know more about you</strong></h3>
                <div class="form-group">
                    <!-- <input type="hidden" id="email_user" name="email_user" class="form-control border-70 fs-20 fontRobReg text-body mt-4" placeholder="Email user" value="<?php //echo($_GET['email'])?>" required> -->
                    <input type="text" required name="companyName" class="form-control border-70 fontRobReg text-body mt-5 fs-16" id="company" placeholder="Company Name">
                    <!-- <p class="text-danger fs-15 fontRobReg m-0" id="alertCompany" style="display: none;">Company has already registered</p> -->
                    <input type="text" required name="domain" class="form-control border-70 fs-16 fontRobReg text-body mt-4" id="domain" placeholder="Domain">
                    <input type="text" required name="address" class="form-control border-70 fs-16 fontRobReg text-body mt-4" id="address" placeholder="Address">
                    <input type="hidden" id="phone" name="phone" class="form-control border-70 fs-20 fontRobReg text-body mt-4" placeholder="Phone number" required>   

                </div>
                <button type="submit" name="submitInfo" class="btn nav-menu-btn-wht-alt py-1 px-3 w-100 m-0 my-4 fs-16">Next</button>
            </form>
        </div>
    </div>
</div>

<?php if(!empty($msg)): ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#myModal").modal("show");
        });
    </script>
<?php endif; ?>

<script type="text/javascript">
    function preventBack(){window.history.forward();}
    setTimeout("preventBack()", 0);
    window.onunload=function(){null};
</script>

<!-- <script type="text/javascript">
        function checkCompany(){
            var company = $('#company').val();

            
                $.ajax({
                    url: 'checkCompany.php',
                    type: 'get',
                    dataType: "json",
                    data: {company:company},
                    success: function(data) {
                        if(data.cnt > 0) {
                           $('#alertCompany').css('display','block');
                        } else {
                           $('#alertCompany').css('display','none');
                        }
                 }
             });
        }
</script> -->

</body>
</html>
