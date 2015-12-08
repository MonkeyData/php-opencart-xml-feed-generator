<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans;


/**
 * Class OrderProductBeans
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans
 * @author MD Developers
 */
class OrderProductBeans extends Beans {

    /**
     * @var ProductsList
     */
    protected $product_list;

    /**
     * @return ProductsList
     */
    public function getProduct_list() {
        return $this->product_list;
    }

    /**
     * @param ProductsList $product_list
     * @return $this
     */
    public function setProduct_list(ProductsList $product_list) {
        $this->product_list = $product_list;
        return $this;
    }
}
