<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;


/**
 * Class ShopNameEntity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 * @author MD Developers
 */
class ShopNameEntity extends Entity {

    /**
     * @param mixed $value
     */
    public function __construct($value = null) {
        parent::__construct("SHOP_NAME", self::DT_string, $value);
    }
    
    protected function setting() {
        $this->setMaxLength(100);
        $this->setRequired(self::RequeredNo);
    }

}
