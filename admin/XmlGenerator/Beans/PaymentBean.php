<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans;


/**
 * Class PaymentBean
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans
 * @author MD Developers
 */
class PaymentBean extends Beans {

    /**
     * @var string|null
     */
    protected $payment_name = null;

    /**
     * @var float|null // TODO: Ask
     */
    protected $payment_price = null;

    /**
     * @var float|null // TODO: Ask
     */
    protected $payment_price_without_vat = null;

    /**
     * @return null|string
     */
    public function getPayment_name() {
        return $this->payment_name;
    }

    /**
     * @return float|null
     */
    public function getPayment_price() {
        return $this->payment_price;
    }

    /**
     * @return float|null
     */
    public function getPayment_price_without_vat() {
        return $this->payment_price_without_vat;
    }

    /**
     * @param $payment_name
     * @return PaymentBean $this
     */
    public function setPayment_name($payment_name) {
        $this->payment_name = $payment_name;
        return $this;
    }

    /**
     * @param $payment_price
     * @return PaymentBean $this
     */
    public function setPayment_price($payment_price) {
        $this->payment_price = $payment_price;
        return $this;
    }

    /**
     * @param $payment_price_without_vat
     * @return PaymentBean $this
     */
    public function setPayment_price_without_vat($payment_price_without_vat) {
        $this->payment_price_without_vat = $payment_price_without_vat;
        return $this;
    }
}
