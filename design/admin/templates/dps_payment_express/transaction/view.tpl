<div class="context-block">

	<div class="box-header"><div class="box-tc"><div class="box-ml"><div class="box-mr"><div class="box-tl"><div class="box-tr">
		<h1 class="context-title">&nbsp;{'DPS Payment Express Transaction details'|i18n( 'extension/dps_payment_express' )}</h1>
		<div class="header-subline"></div>
	</div></div></div></div></div></div>

	<div class="box-ml"><div class="box-mr"><div class="box-content">

		<div class="content-navigation-childlist">

			<div class="block">
				<label>{'ID'|i18n( 'extension/dps_payment_express' )}:</label>
				{$transaction.id}
			</div>

			<div class="block">
				<label>{'Amount'|i18n( 'extension/dps_payment_express' )}:</label>
				{$transaction.amount_formatted} {$transaction.currency_input}
			</div>

			<div class="block">
				<label>{'Status'|i18n( 'extension/dps_payment_express' )}:</label>
				{$transaction.status_description}
			</div>

			{if $transaction.user}
			<div class="block">
				<label>{'User'|i18n( 'extension/dps_payment_express' )}:</label>
				<a href="{$transaction.user.main_node.url_alias|ezurl( 'no' )}">{$transaction.user.name|wash}</a>
			</div>
			{/if}

			<div class="block">
				<label>{'Order'|i18n( 'extension/dps_payment_express' )}:</label>
				<a href="{concat( '/shop/orderview/', $transaction.order_id )|ezurl( 'no' )}">#{$transaction.order_id}</a>
			</div>

			<div class="block">
				<label>{'Started'|i18n( 'extension/dps_payment_express' )}:</label>
				{$transaction.created|datetime( 'custom', '%d.%m.%Y %H:%i:%s' )}
			</div>

			<div class="block">
				<label>{'Finished'|i18n( 'extension/dps_payment_express' )}:</label>
				{$transaction.updated|datetime( 'custom', '%d.%m.%Y %H:%i:%s' )}
			</div>

			<div class="block">
				<label>{'Billing ID'|i18n( 'extension/dps_payment_express' )}:</label>
				{$transaction.billing_id}
			</div>

			<div class="block">
				<label>{'Email address'|i18n( 'extension/dps_payment_express' )}:</label>
				{$transaction.email_address}
			</div>

			<div class="block">
				<label>{'Enable Add Bill Card'|i18n( 'extension/dps_payment_express' )}:</label>
				{if eq( $transaction.enable_add_bill_card, 1 )}{'Yes'|i18n( 'extension/dps_payment_express' )}{else}{'No'|i18n( 'extension/dps_payment_express' )}{/if}
			</div>

			<div class="block">
				<label>{'Merchant Reference'|i18n( 'extension/dps_payment_express' )}:</label>
				{$transaction.merchant_reference}
			</div>

			<div class="block">
				<label>{'TxnData1'|i18n( 'extension/dps_payment_express' )}:</label>
				{$transaction.txn_data_1}
			</div>

			<div class="block">
				<label>{'TxnData2'|i18n( 'extension/dps_payment_express' )}:</label>
				{$transaction.txn_data_2}
			</div>

			<div class="block">
				<label>{'TxnData3'|i18n( 'extension/dps_payment_express' )}:</label>
				{$transaction.txn_data_3}
			</div>

			<div class="block">
				<label>{'TxnType'|i18n( 'extension/dps_payment_express' )}:</label>
				{if eq( $transaction.txn_type, 1 )}{'Auth'|i18n( 'extension/dps_payment_express' )}{else}{'Purchase'|i18n( 'extension/dps_payment_express' )}{/if}
			</div>

			<div class="block">
				<label>{'TxnId'|i18n( 'extension/dps_payment_express' )}:</label>
				{$transaction.txn_id}
			</div>

			<div class="block">
				<label>{'Auth Code'|i18n( 'extension/dps_payment_express' )}:</label>
				{$transaction.auth_code}
			</div>

			<div class="block">
				<label>{'Card name'|i18n( 'extension/dps_payment_express' )}:</label>
				{$transaction.card_name}
			</div>

			<div class="block">
				<label>{'Card number'|i18n( 'extension/dps_payment_express' )}:</label>
				{$transaction.card_number}
			</div>

			<div class="block">
				<label>{'Date expiry'|i18n( 'extension/dps_payment_express' )}:</label>
				{$transaction.date_expiry}
			</div>

			<div class="block">
				<label>{'Card holder name'|i18n( 'extension/dps_payment_express' )}:</label>
				{$transaction.card_holder_name}
			</div>

			<div class="block">
				<label>{'DpsTxnRef'|i18n( 'extension/dps_payment_express' )}:</label>
				{$transaction.dps_txn_ref}
			</div>

			<div class="block">
				<label>{'Success'|i18n( 'extension/dps_payment_express' )}:</label>
				{if eq( $transaction.success, 1 )}{'Yes'|i18n( 'extension/dps_payment_express' )}{else}{'No'|i18n( 'extension/dps_payment_express' )}{/if}
			</div>

			<div class="block">
				<label>{'Response text'|i18n( 'extension/dps_payment_express' )}:</label>
				{$transaction.response_text}
			</div>

			<div class="block">
				<label>{'DpsBillingId'|i18n( 'extension/dps_payment_express' )}:</label>
				{$transaction.dps_billing_id}
			</div>

			<div class="block">
				<label>{'Client info'|i18n( 'extension/dps_payment_express' )}:</label>
				{$transaction.client_ip}
			</div>

			<div class="block">
				<label>{'TxnMac'|i18n( 'extension/dps_payment_express' )}:</label>
				{$transaction.txn_mac}
			</div>

			<div class="block">
				<label>{'Card number 2'|i18n( 'extension/dps_payment_express' )}:</label>
				{$transaction.card_number_2}
			</div>

			<div class="block">
				<label>{'CVC2 result code'|i18n( 'extension/dps_payment_express' )}:</label>
				{$transaction.cvc2_result_code}
			</div>

		</div>

	</div></div></div>

	<div class="controlbar">
		<div class="box-bc"><div class="box-ml"><div class="box-mr"><div class="box-tc"><div class="box-bl"><div class="box-br">
			<div class="block"></div>
		</div></div></div></div></div></div>
	</div>

</div>