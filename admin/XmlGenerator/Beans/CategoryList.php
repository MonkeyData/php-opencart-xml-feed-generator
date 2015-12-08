<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans;


/**
 * Class CategoryList
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans
 * @author MD Developers
 */
class CategoryList extends BeansList {

    /**
     * @param Beans $item
     * @throws \MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Exceptions\MonkeyDataMissingInputException
     */
    public function addBean(Beans $item) {
        $item->validate();
        $this->add($item);
    }
    
    /**
     * @return CategoryBean
     */
    public function current() {
        return parent::current();
    }
    
    /**
     * @param int $id
     * @return CategoryBean
     */
    public function getBeanById($id){
        return parent::getBeanById($id);
    }
}
