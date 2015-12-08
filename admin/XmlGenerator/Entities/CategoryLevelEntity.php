<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;


/**
 * Class CategoryLevelEntity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 * @author MD Developers
 */
class CategoryLevelEntity extends Entity {

    /**
     * @param mixed $value
     */
    public function __construct($value = null) {
        parent::__construct("CATEGORY_LEVEL", self::DT_int, $value);
    }
    
    protected function setting() {
        $this->setRequired(self::RequeredYes);
        $this->setMaxLength(3);
    }
}