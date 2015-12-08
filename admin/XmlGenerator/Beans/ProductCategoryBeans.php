<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans;


/**
 * Class ProductCategoryBean
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans
 * @author MD Developers
 */
class ProductCategoryBeans extends Beans {

    /**
     * @var CategoryList
     */
    protected $category_list;

    /**
     * @return CategoryList
     */
    public function getCategoryList() {
        return $this->category_list;
    }

    /**
     * @param CategoryList $categoryList
     * @return ProductCategoryBeans
     */
    public function setCategoryList(CategoryList $categoryList) {
        $this->category_list = $categoryList;
        return $this;
    }
}