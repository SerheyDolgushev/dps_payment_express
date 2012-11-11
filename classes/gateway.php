<?php
/**
 * @package DPSPaymentExpress
 * @class   DPSPaymentExpressRedirectGateway
 * @author  Serhey Dolgushev <dolgushev.serhey@gmail.com>
 * @date    08 Nov 2012
 **/

class DPSPaymentExpressRedirectGateway extends eZRedirectGateway
{
	const TYPE_DPS_EXPAY = 'dbsexpay';

	public function __construct() {
		$this->logger = eZPaymentLogger::CreateForAdd( 'var/log/dps_payment_express.log' );
	}

	public function createPaymentObject( $processID, $orderID ) {
		$this->logger->writeTimedString( 'DPSPaymentExpressRedirectGateway::createPaymentObject' );
        return eZPaymentObject::createNew( $processID, $orderID, self::TYPE_DPS_EXPAY );
	}

	public function createRedirectionUrl( $process ) {
		$this->logger->writeTimedString( 'DPSPaymentExpressRedirectGateway::createRedirectionUrl' );

		$processParams = $process->attribute( 'parameter_list' );
		$order = eZOrder::fetch( $processParams['order_id'] );

		$transaction = new DPSPaymentExpressTransaction(
			array(
				'amount_input' => $order->attribute( 'total_inc_vat' ),
				'order_id'     => $order->attribute( 'id' )
			)
		);
		$transaction->store();

		$redirectURL = '/dps_payment_express/redirect/' . $transaction->attribute( 'id' );
		eZURI::transformURI( $redirectURL, false, 'full' );
		return $redirectURL;
	}

	public static function sendRequest( $xml ) {
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, 'https://sec.paymentexpress.com/pxpay/pxaccess.aspx' );
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $xml );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		$r = curl_exec( $ch );
		curl_close( $ch );
		return (array) new SimpleXMLElement( $r );
	}
}
?>
