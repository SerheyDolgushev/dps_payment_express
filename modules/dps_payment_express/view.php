<?php
/**
 * @package DPSPaymentExpress
 * @author  Serhey Dolgushev <dolgushev.serhey@gmail.com>
 * @date    09 Nov 2012
 **/

$transaction = DPSPaymentExpressTransaction::fetch( (int) $Params['TransactionID'] );
if( $transaction instanceof DPSPaymentExpressTransaction === false ) {
	return $Params['Module']->handleError( eZError::KERNEL_NOT_FOUND, 'kernel' );
}

$tpl = eZTemplate::factory();
$tpl->setVariable( 'transaction', $transaction );

$Result = array();
$Result['content'] = $tpl->fetch( 'design:dps_payment_express/transaction/view.tpl' );
$Result['path']    = array(
	array(
		'text' => ezpI18n::tr( 'extension/dps_payment_express', 'DPS Payment Express Transaction' ),
		'url'  => false
	)
);
?>