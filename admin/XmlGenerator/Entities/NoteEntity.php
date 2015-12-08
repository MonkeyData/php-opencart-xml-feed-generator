<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;


/**
 * Class NoteEntity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 * @author MD Developers
 */
class NoteEntity extends Entity {

    /**
     * @param mixed $value
     */
    public function __construct($value = null) {
        parent::__construct("NOTE", self::DT_string, $value);
    }
    
    protected function setting() {
        $this->setRequired(self::RequeredNo);
        $this->setMaxLength(1000);
    }
}
