<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans;


/**
 * Class PaymentList
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans
 * @author MD Developers
 */
class PaymentList extends BeansList {

    /**
     * @param Beans $item
     * @throws \MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Exceptions\MonkeyDataMissingInputException
     */
    public function addBean(Beans $item) {
        $item->validate();
        $this->add($item);
    }
    
    /**
     * 
     * @return PaymentBean
     */
    public function current() {
        return parent::current();
    }
    
    /**
     * 
     * @param int $id
     * @return PaymentBean
     */
    public function getBeanById($id) {
        return parent::getBeanById($id);
    }
}
