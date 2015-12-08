<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans;


/**
 * Description of ShippingBean
 *
 * @author Fingarfae
 */
class ShippingBean extends Beans {

    /**
     * @var string|null
     */
    protected $shipping_name = null;

    /**
     * @var float|null // TODO: Ask
     */
    protected $shipping_price = null;

    /**
     * @var float|null // TODO: Ask
     */
    protected $shipping_price_without_vat = null;

    /**
     * @return null|string
     */
    public function getShipping_name() {
        return $this->shipping_name;
    }

    /**
     * @return float|null
     */
    public function getShipping_price() {
        return $this->shipping_price;
    }

    /**
     * @return float|null
     */
    public function getShipping_price_without_vat() {
        return $this->shipping_price_without_vat;
    }

    /**
     * @param $shipping_name
     * @return ShippingBean $this
     */
    public function setShipping_name($shipping_name) {
        $this->shipping_name = $shipping_name;
        return $this;
    }

    /**
     * @param $shipping_price
     * @return ShippingBean $this
     */
    public function setShipping_price($shipping_price) {
        $this->shipping_price = $shipping_price;
        return $this;
    }

    /**
     * @param $shipping_price_without_vat
     * @return ShippingBean $this
     */
    public function setShipping_price_without_vat($shipping_price_without_vat) {
        $this->shipping_price_without_vat = $shipping_price_without_vat;
        return $this;
    }
}
