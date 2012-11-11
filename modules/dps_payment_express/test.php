<?php
/**
 * @package DPSPaymentExpress
 * @author  Serhey Dolgushev <dolgushev.serhey@gmail.com>
 * @date    09 Nov 2012
 **/

$transaction  = new DPSPaymentExpressTransaction(
	array(
		'amount_input' => 23.20,
		'order_id'     => rand( 1, 99999999 )
	)
);
$transaction->store();

return $Params['Module']->redirectTo( '/dps_payment_express/redirect/' . $transaction->attribute( 'id' ) );
?>