<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;


/**
 * Class CategoryIdEntity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 * @author MD Developers
 */
class CategoryIdEntity extends Entity {

    /**
     * @param mixed $value
     */
    public function __construct($value = null) {
        parent::__construct("CATEGORY_ID", self::DT_string, $value);
    }

    protected function setting() {
        $this->setRequired(self::RequeredYes);
        $this->setMaxLength(50);
    }
}
