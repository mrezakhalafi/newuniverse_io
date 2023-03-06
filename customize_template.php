<?php
    // function changeNameByEmail($template,$email,$filename){
    //     $content = file_get_contents($filename);
    //     $embedname = '';
    //     if(is_array($email)){
    //         $partsemail = explode('@',$email[0]);
    //         $embedname = $partsemail[0];
    //         if($template == 'Hi!'){
    //             $email[0] = 'Hi '.$partsemail[0].'!';
    //         }elseif($template == 'Pal!'){
    //             $email[0] = $partsemail[0].'!';
    //         }else{
    //             $email[0] = $partsemail[0];
    //         }
    //         $content = str_replace($template,$email,$content);
    //     }else{
    //         $partsemail = explode('@',$email);
    //         $embedname = $partsemail[0];
    //         if($template == 'Hi!'){
    //             $name = 'Hi '.$partsemail[0].'!';
    //         }elseif($template == 'Pal!'){
    //             $name = $partsemail[0].'!';
    //         }else{
    //             $name = $partsemail[0];
    //         }
    //         $content = str_replace($template,$name,$content);
    //     }
    //     $content = str_replace('href=""','href="https://palio.io"',$content);
    //     $content = str_replace('https://twitter.com/palio_SDK','https://localhost/redirect_tw.php?username='.$embedname,$content);
    //     $content = str_replace('https://www.facebook.com/Palio-103214787950780/','https://localhost/redirect_fb.php?username='.$embedname,$content);
    //     $content = str_replace('https://www.linkedin.com/company/31365478/','https://localhost/redirect_li.php?username='.$embedname,$content);
    //     $content = str_replace('https://www.instagram.com/palio_sdk/','https://localhost/redirect_ig.php?username='.$embedname,$content);
    //     $parts = explode('.',$filename);
    //     $newname = $parts[0].'-new.'.$parts[1];
    //     file_put_contents($newname,$content);
    // }

    // function changeName($template,$name,$filename){
    //     $content = file_get_contents($filename);
    //     $embedname = '';
    //     if(is_array($name)){
    //         if($template == 'Hi!'){
    //             $email[0] = 'Hi '.$name[0].'!';
    //         }elseif($template == 'Pal!'){
    //             $email[0] = $name[0].'!';
    //         }else{
    //             $email[0] = $name[0];
    //         }
    //         $content = str_replace($template,$name,$content);
    //     }else{
    //         if($template == 'Hi!'){
    //             $name = 'Hi '.$name.'!';
    //         }elseif($template == 'Pal!'){
    //             $name = $name.'!';
    //         }else{
    //             $name = $name[0];
    //         }
    //         $content = str_replace($template,$name,$content);
    //     }
    //     $content = str_replace('https://twitter.com/palio_SDK','https://palio.io/redirect_tw.php?username='.$embedname,$content);
    //     $content = str_replace('https://www.facebook.com/Palio-103214787950780/','https://palio.io/redirect_fb.php?username='.$embedname,$content);
    //     $content = str_replace('https://www.linkedin.com/company/31365478/','https://palio.io/redirect_li.php?username='.$embedname,$content);
    //     $content = str_replace('https://www.instagram.com/palio_sdk/','https://palio.io/redirect_ig.php?username='.$embedname,$content);
    //     $parts = explode('.',$filename);
    //     $newname = $parts[0].'-new.'.$parts[1];
    //     file_put_contents($newname,$content);
    //     // return $content;
    // }

    function customizeTemplateByName($template,$name,$filename){
        $content = file_get_contents($filename);
        $embedname = '';
        if(is_array($name)){
            $embedname = $name[0];
            if($template == 'Hi!'){
                $name[0] = 'Hi '.$name[0].'!';
            }elseif($template == 'Pal!'){
                $name[0] = $name[0].'!';
            }else{
                $name[0] = $name[0];
            }
            $content = str_replace($template,$name,$content);
            if ($filename = 'template/WelcometoPalio.htm'){
                $content = str_replace('href="http://"','href="https://palio.io"',$content);
            }
            if ($filename = 'template/FreeTrial.htm' || $filename = 'template/ExpiredFreeTrial.htm' || $filename = 'template/SpecialOfferingv1.htm' || $filename = 'template/Payment.htm'){
                $content = str_replace('href=""','href="https://palio.io/login.php"',$content);
            }else{
                $content = str_replace('href=""','href="https://palio.io"',$content);
            }
            $content = str_replace('https://twitter.com/palio_SDK','https://palio.io/redirect_tw.php?username='.$embedname,$content);
            $content = str_replace('https://www.facebook.com/Palio-103214787950780/','https://palio.io/redirect_fb.php?username='.$embedname,$content);
            $content = str_replace('https://www.linkedin.com/company/31365478/','https://palio.io/redirect_li.php?username='.$embedname,$content);
            $content = str_replace('https://www.instagram.com/palio_sdk/','https://palio.io/redirect_ig.php?username='.$embedname,$content);
        }else{
            $embedname = $name;
            if($filename != 'template/Personalized BCA .htm' || $filename != 'template/Launching.htm' ){
                if($template == 'Hi!'){
                    $name = 'Hi '.$name.'!';
                }elseif($template == 'Pal!'){
                    $name = $name.'!';
                }else{
                    $name = $name;
                }
                $content = str_replace($template,$name,$content);
            }
            if ($filename = 'template/WelcometoPalio.htm'){
                $content = str_replace('href="http://"','href="https://palio.io"',$content);
            }
            if ($filename = 'template/FreeTrial.htm' || $filename = 'template/ExpiredFreeTrial.htm' || $filename = 'template/SpecialOfferingv1.htm' || $filename = 'template/Payment.htm'){
                $content = str_replace('href=""','href="https://palio.io/login.php"',$content);
            }else{
                $content = str_replace('href=""','href="https://palio.io"',$content);
            }
            $content = str_replace('https://twitter.com/palio_SDK','https://palio.io/redirect_tw.php?username='.$embedname,$content);
            $content = str_replace('https://www.facebook.com/Palio-103214787950780/','https://palio.io/redirect_fb.php?username='.$embedname,$content);
            $content = str_replace('https://www.linkedin.com/company/31365478/','https://palio.io/redirect_li.php?username='.$embedname,$content);
            $content = str_replace('https://www.instagram.com/palio_sdk/','https://palio.io/redirect_ig.php?username='.$embedname,$content);
        }
        return $content;
    }

    function customizeTemplateRemoteByName($template,$name,$filename){
        $content = file_get_contents($filename);
        $embedname = '';
        if(is_array($name)){
            $embedname = $name[0];
            if($template == 'Hi!'){
                $name[0] = 'Hi '.$name[0].'!';
            }elseif($template == 'Pal!'){
                $name[0] = $name[0].'!';
            }else{
                $name[0] = $name[0];
            }
            $content = str_replace($template,$name,$content);
            if ($filename = 'template/WelcometoPalio.htm'){
                $content = str_replace('href="http://"','href="http://103.94.169.26:8081"',$content);
            }
            if ($filename = 'template/FreeTrial.htm' || $filename = 'template/ExpiredFreeTrial.htm' || $filename = 'template/SpecialOfferingv1.htm' || $filename = 'template/Payment.htm'){
                $content = str_replace('href=""','href="http://103.94.169.26:8081/login.php"',$content);
            }else{
                $content = str_replace('href=""','href="http://103.94.169.26:8081"',$content);
            }
            $content = str_replace('https://twitter.com/palio_SDK','http://103.94.169.26:8081/redirect_tw.php?username='.$embedname,$content);
            $content = str_replace('https://www.facebook.com/Palio-103214787950780/','http://103.94.169.26:8081/redirect_fb.php?username='.$embedname,$content);
            $content = str_replace('https://www.linkedin.com/company/31365478/','http://103.94.169.26:8081/redirect_li.php?username='.$embedname,$content);
            $content = str_replace('https://www.instagram.com/palio_sdk/','http://103.94.169.26:8081/redirect_ig.php?username='.$embedname,$content);
        }else{
            $embedname = $name;
            if($filename != 'template/Personalized BCA .htm' || $filename != 'template/Launching.htm' ){
                if($template == 'Hi!'){
                    $name = 'Hi '.$name.'!';
                }elseif($template == 'Pal!'){
                    $name = $name.'!';
                }else{
                    $name = $name;
                }
                $content = str_replace($template,$name,$content);
            }
            if ($filename = 'template/WelcometoPalio.htm'){
                $content = str_replace('href="http://"','href="http://103.94.169.26:8081"',$content);
            }
            if ($filename = 'template/FreeTrial.htm' || $filename = 'template/ExpiredFreeTrial.htm' || $filename = 'template/SpecialOfferingv1.htm' || $filename = 'template/Payment.htm'){
                $content = str_replace('href=""','href="http://103.94.169.26:8081/login.php"',$content);
            }else{
                $content = str_replace('href=""','href="http://103.94.169.26:8081"',$content);
            }
            $content = str_replace('https://twitter.com/palio_SDK','http://103.94.169.26:8081/redirect_tw.php?username='.$embedname,$content);
            $content = str_replace('https://www.facebook.com/Palio-103214787950780/','http://103.94.169.26:8081/redirect_fb.php?username='.$embedname,$content);
            $content = str_replace('https://www.linkedin.com/company/31365478/','http://103.94.169.26:8081/redirect_li.php?username='.$embedname,$content);
            $content = str_replace('https://www.instagram.com/palio_sdk/','http://103.94.169.26:8081/redirect_ig.php?username='.$embedname,$content);
        }
        // $parts = explode('.',$filename);
        // $newname = $parts[0].'-new.'.$parts[1];
        // file_put_contents($newname,$content);
        return $content;
    }

    function customizeTemplateLocalByName($template,$name,$filename){
        $content = file_get_contents($filename);
        $embedname = '';
        if(is_array($name)){
            $embedname = $name[0];
            if($template == 'Hi!'){
                $name[0] = 'Hi '.$name[0].'!';
            }elseif($template == 'Pal!'){
                $name[0] = $name[0].'!';
            }else{
                $name[0] = $name[0];
            }
            $content = str_replace($template,$name,$content);
            if ($filename = 'template/WelcometoPalio.htm'){
                $content = str_replace('href="http://"','href="http://192.168.0.31/"',$content);
            }
            if ($filename = 'template/FreeTrial.htm' || $filename = 'template/ExpiredFreeTrial.htm' || $filename = 'template/SpecialOfferingv1.htm' || $filename = 'template/Payment.htm'){
                $content = str_replace('href=""','href="http://192.168.0.31/login.php"',$content);
            }else{
                $content = str_replace('href=""','href="http://192.168.0.31/"',$content);
            }
            $content = str_replace('https://twitter.com/palio_SDK','http://192.168.0.31/redirect_tw.php?username='.$embedname,$content);
            $content = str_replace('https://www.facebook.com/Palio-103214787950780/','http://192.168.0.31/redirect_fb.php?username='.$embedname,$content);
            $content = str_replace('https://www.linkedin.com/company/31365478/','http://192.168.0.31/redirect_li.php?username='.$embedname,$content);
            $content = str_replace('https://www.instagram.com/palio_sdk/','http://192.168.0.31/redirect_ig.php?username='.$embedname,$content);
        }else{
            $embedname = $name;
            if($filename != 'template/Personalized BCA .htm' || $filename != 'template/Launching.htm' ){
                if($template == 'Hi!'){
                    $name = 'Hi '.$name.'!';
                }elseif($template == 'Pal!'){
                    $name = $name.'!';
                }else{
                    $name = $name;
                }
                $content = str_replace($template,$name,$content);
            }
            if ($filename = 'template/WelcometoPalio.htm'){
                $content = str_replace('href="http://"','href="http://192.168.0.31/"',$content);
            }
            if ($filename = 'template/FreeTrial.htm' || $filename = 'template/ExpiredFreeTrial.htm' || $filename = 'template/SpecialOfferingv1.htm' || $filename = 'template/Payment.htm'){
                $content = str_replace('href=""','href="http://192.168.0.31/login.php"',$content);
            }else{
                $content = str_replace('href=""','href="http://192.168.0.31/"',$content);
            }
            $content = str_replace('https://twitter.com/palio_SDK','http://192.168.0.31/redirect_tw.php?username='.$embedname,$content);
            $content = str_replace('https://www.facebook.com/Palio-103214787950780/','http://192.168.0.31/redirect_fb.php?username='.$embedname,$content);
            $content = str_replace('https://www.linkedin.com/company/31365478/','http://192.168.0.31/redirect_li.php?username='.$embedname,$content);
            $content = str_replace('https://www.instagram.com/palio_sdk/','http://192.168.0.31/redirect_ig.php?username='.$embedname,$content);
        }

        
        return $content;
    }

    function customizeTemplateEmailConfirmation($name,$link){
        $content = file_get_contents('template/PalioEmailConfirmation.htm');
        $embedname = $name;
        $content = str_replace('&lt;USER NAME or EMAIL&gt;',$name,$content);
        $content = str_replace('href=""','href="'.$link.'"',$content);
        $content = str_replace('https://twitter.com/palio_SDK','https://palio.io/redirect_tw.php?username='.$embedname,$content);
        $content = str_replace('https://www.facebook.com/Palio-103214787950780/','https://palio.io/redirect_fb.php?username='.$embedname,$content);
        $content = str_replace('https://www.linkedin.com/company/31365478/','https://palio.io/redirect_li.php?username='.$embedname,$content);
        $content = str_replace('https://www.instagram.com/palio_sdk/','https://palio.io/redirect_ig.php?username='.$embedname,$content);
        return $content;
    }

    function customizeTemplateRemoteEmailConfirmation($name,$link){
        $content = file_get_contents('template/PalioEmailConfirmation.htm');
        $embedname = $name;
        $content = str_replace('&lt;USER NAME or EMAIL&gt;',$name,$content);
        $content = str_replace('href=""','href="'.$link.'"',$content);
        $content = str_replace('https://twitter.com/palio_SDK','http://103.94.169.26:8081/redirect_tw.php?username='.$embedname,$content);
        $content = str_replace('https://www.facebook.com/Palio-103214787950780/','http://103.94.169.26:8081/redirect_fb.php?username='.$embedname,$content);
        $content = str_replace('https://www.linkedin.com/company/31365478/','http://103.94.169.26:8081/redirect_li.php?username='.$embedname,$content);
        $content = str_replace('https://www.instagram.com/palio_sdk/','http://103.94.169.26:8081/redirect_ig.php?username='.$embedname,$content);
        
        // $parts = explode('.',$filename);
        // $newname = $parts[0].'-new.'.$parts[1];
        // file_put_contents($newname,$content);

        $content = str_replace('cid:image002', 'https://newuniverse.io/template/PalioEmailConfirmation_files/newuniverse.png', $content);
        $content = str_replace('cid:image004', 'https://newuniverse.io/template/PalioEmailConfirmation_files/image004.jpg', $content);
        $content = str_replace('cid:image006', 'https://newuniverse.io/template/PalioEmailConfirmation_files/mail_icon.jpg', $content);

        return $content;
    }

    function customizeTemplateLocalEmailConfirmation($name,$apikey){
        $content = file_get_contents('template/PalioEmailConfirmation.htm');
        $embedname = $name;
        $content = str_replace('&lt;USER NAME or EMAIL&gt;',$name,$content);
        $content = str_replace('href=""','href="'.$link.'"',$content);
        $content = str_replace('https://twitter.com/palio_SDK','http://192.168.0.31/redirect_tw.php?username='.$embedname,$content);
        $content = str_replace('https://www.facebook.com/Palio-103214787950780/','http://192.168.0.31/redirect_fb.php?username='.$embedname,$content);
        $content = str_replace('https://www.linkedin.com/company/31365478/','http://192.168.0.31/redirect_li.php?username='.$embedname,$content);
        $content = str_replace('https://www.instagram.com/palio_sdk/','http://192.168.0.31/redirect_ig.php?username='.$embedname,$content);
        return $content;
    }

    function customizeTemplateAPIKey($name,$apikey){
        $content = file_get_contents('template/PalioAPIKey.htm');
        $embedname = $name;
        $content = str_replace('Pal!',$name,$content);
        $content = str_replace('XXXXXXXXXXXXXXX',$apikey,$content);
        $content = str_replace('https://twitter.com/palio_SDK','https://palio.io/redirect_tw.php?username='.$embedname,$content);
        $content = str_replace('https://www.facebook.com/Palio-103214787950780/','https://palio.io/redirect_fb.php?username='.$embedname,$content);
        $content = str_replace('https://www.linkedin.com/company/31365478/','https://palio.io/redirect_li.php?username='.$embedname,$content);
        $content = str_replace('https://www.instagram.com/palio_sdk/','https://palio.io/redirect_ig.php?username='.$embedname,$content);
        return $content;
    }

    function customizeTemplateRemoteAPIKey($name,$apikey){
        $content = file_get_contents('template/PalioAPIKey.htm');
        $embedname = $name;
        $content = str_replace('Pal!',$name,$content);
        $content = str_replace('XXXXXXXXXXXXXXX',$apikey,$content);
        $content = str_replace('https://twitter.com/palio_SDK','http://103.94.169.26:8081/redirect_tw.php?username='.$embedname,$content);
        $content = str_replace('https://www.facebook.com/Palio-103214787950780/','http://103.94.169.26:8081/redirect_fb.php?username='.$embedname,$content);
        $content = str_replace('https://www.linkedin.com/company/31365478/','http://103.94.169.26:8081/redirect_li.php?username='.$embedname,$content);
        $content = str_replace('https://www.instagram.com/palio_sdk/','http://103.94.169.26:8081/redirect_ig.php?username='.$embedname,$content);
        return $content;
    }

    function customizeTemplateLocalAPIKey($name,$apikey){
        $content = file_get_contents('template/PalioAPIKey.htm');
        $embedname = $name;
        $content = str_replace('Pal!',$name,$content);
        $content = str_replace('XXXXXXXXXXXXXXX',$apikey,$content);
        $content = str_replace('https://twitter.com/palio_SDK','http://192.168.0.31/redirect_tw.php?username='.$embedname,$content);
        $content = str_replace('https://www.facebook.com/Palio-103214787950780/','http://192.168.0.31/redirect_fb.php?username='.$embedname,$content);
        $content = str_replace('https://www.linkedin.com/company/31365478/','http://192.168.0.31/redirect_li.php?username='.$embedname,$content);
        $content = str_replace('https://www.instagram.com/palio_sdk/','http://192.168.0.31/redirect_ig.php?username='.$embedname,$content);
        return $content;
    }

    function customizeTemplateByEmail($template,$email,$filename){
        $content = file_get_contents($filename);
        $embedname = '';
        if(is_array($email)){
            $partsemail = explode('@',$email[0]);
            $embedname = $partsemail[0];
            if($template == 'Hi!'){
                $email[0] = 'Hi '.$partsemail[0].'!';
            }elseif($template == 'Pal!'){
                $email[0] = $partsemail[0].'!';
            }else{
                $email[0] = $partsemail[0];
            }
            $content = str_replace($template,$email,$content);
            if ($filename = 'template/WelcometoPalio.htm'){
                $content = str_replace('href="http://"','href="https://palio.io"',$content);
            }
            if ($filename = 'template/FreeTrial.htm' || $filename = 'template/ExpiredFreeTrial.htm' || $filename = 'template/SpecialOfferingv1.htm' || $filename = 'template/Payment.htm'){
                $content = str_replace('href=""','href="https://palio.io/login.php"',$content);
            }else{
                $content = str_replace('href=""','href="https://palio.io"',$content);
            }
            $content = str_replace('https://twitter.com/palio_SDK','https://palio.io/redirect_tw.php?username='.$embedname,$content);
            $content = str_replace('https://www.facebook.com/Palio-103214787950780/','https://palio.io/redirect_fb.php?username='.$embedname,$content);
            $content = str_replace('https://www.linkedin.com/company/31365478/','https://palio.io/redirect_li.php?username='.$embedname,$content);
            $content = str_replace('https://www.instagram.com/palio_sdk/','https://palio.io/redirect_ig.php?username='.$embedname,$content);
        }else{
            $partsemail = explode('@',$email);
            $embedname = $partsemail[0];
            if($filename != 'template/Personalized BCA .htm' || $filename != 'template/Launching.htm' ){
                if($template == 'Hi!'){
                    $email = 'Hi '.$partsemail[0].'!';
                }elseif($template == 'Pal!'){
                    $email = $partsemail[0].'!';
                }else{
                    $email = $partsemail[0];
                }
                $content = str_replace($template,$email,$content);
            }
            if ($filename = 'template/WelcometoPalio.htm'){
                $content = str_replace('href="http://"','href="https://palio.io"',$content);
            }
            if ($filename = 'template/FreeTrial.htm' || $filename = 'template/ExpiredFreeTrial.htm' || $filename = 'template/SpecialOfferingv1.htm' || $filename = 'template/Payment.htm'){
                $content = str_replace('href=""','href="https://palio.io/login.php"',$content);
            }else{
                $content = str_replace('href=""','href="https://palio.io"',$content);
            }
            $content = str_replace('https://twitter.com/palio_SDK','https://palio.io/redirect_tw.php?username='.$embedname,$content);
            $content = str_replace('https://www.facebook.com/Palio-103214787950780/','https://palio.io/redirect_fb.php?username='.$embedname,$content);
            $content = str_replace('https://www.linkedin.com/company/31365478/','https://palio.io/redirect_li.php?username='.$embedname,$content);
            $content = str_replace('https://www.instagram.com/palio_sdk/','https://palio.io/redirect_ig.php?username='.$embedname,$content);
        }
        return $content;
    }

    function customizeTemplateRemoteByEmail($template,$email,$filename){
        $content = file_get_contents($filename);
        $embedname = '';
        if(is_array($name)){
            $partsemail = explode('@',$email[0]);
            $embedname = $partsemail[0];
            if($template == 'Hi!'){
                $email[0] = 'Hi '.$partsemail[0].'!';
            }elseif($template == 'Pal!'){
                $email[0] = $partsemail[0].'!';
            }else{
                $email[0] = $partsemail[0];
            }
            $content = str_replace($template,$email,$content);
            if ($filename = 'template/WelcometoPalio.htm'){
                $content = str_replace('href="http://"','href="http://103.94.169.26:8081"',$content);
            }
            if ($filename = 'template/FreeTrial.htm' || $filename = 'template/ExpiredFreeTrial.htm' || $filename = 'template/SpecialOfferingv1.htm' || $filename = 'template/Payment.htm'){
                $content = str_replace('href=""','href="http://103.94.169.26:8081/login.php"',$content);
            }else{
                $content = str_replace('href=""','href="http://103.94.169.26:8081"',$content);
            }
            $content = str_replace('https://twitter.com/palio_SDK','http://103.94.169.26:8081/redirect_tw.php?username='.$embedname,$content);
            $content = str_replace('https://www.facebook.com/Palio-103214787950780/','http://103.94.169.26:8081/redirect_fb.php?username='.$embedname,$content);
            $content = str_replace('https://www.linkedin.com/company/31365478/','http://103.94.169.26:8081/redirect_li.php?username='.$embedname,$content);
            $content = str_replace('https://www.instagram.com/palio_sdk/','http://103.94.169.26:8081/redirect_ig.php?username='.$embedname,$content);
        }else{
            $partsemail = explode('@',$email);
            $embedname = $partsemail[0];
            if($filename != 'template/Personalized BCA .htm' || $filename != 'template/Launching.htm' ){
                if($template == 'Hi!'){
                    $email = 'Hi '.$partsemail[0].'!';
                }elseif($template == 'Pal!'){
                    $email = $partsemail[0].'!';
                }else{
                    $email = $partsemail[0];
                }
                $content = str_replace($template,$email,$content);
            }
            if ($filename = 'template/WelcometoPalio.htm'){
                $content = str_replace('href="http://"','href="http://103.94.169.26:8081"',$content);
            }
            if ($filename = 'template/FreeTrial.htm' || $filename = 'template/ExpiredFreeTrial.htm' || $filename = 'template/SpecialOfferingv1.htm' || $filename = 'template/Payment.htm'){
                $content = str_replace('href=""','href="http://103.94.169.26:8081/login.php"',$content);
            }else{
                $content = str_replace('href=""','href="http://103.94.169.26:8081"',$content);
            }
            $content = str_replace('https://twitter.com/palio_SDK','http://103.94.169.26:8081/redirect_tw.php?username='.$embedname,$content);
            $content = str_replace('https://www.facebook.com/Palio-103214787950780/','http://103.94.169.26:8081/redirect_fb.php?username='.$embedname,$content);
            $content = str_replace('https://www.linkedin.com/company/31365478/','http://103.94.169.26:8081/redirect_li.php?username='.$embedname,$content);
            $content = str_replace('https://www.instagram.com/palio_sdk/','http://103.94.169.26:8081/redirect_ig.php?username='.$embedname,$content);
        }

        
        return $content;
    }

    function customizeTemplateLocalByEmail($template,$email,$filename){
        $content = file_get_contents($filename);
        $embedname = '';
        if(is_array($email)){
            $partsemail = explode('@',$email[0]);
            $embedname = $partsemail[0];
            if($template == 'Hi!'){
                $email[0] = 'Hi '.$partsemail[0].'!';
            }elseif($template == 'Pal!'){
                $email[0] = $partsemail[0].'!';
            }else{
                $email[0] = $partsemail[0];
            }
            $content = str_replace($template,$name,$content);
            if ($filename = 'template/WelcometoPalio.htm'){
                $content = str_replace('href="http://"','href="http://192.168.0.31"',$content);
            }
            if ($filename = 'template/FreeTrial.htm' || $filename = 'template/ExpiredFreeTrial.htm' || $filename = 'template/SpecialOfferingv1.htm' || $filename = 'template/Payment.htm'){
                $content = str_replace('href=""','href="http://192.168.0.31/login.php"',$content);
            }else{
                $content = str_replace('href=""','href="http://192.168.0.31"',$content);
            }
            $content = str_replace('https://twitter.com/palio_SDK','http://192.168.0.31/redirect_tw.php?username='.$embedname,$content);
            $content = str_replace('https://www.facebook.com/Palio-103214787950780/','http://192.168.0.31/redirect_fb.php?username='.$embedname,$content);
            $content = str_replace('https://www.linkedin.com/company/31365478/','http://192.168.0.31/redirect_li.php?username='.$embedname,$content);
            $content = str_replace('https://www.instagram.com/palio_sdk/','http://192.168.0.31/redirect_ig.php?username='.$embedname,$content);
        }else{
            $partsemail = explode('@',$email);
            $embedname = $partsemail[0];
            if($filename != 'template/Personalized BCA .htm' || $filename != 'template/Launching.htm' ){
                if($template == 'Hi!'){
                    $email = 'Hi '.$partsemail[0].'!';
                }elseif($template == 'Pal!'){
                    $email = $partsemail[0].'!';
                }else{
                    $email = $partsemail[0];
                }
                $content = str_replace($template,$email,$content);
            }
            if ($filename = 'template/WelcometoPalio.htm'){
                $content = str_replace('href="http://"','href="http://192.168.0.31"',$content);
            }
            if ($filename = 'template/FreeTrial.htm' || $filename = 'template/ExpiredFreeTrial.htm' || $filename = 'template/SpecialOfferingv1.htm' || $filename = 'template/Payment.htm'){
                $content = str_replace('href=""','href="http://192.168.0.31/login.php"',$content);
            }else{
                $content = str_replace('href=""','href="http://192.168.0.31"',$content);
            }
            $content = str_replace('https://twitter.com/palio_SDK','http://192.168.0.31/redirect_tw.php?username='.$embedname,$content);
            $content = str_replace('https://www.facebook.com/Palio-103214787950780/','http://192.168.0.31/redirect_fb.php?username='.$embedname,$content);
            $content = str_replace('https://www.linkedin.com/company/31365478/','http://192.168.0.31/redirect_li.php?username='.$embedname,$content);
            $content = str_replace('https://www.instagram.com/palio_sdk/','http://192.168.0.31/redirect_ig.php?username='.$embedname,$content);
        }

        
        return $content;
    }



    /*
        Special Offering  
    */
    // customizeTemplateByName('*NAME*','rifqy.f.rijal@easysoft.co.id','template/SpecialOfferingv1.htm');
    // customizeTemplateRemoteByName('*NAME*','rifqy.f.rijal@easysoft.co.id','template/SpecialOfferingv1.htm');
    // customizeTemplateLocalByName('*NAME*','rifqy.f.rijal@easysoft.co.id','template/SpecialOfferingv1.htm');
    // customizeTemplateByEmail('*NAME*','rifqy.f.rijal@easysoft.co.id','template/SpecialOfferingv1.htm');
    // customizeTemplateRemoteByEmail('*NAME*','rifqy.f.rijal@easysoft.co.id','template/SpecialOfferingv1.htm');
    // customizeTemplateLocalByEmail('*NAME*','rifqy.f.rijal@easysoft.co.id','template/SpecialOfferingv1.htm');

    /*
        Email Confirmation(Contoh ada di test_mail.php)
    */
    /*
        Beta Test  
    */
    // customizeTemplateByName('Hi!','rifqy.f.rijal@easysoft.co.id','template/BetaTest.htm');
    // customizeTemplateRemoteByName('Hi!','rifqy.f.rijal@easysoft.co.id','template/BetaTest.htm');
    // customizeTemplateLocalByName('Hi!','rifqy.f.rijal@easysoft.co.id','template/BetaTest.htm');
    // customizeTemplateByEmail('Hi!','rifqy.f.rijal@easysoft.co.id','template/BetaTest.htm');
    // customizeTemplateRemoteByEmail('Hi!','rifqy.f.rijal@easysoft.co.id','template/BetaTest.htm');
    // customizeTemplateLocalByEmail('Hi!','rifqy.f.rijal@easysoft.co.id','template/BetaTest.htm');
    /*
        Welcome To Palio  
    */
    // customizeTemplateByName('*NAME*','rifqy.f.rijal@easysoft.co.id','template/WelcometoPalio.htm');
    // customizeTemplateRemoteByName('*NAME*','rifqy.f.rijal@easysoft.co.id','template/WelcometoPalio.htm');
    // customizeTemplateLocalByName('*NAME*','rifqy.f.rijal@easysoft.co.id','template/WelcometoPalio.htm');
    // customizeTemplateByEmail('*NAME*','rifqy.f.rijal@easysoft.co.id','template/WelcometoPalio.htm');
    // customizeTemplateRemoteByEmail('*NAME*','rifqy.f.rijal@easysoft.co.id','template/WelcometoPalio.htm');
    // customizeTemplateLocalByEmail('*NAME*','rifqy.f.rijal@easysoft.co.id','template/WelcometoPalio.htm');
    /*
        Free Trial  
    */
    // $today = date("d-m-Y");
    // $nextday = strftime("%d-%m-%Y",strtotime("$today +1 day"));
    // customizeTemplateByName(array('*NAME*','*DATE*'),array('rifqy.f.rijal@easysoft.co.id',$nextday),'template/FreeTrial.htm');
    // customizeTemplateRemoteByName(array('*NAME*','*DATE*'),array('rifqy.f.rijal@easysoft.co.id',$nextday),'template/FreeTrial.htm');
    // customizeTemplateLocalByName(array('*NAME*','*DATE*'),array('rifqy.f.rijal@easysoft.co.id',$nextday),'template/FreeTrial.htm');
    // customizeTemplateByEmail(array('*NAME*','*DATE*'),array('rifqy.f.rijal@easysoft.co.id',$nextday),'template/FreeTrial.htm');
    // customizeTemplateRemoteByEmail(array('*NAME*','*DATE*'),array('rifqy.f.rijal@easysoft.co.id',$nextday),'template/FreeTrial.htm');
    // customizeTemplateLocalByEmail(array('*NAME*','*DATE*'),array('rifqy.f.rijal@easysoft.co.id',$nextday),'template/FreeTrial.htm');    
    /*
        Palio API Key  
    */
    // customizeTemplateByName('Pal!','rifqy.f.rijal@easysoft.co.id','template/PalioAPIKey.htm');
    // customizeTemplateRemoteByName('Pal!','rifqy.f.rijal@easysoft.co.id','template/PalioAPIKey.htm');
    // customizeTemplateLocalByName('Pal!','rifqy.f.rijal@easysoft.co.id','template/PalioAPIKey.htm');
    // customizeTemplateByEmail('Pal!','rifqy.f.rijal@easysoft.co.id','template/PalioAPIKey.htm');
    // customizeTemplateRemoteByEmail('Pal!','rifqy.f.rijal@easysoft.co.id','template/PalioAPIKey.htm');
    // customizeTemplateLocalByEmail('Pal!','rifqy.f.rijal@easysoft.co.id','template/PalioAPIKey.htm');
    /*
        Expired Free Trial  
    */
    //  customizeTemplateByName('*NAME*','rifqy.f.rijal@easysoft.co.id','template/ExpiredFreeTrial.htm');
    // customizeTemplateRemoteByName('*NAME*','rifqy.f.rijal@easysoft.co.id','template/ExpiredFreeTrial.htm');
    // customizeTemplateLocalByName('*NAME*','rifqy.f.rijal@easysoft.co.id','template/ExpiredFreeTrial.htm');
    // customizeTemplateByEmail('*NAME*','rifqy.f.rijal@easysoft.co.id','template/ExpiredFreeTrial.htm');
    // customizeTemplateRemoteByEmail('*NAME*','rifqy.f.rijal@easysoft.co.id','template/ExpiredFreeTrial.htm');
    // customizeTemplateLocalByEmail('*NAME*','rifqy.f.rijal@easysoft.co.id','template/ExpiredFreeTrial.htm');
    /*
        Payment  
    */
    // customizeTemplateByName(array('*NAME*','*AMOUNT*'),array('rifqy.f.rijal@easysoft.co.id','1.000.000'),'template/Payment.htm');
    // customizeTemplateRemoteByName(array('*NAME*','*AMOUNT*'),array('rifqy.f.rijal@easysoft.co.id','1.000.000'),'template/Payment.htm');
    // customizeTemplateLocalByName(array('*NAME*','*AMOUNT*'),array('rifqy.f.rijal@easysoft.co.id','1.000.000'),'template/Payment.htm');
    // customizeTemplateByEmail(array('*NAME*','*AMOUNT*'),array('rifqy.f.rijal@easysoft.co.id','1.000.000'),'template/Payment.htm');
    // customizeTemplateRemoteByEmail(array('*NAME*','*AMOUNT*'),array('rifqy.f.rijal@easysoft.co.id','1.000.000'),'template/Payment.htm');
    // customizeTemplateLocalByEmail(array('*NAME*','*AMOUNT*'),array('rifqy.f.rijal@easysoft.co.id','1.000.000'),'template/Payment.htm');
    /*
        Personalized Bank(Tidak perlu ditest)
    */
    // changeNameByEmail('BCA mobile','Mandiri','Personalized BCA .htm');
    // customizeTemplateByName('BCA mobile','Mandiri','Personalized BCA .htm');
    // customizeTemplateRemoteByName('BCA mobile','Mandiri','Personalized BCA .htm');
    // customizeTemplateLocalByName('BCA mobile','Mandiri','Personalized BCA .htm');
    // customizeTemplateByEmail('BCA mobile','Mandiri','Personalized BCA .htm');
    // customizeTemplateRemoteByEmail('BCA mobile','Mandiri','Personalized BCA .htm');
    // customizeTemplateLocalByEmail('BCA mobile','Mandiri','Personalized BCA .htm');

  
?>

