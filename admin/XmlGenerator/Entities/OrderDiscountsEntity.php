<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;


/**
 * Class OrderDiscountsEntity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 * @author MD Developers
 */
class OrderDiscountsEntity extends Entity {
    /**
     * OrderDiscountsEntity constructor.
     */
    public function __construct() {
        parent::__construct('DISCOUNTS', self::DT_list);
    }

    protected function setting() {
    }
}