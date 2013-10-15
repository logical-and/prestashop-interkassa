<?php
include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__) . '/interkassa.php');
	$interkassa = new Interkassa();


$ikey = Configuration::get('secret_key');
$cart = new Cart(intval($_POST['ik_payment_id']));
	$currency = new Currency(intval($cart->id_currency));
	
		if ($currency->iso_code == 'RUR')
			{$purse = Configuration::get('ik_shop_id');}
		
		
$order_amount = number_format(Tools::convertPrice($cart->getOrderTotal(true, 3), $currency), 2, '.', '');


if ($_POST)
	{
		if (isset($_POST['ik_sign_hash']))
			{
			
			// Проверяем правильность платежа.
			$sing_hash_str = $_POST['ik_shop_id'].':'.
			$_POST['ik_payment_amount'].':'.
			$_POST['ik_payment_id'].':'.
			$_POST['ik_paysystem_alias'].':'.
			$_POST['ik_baggage_fields'].':'.
			$_POST['ik_payment_state'].':'.
			$_POST['ik_trans_id'].':'.
			$_POST['ik_currency_exch'].':'.
			$_POST['ik_fees_payer'].':'.
			$ikey;
			
				$crc = strtoupper(md5($sing_hash_str));
					if ($crc == strtoupper($_POST['ik_sign_hash'])) 
						{
							$interkassa->validateOrder($cart->id, _PS_OS_PAYMENT_, $_POST['ik_payment_amount'], $interkassa->displayName, NULL, NULL);
								$order = new Order($interkassa->currentOrder);
								Tools::redirectLink(__PS_BASE_URI__.'order-confirmation.php?id_cart='.$cart->id.'&id_module='.$interkassa->id.'&id_order='.$interkassa->currentOrder.'&key='.$order->secure_key);
						}	
			}
	}
else 
	{
		Tools::redirectLink(__PS_BASE_URI__.'order.php');
	}

// what? -> to order
Tools::redirectLink(__PS_BASE_URI__.'order.php');
?>