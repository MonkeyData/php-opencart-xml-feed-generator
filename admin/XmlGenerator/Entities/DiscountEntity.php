<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;


/**
 * Class DiscountEntity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 * @author MD Developers
 */
class DiscountEntity extends Entity {
    /**
     * DiscountEntity constructor.
     */
    public function __construct() {
        parent::__construct('DISCOUNT', self::DT_list);
    }

    protected function setting() {
    }
}