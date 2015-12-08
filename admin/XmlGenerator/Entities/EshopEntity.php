<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;

use Exception;


/**
 * Class EshopEntity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 * @author MD Developers
 */
class EshopEntity extends Entity {

    /**
     * @param mixed $value
     */
    public function __construct($value = null) {
        parent::__construct("ESHOP", Entity::DT_list, $value);
    }

    protected function setting() {
        $this->setMaxLength(234);
        $this->setRequired(self::RequeredNo);
    }

    /**
     * @param EshopEntity $item
     * @throws Exception
     */
    public function addItem($item) {
        if (!($item instanceof ShopOrderEntity)) {
            throw new Exception("Unexpected Entity");
        }
        parent::addItem($item);
    }
}
