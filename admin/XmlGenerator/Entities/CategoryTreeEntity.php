<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;

use Exception;


/**
 * Class CategoryTreeEntity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 * @author MD Developers
 */
class CategoryTreeEntity extends Entity {

    /**
     * @param mixed $value
     */
    public function __construct($value = null) {
        parent::__construct("CATEGORY_TREE", self::DT_list, $value);
    }
    
    protected function setting() {
        $this->setRequired(self::RequeredNo);
    }

    /**
     * @param Entity $item
     * @throws Exception
     */
    public function addItem($item) {
        if (!($item instanceof CategoryEntity)) {
            throw new Exception("Unexpected Entity");
        }
        parent::addItem($item);
    }
}
