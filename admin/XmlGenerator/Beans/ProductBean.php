<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans;


/**
 * Class ProductBean
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans
 * @author MD Developers
 */
class ProductBean extends Beans {

    /**
     * @var string|null
     */
    protected $product_name = null;

    /**
     * @var int|null // TODO: Ask
     */
    protected $product_count = null;

    /**
     * @var float|null // TODO: Ask
     */
    protected $product_price = null;

    /**
     * @var float|null // TODO: Ask
     */
    protected $product_price_without_vat = null;

    /**
     * @var float|null // TODO: Ask
     */
    protected $product_purchase_price = null;

    /**
     * @var int|null // TODO: Ask
     */
    protected $category_id = null;

    /**
     * @return null|string
     */
    public function getProduct_name() {
        return $this->product_name;
    }

    /**
     * @return int|null
     */
    public function getProduct_count() {
        return $this->product_count;
    }

    /**
     * @return float|null
     */
    public function getProduct_price() {
        return $this->product_price;
    }

    /**
     * @return float|null
     */
    public function getProduct_price_without_vat() {
        return $this->product_price_without_vat;
    }

    /**
     * @return float|null
     */
    public function getProduct_purchase_price() {
        return $this->product_purchase_price;
    }

    /**
     * @return int|null
     */
    public function getCategory_id() {
        return $this->category_id;
    }

    /**
     * @param $product_name
     * @return ProductBean $this
     */
    public function setProduct_name($product_name) {
        $this->product_name = $product_name;
        return $this;
    }

    /**
     * @param $product_count
     * @return ProductBean $this
     */
    public function setProduct_count($product_count) {
        $this->product_count = $product_count;
        return $this;
    }

    /**
     * @param $product_price
     * @return ProductBean $this
     */
    public function setProduct_price($product_price) {
        $this->product_price = $product_price;
        return $this;
    }

    /**
     * @param $product_price_without_vat
     * @return ProductBean $this
     */
    public function setProduct_price_without_vat($product_price_without_vat) {
        $this->product_price_without_vat = $product_price_without_vat;
        return $this;
    }

    /**
     * @param $product_purchase_price
     * @return ProductBean $this
     */
    public function setProduct_purchase_price($product_purchase_price) {
        $this->product_purchase_price = $product_purchase_price;
        return $this;
    }

    /**
     * @param $category_id
     * @return ProductBean $this
     */
    public function setCategory_id($category_id) {
        $this->category_id = $category_id;
        return $this;
    }
}
