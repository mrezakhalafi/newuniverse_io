<?php 

	$method = $_SERVER['REQUEST_METHOD'];

	// Process only POST methods from browser.

	if($method == 'POST'){
		$requestBody = file_get_contents('php://input');
		$data = json_decode($requestBody, true);
		$inpmsg = $data["message"];
		
		//Send the user text to rasa server and receive the intent and entities
		$outputmsg = processInputText($data); 
		
		//Send back the output message as response to the POST request
		$response = new \stdClass();
		$response = $outputmsg ;
		echo json_encode($response);
		
	}
	else
	{
		echo "Method not Allowed";
	}

	function processInputText($inptext)
	{
        // $url = 'https://431276fc.ngrok.io/webhooks/rest/webhook';

        // $response = http_post_data($url, $inptext);

        // API URL to send data
        $url = 'http://192.168.0.31:5005/webhooks/rest/webhook';
        
        // curl initiate
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        
        // SET Method as a POST
        curl_setopt($ch, CURLOPT_POST, 1);
        
        // Pass user data in POST command
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($inptext));
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        // Execute curl and assign returned data
        $response = curl_exec($ch);
        
        // Close curl
        curl_close($ch);

		//Send inptext to rasa-nlu http server and obtain the processed result.
		// $rasatext = file_get_contents("https://431276fc.ngrok.io/webhooks/rest/webhook" . urlencode($inptext));
        
        //Decode the response text as a json array
		// $rasajson = json_decode($rasatext, true);
		
		//Extract the intent
		// $rasa_intent = !empty($rasajson["topScoringIntent"]["intent"]) ? $rasajson["topScoringIntent"]["intent"] : '';
		
		//Extract the entities
		// $rasa_entities = '';
		// if(!empty($rasajson["entities"]))
		// 	{
		// 	foreach ($rasajson["entities"] as $entity)
		// 		{
		// 		$rasa_entities = $rasa_entities . $entity["type"] . '=>' . $entity["entity"] . "<br>";
		// 		}
        //     }
            
		//Prepare a reponse text.    
        // return '<b>Input:</b> ' . $inptext  . '<br><b>Intent:</b> ' . $rasa_intent . '<br><b>Entities:</b><br>' . $rasa_entities;
        return json_decode($response); 
    }
    
?>