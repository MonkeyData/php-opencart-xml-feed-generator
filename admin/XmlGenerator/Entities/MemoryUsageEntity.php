<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;


/**
 * Class MemoryUsageEntity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 * @author MD Developers
 */
class MemoryUsageEntity extends Entity {

    /**
     * @param mixed $value
     */
    public function __construct($value = null) {
        parent::__construct("MEMORY_USAGE", Entity::DT_string, $value);
    }

    protected function setting() {
        $this->setRequired(self::RequeredNo);
    }
}
