<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans;


/**
 * Class OrderList
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans
 * @author MD Developers
 */
class OrderList extends BeansList {

    /**
     * @param Beans $item
     * @throws \MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Exceptions\MonkeyDataMissingInputException
     */
    public function addBean(Beans $item) {
        $item->validate();
        $this->add($item);
    }
    
    /**
     * @return OrderBean
     */
    public function current() {
        return parent::current();
    }
    
    /**
     * @param int $id
     * @return OrderBean
     */
    public function getBeanById($id) {
        return parent::getBeanById($id);
    }
}
