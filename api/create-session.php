<?php

    $public_key = '870fd53ee9274a76a62c34f434b09569'; // El {{PUBLIC_KEY}} de tu Postman
    $private_key = 'eea79c0b501d4d5d9ad3e5355f1c7892'; // El {{PRIVATE_KEY}} de tu Postman
    $bearerToken = '';

    $inputJson = json_decode(file_get_contents('php://input'), true);
    //$input = json_decode($inputJSON, true);
    $data = $inputJson['data'] ?? null;
    
    // 1. La URL de login que tienes en Postman
    $url = "https://apify.epayco.co/login";

    $ch = curl_init($url);

    // 2. Configuración de Basic Auth (lo que tienes en la pestaña Authorization)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, "$public_key:$private_key");
    curl_setopt($ch, CURLOPT_POST, true);

    // 3. Ejecutar y decodificar
    $response = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);

    if ($err) {
        echo "Error cURL: " . $err;
    } else {
        $result = json_decode($response, true);
        
        if (isset($result['token'])) {
            $bearerToken = $result['token'];
            //echo "Token obtenido con éxito: " . $bearerToken;
        } else {
            //echo "No se recibió el token. Respuesta: " . $response;
        }
    }

    //Obtener sessionId
    $url_session = "https://apify.epayco.co/payment/session/create";
    $sessionId = '';

    $data_session = [
        "checkout_version" => "2",
        "test" => false,
        "name" => $data['name'],
        "currency" => $data['currency'],
        "amount" => $data['amount'],
        "description" => $data['description'],
        "invoice" => $data['invoice'],
        "taxBase" => $data['taxBase'],
        "tax" => $data['tax'],
        "taxIco" => $data['taxIco'],
        "country" => $data['country'],
        "lang" => $data['lang'],
        "confirmation" => $data['confirmation'],
        "response" => $data['response'],
        "extra1" => $data['extra1'],
        "extra2" => $data['extra2'],
        "extra3" => $data['extra3'],
        "nameBilling" => $data['nameBilling'],
        "typeDocBilling" => $data['typeDocBilling'],
        "numberDocBilling" => $data['numberDocBilling'],
        "name_billing" => $data['name_billing'],
        "type_doc_billing" => $data['type_doc_billing'],
        "number_doc_billing" => $data['number_doc_billing'],
        "methodsDisable" => $data['methodsDisable'],
        "extrasEpayco" => [
            "extra1" => $data['extra1'],
            "extra2" => $data['extra2'],
            "extra3" => $data['extra3']
        ]
    ];

    /*$data_session = [
        "checkout_version" => "2",
        "test" => false,
        "name" => $data['name'],
        "currency" => $data['currency'],
        "amount" => $data['amount'],
        "description" => $data['description'],
        "invoice" => $data['invoice'],
        "taxBase" => $data['taxBase'],
        "tax" => $data['tax'],
        "taxIco" => $data['taxIco'],
        "country" => $data['country'],
        "lang" => $data['lang'],
        "confirmation" => $data['confirmation'],
        "response" => $data['response'],
        "extras" => [
            "extra1" => $data['extras']['extra1']
        ],
        "billing" => [
            "name" => $data['billing']['name'],
            "typeDoc" => $data['billing']['typeDoc'],
            "numberDoc" => $data['billing']['numberDoc'],
        ],        
        "methodsDisable" => $data['methodsDisable'],
    ];*/

    $ch_session = curl_init($url_session);
    curl_setopt($ch_session, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch_session, CURLOPT_POST, true);
    curl_setopt($ch_session, CURLOPT_POSTFIELDS, json_encode($data_session));
    curl_setopt($ch_session, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Bearer " . $bearerToken
    ]);

    $responseSession = curl_exec($ch_session);
    $err = curl_error($ch_session);
    curl_close($ch_session);

    if ($err) {
        echo json_encode(["error" => $err]);
    } else {
        // Retornamos el JSON con el sessionId al frontend
        //echo $responseSession;
        $respuesta_json = json_decode($responseSession, true);
        $sessionId = $respuesta_json['data']['sessionId'];
    }

    $datos = new stdClass();
    $datos->status = "success";
    $datos->sessionId = $sessionId;
    $datos->dataSession = $data_session;
	echo json_encode($datos, JSON_UNESCAPED_UNICODE);

    //echo $sessionId;
?>