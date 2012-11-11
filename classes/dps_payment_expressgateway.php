<?php
/**
 * @package DPSPaymentExpress
 * @author  Serhey Dolgushev <dolgushev.serhey@gmail.com>
 * @date    08 Nov 2012
 **/

eZPaymentGatewayType::registerGateway(
	DPSPaymentExpressRedirectGateway::TYPE_DPS_EXPAY,
	'DPSPaymentExpressRedirectGateway',
	'DPS Payment Express'
);
?>
