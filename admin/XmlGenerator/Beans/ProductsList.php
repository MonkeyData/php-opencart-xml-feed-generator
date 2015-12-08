<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans;


/**
 * Class ProductsList
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans
 * @author MD Developers
 */
class ProductsList extends BeansList {

    /**
     * @param Beans $item
     * @throws \MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Exceptions\MonkeyDataMissingInputException
     */
    public function addBean(Beans $item) {
        $item->validate();
        $this->add($item);
    }
    
    /**
     * @return ProductBean
     */
    public function current() {
        return parent::current();
    }
    
    /**
     * @param int $id
     * @return ProductBean
     */
    public function getBeanById($id) {
        return parent::getBeanById($id);
    }
}
