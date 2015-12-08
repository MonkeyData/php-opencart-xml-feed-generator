<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;

use Exception;


/**
 * Class CategoryEntity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 * @author MD Developers
 */
class CategoryEntity extends Entity {

    /**
     * @param mixed $value
     */
    public function __construct($value = null) {
        parent::__construct("CATEGORY", self::DT_list, $value);
    }

    protected function setting() {
        $this->setRequired(self::RequeredYes);
    }

    public function addItem($item) {
        $class_name = get_class($item);
        $namespace = "MonkeyData\\EshopXmlFeedGenerator\\XmlGenerator\\Entities\\";
        if (!in_array($class_name, array("{$namespace}CategoryIdEntity", "{$namespace}CategoryNameEntity", "{$namespace}CategoryLevelEntity"))) {
            throw new Exception("Unexpected Entity");
        }
        parent::addItem($item);
    }
}
