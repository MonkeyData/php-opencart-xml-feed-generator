<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans;


/**
 * Class OrderProductsList
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans
 * @author MD Developers
 */
class ProductCategoriesList extends BeansList {

    /**
     * @param Beans $item
     */
    public function addBean(Beans $item) {
        $this->add($item);
    }

    /**
     * @return ProductCategoriesList
     */
    public function current() {
        return parent::current();
    }

    /**
     * @param int $id
     * @return ProductCategoryBeans
     */
    public function getBeanById($id) {
        return parent::getBeanById($id);
    }
}
