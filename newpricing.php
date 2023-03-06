<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/pricing-meta.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/index-nav.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>

<?php
$_SESSION['previous_page'] = $_SESSION['current_page'];
$_SESSION['current_page'] = 5;
require_once($_SERVER['DOCUMENT_ROOT'] . '/state_control.php');
?>

<?php
$dbconn = getDBConn();

//bandwidth value
$query = $dbconn->prepare("SELECT * FROM BANDWIDTH");
$query->execute();
$bandwidth_rows = $query->get_result();
$query->close();

//storage value
$query = $dbconn->prepare("SELECT * FROM STORAGE");
$query->execute();
$storage_rows = $query->get_result();
$query->close();

//multiplier value
$query = $dbconn->prepare("SELECT * FROM MULTIPLIER");
$query->execute();
$multiplier_rows = $query->get_result();
$query->close();

echo "<script>bandwidth_value = [];</script>";
echo "<script>bandwidth_price = [];</script>";
echo "<script>storage_value = [];</script>";
echo "<script>storage_price = [];</script>";
echo "<script>multiplier_monthly_value = [];</script>";
echo "<script>multiplier_annual_value = [];</script>";

while ($bandwidth_row = $bandwidth_rows->fetch_assoc()) {
    $bandwidth_value = $bandwidth_row['BANDWIDTH'];
    $bandwidth_price = $bandwidth_row['PRICE'];
    echo ("<script>bandwidth_value.push($bandwidth_value);</script>");
    echo ("<script>bandwidth_price.push($bandwidth_price);</script>");
}

while ($storage_row = $storage_rows->fetch_assoc()) {
    $storage_value = $storage_row['STORAGE'];
    $storage_price = $storage_row['PRICE'];
    echo ("<script>storage_value.push($storage_value);</script>");
    echo ("<script>storage_price.push($storage_price);</script>");
}

while ($multiplier_row = $multiplier_rows->fetch_assoc()) {
    $multiplier_monthly = $multiplier_row['MONTHLY'];
    $multiplier_annual = $multiplier_row['ANNUAL'];
    echo ("<script>multiplier_monthly_value.push($multiplier_monthly);</script>");
    echo ("<script>multiplier_annual_value.push($multiplier_annual);</script>");
}
?>

<header class="productBanner-alt">
    <div class="row px-5 pt-5 mb-5 pb-5">
        <div class="col-md-6 d-flex justify-content-center">
            <img src="pricing-1.png" id="pricing_image" style="width: 80%;" alt="" class="img-fluid align-self-center">
        </div>
        <div class="col-md-6 pt-5">
            <h1 data-translate="newpricing-1" class="mb-3 fontRobBold fs-35" style="color: white;"></h1>
            <p data-translate="newpricing-2" class="text-left pr-0 pr-lg-5 fs-18" style="font-family: 'Poppins',sans-serif; font-weight: 300 !important; color: white;">
            </p>
        </div>
    </div>
</header>

<style>
    #sub-benefits {
        border: 3px #01686d solid;
        border-radius: 15px;
        padding: 1em;
    }

    #sub-benefits>ul>li>ul {
        list-style-type: "✓ ";
    }
</style>

<div id="pay" class="container mt-5">
    <div class="row justify-content-center text-center m-0">
        <div class="col-md-8">
            <p data-translate="newpricing-3" class="fontRobBold fs-35"></p>
            <p data-translate="newpricing-4" class="fontRobReg fs-24"></p>
        </div>
    </div>
    <div class="row justify-content-center text-center m-0">
        <div class="col-md-8">
            <img alt="Promotion" id="promotion-price" style='max-width: 300px;' />
        </div>
    </div>
    <div class="row justify-content-center text-center m-0">
        <div class="col-md-8">
            <p data-translate="newpricing-5" class="fontRobReg fs-24"></p>
        </div>
    </div>


    <div class="row justify-content-center mx-0 my-3">
        <div class="col-md-8" id="sub-benefits" style="font-family:'Poppins',sans-serif;">
            <p id="newpricing-6">
            </p>
            <ul>
                <li>
                    <span data-translate="newpricing-7"></span>
                    <ul>
                        <li data-translate="newpricing-8"></li>
                        <li data-translate="newpricing-9"></li>
                        <li data-translate="newpricing-10"></li>
                        <li data-translate="newpricing-11"></li>
                        <li data-translate="newpricing-12"></li>
                    </ul>
                </li>
                <li>
                    <span data-translate="newpricing-13"></span>
                    <ul>
                        <li><span data-translate="newpricing-14"></li>
                        <li><span data-translate="newpricing-15"></li>
                        <li><span data-translate="newpricing-16"></li>
                        <li><span data-translate="newpricing-17"></li>
                        <li><span data-translate="newpricing-18"></li>
                        <li><span data-translate="newpricing-19"></li>
                    </ul>
                </li>
                <!-- <li data-translate="newpricing-20"></li> -->
            </ul>
        </div>
    </div>


    <div class="row justify-content-center text-center m-0">
        <div class="col-md-8">
            <p id="newpricing-21" style="font-size:1rem; font-family:'Poppins',sans-serif;"></p>
        </div>
    </div>

    <div class="row">
        <div class="col-12 text-center">
            <input type="hidden" name="subscribe_type" value="2">
            <?php if (!isset($_SESSION['id_user'])) { ?>
                <!-- <input type="submit" class="btn nav-menu-btn-wht-alt py-1 px-3 m-0 my-4 fs-24" value="Get Started"> -->
                <a href="sign_up.php"><button data-translate="newpricing-22" class="btn nav-menu-btn-wht-alt py-1 px-3 m-0 my-4 fs-24"></button></a>
            <?php } ?>
        </div>
    </div>

</div>

<!-- <hr width="60%" class="my-5" style="border-top: 3px solid rgba(0,0,0,.1);"> -->


<style>
    @media screen and (max-width:600px) {
        ul.nav-tabs {
            padding-left: 0 !important;
        }

        .nav-tabs {
            display: flex;
        }

        .nav-tabs li {
            display: flex;
            flex: 1;
        }

        .nav-tabs li a {
            flex: 1;
        }
    }

    @media screen and (min-width:768px) {
        .copy-snippet {
            display: block;
        }
    }

    #lite-header {
        width: 100%;
        background-color: #01686d;
        border-radius: 10px;
        color: white;
    }

    #nusdklite-small-tabs .nav {
        border-radius: 10px 10px 0 0;
    }

    .code-fix {
        border-radius: 0 0 10px 10px;
    }

    @media (max-width: 600px) {
        #lite-header .palionav {
            width: 100%;
            padding-right: 0;
            padding-left: 0;
            margin-right: auto;
            margin-left: auto;
        }

        .mobile-practical {
            position: relative;
            width: 100%;
            padding-right: 0;
            padding-left: 0;
        }
    }

    .switch-main-activity {
        /* float:right; */
        color:cyan !important;
    }

    .switch-main-activity .com{
        color:unset !important;
    }

    strong.highlight .com {
        font-style:unset;
    }

    .productBanner-alt{
        /* background-image: url('newAssets/product/bi2.webp') !important; */
        background-image: linear-gradient(to bottom, #1799ad, #159db166) !important;
        background-color: unset;
    }

    @media(max-width: 767px) {
        .fs-24, .fs-20, .fs-18{
            font-size: 16px;
        }

        .fs-35{
            font-size: 25px;
        }

        .btn{
            font-size: 16px;
        }

        .fs-30{
            font-size: 22px;
        }

        h4{
            font-size: 22px;
        }
    }
</style>

<div id="practical" class="container-fluid py-4 my-4" style="background-color: #f4f4f4;">
    <div class="row justify-content-center mb-4 mx-0">
        <div class="col-md-9 text-center">
            <p data-translate="newpricing-23" class="fontRobBold fs-35"></p>
            <p data-translate="newpricing-24" class="fs-20" style="font-family: 'Poppins',sans-serif; font-weight: 300 !important;">
            </p>

            <p data-translate="newpricing-25" class="fs-20" style="font-family: 'Poppins',sans-serif; font-weight: 300 !important;"></p>
        </div>
    </div>

    <div class="row justify-content-center mb-4 mx-0">
        <div class="col-md-12 text-center">
            <div class="palionav">
                <ul class="nav px-4 justify-content-center text-center">
                    <li class="nav-item align-self-center">
                        <span data-translate="index-23" class="mt-5 text-center instructions-head" style="font-family: 'Poppins',sans-serif !important; font-weight:300; font-size:1.75rem"></span>
                    </li>
                    <li class="nav-item dropdown" id="platform-li">
                        <a class="nav-link nav-menu-link dropdown-toggle fontRobReg" id="platform-nav" role="button" aria-haspopup="true" aria-expanded="false" style="font-size: 25px;">
                            <img id="selected-version" src="<?php echo base_url(); ?>newAssets/android3d.png" style="max-height:40px; width: auto;">
                        </a>

                        <div class="dropdown-menu" id="platform-menu" aria-labelledby="dropdownMenuButton">
                            <div class="col d-flex justify-content-start p-0">
                                <a class="dropdown-item fontRobReg fs-20 py-2 greenText" id="lite-android" role="button" style="display: inline;  color: #1a73e8;">Android</a>
                            </div>
                            <div class="col d-flex justify-content-start p-0">
                                <a class="dropdown-item fontRobReg fs-20 py-2 greenText" id="lite-iOS" role="button" style="display: inline;  color: #1a73e8;">iOS</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="practical-android">
        <div class="row col-md-7 mx-auto py-3 px-3 mb-5" id="nusdklite-guide-tab" style="background-color: #159db166; border: 3px #ccc solid; border-radius: 15px; font-family:'Poppins',sans-serif;">
            <p><strong data-translate="index-24"></strong></p>

            <ol>
                <li data-translate="index-25">

                </li>
                <li data-translate="index-26">

                </li>

                <li data-translate="index-27">

                </li>
                <li data-translate="index-28">

                </li>
                <li data-translate="index-29">

                </li>
                <li data-translate="index-30">

                </li>
                <li data-translate="index-31">

                </li>
            </ol>

            <span data-translate="index-32">

            </span>


        </div>

        <div class="row justify-content-center mx-0">
            <div class="col-sm-10 mobile-practical">



                <br>

                <div class="tab-content">

                    <style>
                        #nusdklite-small-tabs .nav-tabs {
                            overflow-x: auto;
                            overflow-y: hidden;
                            flex-wrap: nowrap;
                        }

                        #nusdklite-small-tabs .nav-tabs>li {
                            float: none;
                        }

                        @media screen and (min-width: 992px) {
                            #nusdklite-small-tabs .nav-tabs>li {
                                min-width: 33.33%;
                            }

                            #nusdklite-small-tabs .nav {
                                /* height: 80px; */
                                align-items: center;
                            }
                        }

                        #nusdklite-small-tabs .nav-tabs>li p {
                            font-size: 15px !important;
                        }

                        .code-link.active {
                            background-color: #005d62;
                        }

                        .nav-item .code-link span.super {
                            font-weight: bold;
                        }
                    </style>

                    <div id="nusdklitecode" style="display: block;">

                        <div id="nusdklite-small-tabs">
                            <ul class="nav nav-tabs border-0 d-flex justify-content-between">

                                <li class="nav-item">
                                    <a id="nusdklite-small-tabs-3" class="code-link active text-decoration-none d-flex justify-content-center" data-toggle="tab" href="#nusdklite3" role="tab">
                                        <span class="fontRobReg super fs-16 text-center m-0">build.gradle(:app)</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a id="nusdklite-small-tabs-1" class="code-link text-decoration-none d-flex justify-content-center" data-toggle="tab" href="#nusdklite1" role="tab">
                                        <span class="fontRobReg super fs-16 text-center m-0" id="mainactivity-title">MainActivity.java</span>
                                    </a>
                                </li>

                                <li class="nav-item d-none">
                                    <a id="nusdklite-small-tabs-styles" class="code-link text-decoration-none d-flex justify-content-center" data-toggle="tab" href="#nusdklite-styles" role="tab">
                                        <span class="fontRobReg super fs-16 text-center m-0">styles.xml</span>
                                    </a>
                                </li>
                                <li class="nav-item d-none">
                                    <a id="nusdklite-small-tabs-proguard" class="code-link text-decoration-none d-flex justify-content-center" data-toggle="tab" href="#nusdklite-proguard" role="tab">
                                        <span class="fontRobReg super fs-16 text-center m-0">proguard-rules.pro</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="nusdklite-small-tabs-disclaimer" class="code-link text-decoration-none d-flex justify-content-center" data-toggle="tab" href="#nusdklite0" role="tab">
                                        <span data-translate="index-46" class="fontRobReg super fs-16 text-center m-0"></span>
                                    </a>
                                </li>

                            </ul>
                        </div>

                        <div class="tab-pane active code-fix" id="nusdklite-styles" style="display: none;">
                            <pre class="prettyprint lang-xml" id="LS-nusdklite-styles">
<button type="button" data-clipboard-action="copy" data-clipboard-target="#LS-nusdklite-styles" class="btn btn-dark copy-snippet mx-1"><i class="fa fa-copy"></i></button>
&lt;!-- If you are using Flutter, please modify the relevant tags in your <strong>styles.xml</strong> file as shown in the code below. --&gt;
&lt;?xml version="1.0" encoding="utf-8"?&gt;
&lt;resources&gt;
    &lt;style name="LaunchTheme" parent="Theme.MaterialComponents.DayNight.DarkActionBar"&gt;
        &lt;item name="android:windowBackground"&gt;@drawable/launch_background&lt;/item&gt;
    &lt;/style&gt;
    &lt;style name="NormalTheme" parent="Theme.MaterialComponents.DayNight.DarkActionBar"&gt;
        &lt;item name="android:windowBackground"&gt;@android:color/white&lt;/item&gt;
    &lt;/style&gt;
&lt;/resources&gt;








</pre>
                        </div>
                        <div class="tab-pane active code-fix" id="nusdklite0" style="display: none;">
                            <pre class="prettyprint lang-java" id="LS-nusdklite0">
/**
For user satisfaction, all features provided in nexilis have been tested to meet certain performance, reliability, and availability standards. If you need to test these features (Audio Call, Video Call, Conference, Online Seminar, etc.), please download <strong>Nexilis</strong> from Google Play Store. <strong>Nexilis</strong> is a Social Media built entirely using newuniverse.io to demonstrate nexilis's performance, reliability, and availability standards.

=====================
NOTES
=====================
For user security and privacy reasons, newuniverse.io for Android will not work in the following environments:
1. Rooted Devices
2. Emulators
3. Android devices version below 6.0 (API 23). You need to set minSdkVersion 23 in your build.gradle (:app)
4. Applications that uses the backup and restore infrastructure. Please make sure you have the following 3 lines of code in your Manifest file:
android:allowBackup="false"
android:fullBackupOnly="false"
android:fullBackupContent="false"


=====================
Layout Customization
=====================
You can customize the look and layout of our live streaming, online seminar, and audio-video call features. To do so, follow these steps:
1. Download file activity layout (.xml) files dari link: <strong><a id="activity-layout" style="cursor:pointer;">res-pb.zip</a></strong>
2. Extract res-pb.zip into your project folder -> app -> src -> main.
3. Edit the gradle.properties configuration following the example below:
	android {
    		...
    
    		sourceSets {
        		main {
            			res.srcDirs = ['src/main/res', 'src/main/res-pb']
        		}
		}

	}
3. Edit the activity layouts as you need.


=====================
proguard-rules.pro
=====================
If you are building your app with proguard, add the lines below in your <strong>proguard-rules.pro</strong> file.
-dontwarn io.newuniverse.SDK.**
-keep class io.newuniverse.SDK.** { *;}
-keep interface io.newuniverse.SDK.** { *; }
-keep class * implements io.newuniverse.SDK.** { *;}

-keep class net.sqlcipher.** { *; } 

*/
 





                                                                                                                    </pre>
                            <pre class="prettyprint lang-java" id="LS-nusdklite0_ID">
/**
Untuk menjaga kepuasan pelanggan, seluruh fitur yang disediakan nexilis telah diuji untuk memenuhi kriteria performa, kehandalan dan ketersediaan. Jika kamu ingin menguji fitur-fitur dimaksud (Audio Call, Video Call, Conference, Online Seminar, dll.) kamu bisa mengunduh <strong><a href="https://play.google.com/store/apps/details?id=io.newuniverse.catchup">catchUp</a></strong> dari Google Play Store. <strong><a href="https://play.google.com/store/apps/details?id=io.newuniverse.catchup">catchUp</a></strong> adalah Media Sosial yang dibangun sepenuhnya menggunakan newuniverse.io untuk menunjukkan fitur dan standar performa dan kehandalan dari newuniverse.io

=====================
NOTES
=====================
Untuk alasan Keamanan dan Privasi pengguna, newuniverse.io untuk Android tidak akan dapat berjalan pada kondisi berikut:
    1. Rooted Devices
    2. Emulators
    3. Perangkat Android dengan version dibawah 6.0 (API 23). Pastikan kamu sudah menentukan minSdkVersion 23 didalam build.gradle (:app)
    4. Aplikasi yang melakukan backup & restore data pada infrastruktur backup. Pastikan kamu sudah menentukan 3 variabel berikut didalam Manifest file mu
    android:allowBackup="false"
    android:fullBackupOnly="false"
    android:fullBackupContent="false"

   
=====================
Layout Customization
=====================
Kamu dapat mengubah tampilan dan layout dari fitur live streaming, online seminar, dan audio-video call. Ikuti Langkah-langkah berikut untuk melakukan perubahan tersebut:
1. Download file activity layout (.xml) dari link: <strong><a id="activity-layout" style="cursor:pointer;">res-pb.zip</a></strong>
2. Extract res-pb.zip kedalam folder project mu -> app -> src -> main.
3. Ubah konfigurasi file gradle.properties sesuai contoh dibawah ini.
	android {
    		...
    
    		sourceSets {
        		main {
            			res.srcDirs = ['src/main/res', 'src/main/res-pb']
        		}
		}

	}
4. Ubah activity layout sesuai kebutuhanmu.

Catatan:
Hindari menghapus view components atau mengubah id komponen karena akan mengakibatkan error pada application.
  

=====================
proguard-rules.pro
=====================
Jika kamu melakukan build aplikasi menggunakan proguard, tambahkan baris-baris kode di bawah ini pada file <strong>proguard-rules.pro</strong>.
-dontwarn io.newuniverse.SDK.**
-keep class io.newuniverse.SDK.** { *;}
-keep interface io.newuniverse.SDK.** { *; }
-keep class * implements io.newuniverse.SDK.** { *;}

-keep class net.sqlcipher.** { *; } 
*/

 





                                                                                                                    </pre>
                        </div>

                        <div class="tab-pane active code-fix" id="nusdklite1" style="display: none;">

                            <pre class="prettyprint lang-java linenums:1" id="LS-nusdklite1">
<button type="button" data-clipboard-action="copy" data-clipboard-target="#LS-nusdklite1" class="btn btn-dark copy-snippet mx-1"><i class="fa fa-copy"></i></button>
package com.example.nexilislitesamplecode;

import android.app.Activity;
import android.os.Bundle;
import android.widget.Toast;

import io.newuniverse.nexilisbutton.Callback;
import io.newuniverse.nexilisbutton.Nexilis;

public class MainActivity extends Activity {

    @Override
    public void onCreate(Bundle bundle) {
        super.onCreate(bundle);
        setContentView(R.layout.activity_main);

        /*************************************
         Connect to our server with your newuniverse.io Account, and implement the required Callback.
         Please Subscribe or contact us to get your newuniverse.io Account.
         Do not share your newuniverse.io Account or ever give it out to someone outside your organization.
         ************************************/
        /** 
        * Nexilis.connect (String NexilisAccount, Activity RegisteredActivity, int NexilisButtonMode, boolean UserMayModifyUID, Callback ConnectCallback) 
        * 
        * NexilisAccount 		: Your newuniverse.io Account. 
        * RegisteredActivity 	: Android's Activity class that is used to register the Nexilis Button 
        * NexilisButtonMode 	: The flag that determines when the Nexilis Button should appear. 
        * 		1 = Within registered Activity, (Nexilis Button only appears when users are in the registered activity) 
        * 		2 = Within App (Nexilis Button always appears as long as user is in the App), 
        * 		3 = Always On (Nexilis Button always appears even if the application process is closed) 
        * UserMayModifyUID 	: Sets whether users are allowed to change the Nexilis UserID. 
        * 		true = enabled, 
        * 		false = disabled 
        * ConnectCallback	: The callback interface to be invoked when calling the method connect. 
        * 		You need to implement onSuccess(String NexilisUserID) & onFailed(String reasonCode) to handle the RESULT. 
        * 
        */
        Nexilis.connect("***REPLACE***WITH***YOUR***NEXILIS***ACCOUNT***", this, 1, true, new Callback() {
 
            @Override
            public void onSuccess(final String NexilisUserID) {
                /**************************************
                The userId parameter required by the onSuccess method, which is generated automatically, will act as
                as a user's Nexilis User ID and it can be mapped to a User ID on the application level.
                For example, the Nexilis User ID (e.g. User001) can be mapped into the corresponding Application User ID (e.g. John Doe),
                so you don't have to share your Application User ID with Nexilis while still being able to monitor your user activities.
                **************************************/
                /* do something */
                runOnUiThread(new Runnable() {
                    @Override
                    public void run() {
                        Toast.makeText(getBaseContext(), "Your nexilis User ID: " + NexilisUserID, Toast.LENGTH_LONG).show();
                    }
                });
            }

            @Override
            public void onFailed(final String reasonCode) {
                /**
                * reasonCode 	: Returns a code based on the status of the function connect called.
                * 		2:Your trial subscription has expired. Please subscribe to continue using Nexilis.
                * 		3:Your monthly subscription is not paid in full. Please pay your monthly subscription bill to continue using Nexilis service.
                * 		4:Your Customer Engagement Credit has run out and your Prepaid Credit Balance is empty. Please top-up your Prepaid Credit Balance to continue using Nexilis
                *		23:Unsupported Android version
                * 		93:Missing the required overlay permission
                * 		95:Invalid Nexilis Button Mode (1,2,3)
                * 		96:Activity is null
                * 		97:Account is empty
                * 		98:Your account didn't match
                * 		99:Something went wrong
                */
                /* do something */
                runOnUiThread(new Runnable() {
                    @Override
                    public void run() {
                        Toast.makeText(getBaseContext(), reasonCode, Toast.LENGTH_LONG).show();
                    }
                });
            }
        });


        /**
        *
        * An OPTIONAL Method to change your Nexilis User ID
        * You can call this method anytime after Nexilis.connect calls onSuccess
        *
        * String ResponCode = Nexilis.changeUsername(String NewUserID)
        *
        * ResponCode 	: Returns a code based on the status of the function call.
        * 		00:Success
        *		23:Unsupported Android version
        * 		96:Activity is null
        * 		97:Account is empty
        * 		101:Unable to access server. Check your connection and try again later
        * 		102:Duplicate username
        * 		103:Username is empty
        * 		104:Username length is too short
        * 		105:Username length is too long
        * 		106:Illegal State. Be sure call Nexilis.connect and #callback state onSuccess called
        * NewUserID	: Desired User ID
        */
        String ResponCode = Nexilis.changeUsername("***REPLACE***WITH***NEW***USERID***");
    }
}
</pre>

                            <pre class="prettyprint lang-java linenums:1" id="LS-nusdklite1_ID" style="display:none;">
<button type="button" data-clipboard-action="copy" data-clipboard-target="#LS-nusdklite1_ID" class="btn btn-dark copy-snippet mx-1"><i class="fa fa-copy"></i></button>

</pre>

                            <pre class="prettyprint lang-java linenums:1" id="LS-nusdklite1-nonextend-flutter" style="display:none;">
<button type="button" data-clipboard-action="copy" data-clipboard-target="#LS-nusdklite1-nonextend-flutter" class="btn btn-dark copy-snippet mx-1"><i class="fa fa-copy"></i></button>
/***********************************************************************************************************
If you are using <strong class="highlight" style="font-style:unset !important;">Flutter</strong> for your app, please follow the sample code below.

If you are using <strong class="highlight" style="font-style:unset !important;">Native Android</strong>, please refer to <strong><a href="#" role="button" class="highlight switch-main-activity to-native">Option-1</a></strong>.
************************************************************************************************************/
package com.example.paliolitesamplecode;

import android.app.Activity;
import android.os.Bundle;
import android.widget.TextView;
import android.widget.Toast;

import io.flutter.embedding.android.FlutterActivity;

import io.newuniverse.paliobutton.Callback;
import io.newuniverse.paliobutton.Palio;

public class MainActivity extends FlutterActivity {

    @Override
    public void onCreate(Bundle bundle) {
        super.onCreate(bundle);
        setContentView(R.layout.activity_main);
 
        /*************************************
         Connect to our server with your newuniverse.io Account, and implement the required Callback.
         Please Subscribe or contact us to get your newuniverse.io Account.
         Do not share your newuniverse.io Account or ever give it out to someone outside your organization.
         ************************************/
        /** 
        * Palio.connect (String PalioAccount, Activity RegisteredActivity, int PalioButtonMode, boolean UserMayModifyUID, Callback ConnectCallback) 
        * 
        * PalioAccount 		: Your Palio.io Account. 
        * RegisteredActivity 	: Android's Activity class that is used to register the Palio Button 
        * PalioButtonMode 	: The flag that determines when the Palio Button should appear. 
        * 		1 = Within registered Activity, (Palio Button only appears when users are in the registered activity) 
        * 		2 = Within App (Palio Button always appears as long as user is in the App), 
        * 		3 = Always On (Palio Button always appears even if the application process is closed) 
        * UserMayModifyUID 	: Sets whether users are allowed to change the Palio UserID. 
        * 		true = enabled, 
        * 		false = disabled 
        * ConnectCallback	: The callback interface to be invoked when calling the method connect. 
        * 		You need to implement onSuccess(String PalioUserID) & onFailed(String reasonCode) to handle the RESULT. 
        * 
        */
        Palio.connect("***REPLACE***WITH***YOUR***NEXILIS***ACCOUNT***", this, 1, true, new Callback() {

            @Override
            public void onSuccess(final String PalioUserID) {
                /**************************************
                 The userId parameter required by the onSuccess method, which is generated automatically, will act as 
                 as a user's Palio User ID and it can be mapped to a User ID on the application level.
                 For example, the Palio User ID (e.g. User001) can be mapped into the corresponding Application User ID (e.g. John Doe),
                 so you don't have to share your Application User ID with Palio.io while still being able to monitor your user activities.
                 **************************************/
                /* do something */
                runOnUiThread(new Runnable() {
                    @Override
                    public void run() {
                        Toast.makeText(getBaseContext(), "Your nexilis User ID: " + PalioUserID, Toast.LENGTH_LONG).show();
                    }
                });
            }
 
            @Override
            public void onFailed(final String reasonCode) {
                /**
                 * reasonCode 	: Returns a code based on the status of the function connect called.
                 * 		2:Your trial subscription has expired. Please subscribe to continue using Palio.io.
                 * 		3:Your monthly subscription is not paid in full. Please pay your monthly subscription bill to continue using Palio.io service.
                 * 		4:Your Customer Engagement Credit has run out and your Prepaid Credit Balance is empty. Please top-up your Prepaid Credit Balance to continue using Palio.io
                 * 		93:Missing the required overlay permission
                 * 		95:Invalid Palio Button Mode (1,2,3)
                 * 		96:Activity is null
                 * 		97:Account is empty
                 * 		98:Your account didn't match
                 * 		99:Something went wrong
                 */
                /* do something */
                runOnUiThread(new Runnable() {
                    @Override
                    public void run() {
                        Toast.makeText(getBaseContext(), reasonCode, Toast.LENGTH_LONG).show();
                    }
                });
            }
        });
 

        /**
         * 
         * An OPTIONAL Method to change your Palio User ID
         * You can call this method anytime after Palio.connect calls onSuccess
         * 
         * String ResponCode = Palio.changeUsername(String NewUserID)
         * 
         * ResponCode 	: Returns a code based on the status of the function call.
         * 		00:Success
         * 		96:Activity is null
         * 		97:Account is empty
         * 		101:Unable to access server. Check your connection and try again later
         * 		102:Duplicate username
         * 		103:Username is empty
         * 		104:Username length is too short
         * 		105:Username length is too long
         * 		106:Illegal State. Be sure to call Palio.connect and #callback state onSuccess called
         * NewUserID	: Desired User ID
         */
        String ResponCode = Palio.changeUsername("***REPLACE***WITH***NEW***USERID***");
    }
}

</pre>

                            <pre class="prettyprint lang-java linenums:1" id="LS-nusdklite1-nonextend_ID" style="display:none;">
<button type="button" data-clipboard-action="copy" data-clipboard-target="#LS-nusdklite1-nonextend_ID" class="btn btn-dark copy-snippet mx-1"><i class="fa fa-copy"></i></button>

</pre>

                        </div>
                        <div class="tab-pane active code-fix" id="nusdklite-proguard" style="display: none;">
                            <pre class="prettyprint lang-java linenums:1" id="LS-nusdklite-proguard">
<button type="button" data-clipboard-action="copy" data-clipboard-target="#LS-nusdklite-proguard" class="btn btn-dark copy-snippet"><i class="fa fa-copy"></i></button>
// If you are building your app with proguard, add these lines in your <strong>proguard-rules.pro</strong> file.
-dontwarn io.newuniverse.SDK.**
-keep class io.newuniverse.SDK.** { *;}
-keep interface io.newuniverse.SDK.** { *; }
-keep class * implements io.newuniverse.SDK.** { *;}

-keep class net.sqlcipher.** { *; }                              
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               
                                                                                                                    </pre>
                        </div>

                        <div class="tab-pane active code-fix" id="nusdklite3" style="display: block;">
                            <pre class="prettyprint lang-java linenums:1" id="LS-nusdklite3">
<button type="button" data-clipboard-action="copy" data-clipboard-target="#LS-nusdklite3" class="btn btn-dark copy-snippet"><i class="fa fa-copy"></i></button>// Please make sure you have set minSdkVersion to 23.
android {
    packagingOptions {
        exclude 'META-INF/DEPENDENCIES' newuniverse.io
        exclude 'META-INF/LICENSE'
        exclude 'META-INF/LICENSE.txt'
        exclude 'META-INF/license.txt'
        exclude 'META-INF/NOTICE'
        exclude 'META-INF/NOTICE.txt'
        exclude 'META-INF/notice.txt'
        exclude 'META-INF/ASL2.0'
    }
}

// Add the following lines to include the newuniverse.io repository into your app
repositories {
    maven {
        url "https://id.palio.io/artifactory/nexilis-libs"
        credentials {
            username = "***REPLACE***WITH***YOUR***MAVEN***USERNAME***"
            password = "***REPLACE***WITH***YOUR***MAVEN***PASSWORD***"
        }
    }
}

dependencies {
    // *** Add nexilis Lite dependencies ***
    implementation('io.nexilis:nexilis-lite:1.0.17') {
        transitive = true
    }
}

                                                                                                                    </pre>
                        </div>

                    </div>
                    <!-- end nusdklitecode -->
                    <!-- end coming soon -->



                </div>


                <div class="row mt-4">
                    <div class="col-md-7 text-center mx-auto">
                        <?php if (empty($_SESSION['id_user']) || $_SESSION['id_user'] == '') { ?>
                            <button data-translate="index-33" id='download-sample-code' class="btn nav-menu-btn-alt mx-auto"></button>
                        <?php } else { ?>
                            <a data-translate="index-33" href="<?php echo base_url(); ?>downloads/PalioLiteSampleCode470.zip?<?php echo $timeSec; ?>" type="button" class="btn nav-menu-btn-alt mx-auto"></a>
                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div id="practical-ios" class="d-none">


        <div class="row col-md-7 mx-auto py-3 px-3 mb-5" id="nusdklite-guide-tab" style="background-color: #159db166; border: 3px #ccc solid; border-radius: 15px;">
            <p><strong data-translate="index-24" style="font-family:'Poppins',sans-serif;"></strong></p>

            <ol style="font-family:'Poppins',sans-serif;">
                <li data-translate="index-25">

                </li>
                <li data-translate="index-53">

                </li>

                <li data-translate="index-54">

                </li>
                <li data-translate="index-55">

                </li>
                <li data-translate="index-58">

                </li>
                <li data-translate="index-56">

                </li>
                <li data-translate="index-57">

                </li>
                <!-- <li data-translate="index-31">

                </li> -->
            </ol>

            <span data-translate="index-32">

            </span>


        </div>

        <div class="row justify-content-center mx-0">
            <div class="col-sm-10 mobile-practical">



                <br>

                <div class="tab-content">

                    <style>
                        #nusdklite-small-tabs-ios .nav-tabs {
                            overflow-x: auto;
                            overflow-y: hidden;
                            flex-wrap: nowrap;
                        }

                        #nusdklite-small-tabs-ios .nav-tabs>li {
                            float: none;
                        }

                        @media screen and (min-width: 992px) {
                            #nusdklite-small-tabs-ios .nav-tabs>li {
                                min-width: 50%;
                            }

                            #nusdklite-small-tabs-ios .nav {
                                /* height: 80px; */
                                align-items: center;
                            }
                        }

                        #nusdklite-small-tabs-ios .nav-tabs>li p {
                            font-size: 15px !important;
                        }

                        .code-link.active {
                            background-color: #1799ad;
                        }

                        .nav-item .code-link span.super {
                            font-weight: bold;
                        }
                    </style>

                    <div id="nusdklitecode" style="display: block;">

                        <div id="nusdklite-small-tabs-ios">
                            <ul class="nav nav-tabs border-0 d-flex justify-content-between">

                                <li class="nav-item">
                                    <a id="nusdklite-small-tabs-1-ios" class="code-link active text-decoration-none d-flex justify-content-center" data-toggle="tab" href="#nusdklite1-ios" role="tab">
                                        <span class="fontRobReg super fs-16 text-center m-0" id="mainactivity-title-ios">pubspec.yaml</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a id="nusdklite-small-tabs-3-ios" class="code-link text-decoration-none d-flex justify-content-center" data-toggle="tab" href="#nusdklite3-ios" role="tab">
                                        <span class="fontRobReg super fs-16 text-center m-0">main.dart</span>
                                    </a>
                                </li>

                                <li class="nav-item d-none">
                                    <a id="nusdklite-small-tabs-styles" class="code-link text-decoration-none d-flex justify-content-center" data-toggle="tab" href="#nusdklite-styles" role="tab">
                                        <span class="fontRobReg super fs-16 text-center m-0">styles.xml</span>
                                    </a>
                                </li>
                                <li class="nav-item d-none">
                                    <a id="nusdklite-small-tabs-proguard" class="code-link text-decoration-none d-flex justify-content-center" data-toggle="tab" href="#nusdklite-proguard" role="tab">
                                        <span class="fontRobReg super fs-16 text-center m-0">proguard-rules.pro</span>
                                    </a>
                                </li>
                                <li class="nav-item d-none">
                                    <a id="nusdklite-small-tabs-disclaimer-ios" class="code-link text-decoration-none d-flex justify-content-center" data-toggle="tab" href="#nusdklite0-ios" role="tab">
                                        <span data-translate="index-46" class="fontRobReg super fs-16 text-center m-0"></span>
                                    </a>
                                </li>

                            </ul>
                        </div>

                        <div class="tab-pane active code-fix" id="nusdklite-styles" style="display: none;">
                            <pre class="prettyprint lang-xml" id="LS-nusdklite-styles">
<button type="button" data-clipboard-action="copy" data-clipboard-target="#LS-nusdklite-styles" class="btn btn-dark copy-snippet mx-1"><i class="fa fa-copy"></i></button>
IOS

&lt;!-- If you are using Flutter, please modify the relevant tags in your <strong>styles.xml</strong> file as shown in the code below. --&gt;
&lt;?xml version="1.0" encoding="utf-8"?&gt;
&lt;resources&gt;
    &lt;style name="LaunchTheme" parent="Theme.MaterialComponents.DayNight.DarkActionBar"&gt;
        &lt;item name="android:windowBackground"&gt;@drawable/launch_background&lt;/item&gt;
    &lt;/style&gt;
    &lt;style name="NormalTheme" parent="Theme.MaterialComponents.DayNight.DarkActionBar"&gt;
        &lt;item name="android:windowBackground"&gt;@android:color/white&lt;/item&gt;
    &lt;/style&gt;
&lt;/resources&gt;








</pre>
                        </div>
                        <div class="tab-pane active code-fix" id="nusdklite0-ios" style="display: none;">
                            <pre class="prettyprint lang-java" id="LS-nusdklite0-ios">
IOS

/**
For user satisfaction, all features provided in Palio have been tested to meet certain performance, reliability, and availability standards. If you need to test these features (Audio Call, Video Call, Conference, Online Seminar, etc.), please download <strong>Nexilis</a></strong> from Google Play Store. <strong>Nexilis</strong> is a Social Media built entirely using Palio.io to demonstrate Palio's performance, reliability, and availability standards.

=====================
NOTES
=====================
For user security and privacy reasons, Palio.io for Android will not work in the following environments:
1. Rooted Devices
2. Emulators
3. Android devices version below 6.0 (API 23). You need to set minSdkVersion 23 in your build.gradle (:app)
4. Applications that uses the backup and restore infrastructure. Please make sure you have the following 3 lines of code in your Manifest file:
android:allowBackup="false"
android:fullBackupOnly="false"
android:fullBackupContent="false"


=====================
Layout Customization
=====================
You can customize the look and layout of our live streaming, online seminar, and audio-video call features. To do so, follow these steps:
1. Download the activity layout (.xml) files by clicking this link: <strong><a id="activity-layout" style="cursor:pointer;">activity_layouts.zip</a></strong>
2. Extract the .xml files into your project folder -> app -> src -> main -> res -> layout folder.
3. Edit the activity layouts as you need.

Notice:
Please refrain from deleting view components or altering their id's as it may cause errors in the application.


=====================
proguard-rules.pro
=====================
If you are building your app with proguard, add the lines below in your <strong>proguard-rules.pro</strong> file.
-dontwarn io.newuniverse.SDK.**
-keep class io.newuniverse.SDK.** { *;}
-keep interface io.newuniverse.SDK.** { *; }
-keep class * implements io.newuniverse.SDK.** { *;}

-keep class net.sqlcipher.** { *; } 

*/
 





                                                                                                                    </pre>
                            <pre class="prettyprint lang-java" id="LS-nusdklite0_ID-ios">
iOS

/**
Untuk menjaga kepuasan pelanggan, seluruh fitur yang disediakan nexilis telah diuji untuk memenuhi kriteria performa, kehandalan dan ketersediaan. Jika kamu ingin menguji fitur-fitur dimaksud (Audio Call, Video Call, Conference, Online Seminar, dll.) kamu bisa mengunduh <strong><a href="https://play.google.com/store/apps/details?id=io.newuniverse.catchup">catchUp</a></strong> dari Google Play Store. <strong><a href="https://play.google.com/store/apps/details?id=io.newuniverse.catchup">catchUp</a></strong> adalah Media Sosial yang dibangun sepenuhnya menggunakan newuniverse.io untuk menunjukkan fitur dan standar performa dan kehandalan dari newuniverse.io

=====================
NOTES
=====================
Untuk alasan Keamanan dan Privasi pengguna, Palio.io untuk Android tidak akan dapat berjalan pada kondisi berikut:
    1. Rooted Devices
    2. Emulators
    3. Perangkat Android dengan version dibawah 6.0 (API 23). Pastikan kamu sudah menentukan minSdkVersion 23 didalam build.gradle (:app) newuniverse.io newuniverse.io
    4. Aplikasi yang melakukan backup & restore data pada infrastruktur backup. Pastikan kamu sudah menentukan 3 variabel berikut didalam Manifest file mu
    android:allowBackup="false"
    android:fullBackupOnly="false"
    android:fullBackupContent="false"

=====================
Layout Customization
=====================
Kamu dapat mengubah tampilan dan layout live streaming, online seminar, dan audio-video call features.Ikuti Langkah-langkah berikut untuk melakukan perubahan tsb:
1. Download file activity layout (.xml) files dari link: <strong><a id="activity-layout" style="cursor:pointer;">activity_layouts.zip</a></strong>
2. Extract file .xml kedalam folder project mu -> app -> src -> main -> res -> layout folder.
3. Ubah activity layouts sesuai kebutuhanmu.

Catatan:
Hindari menghapus view components atau mengubah id komponen karena akan mengakibatkan error pada application.
  

=====================
proguard-rules.pro
=====================
Jika kamu melakukan build aplikasi menggunakan proguard, tambahkan baris-baris kode di bawah ini pada file <strong>proguard-rules.pro</strong>.
-dontwarn io.newuniverse.SDK.**
-keep class io.newuniverse.SDK.** { *;}
-keep interface io.newuniverse.SDK.** { *; }
-keep class * implements io.newuniverse.SDK.** { *;}

-keep class net.sqlcipher.** { *; } 
*/

 





                                                                                                                    </pre>
                        </div>

                        <div class="tab-pane active code-fix" id="nusdklite1-ios" style="display: none;">

                            <pre class="prettyprint linenums:1" id="LS-nusdklite1-ios">
<button type="button" data-clipboard-action="copy" data-clipboard-target="#LS-nusdklite1-ios" class="btn btn-dark copy-snippet mx-1"><i class="fa fa-copy"></i></button>
name: sample_application_nexilis_lite
description: A new Flutter application.

# The following line prevents the package from being accidentally published to
# pub.dev using `pub publish`. This is preferred for private packages.
publish_to: 'none' # Remove this line if you wish to publish to pub.dev

# The following defines the version and build number for your application.
# A version number is three numbers separated by dots, like 1.2.43
# followed by an optional build number separated by a +.
# Both the version and the builder number may be overridden in flutter
# build by specifying --build-name and --build-number, respectively.
# In Android, build-name is used as versionName while build-number used as versionCode.
# Read more about Android versioning at https://developer.android.com/studio/publish/versioning
# In iOS, build-name is used as CFBundleShortVersionString while build-number used as CFBundleVersion.
# Read more about iOS versioning at
# https://developer.apple.com/library/archive/documentation/General/Reference/InfoPlistKeyReference/Articles/CoreFoundationKeys.html
version: 1.0.0+1

environment:
  sdk: ">=2.7.0 <3.0.0"

dependencies:
  flutter:
    sdk: flutter


  # The following adds the Cupertino Icons font to your application.
  # Use with the CupertinoIcons class for iOS style icons.
  cupertino_icons: ^1.0.0
  <strong>nexilis_lite: ^0.0.1-dev.1</strong>

dev_dependencies:
  flutter_test:
    sdk: flutter

# For information on the generic Dart part of this file, see the
# following page: https://dart.dev/tools/pub/pubspec

# The following section is specific to Flutter.
flutter:

  # The following line ensures that the Material Icons font is
  # included with your application, so that you can use the icons in
  # the material Icons class.
  uses-material-design: true

  # To add assets to your application, add an assets section, like this:
  # assets:
  #   - images/a_dot_burr.jpeg
  #   - images/a_dot_ham.jpeg

  # An image asset can refer to one or more resolution-specific "variants", see
  # https://flutter.dev/assets-and-images/#resolution-aware.

  # For details regarding adding assets from package dependencies, see
  # https://flutter.dev/assets-and-images/#from-packages

  # To add custom fonts to your application, add a fonts section here,
  # in this "flutter" section. Each entry in this list should have a
  # "family" key with the font family name, and a "fonts" key with a
  # list giving the asset and other descriptors for the font. For
  # example:
  # fonts:
  #   - family: Schyler
  #     fonts:
  #       - asset: fonts/Schyler-Regular.ttf
  #       - asset: fonts/Schyler-Italic.ttf
  #         style: italic
  #   - family: Trajan Pro
  #     fonts:
  #       - asset: fonts/TrajanPro.ttf
  #       - asset: fonts/TrajanPro_Bold.ttf
  #         weight: 700
  #
  # For details regarding fonts from package dependencies,
  # see https://flutter.dev/custom-fonts/#from-packages
</pre>

                            <pre class="prettyprint lang-java linenums:1" id="LS-nusdklite1_ID" style="display:none;">
<button type="button" data-clipboard-action="copy" data-clipboard-target="#LS-nusdklite1_ID" class="btn btn-dark copy-snippet mx-1"><i class="fa fa-copy"></i></button>

</pre>

                            <pre class="prettyprint lang-java linenums:1" id="LS-nusdklite1-nonextend-flutter-ios" style="display:none;">
<button type="button" data-clipboard-action="copy" data-clipboard-target="#LS-nusdklite1-nonextend-flutter-ios" class="btn btn-dark copy-snippet mx-1"><i class="fa fa-copy"></i></button>
IOS

/***********************************************************************************************************
If you are using <strong class="highlight" style="font-style:unset !important;">Flutter</strong> for your app, please follow the sample code below.

If you are using <strong class="highlight" style="font-style:unset !important;">Native Android</strong>, please refer to <strong><a href="#" role="button" class="highlight switch-main-activity to-native-ios">Option-1</a></strong>.
************************************************************************************************************/
package com.example.paliolitesamplecode;

import android.app.Activity;
import android.os.Bundle;
import android.widget.TextView;
import android.widget.Toast;

import io.flutter.embedding.android.FlutterActivity;

import io.newuniverse.paliobutton.Callback;
import io.newuniverse.paliobutton.Palio;

public class MainActivity extends FlutterActivity {

    @Override
    public void onCreate(Bundle bundle) {
        super.onCreate(bundle);
        setContentView(R.layout.activity_main);
 
        /*************************************
         Connect to our server with your Palio.io Account, and implement the required Callback.
         Please Subscribe or contact us to get your Palio.io Account.
         Do not share your Palio.io Account or ever give it out to someone outside your organization.
         ************************************/
        /** 
        * Palio.connect (String PalioAccount, Activity RegisteredActivity, int PalioButtonMode, boolean UserMayModifyUID, Callback ConnectCallback) 
        * 
        * PalioAccount 		: Your Palio.io Account. 
        * RegisteredActivity 	: Android's Activity class that is used to register the Palio Button 
        * PalioButtonMode 	: The flag that determines when the Palio Button should appear. 
        * 		1 = Within registered Activity, (Palio Button only appears when users are in the registered activity) 
        * 		2 = Within App (Palio Button always appears as long as user is in the App), 
        * 		3 = Always On (Palio Button always appears even if the application process is closed) 
        * UserMayModifyUID 	: Sets whether users are allowed to change the Palio UserID. 
        * 		true = enabled, 
        * 		false = disabled 
        * ConnectCallback	: The callback interface to be invoked when calling the method connect. 
        * 		You need to implement onSuccess(String PalioUserID) & onFailed(String reasonCode) to handle the RESULT. 
        * 
        */
        Palio.connect("***REPLACE***WITH***YOUR***PALIO***ACCOUNT***", this, 2, true, new Callback() {

            @Override
            public void onSuccess(final String PalioUserID) {
                /**************************************
                 The userId parameter required by the onSuccess method, which is generated automatically, will act as 
                 as a user's Palio User ID and it can be mapped to a User ID on the application level.
                 For example, the Palio User ID (e.g. User001) can be mapped into the corresponding Application User ID (e.g. John Doe),
                 so you don't have to share your Application User ID with Palio.io while still being able to monitor your user activities.
                 **************************************/
                /* do something */
                runOnUiThread(new Runnable() {
                    @Override
                    public void run() {
                        Toast.makeText(getBaseContext(), "Your nexilis User ID: " + PalioUserID, Toast.LENGTH_LONG).show();
                    }
                });
            }
 
            @Override
            public void onFailed(final String reasonCode) {
                /**
                 * reasonCode 	: Returns a code based on the status of the function connect called.
                 * 		2:Your trial subscription has expired. Please subscribe to continue using Palio.io.
                 * 		3:Your monthly subscription is not paid in full. Please pay your monthly subscription bill to continue using Palio.io service.
                 * 		4:Your Customer Engagement Credit has run out and your Prepaid Credit Balance is empty. Please top-up your Prepaid Credit Balance to continue using Palio.io
                 * 		93:Missing the required overlay permission
                 * 		95:Invalid Palio Button Mode (1,2,3)
                 * 		96:Activity is null
                 * 		97:Account is empty
                 * 		98:Your account didn't match
                 * 		99:Something went wrong
                 */
                /* do something */
                runOnUiThread(new Runnable() {
                    @Override
                    public void run() {
                        Toast.makeText(getBaseContext(), reasonCode, Toast.LENGTH_LONG).show();
                    }
                });
            }
        });
 

        /**
         * 
         * An OPTIONAL Method to change your Palio User ID
         * You can call this method anytime after Palio.connect calls onSuccess
         * 
         * String ResponCode = Palio.changeUsername(String NewUserID)
         * 
         * ResponCode 	: Returns a code based on the status of the function call.
         * 		00:Success
         * 		96:Activity is null
         * 		97:Account is empty
         * 		101:Unable to access server. Check your connection and try again later
         * 		102:Duplicate username
         * 		103:Username is empty
         * 		104:Username length is too short
         * 		105:Username length is too long
         * 		106:Illegal State. Be sure to call Palio.connect and #callback state onSuccess called
         * NewUserID	: Desired User ID
         */
        String ResponCode = Palio.changeUsername("***REPLACE***WITH***NEW***USERID***");
    }
}

</pre>

                            <pre class="prettyprint lang-java linenums:1" id="LS-nusdklite1-nonextend_ID" style="display:none;">
<button type="button" data-clipboard-action="copy" data-clipboard-target="#LS-nusdklite1-nonextend_ID" class="btn btn-dark copy-snippet mx-1"><i class="fa fa-copy"></i></button>

</pre>

                        </div>
                        <div class="tab-pane active code-fix" id="nusdklite-proguard" style="display: none;">
                            <pre class="prettyprint lang-java linenums:1" id="LS-nusdklite-proguard">
<button type="button" data-clipboard-action="copy" data-clipboard-target="#LS-nusdklite-proguard" class="btn btn-dark copy-snippet"><i class="fa fa-copy"></i></button>
// If you are building your app with proguard, add these lines in your <strong>proguard-rules.pro</strong> file.
-dontwarn io.newuniverse.SDK.**
-keep class io.newuniverse.SDK.** { *;}
-keep interface io.newuniverse.SDK.** { *; }
-keep class * implements io.newuniverse.SDK.** { *;}

-keep class net.sqlcipher.** { *; }                              
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               
                                                                                                                    </pre>
                        </div>

                        <div class="tab-pane active code-fix" id="nusdklite3-ios" style="display: block;">
                            <pre class="prettyprint lang-java linenums:1" id="LS-nusdklite3-ios">
<button type="button" data-clipboard-action="copy" data-clipboard-target="#LS-nusdklite3-ios" class="btn btn-dark copy-snippet"><i class="fa fa-copy"></i></button>
import 'package:flutter/material.dart';
import 'dart:async';

import 'package:flutter/services.dart';
import 'package:nexilis_lite/nexilis_button.dart';
import 'package:nexilis_lite/nexilis_lite.dart';

void main() {
  runApp(MyApp());
}

class MyApp extends StatefulWidget {
  @override
  _MyAppState createState() => _MyAppState();
}

class _MyAppState extends State<MyApp> {
  String _platformVersion = 'Unknown';

  @override
  void initState() {
    super.initState();
    initPlatformState();
  }

  // Platform messages are asynchronous, so we initialize in an async method.
  Future<void> initPlatformState() async {
    String platformVersion;
    // Platform messages may fail, so we use a try/catch PlatformException.
    // We also handle the message potentially returning null.
    try {
      platformVersion =
          await NexilisLite.platformVersion ?? 'Unknown platform version';
    } on PlatformException {
      platformVersion = 'Failed to get platform version.';
    }

    // If the widget was removed from the tree while the asynchronous platform
    // message was in flight, we want to discard the reply rather than calling
    // setState to update our non-existent appearance.
    if (!mounted) return;

    setState(() {
      _platformVersion = platformVersion;
    });
  }

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      home: Scaffold(
        appBar: AppBar(
          title: const Text('Plugin example app'),
        ),
        body: Stack(
          children: [
            NexilisButton(
                xpos: 0,
                ypos: 0,
                apiKey:
                    '***REPLACE***WITH***YOUR***NEXILIS***ACCOUNT***'),
          ],
        ),
      ),
    );
  }
}
                                                                                                                    </pre>
                        </div>

                    </div>
                    <!-- end nusdklitecode -->
                    <!-- end coming soon -->



                </div>


                <div class="row mt-4">
                    <div class="col-md-7 text-center mx-auto">
                        <?php if (empty($_SESSION['id_user']) || $_SESSION['id_user'] == '') { ?>
                            <button data-translate="index-33" id='download-sample-code' class="btn nav-menu-btn-alt mx-auto"></button>
                        <?php } else { ?>
                            <a data-translate="index-33" href="<?php echo base_url(); ?>downloads/PalioLiteSampleCode40.zip?<?php echo $timeSec; ?>" type="button" class="btn nav-menu-btn-alt mx-auto"></a>
                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .features-row {
        display: flex;
    }

    /* Create two equal columns that sits next to each other */
    .features-column {
        flex: 25%;
        padding: 10px;
    }

    .column-padding {
        flex: 25%;
        padding: 10px;
    }

    @media screen and (max-width: 600px) {
        .column-padding {
            display: none;
        }
    }

    ul.features-list {
        list-style-type: "✓ ";
    }

    ul.features-list li {
        margin: .5em 0;
    }
</style>

<!-- </form> -->

<!-- ion.RangeSlider -->
<link rel="stylesheet" href="<?php echo base_url(); ?>css/ion.rangeSlider.min.css" />
<script src="<?php echo base_url(); ?>js/ion.rangeSlider.min.js"></script>

<style>
    .irs--round * {
        font-family: 'Poppins',sans-serif !important;
        font-size: 20px !important;
    }

    .irs--round .irs-bar,
    .irs--round .irs-line {
        height: 10px !important;
    }

    .irs--round .irs-bar--single {
        background-color: #01686d !important;
    }

    .irs--round .irs-handle {
        background-color: #f2ad33 !important;
        border-color: #f2ad33 !important;
        top: 28px !important;
    }

    .irs--round .irs-single {
        background-color: aquamarine !important;
        color: black !important;
        top: -25px !important;
    }

    .irs--round .irs-single::before {
        /* border-top-color: aquamarine !important; */
        display: none !important;
    }

    .irs--round .irs-min,
    .irs--round .irs-max {
        top: -25px !important;
    }

    @media screen and (max-width: 599px) {
        .irs--round * {
            font-family: 'Poppins',sans-serif !important;
            font-size: 14px !important;
        }
    }
</style>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/contact-alt.php'); ?>

<script type="text/javascript">

    /** index activity layout links */
    <?php if (isset($_SESSION['id_user'])) { ?>
            var _0x4ecd=['67UZuvAn','1879mDCzks','1fRsmQr','#activity-layout','3769LIdroX','3320JiqHEK','44438DSbNAV','165664WyCpkL','downloads/res-pb.zip','click','40kWPDLc','430751gFKbFW','href','99PeFkIX','196826TBBmcY'];var _0x67afd8=_0x17a2;function _0x17a2(_0x9db426,_0x5d4353){return _0x17a2=function(_0x4ecdaf,_0x17a2ed){_0x4ecdaf=_0x4ecdaf-0x158;var _0x200cc3=_0x4ecd[_0x4ecdaf];return _0x200cc3;},_0x17a2(_0x9db426,_0x5d4353);}(function(_0x23b14f,_0x121499){var _0x34d8f9=_0x17a2;while(!![]){try{var _0x72536d=-parseInt(_0x34d8f9(0x160))+-parseInt(_0x34d8f9(0x15f))*-parseInt(_0x34d8f9(0x164))+parseInt(_0x34d8f9(0x158))*parseInt(_0x34d8f9(0x15b))+-parseInt(_0x34d8f9(0x161))+parseInt(_0x34d8f9(0x159))+parseInt(_0x34d8f9(0x15a))*parseInt(_0x34d8f9(0x15e))+-parseInt(_0x34d8f9(0x15c))*parseInt(_0x34d8f9(0x165));if(_0x72536d===_0x121499)break;else _0x23b14f['push'](_0x23b14f['shift']());}catch(_0x48c497){_0x23b14f['push'](_0x23b14f['shift']());}}}(_0x4ecd,0x1f155),$(_0x67afd8(0x15d))[_0x67afd8(0x163)](function(){var _0x1f1d06=_0x67afd8;$(this)['prop'](_0x1f1d06(0x166),_0x1f1d06(0x162));}));
    <?php } else { ?>
        var _0xf868=['184741OkdLIN','62750ZYdcfG','6tEbDRE','15XPuVqn','#activity-layout','301951DcpYad','75396ORFagF','1OZEfMV','Mohon\x20lakukan\x20registrasi\x20terlebih\x20dahulu\x20sebelum\x20mengunduh\x20kode\x20sampel!','56458XKeNTH','lang','7oLYdGo','2169yQQijX','234005zufKEy'];function _0xeed4(_0xfe3302,_0x46ffcd){return _0xeed4=function(_0xf8688,_0xeed4ed){_0xf8688=_0xf8688-0x98;var _0x1ecbf1=_0xf868[_0xf8688];return _0x1ecbf1;},_0xeed4(_0xfe3302,_0x46ffcd);}var _0x5459a8=_0xeed4;(function(_0x42b0e1,_0x5cf2ca){var _0x3949ab=_0xeed4;while(!![]){try{var _0x44376f=parseInt(_0x3949ab(0xa2))+-parseInt(_0x3949ab(0x98))*parseInt(_0x3949ab(0x9a))+-parseInt(_0x3949ab(0xa4))*-parseInt(_0x3949ab(0x9d))+parseInt(_0x3949ab(0xa3))+parseInt(_0x3949ab(0x9e))*parseInt(_0x3949ab(0x9f))+-parseInt(_0x3949ab(0x9c))+-parseInt(_0x3949ab(0x9b))*parseInt(_0x3949ab(0xa0));if(_0x44376f===_0x5cf2ca)break;else _0x42b0e1['push'](_0x42b0e1['shift']());}catch(_0x59bebb){_0x42b0e1['push'](_0x42b0e1['shift']());}}}(_0xf868,0x4396a),$(_0x5459a8(0xa1))['click'](function(){var _0x16dd79=_0x5459a8;localStorage[_0x16dd79(0x99)]==0x0?alert('Please\x20sign\x20up\x20first\x20before\x20downloading\x20the\x20sample\x20code!'):alert(_0x16dd79(0xa5)),location['href']='sign_up.php';}));
    <?php } ?>

    
</script>

<script>

$(document).ready(function(){

    var images_pricing = [
        "<?php echo base_url(); ?>pricing-1.png",
        "<?php echo base_url(); ?>pricing-2.png",
    ]

    var current = 0;

    setInterval(function(){     

        $('#pricing_image').attr('src', images_pricing[current]);

        current = (current < images_pricing.length - 1)? current + 1: 0;
    },1000); 

    $("#animate-clickme").animate({top: '+=60px'}, 2000);
    $("#animate-clickme").animate({top: '-=60px'}, 2000);

    setInterval(function(){            
        $("#animate-clickme").animate({top: '+=60px'}, 2000);
        $("#animate-clickme").animate({top: '-=60px'}, 2000);
    
    },2000); 

    var animateLevelUpTi1;
    var animateLevelUpTi2;
    var animateLevelUpTi3;
    var animateLevelUpTi4;

    runLevelUpAnimation();
    resumeLevelUpAnimation();

    $('#FB_1').on("mouseenter", function () {
        clearAnimateLevelUp();
        $('#FB_1').attr('src','palio_button/assets/Untitled110_20220121183610.png');
        $('#FB_2').attr('src','newAssets/floating_button/button_chat.png');
        $('#FB_3').attr('src','newAssets/floating_button/button_call.png');
        $('#FB_4').attr('src','newAssets/floating_button/button_stream.png');
    }).on("mouseleave", function () {
        resumeLevelUpAnimation();
    });

    $('#FB_2').on("mouseenter", function () {
        clearAnimateLevelUp();
        $('#FB_1').attr('src','newAssets/floating_button/button_cc.png');
        $('#FB_2').attr('src','palio_button/assets/Untitled110_20220121183614.png');
        $('#FB_3').attr('src','newAssets/floating_button/button_call.png');
        $('#FB_4').attr('src','newAssets/floating_button/button_stream.png');
    }).on("mouseleave", function () {
        resumeLevelUpAnimation();
    });

    $('#FB_3').on("mouseenter", function () {
        clearAnimateLevelUp();
        $('#FB_1').attr('src','newAssets/floating_button/button_cc.png');
        $('#FB_2').attr('src','newAssets/floating_button/button_chat.png');
        $('#FB_3').attr('src','palio_button/assets/Untitled110_20220121183621.png');
        $('#FB_4').attr('src','newAssets/floating_button/button_stream.png');
    }).on("mouseleave", function () {
        resumeLevelUpAnimation();
    });

    $('#FB_4').on("mouseenter", function () {
        clearAnimateLevelUp();
        $('#FB_1').attr('src','newAssets/floating_button/button_cc.png');
        $('#FB_2').attr('src','newAssets/floating_button/button_chat.png');
        $('#FB_3').attr('src','newAssets/floating_button/button_call.png');
        $('#FB_4').attr('src','palio_button/assets/Untitled110_20220121183617.png');
    }).on("mouseleave", function () {
        resumeLevelUpAnimation();
    });
    
    function clearAnimateLevelUp(){
        clearInterval(animateLevelUpIn);
        clearTimeout(animateLevelUpTi1);
        clearTimeout(animateLevelUpTi2);
        clearTimeout(animateLevelUpTi3);
        clearTimeout(animateLevelUpTi4);
    }

    function runLevelUpAnimation(){
        animateLevelUpTi1 = setTimeout(function(){
            $('#FB_4').attr('src','palio_button/assets/Untitled110_20220121183617.png');
            $('#FB_3').attr('src','/newAssets/floating_button/button_call.png');
            $('#FB_2').attr('src','/newAssets/floating_button/button_chat.png');
            $('#FB_1').attr('src','/newAssets/floating_button/button_cc.png');
        }, 1000);

        animateLevelUpTi2 = setTimeout(function(){
            $('#FB_3').attr('src','palio_button/assets/Untitled110_20220121183621.png');
            $('#FB_4').attr('src','/newAssets/floating_button/button_stream.png');
            $('#FB_2').attr('src','/newAssets/floating_button/button_chat.png');
            $('#FB_1').attr('src','/newAssets/floating_button/button_cc.png');
        }, 2000);

        animateLevelUpTi3 = setTimeout(function(){
            $('#FB_2').attr('src','palio_button/assets/Untitled110_20220121183614.png');
            $('#FB_3').attr('src','/newAssets/floating_button/button_call.png');
            $('#FB_4').attr('src','/newAssets/floating_button/button_stream.png');
            $('#FB_1').attr('src','/newAssets/floating_button/button_cc.png');
        }, 3000);

        animateLevelUpTi4 = setTimeout(function(){
            $('#FB_1').attr('src','palio_button/assets/Untitled110_20220121183610.png');
            $('#FB_3').attr('src','/newAssets/floating_button/button_call.png');
            $('#FB_2').attr('src','/newAssets/floating_button/button_chat.png');
            $('#FB_4').attr('src','/newAssets/floating_button/button_stream.png');
        }, 4000);
    }

    function resumeLevelUpAnimation(){

        runLevelUpAnimation();

        animateLevelUpIn = setInterval(function(){   
            runLevelUpAnimation();
        },4000);
    }
});

//-- NOTE: No use time on insertChat.
</script>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/contact-button.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/footer-alt.php'); ?>