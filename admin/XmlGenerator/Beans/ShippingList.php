<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans;


/**
 * Class ShippingList
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans
 * @author MD Developers
 */
class ShippingList extends BeansList {

    /**
     * @param Beans $item
     * @throws \MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Exceptions\MonkeyDataMissingInputException
     */
    public function addBean(Beans $item) {
        $item->validate();
        $this->add($item);
    }
    
    /**
     * @return ShippingBean
     */
    public function current() {
        return parent::current();
    }
    
    /**
     * @param int $id
     * @return ShippingBean
     */
    public function getBeanById($id) {
        return parent::getBeanById($id);
    }
}
