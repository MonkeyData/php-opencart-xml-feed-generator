<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans;


/**
 * Class OrderBean
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans
 * @author MD Developers
 */
class OrderBean extends Beans {

    /**
     * @var int|null // TODO: Ask
     */
    protected $shop_id = null;

    /**
     * @var string|null
     */
    protected $shop_name = null;

    /**
     * @var int|null // TODO: Ask
     */
    protected $order_status_id = null;

    /**
     * @var string|null
     */
    protected $date_created = null;

    /**
     * @var string|null
     */
    protected $date_updated = null;

    /**
     * @var int|null // TODO: Ask
     */
    protected $currency_id = null;

    /**
     * @var string|null // TODO: Ask
     */
    protected $currency = null;

    /**
     * @var int|null // TODO: Ask
     */
    protected $payment_id = null;

    /**
     * @var int|null // TODO: Ask
     */
    protected $shipping_id = null;

    /**
     * @var string|null // TODO: Ask
     */
    protected $note = null;

    /**
     * @var float|null // TODO: Ask
     */
    protected $price = null;

    /**
     * @var float|null // TODO: Ask
     */
    protected $price_without_vat = null;

    /**
     * @var int|null // TODO: Ask
     */
    protected $customer_id = null;

    /**
     * @return int|null
     */
    public function getShop_id() {
        return $this->shop_id;
    }

    /**
     * @return null|string
     */
    public function getShop_name() {
        return $this->shop_name;
    }

    /**
     * @return int|null
     */
    public function getOrder_status_id() {
        return $this->order_status_id;
    }

    /**
     * @return null|string
     */
    public function getDate_created() {
        return $this->date_created;
    }

    /**
     * @return null|string
     */
    public function getDate_updated() {
        return $this->date_updated;
    }

    /**
     * @return int|null
     */
    public function getCurrency_id() {
        return $this->currency_id;
    }

    /**
     * @return null|string
     */
    public function getCurrency() {
        return $this->currency;
    }

    /**
     * @return int|null
     */
    public function getPayment_id() {
        return $this->payment_id;
    }

    /**
     * @return int|null
     */
    public function getShipping_id() {
        return $this->shipping_id;
    }

    /**
     * @return null|string
     */
    public function getNote() {
        return $this->note;
    }

    /**
     * @return float|null
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * @return float|null
     */
    public function getPrice_without_vat() {
        return $this->price_without_vat;
    }

    /**
     * @return int|null
     */
    public function getCustomer_id() {
        return $this->customer_id;
    }

    /**
     * @param $shop_id
     * @return OrderBean $this
     */
    public function setShop_id($shop_id) {
        $this->shop_id = $shop_id;
        return $this;
    }

    /**
     * @param $shop_name
     * @return OrderBean $this
     */
    public function setShop_name($shop_name) {
        $this->shop_name = $shop_name;
        return $this;
    }

    /**
     * @param $order_status_id
     * @return OrderBean $this
     */
    public function setOrder_status_id($order_status_id) {
        $this->order_status_id = $order_status_id;
        return $this;
    }

    /**
     * @param $date_created
     * @return OrderBean $this
     */
    public function setDate_created($date_created) {
        $this->date_created = $date_created;
        return $this;
    }

    /**
     * @param $date_updated
     * @return OrderBean $this
     */
    public function setDate_updated($date_updated) {
        $this->date_updated = $date_updated;
        return $this;
    }

    /**
     * @param $currency_id
     * @return OrderBean $this
     */
    public function setCurrency_id($currency_id) {
        $this->currency_id = $currency_id;
        return $this;
    }

    /**
     * @param $currency
     * @return OrderBean $this
     */
    public function setCurrency($currency) {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @param $payment_id
     * @return OrderBean $this
     */
    public function setPayment_id($payment_id) {
        $this->payment_id = $payment_id;
        return $this;
    }

    /**
     * @param $shipping_id
     * @return OrderBean $this
     */
    public function setShipping_id($shipping_id) {
        $this->shipping_id = $shipping_id;
        return $this;
    }

    /**
     * @param $note
     * @return OrderBean $this
     */
    public function setNote($note) {
        $this->note = $note;
        return $this;
    }

    /**
     * @param $price
     * @return OrderBean $this
     */
    public function setPrice($price) {
        $this->price = $price;
        return $this;
    }

    /**
     * @param $price_without_vat
     * @return OrderBean $this
     */
    public function setPrice_without_vat($price_without_vat) {
        $this->price_without_vat = $price_without_vat;
        return $this;
    }

    /**
     * @param $customer_id
     * @return OrderBean $this
     */
    public function setCustomer_id($customer_id) {
        $this->customer_id = $customer_id;
        return $this;
    }
}
