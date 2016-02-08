<?php

namespace Waavi\Redsys;

class POSRequest
{
    protected $merchantAttributes;



    public function __construct($transactionType, $merchantName, $merchantCode, $terminal, $currencyCode, $secret, $callbackUrl, $okUrl, $koUrl, $amount, $description, $order, $metadata)
    {
        $this->attributes = [
            'Ds_SignatureVersion' => 'HMAC_SHA256_V1',
            'DS_MERCHANT_TRANSACTIONTYPE' => $transactionType,
            'DS_MERCHANT_TERMINAL' => $terminal,
            'DS_MERCHANT_MERCHANTNAME' => 
            'DS_MERCHANT_MERCHANTCODE' => $merchantCode,
            'DS_MERCHANT_AMOUNT'          => $this->amountToString($amount),
            'DS_MERCHANT_ORDER'           => $this->generateOrderNum($order),

        ];
        $this->transactionType = $transactionType;
        $this->merchantName    = $merchantName;
        $this->merchantCode    = $merchantCode;
    }

    /**
     *  Format the price as zero padding 12N string. The two last digits are decimal positions of the given amount.
     *  Examples:
     *    - 9.95  => 000000000995
     *    - 12    => 000000001200
     *
     *  @return string Formatted price.
     */
    public function amountToString($amount)
    {
        return intval($amount * 100);
    }

    /**
     *  Reverse the formatting done through amountToString.
     *
     *  @return string price.
     */
    public function amountToFloat($amount)
    {
        return number_format(intval($amount) / 100, 2, '.', '');
    }
}
