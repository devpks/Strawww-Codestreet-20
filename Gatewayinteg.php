<?php

require 'vendor/autoload.php';

// Load the pre-configured ini file...

\VGSVault\Config::loadSettings('/path/to/config.ini');

// ...OR, optionally, you can set the credentials manually

\VGSVault\Config::setEndpoint(\VGSVault\API\Constants\Endpoints::EMERCHANTPAY);

\VGSVault\Config::setEnvironment(\VGSVault\API\Constants\Environments::STAGING);

\VGSVault\Config::setUsername('itspks');

\VGSVault\Config::setPassword('Wordpress@2552');

\VGSVault\Config::setToken('KN7C9d99DC0X0');

// Create a new VGSVault instance with desired API request

$VGSVault = new \VGSVault\VGSVault('Financial\Cards\Authorize');

// Set request parameters

$VGSVault

->request()

->setTransactionId('43671')

->setUsage('40208 concert tickets')

->setRemoteIp('245.253.2.12')

->setAmount('50')

->setCurrency('USD')

// Customer Details

->setCustomerEmail('emil@strawww.com')

->setCustomerPhone('1987987987987')

// Credit Card Details

->setCardHolder('Emil Example')

->setCardNumber('4200000000000000')

->setExpirationMonth('01')

->setExpirationYear('2020')

->setCvv('123')

// Billing/Invoice Details

->setBillingFirstName('Praveen')

->setBillingLastName('Kumar')

->setBillingAddress1('South Extension, Opp AIIMS')

->setBillingZipCode('10178')

->setBillingCity('New Delhi')

->setBillingState('DEL')

->setBillingCountry('IND');

try {

// Send the request

$VGSVault->execute();

// Successfully completed the transaction - display the gateway unique id

echo $VGSVault->response()->getResponseObject()->unique_id;

}

// Log/handle API errors

// Example: Declined transaction, Invalid data, Invalid configuration

catch (\VGSVault\Exceptions\ErrorAPI $api) {

echo $VGSVault->response()->getResponseObject()->technical_message;

}

// Log/handle invalid parameters

// Example: Empty (required) parameter

catch (\VGSVault\Exceptions\ErrorParameter $parameter) {

error_log($parameter->getMessage());

}

// Log/handle network (transport) errors

// Example: SSL verification errors, Timeouts

catch (\VGSVault\Exceptions\ErrorNetwork $network) {

error_log($network->getMessage());

}

?>
