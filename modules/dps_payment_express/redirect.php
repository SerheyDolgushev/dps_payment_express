<?php
/**
 * @package DPSPaymentExpress
 * @author  Serhey Dolgushev <dolgushev.serhey@gmail.com>
 * @date    10 Nov 2012
 **/

$transaction = DPSPaymentExpressTransaction::fetch( (int) $Params['TransactionID'] );
if( $transaction instanceof DPSPaymentExpressTransaction === false ) {
	return $Params['Module']->handleError( eZError::KERNEL_NOT_FOUND, 'kernel' );
}

$txnType = $transaction->attribute( 'txn_type' ) === DPSPaymentExpressTransaction::TXN_TYPE_AUTH
	? 'Auth'
	: 'Purchase';
$returnURL = '/dps_payment_express/return/' . $transaction->attribute( 'id' );
eZURI::transformURI( $returnURL, false, 'full' );

$dom     = new DOMDocument( '1.0', 'utf-8' );
$dom->formatOutput = true;
$request = $dom->createElement( 'GenerateRequest' );
$dom->appendChild( $request );

$request->appendChild( $dom->createElement( 'PxPayUserId', $transaction->attribute( 'px_pay_user_id' ) ) );
$request->appendChild( $dom->createElement( 'PxPayKey', $transaction->attribute( 'px_pay_key' ) ) );
$request->appendChild( $dom->createElement( 'AmountInput', $transaction->attribute( 'amount_formatted' ) ) );
$request->appendChild( $dom->createElement( 'CurrencyInput', $transaction->attribute( 'currency_input' ) ) );
$request->appendChild( $dom->createElement( 'MerchantReference', $transaction->attribute( 'merchant_reference' ) ) );
$request->appendChild( $dom->createElement( 'EmailAddress', $transaction->attribute( 'email_address' ) ) );
$request->appendChild( $dom->createElement( 'TxnData1', $transaction->attribute( 'txn_data_1' ) ) );
$request->appendChild( $dom->createElement( 'TxnData2', $transaction->attribute( 'txn_data_2' ) ) );
$request->appendChild( $dom->createElement( 'TxnData3', $transaction->attribute( 'txn_data_3' ) ) );
$request->appendChild( $dom->createElement( 'TxnType', $txnType ) );
$request->appendChild( $dom->createElement( 'TxnId', $transaction->attribute( 'txn_id' ) ) );
$request->appendChild( $dom->createElement( 'BillingId', $transaction->attribute( 'billing_id' ) ) );
$request->appendChild( $dom->createElement( 'EnableAddBillCard', $transaction->attribute( 'enable_add_bill_card' ) ) );
$request->appendChild( $dom->createElement( 'UrlSuccess', $returnURL ) );
$request->appendChild( $dom->createElement( 'UrlFail', $returnURL ) );

$result = DPSPaymentExpressRedirectGateway::sendRequest( $dom->saveXML() );
$transaction->setAttribute( 'status', DPSPaymentExpressTransaction::STATUS_GENERATE_REQUEST );
$transaction->store();

if( (bool) $result['@attributes']['valid'] === false ) {
	eZDebug::writeError( $result['URI'], 'DPS Payment Express' );
	return $Params['Module']->handleError( eZError::KERNEL_NOT_FOUND, 'kernel' );
}

$transaction->setAttribute( 'status', DPSPaymentExpressTransaction::STATUS_REDIRECTED_TO_HPP );
$transaction->store();
header( 'Location: ' . $result['URI'] );
eZExecution::cleanExit();
?>
