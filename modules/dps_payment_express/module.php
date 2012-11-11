<?php
/**
 * @package DPSPaymentExpress
 * @author  Serhey Dolgushev <dolgushev.serhey@gmail.com>
 * @date    09 Nov 2012
 **/

$Module = array(
	'name'            => 'DPS Payment Express payment gateway',
 	'variable_params' => true
);

$ViewList = array(
	'test' => array(
		'functions' => array( 'pay' ),
		'script'    => 'test.php',
		'params'    => array()
	),
	'redirect' => array(
		'functions' => array( 'pay' ),
		'script'    => 'redirect.php',
		'params'    => array( 'TransactionID' )
	),
	'return' => array(
		'functions' => array( 'pay' ),
		'script'    => 'return.php',
		'params'    => array( 'TransactionID' )
	),
	'transactions' => array(
		'functions'               => array( 'history' ),
		'script'                  => 'transactions.php',
		'default_navigation_part' => 'ezshopnavigationpart',
		'params'                  => array(),
		'unordered_params'        => array(
			'offset' => 'Offset',
			'limit'  => 'Limit'
		)
	),
	'view' => array(
		'functions'               => array( 'history' ),
		'script'                  => 'view.php',
		'default_navigation_part' => 'ezshopnavigationpart',
		'params'                  => array( 'TransactionID' )
	)
);

$FunctionList = array(
	'pay'     => array(),
	'history' => array()
);
?>
