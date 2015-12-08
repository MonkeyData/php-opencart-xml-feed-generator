<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans;


/**
 * Class OrderProductsList
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans
 * @author MD Developers
 */
class OrderProductsList extends BeansList {

    /**
     * @param Beans $item
     */
    public function addBean(Beans $item) {
        $this->add($item);
    }
    
    /**
     * @return OrderProductBeans
     */
    public function current() {
        return parent::current();
    }
    
    /**
     * @param int $id
     * @return OrderProductBeans
     */
    public function getBeanById($id) {
        return parent::getBeanById($id);
    }
}
