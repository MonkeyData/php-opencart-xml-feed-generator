<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;


/**
 * Class ShopIdEntity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 * @author MD Developers
 */
class ShopIdEntity extends Entity {

    /**
     * @param mixed $value
     */
    public function __construct($value = null) {
        parent::__construct("SHOP_ID", self::DT_string, $value);
    }

    protected function setting() {
        $this->setMaxLength(50);
        $this->setRequired(self::RequeredNo);
    }
}
