<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;


/**
 * Class OrderStatusIdEntity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 * @author MD Developers
 */
class OrderStatusIdEntity extends Entity {

    /**
     * @param mixed $value
     */
    public function __construct($value = null) {
        parent::__construct("ORDER_STATUS_ID", self::DT_string, $value);
    }

    protected function setting() {
        $this->setRequired(self::RequeredYes);
        $this->setMaxLength(50);
    }
}
