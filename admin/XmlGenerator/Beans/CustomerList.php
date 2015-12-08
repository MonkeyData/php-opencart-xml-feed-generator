<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans;


/**
 * Class CustomerList
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans
 * @author MD Developers
 */
class CustomerList extends BeansList {

    /**
     * @param Beans $item
     * @throws \MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Exceptions\MonkeyDataMissingInputException
     */
    public function addBean(Beans $item) {
        $item->validate();
        $this->add($item);
    }
    
    /**
     * @return CustomerBean
     */
    public function current() {
        return parent::current();
    }
    
    /**
     * @param int $id
     * @return CustomerBean
     */
    public function getBeanById($id) {
        return parent::getBeanById($id);
    }
}
