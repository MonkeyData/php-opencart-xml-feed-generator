<?php

use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Generate\XmlGenerator;


/**
 * Class MonkeyDataExampleXmlGenerator
 *
 * Example class
 *
 * @author MD Developers
 */
class MonkeyDataExampleXmlGenerator extends XmlGenerator {

    /**
     * @return MonkeyDataXmlModel
     */
    public function getModel() {
        return new MonkeyDataXmlModel();
    }
}