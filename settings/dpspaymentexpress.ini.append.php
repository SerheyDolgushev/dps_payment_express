<?php /* #?ini charset="utf-8"?

[LocalShopSettings]
# Unique username to identify customer account.
# Assigned on account setup by Payment Express support team.
PxPayUserID=USER_ID

# Unique key to identify customer and used to encrypt the transaction request
# with 3DES to protect the transaction information.
# Assigned on account setup by Payment Express support team.
PxPayKey=PX_PAY_KEY

# Used to specify the currency to be used: AUD, USD, NZD etc.
# http://www.paymentexpress.com/Technical_Resources/Ecommerce_Hosted/PxPay.aspx#currencyinput
Currency=USD

# URL where user will be redirected after payment will be processed.
# Allowed parameters:
# - ORDER_ID - order ID
# - TRANSACTION_ID - transaction ID
PaymentCompleteRedirectURL=shop/orderview/ORDER_ID
*/ ?>