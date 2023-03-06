<?php

    ob_start();

    function base_url(){

            // first get http protocol if http or https
    
            $base_url = (isset($_SERVER['HTTPS']) &&
    
            $_SERVER['HTTPS']!='off') ? 'https://' : 'http://';
    
            // get default website root directory
    
            $tmpURL = dirname(__FILE__);
    
            // when use dirname(__FILE__) will return value like this "C:\xampp\htdocs\my_website",
    
            //convert value to http url use string replace,
    
            // replace any backslashes to slash in this case use chr value "92"
    
            $tmpURL = str_replace(chr(92),'/',$tmpURL);
    
            // now replace any same string in $tmpURL value to null or ''
    
            // and will return value like /localhost/my_website/ or just /my_website/
    
            $tmpURL = str_replace($_SERVER['DOCUMENT_ROOT'],'',$tmpURL);
    
            // delete any slash character in first and last of value
    
            $tmpURL = ltrim($tmpURL,'/');
    
            $tmpURL = rtrim($tmpURL, '/');
    
    
            // check again if we find any slash string in value then we can assume its local machine
    
            if (strpos($tmpURL,'/')){
    
                // explode that value and take only first value
    
               $tmpURL = explode('/',$tmpURL);
    
               $tmpURL = $tmpURL[0];
    
            }
    
            // now last steps
    
            // assign protocol in first value
    
           if ($tmpURL !== $_SERVER['HTTP_HOST'])
    
            // if protocol its http then like this
    
              $base_url .= $_SERVER['HTTP_HOST'].'/'.$tmpURL;
    
            else
    
            // else if protocol is https
    
              $base_url .= $tmpURL;
    
            // give return value
    
            return $base_url;
    
        }

     function redirect($url){
            header("Location: ".$url);
            die();
        }

    function startExcel($filename = "laporan.xls"){

        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$filename");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Pragma: public");
    }

    function startCSV($filename = "laporan.csv"){
        header("Content-type: application/force-download");
        header("Content-type: application/octet-stream");
        header("Content-type: application/download");
	
        header("Content-Disposition: attachment; filename=$filename");
	header("Content-Transfer-Encoding: binary");

        header("Expires: 0");
        header("Chace-Control:max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Pragma: public");
    }

?>