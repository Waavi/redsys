<?php

namespace Waavi\Redsys;

class POSRequestFactory
{
    protected $merchantName;
    protected $merchantCode;
    protected $terminal;
    protected $currencyCode;
    protected $secret;
    protected $callbackUrl;
    protected $okUrl;
    protected $koUrl;

    /**
     *  Create a new Point of Sale Request factory.
     *
     *  @param  string  $merchantName   Name of the merchant or online store.
     *  @param  string  $merchantCode   Merchant code. Given by the Bank and unique to the Merchant.
     *  @param  string  $terminal       Terminal number. Usually 1.
     *  @param  string  $currencyCode   See your bank's manual. 978 usually corresponds to euros.
     *  @param  string  $secret         Your merchant secret. Unique to your virtual POS, given by the bank.
     *  @param  string  $callbackUrl    The url that the Bank will send the transaction details to once the user pays through them.
     *  @param  string  $okUrl          Customers will be redirected to this route if their payment is successful.
     *  @param  sting   $koUrl          Customers will be sent to this url if an error occurs in their payment (or they cancel the transaction)
     *  @return POSRequestFactory
     */
    public function __construct($merchantName, $merchantCode, $terminal, $currencyCode, $secret, $callbackUrl, $okUrl, $koUrl)
    {
        $this->merchantName = $merchantName;
        $this->merchantCode = $merchantCode;
        $this->terminal     = $terminal;
        $this->currencyCode = $currencyCode;
        $this->secret       = $secret;
        $this->callbackUrl  = $callbackUrl;
        $this->okUrl        = $okUrl;
        $this->koUrl        = $koUrl;
    }

    /**
     *  Creates a new POS request
     *
     *  @param  string  $transactionType
     *  @param  float   $amount
     *  @param  string  $description    Optional. Description of the goods or services to be acquired once the payment is made.
     *  @param  string  $currencyCode   Optional. If none give, default value will be used.
     *  @param  string  $order          Optional. Payment order number. If none given one will be generated.
     *  @param  string  $metadata       Optional. Metada to include in the bank's callback. Will remain unchanged (customer_id, etc...)
     *  @return PaymentRequest
     */
    public function makeRequest($transactionType, $amount, $description = null, $currencyCode = null, $order = null, $metadata = null)
    {
        return new POSRequest(
            $transactionType,
            $this->merchantName,
            $this->merchantCode,
            $this->terminal,
            $currencyCode ?: $this->currencyCode,
            $this->secret,
            $this->callbackUrl,
            $this->okUrl,
            $this->koUrl,
            $this->amountToString($amount),
            $description,
            $this->generateOrderCode($order),
            $metadata);
    }

    /**
     *  Creates a new payment request
     *
     *  @param  float   $amount
     *  @param  string  $description    Optional. Description of the goods or services to be acquired once the payment is made.
     *  @param  string  $currencyCode   Optional. If none give, default value will be used.
     *  @param  string  $order          Optional. Payment order number. If none given one will be generated.
     *  @param  string  $metadata       Optional. Metada to include in the bank's callback. Will remain unchanged (customer_id, etc...)
     *  @return PaymentRequest
     */
    public function paymentRequest($amount, $description = null, $currencyCode = null, $order = null, $metadata = null)
    {
        return $this->request(
            '0',
            $amount,
            $description,
            $currencyCode,
            $order,
            $metadata
        );
    }

    /**
     *  Creates a new payment request
     *
     *  @param  float   $amount
     *  @param  string  $description    Optional. Description of the goods or services to be acquired once the payment is made.
     *  @param  string  $currencyCode   Optional. If none give, default value will be used.
     *  @param  string  $order          Optional. Payment order number. If none given one will be generated.
     *  @param  string  $metadata       Optional. Metada to include in the bank's callback. Will remain unchanged (customer_id, etc...)
     *  @return PaymentRequest
     */
    public function returnRequest($amount, $description = null, $currencyCode = null, $order = null, $metadata = null)
    {
        return $this->request(
            '3',
            $amount,
            $description,
            $currencyCode,
            $order,
            $metadata
        );
    }

}
