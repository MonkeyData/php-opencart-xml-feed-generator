<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans;


/**
 * Class DiscountList
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans
 * @author MD Developers
 */
class DiscountList extends BeansList {
    /**
     * @param Beans $item
     */
    public function addBean(Beans $item) {
        $this->add($item);
    }
}