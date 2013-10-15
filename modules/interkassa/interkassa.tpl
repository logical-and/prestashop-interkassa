<p class="payment_module">
<a href="javascript:$('#interkassa').submit();" title="Оплатить через Интеркассу">
		<img src="{$this_path}interkassa.gif" style="float:left;" />
		<br />Оплатить через Интеркассу<br />
		<br style="clear:both;" />
</a>
</p>

<form id="interkassa" accept-charset="windows-1251" method="POST" action="https://interkassa.com/lib/payment.php">
<input type="hidden" name="ik_payment_amount" value="{$total}">
<input type="hidden" name="ik_payment_desc" value="Оплата заказа №{$id_cart}">
<input type="hidden" name="ik_payment_id" value="{$id_cart}">
<input type="hidden" name="ik_shop_id" value="{$purse}">
<input type="hidden"   name="ik_sign_hash" value="{$sign_hash}">
</form>