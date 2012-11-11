<div class="context-block">
	<div class="box-header"><div class="box-tc"><div class="box-ml"><div class="box-mr"><div class="box-tl"><div class="box-tr">
		<h1 class="context-title">&nbsp;{'DPS Payment Express Transactions'|i18n( 'extension/dps_payment_express' )} ({$count})</h1>
		<div class="header-subline"></div>
	</div></div></div></div></div></div>

	<div class="box-ml"><div class="box-mr"><div class="box-content">

		<div class="pagenavigator" style="text-align: right;">
			<p>
				<span class="pages">
					{foreach $limits as $possible_limit}
						{if $possible_limit|eq( $limit )}
							<span class="current">{$possible_limit}</span>
						{else}
							<span class="other"><a href="{concat( '/dps_payment_express/transactions/limit/', $possible_limit )|ezurl( 'no' )}">{$possible_limit}</a></span>
						{/if}
					{/foreach}
				</span>
			</p>
			<div class="break"></div>
		</div>
		<br />

		{include
			uri='design:navigator/dps_transactions.tpl'
			count=$count
			offset=$offset
			limit=$limit
		}
		<br />

		<div class="content-navigation-childlist">
			<table class="list" cellspacing="0" cellpadding="0">
				<thead>
					<tr>
						<th>{'ID'|i18n( 'extension/dps_payment_express' )}</th>
						<th>{'Amount'|i18n( 'extension/dps_payment_express' )}</th>
						<th>{'Status'|i18n( 'extension/dps_payment_express' )}</th>
						<th>{'Customer IP'|i18n( 'extension/dps_payment_express' )}</th>
						<th>{'Started'|i18n( 'extension/dps_payment_express' )}</th>
						<th>{'Finished'|i18n( 'extension/dps_payment_express' )}</th>
					</tr>
				</thead>
				<tbody>
					{foreach $transactions as $transaction sequence array( 'bgdark', 'bglight' ) as $style }
					<tr class="{$style}">
						<td><a href="{concat( 'dps_payment_express/view/', $transaction.id )|ezurl( 'no' )}">{$transaction.id}</a></td>
						<td>{$transaction.amount_formatted} {$transaction.currency_input}</td>
						<td>{$transaction.status_description}</td>
						<td>{$transaction.client_ip}</td>
						<td>{$transaction.created|datetime( 'custom', '%d.%m.%Y %H:%i:%s' )}</td>
						<td>{$transaction.updated|datetime( 'custom', '%d.%m.%Y %H:%i:%s' )}</td>
					</tr>
					{/foreach}
				</tbody>
			</table>
		</div>

		<br />
		{include
			uri='design:navigator/dps_transactions.tpl'
			count=$count
			offset=$offset
			limit=$limit
		}

	</div></div></div>

	<div class="controlbar">
		<div class="box-bc"><div class="box-ml"><div class="box-mr"><div class="box-tc"><div class="box-bl"><div class="box-br">
			<div class="block"></div>
		</div></div></div></div></div></div>
	</div>

</div>
