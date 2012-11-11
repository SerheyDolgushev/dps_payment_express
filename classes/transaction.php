<?php
/**
 * @package DPSPaymentExpress
 * @class   DPSPaymentExpressTransaction
 * @author  Serhey Dolgushev <dolgushev.serhey@gmail.com>
 * @date    08 Nov 2012
 **/

class DPSPaymentExpressTransaction extends eZPersistentObject
{
	const STATUS_CREATED           = 1;
	const STATUS_GENERATE_REQUEST  = 2;
	const STATUS_REDIRECTED_TO_HPP = 3;
	const STATUS_PROCESSED         = 4;

	const TXN_TYPE_AUTH     = 1;
	const TXN_TYPE_PURCHASE = 2;

	private $cache = array(
		'user'  => null,
		'order' => null
	);

	public function __construct( $row = array() ) {
		$this->eZPersistentObject( $row );

		if( $this->attribute( 'user_id' ) === null ) {
			$this->setAttribute( 'user_id', eZUser::currentUserID() );
		}

		$ini = eZINI::instance( 'dpspaymentexpress.ini' );
		if( $this->attribute( 'px_pay_user_id' ) === null ) {
			$this->setAttribute( 'px_pay_user_id', $ini->variable( 'LocalShopSettings', 'PxPayUserID' ) );
		}
		if( $this->attribute( 'px_pay_key' ) === null ) {
			$this->setAttribute( 'px_pay_key', $ini->variable( 'LocalShopSettings', 'PxPayKey' ) );
		}
		if( $this->attribute( 'currency_input' ) === null ) {
			$this->setAttribute( 'currency_input', $ini->variable( 'LocalShopSettings', 'Currency' ) );
		}

		if( $this->attribute( 'merchant_reference' ) === null ) {
			$this->setAttribute(
				'merchant_reference',
				ezpI18n::tr(
					'extension/dps_payment_express',
					'Order #%order_id',
					null,
					array( '%order_id' => $this->attribute( 'order_id' ) )
				)
			);
		}
		if( $this->attribute( 'txn_id' ) === null ) {
			$this->setAttribute( 'txn_id', $this->attribute( 'order_id' ) );
		}
	}

	public static function definition() {
		return array(
			'fields'              => array(
				'id' => array(
					'name'     => 'id',
					'datatype' => 'integer',
					'default'  => 0,
					'required' => true
				),
				'status' => array(
					'name'     => 'status',
					'datatype' => 'integer',
					'default'  => self::STATUS_CREATED,
					'required' => true
				),
				'order_id' => array(
					'name'     => 'orderID',
					'datatype' => 'integer',
					'default'  => null,
					'required' => true
				),
				'user_id' => array(
					'name'     => 'userID',
					'datatype' => 'integer',
					'default'  => null,
					'required' => true
				),
				'created' => array(
					'name'     => 'created',
					'datatype' => 'integer',
					'default'  => time(),
					'required' => true
				),
				'updated' => array(
					'name'     => 'updated',
					'datatype' => 'integer',
					'default'  => time(),
					'required' => true
				),
				// Create Request params
				'px_pay_user_id' => array(
					'name'     => 'PxPayUserID',
					'datatype' => 'string',
					'default'  => null,
					'required' => true
				),
				'px_pay_key' => array(
					'name'     => 'PxPayKey',
					'datatype' => 'string',
					'default'  => null,
					'required' => true
				),
				'amount_input' => array(
					'name'     => 'amountInput',
					'datatype' => 'float',
					'default'  => null,
					'required' => true
				),
				'billing_id' => array(
					'name'     => 'billingID',
					'datatype' => 'string',
					'default'  => null,
					'required' => false
				),
				'currency_input' => array(
					'name'     => 'currencyInput',
					'datatype' => 'string',
					'default'  => null,
					'required' => true
				),
				'email_address' => array(
					'name'     => 'emailAddress',
					'datatype' => 'string',
					'default'  => null,
					'required' => false
				),
				'enable_add_bill_card' => array(
					'name'     => 'enableAddBillCard',
					'datatype' => 'int',
					'default'  => 0,
					'required' => true
				),
				'merchant_reference' => array(
					'name'     => 'merchantReference',
					'datatype' => 'string',
					'default'  => null,
					'required' => true
				),
				'txn_data_1' => array(
					'name'     => 'txnData1',
					'datatype' => 'string',
					'default'  => null,
					'required' => false
				),
				'txn_data_2' => array(
					'name'     => 'txnData2',
					'datatype' => 'string',
					'default'  => null,
					'required' => false
				),
				'txn_data_3' => array(
					'name'     => 'txnData3',
					'datatype' => 'string',
					'default'  => null,
					'required' => false
				),
				'txn_type' => array(
					'name'     => 'txnType',
					'datatype' => 'integer',
					'default'  => self::TXN_TYPE_PURCHASE,
					'required' => true
				),
				'txn_id' => array(
					'name'     => 'txnID',
					'datatype' => 'string',
					'default'  => null,
					'required' => false
				),
				// Transaction response params
				'auth_code' => array(
					'name'     => 'authCode',
					'datatype' => 'string',
					'default'  => null,
					'required' => false
				),
				'card_name' => array(
					'name'     => 'cardName',
					'datatype' => 'string',
					'default'  => null,
					'required' => false
				),
				'card_number' => array(
					'name'     => 'cardNumber',
					'datatype' => 'string',
					'default'  => null,
					'required' => false
				),
				'date_expiry' => array(
					'name'     => 'dateExpiry',
					'datatype' => 'integer',
					'default'  => null,
					'required' => false
				),
				'dps_txn_ref' => array(
					'name'     => 'DPSTxnRef',
					'datatype' => 'string',
					'default'  => null,
					'required' => false
				),
				'success' => array(
					'name'     => 'success',
					'datatype' => 'integer',
					'default'  => null,
					'required' => false
				),
				'response_text' => array(
					'name'     => 'responseText',
					'datatype' => 'string',
					'default'  => null,
					'required' => false
				),
				'dps_billing_id' => array(
					'name'     => 'dpsBillingID',
					'datatype' => 'string',
					'default'  => null,
					'required' => false
				),
				'card_holder_name' => array(
					'name'     => 'cardHolderName',
					'datatype' => 'string',
					'default'  => null,
					'required' => false
				),
				'client_info' => array(
					'name'     => 'clientInfo',
					'datatype' => 'string',
					'default'  => null,
					'required' => false
				),
				'txn_mac' => array(
					'name'     => 'txnMac',
					'datatype' => 'string',
					'default'  => null,
					'required' => false
				),
				'card_number_2' => array(
					'name'     => 'cardNumber2',
					'datatype' => 'string',
					'default'  => null,
					'required' => false
				),
				'cvc2_result_code' => array(
					'name'     => 'CVC2ResultCode',
					'datatype' => 'string',
					'default'  => null,
					'required' => false
				)
			),
			'function_attributes' => array(
				'status_description' => 'getStatusDescription',
				'amount_formatted'   => 'getamountFormatted',
				'user'               => 'getUser',
				'order'              => 'getOrder',
				'client_ip'          => 'getClientIP'
			),
			'keys'                => array( 'id' ),
			'sort'                => array( 'id' => 'desc' ),
			'increment_key'       => 'id',
			'class_name'          => __CLASS__,
			'name'                => 'dps_payment_express_transactions'
		);
	}

	public function getStatusDescription() {
		switch( $this->attribute( 'status' ) ) {
			case self::STATUS_GENERATE_REQUEST:
				return ezpI18n::tr( 'extension/dps_payment_express', 'Initialized' );
			case self::STATUS_REDIRECTED_TO_HPP:
				return ezpI18n::tr( 'extension/dps_payment_express', 'Redirected to DPS' );
			case self::STATUS_PROCESSED:
				return ezpI18n::tr( 'extension/dps_payment_express', 'Processed' );
			default:
				return ezpI18n::tr( 'extension/dps_payment_express', 'Created' );
		}
	}

	public function getamountFormatted() {
		return number_format( $this->attribute( 'amount_input' ), 2, '.', '' );
	}

	public function getUser() {
		if(
			$this->cache['user'] === null
			&& $this->attribute( 'user_id' ) !== null
		) {
			$user = eZContentObject::fetch( $this->attribute( 'user_id' ) );
			if( $user instanceof eZContentObject ) {
				$this->cache['user'] = $user;
			}
		}

		return $this->cache['user'];
	}

	public function getOrder() {
		if(
			$this->cache['order'] === null
			&& $this->attribute( 'order_id' ) !== null
		) {
			$order = eZOrder::fetch( $this->attribute( 'order_id' ) );
			if( $order instanceof eZOrder ) {
				$this->cache['order'] = $order;
			}
		}

		return $this->cache['order'];
	}

	public function getClientIP() {
		$ip = $this->attribute( 'client_info' );
		return $ip !== null ? inet_ntop( $ip ) : null;
	}

	public static function fetch( $id ) {
		return eZPersistentObject::fetchObject(
			self::definition(),
			null,
			array( 'id' => $id ),
			true
		);
	}

	public function store( $fieldFilters = null ) {
		$this->setAttribute( 'updated', time() );

		eZPersistentObject::storeObject( $this, $fieldFilters );
	}
}
?>
