<?php
/**
 * @package DPSPaymentExpress
 * @author  Serhey Dolgushev <dolgushev.serhey@gmail.com>
 * @date    09 Nov 2012
 **/

$module = $Params['Module'];
$offset = isset( $Params['Offset'] ) ? (int) $Params['Offset'] : 0;
if( $offset < 0 ) {
	$offset = 0;
}
$limits = array( 50, 100, 200 );
$limit  = isset( $Params['Limit'] ) ? (int) $Params['Limit'] : 50;
if( in_array( $limit, $limits ) === false ) {
	$limit = $limits[0];
}

$count = eZPersistentObject::count( DPSPaymentExpressTransaction::definition() );

$transactions = eZPersistentObject::fetchObjectList(
	DPSPaymentExpressTransaction::definition(),
	null,
	null,
	array( 'id' => 'desc' ),
	array( 'offset' => $offset, 'limit' => $limit )
);

$tpl = eZTemplate::factory();
$tpl->setVariable( 'count', $count );
$tpl->setVariable( 'transactions', $transactions );
$tpl->setVariable( 'offset', $offset );
$tpl->setVariable( 'limit', $limit );
$tpl->setVariable( 'limits', $limits );

$Result = array();
$Result['content'] = $tpl->fetch( 'design:dps_payment_express/transaction/list.tpl' );
$Result['path']    = array(
	array(
		'text' => ezpI18n::tr( 'extension/dps_payment_express', 'DPS Payment Express Transactions' ),
		'url'  => false
	)
);
?>
