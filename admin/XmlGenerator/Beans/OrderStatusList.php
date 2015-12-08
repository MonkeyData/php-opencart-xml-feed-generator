<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans;


/**
 * Class OrderStatusList
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans
 * @author MD Developers
 */
class OrderStatusList extends BeansList {

    /**
     * @param Beans $item
     * @throws \MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Exceptions\MonkeyDataMissingInputException
     */
    public function addBean(Beans $item) {
        $item->validate();
        $this->add($item);
    }

    /**
     * @return OrderStatusList
     */
    public function current() {
        return parent::current();
    }
    
    /**
     * 
     * @param int $id
     * @return OrderStatusList
     */
    public function getBeanById($id) {
        return parent::getBeanById($id);
    }
}
