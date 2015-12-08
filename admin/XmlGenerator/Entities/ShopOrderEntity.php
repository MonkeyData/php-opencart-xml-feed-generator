<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;


/**
 * Class ShopOrderEntity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 */
class ShopOrderEntity extends Entity {

    /**
     * @param mixed $value
     */
    public function __construct($value = null) {
        parent::__construct("SHOP_ORDER", self::DT_list, $value);
    }
    
    protected function setting() {}
}
