<?php

        require_once ('lib/PayU.php');
		
		
		if(preg_match('/^4[0-9]{12}(?:[0-9]{3})?$/', $_REQUEST['tarjeta']))
		{
				$franquicia = 'VISA';
		}
		
		if(preg_match('/^5[1-5][0-9]{14}$/', $_REQUEST['tarjeta']))
		{
				$franquicia = 'MASTERCARD';
		}
			
		if(preg_match('/^3[47][0-9]{13}$/', $_REQUEST['tarjeta']))
		{
				$franquicia = 'AMEX';
		}
		
	
        //PayU::$apiKey = "4Vj8eK4rloUd272L48hsrarnUA"; //Ingrese aquí su propio apiKey.
        //PayU::$apiLogin = "pRRXKOl8ikMmt9u"; //Ingrese aquí su propio apiLogin.
        //PayU::$merchantId = "508029"; //Ingrese aquí su Id de Comercio.
		
		PayU::$apiKey = "66zL40RYgC5TlTVIoNlt1jgwW6"; //Ingrese aquí su propio apiKey.
        PayU::$apiLogin = "93nIyemu74P0V26"; //Ingrese aquí su propio apiLogin.
        PayU::$merchantId = "680277"; //Ingrese aquí su Id de Comercio.
        PayU::$language = SupportedLanguages::ES; //Seleccione el idioma.
        PayU::$isTest = false; //Dejarlo True cuando sean pruebas.

        // URL de Pagos
        //Environment::setPaymentsCustomUrl("https://sandbox.api.payulatam.com/payments-api/4.0/service.cgi");
        // URL de Consultas
        //Environment::setReportsCustomUrl("https://sandbox.api.payulatam.com/reports-api/4.0/service.cgi");
        // URL de Suscripciones para Pagos Recurrentes
        //Environment::setSubscriptionsCustomUrl("https://sandbox.api.payulatam.com/payments-api/rest/v4.3/");
		
		Environment::setPaymentsCustomUrl("https://api.payulatam.com/payments-api/4.0/service.cgi");
		Environment::setReportsCustomUrl("https://api.payulatam.com/reports-api/4.0/service.cgi"); 
		Environment::setSubscriptionsCustomUrl("https://api.payulatam.com/payments-api/rest/v4.3/");


        $reference = $variable = time().'-'.mt_rand();
        $value = $_REQUEST['mount'];

        $parameters = array(
            //Ingrese aquí el identificador de la cuenta.
            PayUParameters::ACCOUNT_ID => "683055",
            //Ingrese aquí el código de referencia.
            PayUParameters::REFERENCE_CODE => $reference,
            //Ingrese aquí la descripción.
            PayUParameters::DESCRIPTION => "ACN México",

            // -- Valores --
            //Ingrese aquí el valor.
            PayUParameters::VALUE => $value,
            //Ingrese aquí la moneda.
            PayUParameters::CURRENCY => "MXN",

            
            // -- Comprador 
            //Ingrese aquí el nombre del comprador.
            PayUParameters::BUYER_NAME => $_REQUEST['nombre'],
            //Ingrese aquí el email del comprador.
            PayUParameters::BUYER_EMAIL => $_REQUEST['email'],
            //Ingrese aquí el teléfono de contacto del comprador.
            PayUParameters::BUYER_CONTACT_PHONE => $_REQUEST['celular'],
            //Ingrese aquí el documento de contacto del comprador.
            PayUParameters::BUYER_DNI => "",
            //Ingrese aquí la dirección del comprador.
            PayUParameters::BUYER_STREET => "",
            PayUParameters::BUYER_STREET_2 => "",
            PayUParameters::BUYER_CITY => "",
            PayUParameters::BUYER_STATE => "",
            PayUParameters::BUYER_COUNTRY => "MX",
            PayUParameters::BUYER_POSTAL_CODE => "000000",
            PayUParameters::BUYER_PHONE => $_REQUEST['celular'],

            // -- pagador --
            //Ingrese aquí el nombre del pagador.
            PayUParameters::PAYER_NAME => $_REQUEST['nombre'],
            //Ingrese aquí el email del pagador.
            PayUParameters::PAYER_EMAIL => $_REQUEST['email'],
            //Ingrese aquí el teléfono de contacto del pagador.
            PayUParameters::PAYER_CONTACT_PHONE => $_REQUEST['celular'],
            //Ingrese aquí el documento de contacto del pagador.
            PayUParameters::PAYER_DNI => "",
            //Ingrese aquí la dirección del pagador.
            PayUParameters::PAYER_STREET => "",
            PayUParameters::PAYER_STREET_2 => "",
            PayUParameters::PAYER_CITY => "",
            PayUParameters::PAYER_STATE => "",
            PayUParameters::PAYER_COUNTRY => "MX",
            PayUParameters::PAYER_POSTAL_CODE => "000000",
            PayUParameters::PAYER_PHONE => $_REQUEST['celular'],

            // -- Datos de la tarjeta de crédito -- 
            //Ingrese aquí el número de la tarjeta de crédito
            PayUParameters::CREDIT_CARD_NUMBER => $_REQUEST['tarjeta'],
            //Ingrese aquí la fecha de vencimiento de la tarjeta de crédito
            PayUParameters::CREDIT_CARD_EXPIRATION_DATE => $_REQUEST['year'].'/'.$_REQUEST['month'],
            //Ingrese aquí el código de seguridad de la tarjeta de crédito
            PayUParameters::CREDIT_CARD_SECURITY_CODE=> $_REQUEST['cvc'],
            //Ingrese aquí el nombre de la tarjeta de crédito
            //VISA||MASTERCARD||AMEX
            PayUParameters::PAYMENT_METHOD => $franquicia,

            //Ingrese aquí el número de cuotas.
            PayUParameters::INSTALLMENTS_NUMBER => "1",
            //Ingrese aquí el nombre del pais.
            PayUParameters::COUNTRY => PayUCountries::MX,

            //Session id del device.
            PayUParameters::DEVICE_SESSION_ID => "vghs6tvkcle931686k1900o6e1",
            //IP del pagadador
            PayUParameters::IP_ADDRESS => "127.0.0.1",
            //Cookie de la sesión actual.
            PayUParameters::PAYER_COOKIE=>"pt1t38347bs6jc9ruv2ecpv7o2",
            //Cookie de la sesión actual.        
            PayUParameters::USER_AGENT=>"Mozilla/5.0 (Windows NT 5.1; rv:18.0) Gecko/20100101 Firefox/18.0"
        );
            
        //solicitud de autorización y captura
        $response = PayUPayments::doAuthorizationAndCapture($parameters);

        //  -- podrás obtener las propiedades de la respuesta --
        if($response){
            $response->transactionResponse->orderId;
            $response->transactionResponse->transactionId;
            $response->transactionResponse->state;
            if($response->transactionResponse->state=="PENDING"){
                $response->transactionResponse->pendingReason;  
            }
            $response->transactionResponse->paymentNetworkResponseCode;
            $response->transactionResponse->paymentNetworkResponseErrorMessage;
            $response->transactionResponse->trazabilityCode;
            $response->transactionResponse->responseCode;
            $response->transactionResponse->responseMessage;    
}
        echo json_encode($response);

?>