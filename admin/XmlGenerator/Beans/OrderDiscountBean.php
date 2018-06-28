<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans;


/**
 * Class OrderDiscountBean
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans
 * @author MD Developers
 */
class OrderDiscountBean extends Beans {
    /**
     * @var DiscountList $discountList
     */
    protected $discountList;

    public function __construct($data = null) {
        parent::__construct($data);
    }

    /**
     * @return DiscountList
     */
    public function getDiscountList() {
        return $this->discountList;
    }

    /**
     * @param DiscountList $discountList
     * @return OrderDiscountBean
     */
    public function setDiscountList($discountList) {
        $this->discountList = $discountList;
        return $this;
    }
}