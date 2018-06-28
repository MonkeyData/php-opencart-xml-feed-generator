<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans;


/**
 * Class OrderDiscountList
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans
 * @author MD Developers
 */
class OrderDiscountList extends BeansList {
    /**
     * @param Beans $item
     */
    public function addBean(Beans $item) {
        $this->add($item);
    }
}