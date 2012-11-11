{def
	$current_page = sum( $offset|div( $limit ), 1 )
	$pages_count  = $count|div( $limit )|ceil()
}

{if gt( $pages_count, 1 )}
<div class="pagenavigator">
	<p>

		{if gt( $current_page, 1 )}
			<span class="previous"><a href="{concat( '/dps_payment_express/transactions/limit/', $limit, '/offset/', sub( $current_page, 2 )|mul( $limit ) )|ezurl( 'no' )}"><span class="text">&laquo;&nbsp;{'Previous'|i18n( 'design/admin/navigator' )}</span></a></span>
		{else}
			<span class="previous"><span class="text disabled">&laquo;&nbsp;{'Previous'|i18n( 'design/admin/navigator' )}</span></span>
		{/if}

	    {if lt( $current_page, $pages_count )}
			<span class="next"><a href="{concat( '/dps_payment_express/transactions/limit/', $limit, '/offset/', $current_page|mul( $limit ) )|ezurl( 'no' )}"><span class="text">{'Next'|i18n( 'design/admin/navigator' )}&nbsp;&raquo;</span></a></span>
		{else}
			<span class="next"><span class="text disabled">{'Next'|i18n( 'design/admin/navigator' )}&nbsp;&raquo;</span></span>
		{/if}

		<span class="pages">
		{set $pages_count = $pages_count|dec()}
		{for 0 to $pages_count as $page}
			{if $page|mul( $limit )|eq( $offset )}
				<span class="current">{sum( $page, 1 )}</span>
			{else}
				<span class="other"><a href="{concat( '/dps_payment_express/transactions/limit/', $limit, '/offset/', $page|mul( $limit ) )|ezurl( 'no' )}">{sum( $page, 1 )}</a></span>
			{/if}
		{/for}
		</span>

	</p>

	<div class="break"></div>
</div>
{/if}
